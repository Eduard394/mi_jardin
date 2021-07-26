<?php

namespace Database\Seeders;

use App\Models\ValorLonchera;
use Illuminate\Database\Seeder;

class ValorLoncheraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userAdmin = ValorLonchera::create([
        	'valor_lonchera'  => '150000',
        ]);
    }
}
