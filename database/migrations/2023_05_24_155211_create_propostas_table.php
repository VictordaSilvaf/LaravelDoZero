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

            $table->foreignId('users_id')->constrained()->onUpdate('cascade')
                ->onDelete('cascade');;

            $table->foreignId('cliente_id')
                ->constrained('clientes')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->string('consumo_revenda');
            $table->string('observacaoVendedor')->nullable();
            $table->string('transportadora');
            $table->string('modo_envio');
            $table->float('frete', 8, 2);
            $table->float('peso_total', 8, 2);
            $table->json('parcelas');
            $table->float('desconto_vendedor', 8, 2)->default(0);
            $table->float('desconto_total', 8, 2)->default(0);
            $table->float('total', 8, 2);
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
