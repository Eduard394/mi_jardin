<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lonchera extends Model
{
    use HasFactory;

    protected $fillable = [
        'fecha_ingreso',
        'fecha_retiro',
        'alumno_id',
        'valor_lonchera'
    ];

    public function crear( $data ){

    	$lonchera 			        = new Lonchera();
    	$lonchera->fecha_ingreso    = $data['fecha_ingreso'];
        $lonchera->fecha_retiro 	= ( $data['fecha_retiro'] ) ? $data['fecha_retiro'] : null;
        $lonchera->alumno_id     	= $data['alumno_id'];
        $lonchera->valor_lonchera   = $data['valor'];
    	$lonchera->estado 	        = 1;

    	$lonchera->save();        
        return $lonchera->id;

    }

    public function editar( $data ){

    	$lonchera 			        = Lonchera::find($data['lonchera_id']);
    	$lonchera->fecha_ingreso    = $data['fecha_ingreso'];
        $lonchera->fecha_retiro 	= $data['fecha_retiro'];
        $lonchera->alumno_id     	= $data['alumno_id'];
        $lonchera->valor_lonchera   = $data['valor_lonchera'];
    	$lonchera->estado 	        = 0;

    	$lonchera->save();        
        return $lonchera->id;

    }

}
