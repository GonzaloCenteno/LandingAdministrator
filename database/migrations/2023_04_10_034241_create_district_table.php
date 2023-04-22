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
            $table->string('DIST_Valor',250)->unique();
            $table->string('DIST_Nombre',250)->unique();
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
