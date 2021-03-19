<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumnos extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'documento',
        'acudiente',
        'telefono',
        'telefono1',
        'estado',
    ];

    public function saludo(){
    	return 'la vida es bella';
    }

    public function index(){
    	return 'la vida es bella';
    }
    public function crear($data){
    	$alumno 			= new Alumnos();
    	$alumno->nombre 	= $data['nombre'];
    	$alumno->documento 	= $data['documento'];
    	$alumno->acudiente 	= $data['acudiente'];
    	$alumno->telefono 	= $data['telefono'];
    	$alumno->telefono1 	= $data['telefono1'];
    	$alumno->estado 	= 1;

    	$alumno->save();        
        return $alumno->id;

    }
}
