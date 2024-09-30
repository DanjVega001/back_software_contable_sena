<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatosFacturacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datos_facturaciones', function (Blueprint $table) {
            $table->id();
            $table->string("nombres_contacto")->nullable();
            $table->string("apellidos_contacto")->nullable();
            $table->string("correo_electronico")->nullable();
            $table->string("tipo_regimen_iva")->nullable();
            $table->unsignedBigInteger("telefono")->nullable();
            $table->unsignedInteger("codigo_postal")->nullable();
            $table->unsignedBigInteger("tercero_id");
            $table->foreign("tercero_id")->references("id")->on("terceros")->cascadeOnDelete();
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
        Schema::dropIfExists('datos_facturaciones');
    }
}
