<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlumnosController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\LoncheraController;
use App\Http\Controllers\PagosController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\ValorLoncheraController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get( 'alumno', [ AlumnosController::class,'index']);
Route::get( 'alumno/getAlumnos', [ AlumnosController::class, 'getAlumnos' ]);
Route::get( 'alumno/getAlumno', [ AlumnosController::class, 'getAlumno' ]);
Route::post( 'alumno/crear', [ AlumnosController::class, 'crear' ] )->name( 'alumno.crear' );
Route::post( 'alumno/update', [ AlumnosController::class, 'update' ] );
Route::post( 'alumno/eliminar', [ AlumnosController::class, 'eliminar' ] );
Route::get( 'alumno/lista', [ AlumnosController::class,'lista' ] )->name( 'alumno.lista' );
Route::resource( 'alumno/get', AlumnosController::class ); 

Route::get( 'lonchera', [ LoncheraController::class, 'index' ] );
Route::get( 'lonchera/selector', [ LoncheraController::class, ' getSelectores' ] );
Route::post( 'lonchera/getLonchera', [ LoncheraController::class, 'getLonchera' ] );
Route::post( 'lonchera/createLonchera', [ LoncheraController::class, 'createLonchera' ] );

Route::get( 'valor', [ ValorLoncheraController::class, 'index' ] );
Route::post( 'valor/updateValor', [ ValorLoncheraController::class, 'updateValor' ] );

Route::get( 'pagos', [ PagosController::class, 'index' ] );
Route::get( 'pagos/lista', [ PagosController::class,'lista' ] );
Route::get( 'subsanar', [ PagosController::class, 'indexSubsanar' ] );
Route::post( 'pagos/subsanar', [ PagosController::class, 'subsanar' ] );
Route::post( 'pagos/validarMes', [ PagosController::class, 'validarMes' ] );
Route::post( 'pagos/createPago', [ PagosController::class, 'createPago' ] );
Route::get( 'pagos/getPagos', [ PagosController::class, 'getPagos' ]);
Route::post( 'pagos/getUltimoPago', [ PagosController::class, 'getUltimoPago' ]);

Route::get( 'reporte', [ ReporteController::class, 'index' ] );
Route::get( 'reporte/getInfo', [ ReporteController::class, 'getInfo' ] );

Route::get( 'item', [ ItemController::class, 'index' ] );
Route::post( 'item/actualizar', [ ItemController::class, 'actualizar' ] );

Route::resource('alumno', AlumnosController::class);