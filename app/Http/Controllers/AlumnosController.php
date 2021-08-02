<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alumnos;
use App\Models\MesCobrado;
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

        $alumnos = DB::table( 'alumnos as a' )
                    ->select(DB::raw('a.id, a.nombre, a.grado, a.acudiente, a.telefono, a.deuda, concat(max(mc.mes_id), \'-\', mc.year) as mes') )
                    ->join( 'mes_cobrados as mc', 'mc.alumno_id', '=', 'a.id')
                    ->groupBy( 'a.id', 'a.grado', 'mc.year', 'a.nombre', 'a.acudiente', 'a.telefono', 'a.deuda' )
                    ->get();

        return $alumnos;

    }
}
