<?php

namespace App\Http\Controllers;

use App\Models\Reporte;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReporteController extends Controller
{

    private $reporte;

    public function __construct(Reporte $reporte)
    {
        $this->reporte     = new Reporte();
        //$this->middleware('auth');
    }

    public function index(){
    	return view('Reportes.index');
    }

    public function getInfo() {

        // $data['discriminado'] = DB::table( 'pagos as p' )
        //             ->select(DB::raw('sum(p.pago_matricula, p.pago_pension, p.pago_lonchera, p.pago_seguro, p.pago_matricula) as pagos, a.grado'))
        //             ->join( 'alumnos as a', 'p.alumno_id', '=', 'a.id')
        //             ->groupBy( 'a.grado' )
        //             ->get();

        $data['discriminado'] = DB::table( 'pagos as p' )
                    ->select(DB::raw('sum(p.pago_lonchera) as lonchera, sum(p.pago_materiales) as materiales,
                    sum(p.pago_matricula) as matricula, sum(p.pago_pension) as pension, sum(p.pago_seguro) as seguro'))
                    ->get();

        $data['saldo_grado'] = DB::table( 'pagos as p' )
                    ->select(DB::raw('sum(p.pago_matricula + p.pago_pension + p.pago_lonchera + p.pago_seguro + p.pago_matricula) as pagos, a.grado'))
                    ->join( 'alumnos as a', 'p.alumno_id', '=', 'a.id')
                    ->groupBy( 'a.grado' )
                    ->get();

        $data['saldo'] = DB::table( 'pagos as p' )
                    ->select(DB::raw('sum(p.pago_matricula + p.pago_pension + p.pago_lonchera + p.pago_seguro + p.pago_matricula) as Pagos, sum(a.deuda) as Deudas'))
                    ->join( 'alumnos as a', 'p.alumno_id', '=', 'a.id')
                    ->get();

        $data['cantidad_grado'] = DB::table( 'alumnos as a' )
                    ->select(DB::raw('count(a.id) as cantidad'), 'a.grado')
                    ->groupBy( 'a.grado' )
                    ->get();

        $data['cantidad_jornada'] = DB::table( 'alumnos as a' )
                    ->select(DB::raw('count(a.id) as cantidad'), 'a.jornada')
                    ->groupBy( 'a.jornada' )
                    ->get();

        $data['ingreso_mes'] = DB::table( 'pagos as p' )
                    ->select(DB::raw('sum(p.pago_matricula + p.pago_pension + p.pago_lonchera + p.pago_seguro + p.pago_matricula) as pagos, m.nombre, m.id'))
                    ->join( 'mes as m', 'p.mes_id', '=', 'm.id')
                    ->groupBy( 'm.nombre', 'm.id' )
                    ->orderBy( 'm.id' )
                    ->get();
                    
        return $data;
    }
}
