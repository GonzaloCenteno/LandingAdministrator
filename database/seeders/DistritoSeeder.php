<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DistritoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('GEN_Distrito')->insert([
            'DIST_Valor'       => 'miraflores',
            'DIST_Nombre'       => 'Miraflores',
            'DEPA_Id'           => 14,
            'created_at' 		 => Carbon::now(),
            'updated_at' 		 => Carbon::now()
        ]);

        DB::table('GEN_Distrito')->insert([
            'DIST_Valor'       => 'san_juan_lurigancho',
            'DIST_Nombre'       => 'San Juan Lurigancho',
            'DEPA_Id'           => 14,
            'created_at' 		 => Carbon::now(),
            'updated_at' 		 => Carbon::now()
        ]);

        DB::table('GEN_Distrito')->insert([
            'DIST_Valor'       => 'callao',
            'DIST_Nombre'       => 'Callao',
            'DEPA_Id'           => 14,
            'created_at' 		 => Carbon::now(),
            'updated_at' 		 => Carbon::now()
        ]);
    }
}
