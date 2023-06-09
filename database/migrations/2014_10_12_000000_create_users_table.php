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
        Schema::create('GEN_Usuario', function (Blueprint $table) {
            $table->bigIncrements('USUA_Id');
            $table->text('USUA_Nombres');
            $table->text('USUA_Apaterno');
            $table->text('USUA_Amaterno')->nullable();
            $table->string('USUA_NombreUsuario')->unique();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('GEN_Usuario');
    }
};
