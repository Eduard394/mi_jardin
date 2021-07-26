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
        $alumno->deuda 	            = $data['deuda'];
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

    public function editarDeuda ( $data ) {

        $alumno                     = Alumnos::find( $data['alumno_id'] );
        $alumno->deuda              = $data['deuda'];
        $alumno->deuda_pension 	    = $data['pension'];
        $alumno->deuda_lonchera 	= $data['lonchera_valor'];

        $alumno->save();        
        return $alumno->deuda;

    }
}
