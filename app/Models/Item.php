<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{

    use HasFactory;

    protected $fillable = [
        'matricula',
        'lonchera',
        'pension',
        'seguro',
        'materiales',
        'culminacion',
        'desc_matricula',
        'desc_pension',
        'desc_hermano'
    ];

    public function editar( $data ){

    	$item 			        = Item::find($data['id']);
    	$item->matricula        = $data['matricula'];
        $item->lonchera         = $data['lonchera'];
        $item->pension          = $data['pension'];
        $item->seguro           = $data['seguro'];
        $item->materiales       = $data['materiales'];
        $item->inicio           = $data['inicio'];
        $item->culminacion      = $data['culminacion'];
        $item->desc_matricula   = $data['desc_matricula'];
        $item->desc_pension     = $data['desc_pension'];
        $item->desc_hermano     = $data['desc_hermano'];

    	$item->save();        
        return $item->id;

    }
}
