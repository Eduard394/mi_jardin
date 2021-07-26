<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ValorLonchera extends Model
{
    use HasFactory;

    protected $fillable = [
        'valor_lonchera'
    ];

    public function editar( $data ){

    	$valor 			        = ValorLonchera::find($data['valor_id']);
    	$valor->valor_lonchera  = $data['valor'];

    	$valor->save();        
        return $valor->id;

    }

}
