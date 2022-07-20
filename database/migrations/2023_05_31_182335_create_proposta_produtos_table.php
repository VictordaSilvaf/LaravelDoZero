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
        Schema::create('proposta_produtos', function (Blueprint $table) {
            $table->id();

            $table->foreignId('propostas_id')->constrained()->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('produtos_id')->constrained()->onUpdate('cascade');
            $table->foreignId('users_id')->constrained()->onUpdate('cascade');

            $table->double('descontoFiscal')->default(0);
            $table->float('quantidade');
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
        Schema::dropIfExists('proposta_produtos');
    }
};
