<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ItemController extends Controller
{

    private $item;

    public function __construct( Item $item )
    {
        $this->item      = new Item();
        //$this->middleware('auth');
    }

    public function index(){

        $items = DB::table('items as i')
                    ->select( '*' )
                    ->get();

    	return view( 'Items.index', compact( 'items' ) );
    }

    public function actualizar ( Request $request ){

        $data     = $request->all();
        return $this->item->editar( $data );

    }
}
