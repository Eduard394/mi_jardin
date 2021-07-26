<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(DB::table('items')->get()->count() == 0){

            DB::table('items')->insert([
                [   'id' => 1, 'matricula' => 230000, 'lonchera' => 70000, 'pension' => 200000,
                    'seguro' => 15000, 'materiales' => 260000, 'culminacion' => '2022-05-31',
                    'desc_matricula' => 30000, 'desc_pension' => 15000, 'desc_hermano' => 10000 ]
                ]);
        }else{
                echo "\e[31mTable is not empty, therefore NOT "; 
        }
    }
}
