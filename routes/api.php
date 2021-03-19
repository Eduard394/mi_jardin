<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlumnosController;


Route::/*middleware('auth:api')->*/get('/user', function (Request $request) {
    return 'hola';
});

Route::post('alumno/crear', [AlumnosController::class,'index']);