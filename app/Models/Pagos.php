<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pagos extends Model
{
    use HasFactory;

    protected $fillable = [
        'alumno_id',
        'mes_id',
        'valor_pago'
    ];

    public function crear( $data ){

    	$pago 			    = new Pagos();
        $pago->alumno_id    = $data['alumno_id'];
    	$pago->mes_id       = $data['mes_id'];
        $pago->valor_pago   = $data['pago'];

    	$pago->save();        
        return $pago->id;

    }
}
