<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alumnos;

class AlumnosController extends Controller
{
    private $alumno;

    public function __construct(Alumnos $alumno)
    {
        $this->alumno      = $alumno;
        //$this->middleware('auth');
    }

    public function index(){
    	return view('Alumnos.index');
    }

    public function crear(){
    	return $this->alumno->crear();
    }
}
