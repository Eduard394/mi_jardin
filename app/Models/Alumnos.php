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
        'telefono'
    ];

    public function crear( $data ){

    	$alumno 			        = new Alumnos();
    	$alumno->nombre 	        = $data['nombre'];
    	$alumno->documento 	        = $data['codigo'];
    	$alumno->periodo_entrada    = $data['periodo_entrada'];
    	$alumno->periodo_salida 	= $data['periodo_salida'];
    	$alumno->matricula 	        = $data['matricula'];
    	$alumno->materiales 	    = $data['materiales'];
    	$alumno->jornada 	        = $data['jornada'];
    	$alumno->fecha_ingreso 	    = $data['fecha_ingreso'];
        
        $alumno->fecha_retiro 	    = $data['fecha_retiro'];
    	$alumno->pension 	        = $data['pension'];
    	$alumno->seguro 	        = $data['seguro'];
    	$alumno->grado 	            = $data['grado'];
    	$alumno->acudiente 	        = $data['acudiente'];
        $alumno->telefono 	        = $data['telefono'];
    	$alumno->estado 	        = 1;

    	$alumno->save();        
        return $alumno->id;

    }
}
