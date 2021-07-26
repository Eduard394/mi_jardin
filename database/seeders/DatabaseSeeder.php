<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsuarioSeeder::class);
        $this->call(Meses::class);
        $this->call(ValorLoncheraSeeder::class);
        $this->call(ItemSeeder::class);
    }
}
