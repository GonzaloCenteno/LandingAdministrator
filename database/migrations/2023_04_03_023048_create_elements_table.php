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
        Schema::create('GEN_Elemento', function (Blueprint $table) {
            $table->bigIncrements('ELEM_Id');
            $table->string('ELEM_Nombre',250)->unique();
            $table->enum('ELEM_Tipo',['L','I','T','S','C','R']);
            $table->text('ELEM_ValorAhorro')->nullable();
            $table->text('ELEM_ValorGeneral')->nullable();
            $table->text('ELEM_ValorCredito')->nullable();
            $table->text('ELEM_ValorCampo')->nullable();
            $table->text('ELEM_Icono')->nullable();
            $table->text('ELEM_ValorAuxiliar')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('GEN_Elemento');
    }
};
