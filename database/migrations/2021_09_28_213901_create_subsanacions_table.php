<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubsanacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subsanacions', function (Blueprint $table) {
            $table->id();
            $table->foreignId( 'alumno_id' )->references('id')->on('alumnos')->onDelete('cascade'); 
            $table->string( 'item' );
            $table->integer( 'tipo_subsanacion' )->comment('1:borrar pago, 2: anadir pago, 3: eversar pago');
            $table->integer( 'valor_subsanar' );
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
        Schema::dropIfExists('subsanacions');
    }
}
