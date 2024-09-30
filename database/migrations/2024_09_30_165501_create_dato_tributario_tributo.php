<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatoTributarioTributo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dato_tributario_tributo', function (Blueprint $blueprint) {
            $blueprint->unsignedBigInteger("dato_tributario_id");
            $blueprint->unsignedBigInteger("tributo_id");
            $blueprint->foreign("dato_tributario_id")->references("id")->on("datos_tributarios")->cascadeOnDelete();
            $blueprint->foreign("tributo_id")->references("id")->on("tributos")->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dato_tributario_tributo');
    }
}
