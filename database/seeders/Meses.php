<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Meses extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(DB::table('mes')->get()->count() == 0){

            DB::table('mes')->insert([
                ['id' => 1,  'nombre'=> 'Enero',],
                ['id' => 2,  'nombre'=> 'Febrero',],
                ['id' => 3, 'nombre'=> 'Marzo'],
                ['id' => 4, 'nombre'=> 'Abril',],
                ['id' => 5, 'nombre'=> 'Mayo',],
                ['id' => 6, 'nombre'=> 'Junio',],
                ['id' => 7, 'nombre'=> 'Julio',],
                ['id' => 8, 'nombre'=> 'Agosto',],
                ['id' => 9, 'nombre'=> 'Septiembre',],
                ['id' => 10, 'nombre'=> 'Octubre',],
                ['id' => 11, 'nombre'=> 'Noviembre',],
                ['id' => 12, 'nombre'=> 'Diciembre',]      
                ]);
        }else{
                echo "\e[31mTable is not empty, therefore NOT "; 
        }
    }
}
