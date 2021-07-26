<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoncherasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loncheras', function (Blueprint $table) {
            $table->id();
            $table->integer( 'valor_lonchera' );
            $table->date( 'fecha_ingreso' );
            $table->date( 'fecha_retiro')->nullable();
            $table->boolean( 'estado' )->default(1);
            $table->foreignId( 'alumno_id' )->references('id')->on('alumnos')->onDelete('cascade');
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
        Schema::dropIfExists('loncheras');
    }
}
