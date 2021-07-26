<?php

namespace App\Http\Controllers;

use App\Models\ValorLonchera;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ValorLoncheraController extends Controller
{

    private $valor;

    public function __construct(ValorLonchera $valor)
    {
        $this->valor      = new ValorLonchera();
        //$this->middleware('auth');
    }

    public function index(){

        //return view('Loncheras.valorindex');
        $valor = DB::table( 'valor_loncheras as v' )
                    ->select( 'v.id', 'v.valor_lonchera' )
                    ->get();

    	return view('Loncheras.valorindex', compact('valor'));

    }

    public function updateValor (Request $request) {
    
        $data = $request->all();

        return $this->valor->editar( $data );
        
    }

}
