<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class FormSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('GEN_Formulario')->insert([
            'FORM_Nombre'       => 'GENERAL',
            'created_at' 		=> Carbon::now(),
            'updated_at' 		=> Carbon::now()
        ]);

        DB::table('GEN_Formulario')->insert([
            'FORM_Nombre'       => 'AHORROS',
            'created_at' 		=> Carbon::now(),
            'updated_at' 		=> Carbon::now()
        ]);

        DB::table('GEN_Formulario')->insert([
            'FORM_Nombre'       => 'CREDITOS',
            'created_at' 		=> Carbon::now(),
            'updated_at' 		=> Carbon::now()
        ]);
    }
}
