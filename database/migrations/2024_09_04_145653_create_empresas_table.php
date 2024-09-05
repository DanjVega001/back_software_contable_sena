<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresas', function (Blueprint $table) {
            $table->unsignedBigInteger("serial")->unique()->primary();
            $table->string("tipo_regimen_iva");
            $table->string("correo_contacto");
            $table->string("nombre_contacto");
            $table->string("pagina_web")->nullable();
            $table->boolean("es_consorcio")->nullable();
            $table->unsignedInteger("cobrador_id");
            $table->string("logo")->nullable();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('datos_basicos_id');
            $table->foreign('datos_basicos_id')->references('id')->on('datos_basicos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empresas');
    }
}
