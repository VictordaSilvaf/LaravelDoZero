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
            $table->foreignId('proposta_id')->constrained('propostas');
            $table->foreignId('produtos_id')->constrained('produtos');
            $table->foreignId('users_id')->constrained('users');
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
