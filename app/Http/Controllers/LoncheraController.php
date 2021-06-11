<?php

namespace App\Http\Controllers;

use App\Models\Lonchera;
use Illuminate\Http\Request;

class LoncheraController extends Controller
{
    private $lonchera;

    public function __construct(Lonchera $lonchera)
    {
        $this->lonchera      = new Lonchera();
        //$this->middleware('auth');
    }

    public function index(){
    	return view('Loncheras.index');
    }

    public function lista(){
        return view('Loncheras.lista');
    }

    public function crear(Request $request) {
    
        $data     = $request->all();

    	return $this->lonchera->crear( $data );
        
    }
}
