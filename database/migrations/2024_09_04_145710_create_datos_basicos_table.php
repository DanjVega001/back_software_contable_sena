<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatosBasicosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datos_basicos', function (Blueprint $table) {
            $table->id();
            $table->string('tipo_razon_social');
            $table->string('tipo_identificacion');
            $table->unsignedBigInteger('numero_identificacion');
            $table->string('razon_social')->nullable();
            $table->string('nombres')->nullable();
            $table->string('apellidos')->nullable();
            $table->string('nombre_comercial')->nullable();
            $table->string('direccion')->nullable();
            $table->unsignedBigInteger('telefono')->nullable();
            $table->unsignedInteger('ciudad_codigo_dian');
            $table->foreign('ciudad_codigo_dian')->references('codigo_dian')->on('ciudades');
            $table->unsignedBigInteger('empresa_serial')->nullable();
            $table->foreign('empresa_serial')->references('serial')->on('empresas')->cascadeOnDelete();
            $table->unsignedBigInteger('tercero_id')->nullable();
            $table->foreign('tercero_id')->references('id')->on('terceros')->cascadeOnDelete();
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
        Schema::dropIfExists('datos_basicos');
    }
}
