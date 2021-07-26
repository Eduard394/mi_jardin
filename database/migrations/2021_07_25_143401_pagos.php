<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Pagos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagos', function (Blueprint $table) {
            $table->id();
            $table->foreignId( 'alumno_id' )->references('id')->on('alumnos')->onDelete('cascade'); 
            $table->foreignId( 'mes_id' )->references('id')->on('mes')->onDelete('cascade'); 
            $table->foreignId( 'item_id' )->references('id')->on('items')->onDelete('cascade'); 
            $table->integer( 'valor_pago' );
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
        Schema::dropIfExists('pagos');
    }
}
