<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subsanacion extends Model
{
    use HasFactory;

    public function crear( $data ){

    	$subsanacion 			        = new Subsanacion();
        $subsanacion->alumno_id         = $data['alumno_id'];
    	$subsanacion->item              = $data['item_id'];
        $subsanacion->valor_subsanar    = $data['valor'];
        $subsanacion->tipo_subsanacion  = $data['tipo_subsanacion'];

    	$subsanacion->save();        
        return $subsanacion->id;

    }
}
