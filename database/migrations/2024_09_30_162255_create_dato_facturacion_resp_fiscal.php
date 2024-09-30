<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatoFacturacionRespFiscal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dato_facturacion_resp_fiscal', function (Blueprint $blueprint) {
            $blueprint->unsignedBigInteger("dato_facturacion_id");
            $blueprint->string("responsabilidad_fiscal_id");
            $blueprint->foreign("dato_facturacion_id")->references("id")->on("datos_facturaciones")->cascadeOnDelete();
            $blueprint->foreign("responsabilidad_fiscal_id")->references("codigo")->on("responsabilidades_fiscales");
            $blueprint->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dato_facturacion_resp_fiscal');
    }
}
