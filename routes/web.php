<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlumnosController;
use App\Http\Controllers\LoncheraController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('alumno', [AlumnosController::class,'index']);
Route::get( 'alumno/getAlumnos', [ AlumnosController::class, 'getAlumnos' ]);
Route::post( 'alumno/crear', [ AlumnosController::class, 'crear' ] )->name( 'alumno.crear' );
Route::get( 'alumno/lista', [ AlumnosController::class,'lista' ] )->name( 'alumno.lista' );
Route::resource('alumno/get', AlumnosController::class);

Route::get('lonchera', [LoncheraController::class,'index']);
Route::get('lonchera/selector', [LoncheraController::class,'getSelectores']);