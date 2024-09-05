<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatoTributarioRespFiscal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dato_tributario_resp_fiscal', function (Blueprint $table) {
            $table->unsignedBigInteger("dato_tributario_id");
            $table->string("responsabilidad_fiscal_id");
            $table->foreign("dato_tributario_id")->references("id")->on("datos_tributarios");
            $table->foreign("responsabilidad_fiscal_id")->references("codigo")->on("responsabilidades_fiscales");
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
        Schema::dropIfExists('dato_tributario_resp_fiscal');
    }
}
