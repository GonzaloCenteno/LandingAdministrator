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
        Schema::create('GEN_Distrito', function (Blueprint $table) {
            $table->bigIncrements('DIST_Id');
            $table->text('DIST_Valor')->unique();
            $table->text('DIST_Nombre')->unique();
            $table->bigInteger('DEPA_Id')->unsigned()->required();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('DEPA_Id')->references('DEPA_Id')->on('GEN_Departamento');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('GEN_Distrito');
    }
};
