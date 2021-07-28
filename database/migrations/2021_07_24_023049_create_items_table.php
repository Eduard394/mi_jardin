<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->integer( 'matricula' );
            $table->integer( 'lonchera' );
            $table->integer( 'pension' );
            $table->integer( 'seguro' );
            $table->integer( 'materiales' );
            $table->date( 'inicio' );
            $table->date( 'culminacion' );
            $table->integer( 'desc_matricula' );
            $table->integer( 'desc_pension' );
            $table->integer( 'desc_hermano' );
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
        Schema::dropIfExists('items');
    }
}
