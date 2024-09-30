<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatosTributariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datos_tributarios', function (Blueprint $table) {
            $table->id();
            $table->integer('tarifa_ica');
            $table->boolean('maneja_aiu');
            $table->boolean('utiliza_dos_impuestos');
            $table->boolean('es_agente_retenedor');
            $table->boolean('maneja_impuesto_ad_valorem');
            $table->boolean('moneda_extranjera');
            $table->unsignedInteger('actividad_economica_codigo_ciiu');
            $table->foreign('actividad_economica_codigo_ciiu')->references('codigo_ciiu')->on('actividades_economicas');
            $table->unsignedBigInteger('empresa_serial');
            $table->foreign('empresa_serial')->references('serial')->on('empresas')->cascadeOnDelete();
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
        Schema::dropIfExists('datos_tributarios');
    }
}
