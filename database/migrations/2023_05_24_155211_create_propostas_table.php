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
        Schema::create('propostas', function (Blueprint $table) {
            $table->id();

            $table->foreignId('users_id')->constrained();
            $table->foreignId('clientes_id')->constrained();

            $table->string('consumo_revenda');
            $table->string('observacaoVendedor');
            $table->string('transportadora');
            $table->string('modo_envio');
            $table->float('frete');
            $table->float('peso_total');
            $table->json('parcelas');
            $table->float('desconto_vendedor')->default(0);
            $table->float('desconto_total')->default(0);
            $table->float('total');
            $table->string('status')->default('pendente');
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
        Schema::dropIfExists('propostas');
    }
};
