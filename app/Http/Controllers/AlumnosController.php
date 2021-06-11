<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alumnos;

class AlumnosController extends Controller
{
    private $alumno;

    public function __construct(Alumnos $alumno)
    {
        $this->alumno      = new Alumnos();
        //$this->middleware('auth');
    }

    public function index(){
    	return view('Alumnos.index');
    }

    public function lista(){
        return view('Alumnos.lista');
    }

    public function crear(Request $request) {
    
        $data     = $request->all();

    	return $this->alumno->crear( $data );
        
    }

    public function getAlumnos() {

        return Alumnos::all();
        
    }
}
