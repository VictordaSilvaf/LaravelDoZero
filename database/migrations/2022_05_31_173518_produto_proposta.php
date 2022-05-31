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
        Schema::create('produto_proposta', function (Blueprint $table) {
            $table->id();
            $table->foreignId('propostas_id')->constrained('propostas');
            $table->foreignId('produtos_id')->constrained('produtos');
            $table->foreignId('users_id')->constrained('users');
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
        //
    }
};
