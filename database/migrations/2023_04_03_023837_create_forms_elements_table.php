<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('GEN_FormularioElemento', function (Blueprint $table) {
            $table->bigInteger('FORM_Id')->unsigned()->required();
            $table->bigInteger('ELEM_Id')->unsigned()->required();

            $table->foreign('FORM_Id')->references('FORM_Id')->on('GEN_Formulario');
            $table->foreign('ELEM_Id')->references('ELEM_Id')->on('GEN_Elemento');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('GEN_FormularioElemento');
    }
};
