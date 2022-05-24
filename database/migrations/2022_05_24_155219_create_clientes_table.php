<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary();
            $table->string('codigo');
            $table->string('nome');
            $table->string('fantasia')->nullable();
            $table->string('tipo')->nullable();
            $table->string('cnpj')->nullable();
            $table->string('ie_rg')->nullable();
            $table->string('endereco')->nullable();
            $table->string('numero')->nullable();
            $table->string('bairro')->nullable();
            $table->string('cep')->nullable();
            $table->string('cidade')->nullable();
            $table->string('complemento')->nullable();
            $table->string('uf')->nullable();
            $table->string('fone')->nullable();
            $table->string('email')->nullable();
            $table->string('situacao')->nullable();
            $table->string('contribuinte')->nullable();
            $table->string('site')->nullable();
            $table->string('celular')->nullable();
            $table->string('dataAlteracao')->nullable();
            $table->string('dataInclusao')->nullable();
            $table->string('sexo')->nullable();
            $table->string('clienteDesde')->nullable();
            $table->string('limiteCredito')->nullable();
            $table->boolean('gold')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clientes');
    }
};
