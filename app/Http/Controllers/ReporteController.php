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

        $data['discriminado'] = DB::table( 'pagos as p' )
                    ->select(DB::raw('sum(p.valor_pago) as pagos, a.grado'))
                    ->join( 'alumnos as a', 'p.alumno_id', '=', 'a.id')
                    ->groupBy( 'a.grado' )
                    ->get();

        $data['saldo_grado'] = DB::table( 'pagos as p' )
                    ->select(DB::raw('sum(p.valor_pago) as pagos, a.grado'))
                    ->join( 'alumnos as a', 'p.alumno_id', '=', 'a.id')
                    ->groupBy( 'a.grado' )
                    ->get();

        $data['saldo'] = DB::table( 'pagos as p' )
                    ->select(DB::raw('sum(p.valor_pago) as Pagos, sum(a.deuda) as Deudas'))
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
                    
        return $data;
    }
}
