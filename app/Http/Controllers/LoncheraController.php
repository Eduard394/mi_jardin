<?php

namespace App\Http\Controllers;

use App\Models\Alumnos;
use App\Models\Lonchera;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoncheraController extends Controller
{
    private $lonchera;
    private $alumno;

    public function __construct(Lonchera $lonchera)
    {
        $this->lonchera     = new Lonchera();
        $this->alumno       = new Alumnos();
        //$this->middleware('auth');
    }

    public function index(){
        $alumnos = DB::table('alumnos as a')
                    ->select('a.id', 'a.nombre')->orderBy('a.nombre', 'ASC')
                    ->get();
    	return view('Loncheras.index', compact('alumnos'));
    }


    public function getLonchera( Request $request ){

        $data     = $request->all();

        $datos = DB::table('loncheras as l')
                    ->select('l.id', 'l.fecha_ingreso', 'l.fecha_retiro')
                    ->where('l.alumno_id', $data['alumno_id'])
                    ->get();
                    
    	return $datos;

    }

    public function createLonchera(Request $request) {
    
        $data = $request->all();

        if ( empty( $data[ 'lonchera_id' ] ) ) {

            $resp = $this->lonchera->crear( $data );

            if ( $resp ) {

                $deuda = DB::table( 'alumnos as a' )
                            ->select( 'a.deuda' )
                            ->where( 'a.id', $data['alumno_id'] )
                            ->get();
                
                // $valor = DB::table( 'valor_loncheras as v' )
                //             ->select( 'v.id', 'v.valor_lonchera' )
                //             ->get();

                // $data['deuda'] = $deuda[0]->deuda + $valor[0]->valor_lonchera;
                $data['deuda'] = $deuda[0]->deuda + $data[ 'valor' ];
                
                return $this->alumno->editarDeuda( $data, $data['id'] );

            }
        } else
            return $this->lonchera->editar( $data );
        
    }
    
}
