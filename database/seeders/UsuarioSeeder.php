<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userAdmin = User::create([
        	'name'  => 'Admin Mi Jardin',
	        'email' => 'admin@mijardin.com',            
	        'password' => Hash::make('miJardin2021') , 
        ]);
    }
}
