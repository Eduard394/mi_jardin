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
            $table->integer( 'matricula' );
            $table->integer( 'materiales' );
            $table->string( 'jornada' );
            $table->date( 'fecha_ingreso' );
            $table->date( 'fecha_retiro' )->nullable();
            $table->integer( 'pension' );
            $table->integer( 'seguro' );
            $table->string( 'grado' );
            $table->boolean( 'lonchera' );
            $table->integer( 'lonchera_valor' );
            $table->integer( 'deuda_matricula' );
            $table->integer( 'deuda_materiales' );
            $table->integer( 'deuda_pension' );
            $table->integer( 'deuda_seguro' );
            $table->integer( 'deuda_lonchera' );
            $table->boolean( 'hermano' );
            $table->integer( 'hermano_id' )->nullable();
            $table->boolean( 'descuento' );
            $table->string( 'acudiente' );
            $table->string( 'telefono' );
            $table->string( 'correo' )->nullable();
            $table->integer( 'deuda' );
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
