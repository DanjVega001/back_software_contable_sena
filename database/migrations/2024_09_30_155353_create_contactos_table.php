<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contactos', function (Blueprint $table) {
            $table->id();
            $table->string("nombre");
            $table->string("apellido")->nullable();
            $table->string("correo_electronico")->nullable();
            $table->unsignedBigInteger("telefono")->nullable();
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
        Schema::dropIfExists('contactos');
    }
}
