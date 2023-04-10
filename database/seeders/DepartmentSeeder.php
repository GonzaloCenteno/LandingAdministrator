<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('GEN_Departamento')->insert([
            'DEPA_Valor'       => 'amazonas',
            'DEPA_Nombre'       => 'Amazonas',
            'created_at' 		 => Carbon::now(),
            'updated_at' 		 => Carbon::now()
        ]);

        DB::table('GEN_Departamento')->insert([
            'DEPA_Valor'       => 'ancash',
            'DEPA_Nombre'       => 'Áncash',
            'created_at' 		 => Carbon::now(),
            'updated_at' 		 => Carbon::now()
        ]);

        DB::table('GEN_Departamento')->insert([
            'DEPA_Valor'       => 'apurimac',
            'DEPA_Nombre'       => 'Apurímac',
            'created_at' 		 => Carbon::now(),
            'updated_at' 		 => Carbon::now()
        ]);

        DB::table('GEN_Departamento')->insert([
            'DEPA_Valor'       => 'arequipa',
            'DEPA_Nombre'       => 'Arequipa',
            'created_at' 		 => Carbon::now(),
            'updated_at' 		 => Carbon::now()
        ]);

        DB::table('GEN_Departamento')->insert([
            'DEPA_Valor'       => 'ayacucho',
            'DEPA_Nombre'       => 'Ayacucho',
            'created_at' 		 => Carbon::now(),
            'updated_at' 		 => Carbon::now()
        ]);

        DB::table('GEN_Departamento')->insert([
            'DEPA_Valor'       => 'cajamarca',
            'DEPA_Nombre'       => 'Cajamarca',
            'created_at' 		 => Carbon::now(),
            'updated_at' 		 => Carbon::now()
        ]);

        DB::table('GEN_Departamento')->insert([
            'DEPA_Valor'       => 'cusco',
            'DEPA_Nombre'       => 'Cusco',
            'created_at' 		 => Carbon::now(),
            'updated_at' 		 => Carbon::now()
        ]);

        DB::table('GEN_Departamento')->insert([
            'DEPA_Valor'       => 'huancavelica',
            'DEPA_Nombre'       => 'Huancavelica',
            'created_at' 		 => Carbon::now(),
            'updated_at' 		 => Carbon::now()
        ]);

        DB::table('GEN_Departamento')->insert([
            'DEPA_Valor'       => 'huanuco',
            'DEPA_Nombre'       => 'Huánuco',
            'created_at' 		 => Carbon::now(),
            'updated_at' 		 => Carbon::now()
        ]);

        DB::table('GEN_Departamento')->insert([
            'DEPA_Valor'       => 'ica',
            'DEPA_Nombre'       => 'Ica',
            'created_at' 		 => Carbon::now(),
            'updated_at' 		 => Carbon::now()
        ]);

        DB::table('GEN_Departamento')->insert([
            'DEPA_Valor'       => 'junin',
            'DEPA_Nombre'       => 'Junín',
            'created_at' 		 => Carbon::now(),
            'updated_at' 		 => Carbon::now()
        ]);

        DB::table('GEN_Departamento')->insert([
            'DEPA_Valor'       => 'la_libertad',
            'DEPA_Nombre'       => 'La Libertad',
            'created_at' 		 => Carbon::now(),
            'updated_at' 		 => Carbon::now()
        ]);

        DB::table('GEN_Departamento')->insert([
            'DEPA_Valor'       => 'lambayeque',
            'DEPA_Nombre'       => 'Lambayeque',
            'created_at' 		 => Carbon::now(),
            'updated_at' 		 => Carbon::now()
        ]);

        DB::table('GEN_Departamento')->insert([
            'DEPA_Valor'       => 'lima',
            'DEPA_Nombre'       => 'Lima',
            'created_at' 		 => Carbon::now(),
            'updated_at' 		 => Carbon::now()
        ]);

        DB::table('GEN_Departamento')->insert([
            'DEPA_Valor'       => 'loreto',
            'DEPA_Nombre'       => 'Loreto',
            'created_at' 		 => Carbon::now(),
            'updated_at' 		 => Carbon::now()
        ]);

        DB::table('GEN_Departamento')->insert([
            'DEPA_Valor'       => 'madre_de_dios',
            'DEPA_Nombre'       => 'Madre de Dios',
            'created_at' 		 => Carbon::now(),
            'updated_at' 		 => Carbon::now()
        ]);

        DB::table('GEN_Departamento')->insert([
            'DEPA_Valor'       => 'moquegua',
            'DEPA_Nombre'       => 'Moquegua',
            'created_at' 		 => Carbon::now(),
            'updated_at' 		 => Carbon::now()
        ]);

        DB::table('GEN_Departamento')->insert([
            'DEPA_Valor'       => 'pasco',
            'DEPA_Nombre'       => 'Pasco',
            'created_at' 		 => Carbon::now(),
            'updated_at' 		 => Carbon::now()
        ]);

        DB::table('GEN_Departamento')->insert([
            'DEPA_Valor'       => 'piura',
            'DEPA_Nombre'       => 'Piura',
            'created_at' 		 => Carbon::now(),
            'updated_at' 		 => Carbon::now()
        ]);

        DB::table('GEN_Departamento')->insert([
            'DEPA_Valor'       => 'puno',
            'DEPA_Nombre'       => 'Puno',
            'created_at' 		 => Carbon::now(),
            'updated_at' 		 => Carbon::now()
        ]);

        DB::table('GEN_Departamento')->insert([
            'DEPA_Valor'       => 'san_martin',
            'DEPA_Nombre'       => 'San Martín',
            'created_at' 		 => Carbon::now(),
            'updated_at' 		 => Carbon::now()
        ]);

        DB::table('GEN_Departamento')->insert([
            'DEPA_Valor'       => 'tacna',
            'DEPA_Nombre'       => 'Tacna',
            'created_at' 		 => Carbon::now(),
            'updated_at' 		 => Carbon::now()
        ]);

        DB::table('GEN_Departamento')->insert([
            'DEPA_Valor'       => 'tumbes',
            'DEPA_Nombre'       => 'Tumbes',
            'created_at' 		 => Carbon::now(),
            'updated_at' 		 => Carbon::now()
        ]);
    }
}
