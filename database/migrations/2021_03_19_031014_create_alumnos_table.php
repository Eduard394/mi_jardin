<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlumnosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumnos', function (Blueprint $table) {
            $table->id();
            $table->string( 'nombre' );            
            $table->string( 'documento' )->unique();
            $table->integer( 'periodo_entrada' );
            $table->integer( 'periodo_salida' );
            $table->integer( 'matricula' );
            $table->integer( 'materiales' );
            $table->string( 'jornada' );
            $table->date( 'fecha_ingreso' );
            $table->date( 'fecha_retiro' );
            $table->integer( 'pension' );
            $table->integer( 'seguro' );
            $table->string( 'grado' );
            $table->string( 'acudiente' );
            $table->string( 'telefono' );
            $table->boolean( 'estado' )->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alumnos');
    }
}
