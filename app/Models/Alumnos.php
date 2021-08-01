<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumnos extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'codigo',
        'periodo_entrada',
        'periodo_salida',
        'matricula',
        'materiales',
        'jornada',
        'fecha_ingreso',
        'fecha_retiro',
        'pension',
        'seguro',
        'grado',
        'acudiente',
        'telefono',
        'deuda'
    ];

    public function crear( $data ){

    	$alumno 			        = new Alumnos();
    	$alumno->nombre 	        = $data['nombre'];
    	$alumno->matricula 	        = $data['matricula'];
    	$alumno->materiales 	    = $data['materiales'];
    	$alumno->jornada 	        = $data['jornada'];
    	$alumno->fecha_ingreso 	    = $data['fecha_ingreso'];
        $alumno->fecha_retiro 	    = $data['fecha_retiro'];
    	$alumno->pension 	        = $data['pension'];
    	$alumno->seguro 	        = $data['seguro'];
    	$alumno->grado 	            = $data['grado'];
        $alumno->lonchera 	        = $data['lonchera'];
        $alumno->lonchera_valor 	= $data['lonchera_valor'];
        $alumno->hermano 	        = ( $data['hermano'] ) ? $data['hermano'] : false;
        $alumno->hermano_id 	    = ( $data['hermano_id'] != "NULL" ) ? $data['hermano_id'] : null;
        $alumno->descuento 	        = $data['descuento'];
        $alumno->deuda_matricula 	= $data['matricula'];
        $alumno->deuda_materiales 	= $data['materiales'];
        $alumno->deuda_pension 	    = $data['pension'];
    	$alumno->deuda_seguro 	    = $data['seguro'];
        $alumno->deuda_lonchera 	= $data['lonchera_valor'];
    	$alumno->acudiente 	        = $data['acudiente'];
        $alumno->telefono 	        = $data['telefono'];
        $alumno->correo 	        = $data['correo'];
        $alumno->deuda 	            = $data['deuda'];
    	$alumno->estado 	        = 1;

    	$alumno->save();        
        return $alumno->id;

    }

    public function editar( $data ){

    	$alumno 			        = Alumnos::find( $data['alumno_id'] );
    	$alumno->nombre 	        = $data['nombre'];
    	$alumno->matricula 	        = $data['matricula'];
    	$alumno->materiales 	    = $data['materiales'];
    	$alumno->jornada 	        = $data['jornada'];
    	$alumno->fecha_ingreso 	    = $data['fecha_ingreso'];
        $alumno->fecha_retiro 	    = $data['fecha_retiro'];
    	$alumno->pension 	        = $data['pension'];
    	$alumno->seguro 	        = $data['seguro'];
    	$alumno->grado 	            = $data['grado'];
        $alumno->lonchera 	        = $data['lonchera'];
        $alumno->lonchera_valor 	= $data['lonchera_valor'];
        $alumno->hermano 	        = $data['hermano']? $data['hermano'] : false;

        if ( $data['hermano'] )
            $alumno->hermano_id 	= ( $data['hermano_id'] != "NULL" ) ? $data['hermano_id'] : null;
        else 
            $alumno->hermano_id     = null;

        $alumno->descuento 	        = $data['descuento'];
    	$alumno->acudiente 	        = $data['acudiente'];
        $alumno->telefono 	        = $data['telefono'];
        $alumno->correo 	        = ( $data['correo'] != "" ) ? $data['correo'] : null;
    	$alumno->estado 	        = 1;

    	$alumno->save();        
        return $alumno->id;

    }

    public function editarHermano( $data, $id ){
        
    	$alumno 			        = Alumnos::find( $data );
        $alumno->hermano 	        = true;
        $alumno->hermano_id 	    = $id;

    	$alumno->save();        
        return $alumno->id;

    }

    public function editarDeuda ( $data, $id ) {

        $alumno                     = Alumnos::find( $id );
        $alumno->deuda              = $data['deuda'];
        $alumno->deuda_matricula 	= $data['p_matricula'];
        $alumno->deuda_pension 	    = $data['p_pension'];
        $alumno->deuda_lonchera 	= $data['p_lonchera'];
        $alumno->deuda_seguro 	    = $data['p_seguro'];
        $alumno->deuda_materiales   = $data['p_materiales'];

        $alumno->save();        
        return $alumno->deuda;

    }

    public function actualizarDeuda ( $data, $id ) {

        $alumno                     = Alumnos::find( $id );
        $alumno->deuda              = $data[0]->deuda;
        $alumno->deuda_pension 	    = $data[0]->pension;
        $alumno->deuda_lonchera 	= $data[0]->lonchera_valor;

        $alumno->save();        
        return $alumno->deuda;

    }

    public function subsanarDeuda ( $data, $id ) {

        $alumno                     = Alumnos::find( $id );
        $alumno->deuda              = $data[0]->deuda;
        $alumno->deuda_pension 	    = $data[0]->deuda_pension;
        $alumno->deuda_lonchera 	= $data[0]->deuda_lonchera;

        $alumno->save();        
        return $alumno->deuda;

    }

}
