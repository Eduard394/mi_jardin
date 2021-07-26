<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MesCobrado extends Model
{

    use HasFactory;

    protected $fillable = [
        'alumno_id',
        'mes_id'
    ];

    public function crear( $alumnoId, $mesId, $year ){

    	$mes 			= new MesCobrado();
    	$mes->alumno_id = $alumnoId;
        $mes->mes_id 	= $mesId;
        $mes->year      = $year;

    	$mes->save();        
        return $mes->id;

    }

}
