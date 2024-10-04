<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCuentaContableEmpresa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cuenta_contable_empresa', function (Blueprint $table) {
            $table->unsignedBigInteger('empresa_serial');
            $table->foreign('empresa_serial')->references('serial')->on('empresas')->cascadeOnDelete();
            $table->unsignedBigInteger('cuenta_contable_id');
            $table->foreign('cuenta_contable_id')->references('id')->on('cuentas_contables')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cuenta_contable_empresa');
    }
}
