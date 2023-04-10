<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class FormElementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('GEN_FormularioElemento')->insert([
            'FORM_Id'       => 1,
            'ELEM_Id'       => 1
        ]);

        DB::table('GEN_FormularioElemento')->insert([
            'FORM_Id'       => 1,
            'ELEM_Id'       => 2
        ]);

        DB::table('GEN_FormularioElemento')->insert([
            'FORM_Id'       => 1,
            'ELEM_Id'       => 3
        ]);

        DB::table('GEN_FormularioElemento')->insert([
            'FORM_Id'       => 1,
            'ELEM_Id'       => 4
        ]);

        DB::table('GEN_FormularioElemento')->insert([
            'FORM_Id'       => 1,
            'ELEM_Id'       => 5
        ]);

        DB::table('GEN_FormularioElemento')->insert([
            'FORM_Id'       => 1,
            'ELEM_Id'       => 6
        ]);

        DB::table('GEN_FormularioElemento')->insert([
            'FORM_Id'       => 1,
            'ELEM_Id'       => 7
        ]);

        DB::table('GEN_FormularioElemento')->insert([
            'FORM_Id'       => 1,
            'ELEM_Id'       => 8
        ]);

        DB::table('GEN_FormularioElemento')->insert([
            'FORM_Id'       => 1,
            'ELEM_Id'       => 9
        ]);

        

        DB::table('GEN_FormularioElemento')->insert([
            'FORM_Id'       => 2,
            'ELEM_Id'       => 1
        ]);

        DB::table('GEN_FormularioElemento')->insert([
            'FORM_Id'       => 2,
            'ELEM_Id'       => 2
        ]);

        DB::table('GEN_FormularioElemento')->insert([
            'FORM_Id'       => 2,
            'ELEM_Id'       => 3
        ]);

        DB::table('GEN_FormularioElemento')->insert([
            'FORM_Id'       => 2,
            'ELEM_Id'       => 4
        ]);

        DB::table('GEN_FormularioElemento')->insert([
            'FORM_Id'       => 2,
            'ELEM_Id'       => 5
        ]);

        DB::table('GEN_FormularioElemento')->insert([
            'FORM_Id'       => 2,
            'ELEM_Id'       => 6
        ]);

        DB::table('GEN_FormularioElemento')->insert([
            'FORM_Id'       => 2,
            'ELEM_Id'       => 7
        ]);

        DB::table('GEN_FormularioElemento')->insert([
            'FORM_Id'       => 2,
            'ELEM_Id'       => 8
        ]);

        DB::table('GEN_FormularioElemento')->insert([
            'FORM_Id'       => 2,
            'ELEM_Id'       => 9
        ]);



        DB::table('GEN_FormularioElemento')->insert([
            'FORM_Id'       => 3,
            'ELEM_Id'       => 1
        ]);

        DB::table('GEN_FormularioElemento')->insert([
            'FORM_Id'       => 3,
            'ELEM_Id'       => 2
        ]);

        DB::table('GEN_FormularioElemento')->insert([
            'FORM_Id'       => 3,
            'ELEM_Id'       => 6
        ]);

        DB::table('GEN_FormularioElemento')->insert([
            'FORM_Id'       => 3,
            'ELEM_Id'       => 7
        ]);

        DB::table('GEN_FormularioElemento')->insert([
            'FORM_Id'       => 3,
            'ELEM_Id'       => 8
        ]);

        DB::table('GEN_FormularioElemento')->insert([
            'FORM_Id'       => 3,
            'ELEM_Id'       => 9
        ]);
    }
}
