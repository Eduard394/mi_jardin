<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alumnos;
use App\Models\MesCobrado;
use App\Models\Pagos;
use DateTime;
use Illuminate\Support\Facades\DB;

class AlumnosController extends Controller
{
    private $alumno;
    private $mesCobrado;

    public function __construct(Alumnos $alumno)
    {
        $this->alumno      = new Alumnos();
        $this->mesCobrado  = new MesCobrado();
        //$this->middleware('auth');
    }

    public function show(Alumnos $alumno){

        $al = Alumnos::find( $alumno->id );

        $alumnos = DB::table( 'alumnos as a' )
                    ->select( 'a.id', 'a.nombre' )
                    ->orderBy( 'a.nombre', 'ASC' )
                    ->get();
        
        $items = DB::table( 'items as i' )
                    ->select( '*' )
                    ->get();
        return view( 'Alumnos.index', compact( 'alumnos', 'items', 'al' ) );
    }

    public function index(){

        $alumnos = DB::table('alumnos as a')
                    ->select('a.id', 'a.nombre')->orderBy('a.nombre', 'ASC')
                    ->get();
        
        $items = DB::table('items as i')
                    ->select('*')
                    ->get();

        $al = '';

    	return view( 'Alumnos.index', compact('alumnos', 'items', 'al') );
    }

    public function lista(){
        return view('Alumnos.lista');
    }

    public function crear(Request $request) {
    
        $data     = $request->all();

        $deuda = 0;

        if ( $data['matricula'] )
            $deuda += $data['matricula'];

        if ( $data['materiales'] )
            $deuda += $data['materiales'];

        if ( $data['pension'] )
            $deuda += $data['pension'];

        if ( $data['seguro'] )
            $deuda += $data['seguro'];
        
        if ( $data['lonchera'] )
            $deuda += $data['lonchera_valor'];
        else
            $data['lonchera_valor'] = 0;

        $data[ 'deuda' ] = $deuda;
   
    	$result = $this->alumno->crear( $data );

        if ( $result ) {

            if ( $data[ 'hermano' ] )
                $edit = $this->alumno->editarHermano( $data[ 'hermano_id' ], $result );
            
            return $this->mesCobrado->crear( $result, $data['mesInicio'], $data['anoInicio'] );

        }
        
    }

    public function update(Request $request) {
    
        $data     = $request->all();

        if ( !$data['lonchera'] )
            $data['lonchera_valor'] = 0;
   
    	$result = $this->alumno->editar( $data );
        
        if ( $result ) {

            if ( $data[ 'hermano' ] )
                return $this->alumno->editarHermano( $data[ 'hermano_id' ], $result );
            
        }
        
    }

    public function getAlumno(Request $request) {
    
        $data     = $request->all();
        $alumno   = Alumnos::find( $data['alumno_id'] );
        return $alumno;

    }

    public function getAlumnos() {

        // $alumnos = DB::table( 'alumnos as a' )
        //             ->select(DB::raw('a.id, a.nombre, a.grado, a.acudiente, a.telefono, a.deuda, concat(max(mc.mes_id), \'-\', mc.year) as mes') )
        //             ->join( 'mes_cobrados as mc', 'mc.alumno_id', '=', 'a.id')
        //             ->groupBy( 'a.id', 'a.grado', 'mc.year', 'a.nombre', 'a.acudiente', 'a.telefono', 'a.deuda' )
        //             ->get();

        $alumnos = DB::table( 'alumnos as a' )
                    ->select(DB::raw('a.id, a.nombre, a.grado, a.acudiente, a.telefono, a.deuda') )
                    ->get();

        return $alumnos;

    }

    public function eliminar(Request $request) {

        $data     = $request->all();

        $alumno   = DB::table( 'pagos as p' )
                    ->select( '*' )
                    ->where( 'p.alumno_id', $data[ 'alumno_id' ] )
                    ->get();

        if ( count( $alumno ) == 0 ) {
            return $this->alumno->eliminar( $data[ 'alumno_id' ] );
        }
        else {
            $nombre['error'] = 'Este alumno tiene pagos ya realizados';
            return $nombre;
        }
        
    }

    public function indexDeuda(){

        $alumnos    = DB::table( 'mes_cobrados as mc' )
                    ->select( DB::raw( 'max(mc.id)as id, mc.alumno_id' ) )
                    ->groupBy( 'mc.alumno_id' )
                    ->get();
        
        foreach( $alumnos as $key => $value ){

            $alumnos[ $key ] = $this->getDataAlumnos( $value->id );
       
            if ( $alumnos[ $key ]->meses < 0 || ( $alumnos[ $key ]->deuda == 0 && $alumnos[ $key ]->meses == 0 ) ){
                unset( $alumnos[ $key ] );
            } else {

                if ( $alumnos[ $key ]->meses > 0 ) {

                    $deudaP = $alumnos[ $key ]->pension * $alumnos[ $key ]->meses;
                    $deudaL = $alumnos[ $key ]->lonchera_valor * $alumnos[ $key ]->meses;

                    $alumnos[ $key ]->deuda_pension  += $deudaP;
                    $alumnos[ $key ]->deuda_lonchera += $deudaL;
                    $alumnos[ $key ]->deuda          += $deudaP + $deudaL;

                }
                
            }

        }

    	return view( 'Alumnos.deudores', compact( 'alumnos' ) );
        
    }

    private function getDataAlumnos( $alumnoId ) {

        $data   = DB::table( 'mes_cobrados as mc' )
                ->select( DB::raw( '*, extract(year from age( concat(date_part(\'year\', now()), \'-\', date_part(\'month\', now()), \'-01\')::DATE, concat( mc."year", \'-\', mc.mes_id, \'-01\' )::DATE ) ) * 12 + extract(month from age( concat(date_part(\'year\', now()), \'-\', date_part(\'month\', now()), \'-01\')::DATE, concat( mc."year", \'-\', mc.mes_id, \'-01\' )::DATE ) ) as meses' ) )
                ->join( 'alumnos as a', 'mc.alumno_id', '=', 'a.id')
                ->where( 'mc.id', $alumnoId )
                ->get();

        return $data[0];

    }
}
