<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('GEN_Usuario')->insert([
            'USUA_Nombres'       => 'GONZALO JAVIER',
            'USUA_Apaterno'      => 'CENTENO',
            'USUA_Amaterno'      => 'ZAPATA',
            'USUA_NombreUsuario' => 'GCENTENO',
            'password' 			 => Hash::make('47600274'),
            'created_at' 		 => Carbon::now(),
            'updated_at' 		 => Carbon::now()
        ]);
    }
}
