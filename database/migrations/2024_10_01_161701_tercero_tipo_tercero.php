<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TerceroTipoTercero extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("tercero_tipo_tercero", function (Blueprint $table) {
            $table->unsignedBigInteger("tercero_id");
            $table->unsignedBigInteger("tipo_tercero_id");
            $table->timestamps();

            $table->foreign("tercero_id")
                ->references("id")
                ->on("terceros")
                ->onDelete("cascade");

            $table->foreign("tipo_tercero_id")
                ->references("id")
                ->on("tipo_terceros")
                ->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("tercero_tipo_tercero");
    }
}
