<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ElementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('GEN_Elemento')->insert([
            'ELEM_Nombre'       => 'TITULO PRINCIPAL',
            'ELEM_Tipo'         => 'L',
            'ELEM_ValorGeneral' => 'Solicita tu Crédito - General',
            'ELEM_ValorAhorro'  => 'Solicita tu Crédito - Ahorro',
            'ELEM_ValorCredito' => 'Solicita tu Crédito - Credito',
            'created_at' 		=> Carbon::now(),
            'updated_at' 		=> Carbon::now()
        ]);

        DB::table('GEN_Elemento')->insert([
            'ELEM_Nombre'       => 'IMAGEN PORTADA',
            'ELEM_Tipo'         => 'I',
            'ELEM_ValorGeneral' => 'portadas/3X8Z2R3slLFD_partido1.png',
            'ELEM_ValorAhorro'  => 'portadas/F22xQFb40SK1_imagen2.png',
            'ELEM_ValorCredito' => 'portadas/oP5Da9ZlCbmk_logo-cc.png',
            'ELEM_ValorCampo'   => 'imagen',
            'created_at' 		=> Carbon::now(),
            'updated_at' 		=> Carbon::now()
        ]);

        DB::table('GEN_Elemento')->insert([
            'ELEM_Nombre'       => 'CAJA DOCUMENTO IDENTIDAD',
            'ELEM_Tipo'         => 'T',
            'ELEM_ValorGeneral' => 'Documento de Identidad',
            'ELEM_ValorAhorro'  => 'Documento de Identidad',
            'ELEM_ValorCredito' => 'Documento de Identidad',
            'ELEM_ValorCampo'   => 'dni',
            'ELEM_Icono'        => 'fa-regular fa-address-card',
            'created_at' 		=> Carbon::now(),
            'updated_at' 		=> Carbon::now()
        ]);

        DB::table('GEN_Elemento')->insert([
            'ELEM_Nombre'       => 'CAJA CORREO ELECTRONICO',
            'ELEM_Tipo'         => 'T',
            'ELEM_ValorGeneral' => 'Correo Electrónico',
            'ELEM_ValorAhorro'  => 'Correo Electrónico',
            'ELEM_ValorCredito' => 'Correo Electrónico',
            'ELEM_ValorCampo'   => 'correoElectronico',
            'ELEM_Icono'        => 'fa-regular fa-envelope',
            'created_at' 		=> Carbon::now(),
            'updated_at' 		=> Carbon::now()
        ]);

        DB::table('GEN_Elemento')->insert([
            'ELEM_Nombre'       => 'CAJA NUMERO CELULAR',
            'ELEM_Tipo'         => 'T',
            'ELEM_ValorGeneral' => 'Número de Celular',
            'ELEM_ValorAhorro'  => 'Número de Celular',
            'ELEM_ValorCredito' => 'Número de Celular',
            'ELEM_ValorCampo'   => 'numeroCelular',
            'ELEM_Icono'        => 'fa-solid fa-mobile-screen',
            'created_at' 		=> Carbon::now(),
            'updated_at' 		=> Carbon::now()
        ]);

        DB::table('GEN_Elemento')->insert([
            'ELEM_Nombre'       => 'CAJA NOMBRE',
            'ELEM_Tipo'         => 'T',
            'ELEM_ValorGeneral' => 'Nombre Persona',
            'ELEM_ValorAhorro'  => 'Nombre Persona',
            'ELEM_ValorCredito' => 'Nombre Persona',
            'ELEM_ValorCampo'   => 'nombrePersona',
            'ELEM_Icono'        => 'fa-solid fa-mobile-screen',
            'created_at' 		=> Carbon::now(),
            'updated_at' 		=> Carbon::now()
        ]);

        DB::table('GEN_Elemento')->insert([
            'ELEM_Nombre'       => 'CAJA ADICIONAL',
            'ELEM_Tipo'         => 'T',
            'ELEM_ValorGeneral' => 'Texto Adicional',
            'ELEM_ValorAhorro'  => 'Texto Adicional',
            'ELEM_ValorCredito' => 'Texto Adicional',
            'ELEM_ValorCampo'   => 'textoAdicional',
            'ELEM_Icono'        => 'fa-solid fa-mobile-screen',
            'created_at' 		=> Carbon::now(),
            'updated_at' 		=> Carbon::now()
        ]);

        DB::table('GEN_Elemento')->insert([
            'ELEM_Nombre'       => 'COMBO TIPO INGRESOS',
            'ELEM_Tipo'         => 'S',
            'ELEM_ValorGeneral' => 'Tipo de Ingresos',
            'ELEM_ValorAhorro'  => 'Tipo de Ingresos',
            'ELEM_ValorCredito' => 'Tipo de Ingresos',
            'ELEM_ValorCampo'   => 'tipoIngresos',
            'ELEM_ValorAuxiliar'=> 'INGRESO',
            'created_at' 		=> Carbon::now(),
            'updated_at' 		=> Carbon::now()
        ]);

        DB::table('GEN_Elemento')->insert([
            'ELEM_Nombre'       => 'COMBO DEPARTAMENTO',
            'ELEM_Tipo'         => 'S',
            'ELEM_ValorGeneral' => 'Departamento',
            'ELEM_ValorAhorro'  => 'Departamento',
            'ELEM_ValorCredito' => 'Departamento',
            'ELEM_ValorCampo'   => 'departamento',
            'ELEM_ValorAuxiliar'=> 'DEPARTAMENTO',
            'created_at' 		=> Carbon::now(),
            'updated_at' 		=> Carbon::now()
        ]);

        DB::table('GEN_Elemento')->insert([
            'ELEM_Nombre'       => 'CHECK CONDICIONES',
            'ELEM_Tipo'         => 'C',
            'ELEM_ValorGeneral' => 'He leído las condiciones para la autorización y protección de datos personales.',
            'ELEM_ValorAhorro'  => 'He leído las condiciones para la autorización y protección de datos personales.',
            'ELEM_ValorCredito' => 'He leído las condiciones para la autorización y protección de datos personales.',
            'ELEM_ValorCampo'   => 'condiciones',
            'ELEM_ValorAuxiliar'=> 'REF',
            'created_at' 		=> Carbon::now(),
            'updated_at' 		=> Carbon::now()
        ]);

        DB::table('GEN_Elemento')->insert([
            'ELEM_Nombre'       => 'CHECK ACEPTO',
            'ELEM_Tipo'         => 'C',
            'ELEM_ValorGeneral' => 'Acepto recibir información sobre otros productos y servicios de Caja Cusco.',
            'ELEM_ValorAhorro'  => 'Acepto recibir información sobre otros productos y servicios de Caja Cusco.',
            'ELEM_ValorCredito' => 'Acepto recibir información sobre otros productos y servicios de Caja Cusco.',
            'ELEM_ValorCampo'   => 'acepto',
            'created_at' 		=> Carbon::now(),
            'updated_at' 		=> Carbon::now()
        ]);
    }
}
