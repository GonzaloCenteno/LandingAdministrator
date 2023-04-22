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
        Schema::create('GEN_Departamento', function (Blueprint $table) {
            $table->bigIncrements('DEPA_Id');
            $table->string('DEPA_Valor',250)->unique();
            $table->string('DEPA_Nombre',250)->unique();
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
        Schema::dropIfExists('GEN_Departamento');
    }
};
