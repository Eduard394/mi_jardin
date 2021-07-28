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

    	$pago 			        = new Pagos();
        $pago->alumno_id        = $data['alumno_id'];
    	$pago->mes_id           = $data['mes_id'];
        $pago->fecha_pago       = $data['fecha_pago'];
        $pago->pago_matricula   = $data['p_matricula'];
        $pago->pago_pension     = $data['p_pension'];
        $pago->pago_lonchera    = $data['p_lonchera'];
        $pago->pago_seguro      = $data['p_seguro'];
        $pago->pago_materiales  = $data['p_materiales'];

    	$pago->save();        
        return $pago->id;

    }
}
