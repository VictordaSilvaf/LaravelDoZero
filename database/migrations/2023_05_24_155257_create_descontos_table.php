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
        Schema::create('descontos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('produto_id')->constrained('produtos');
            $table->integer('quantidade0')->default(0);
            $table->integer('porcentagem0')->default(0);
            $table->integer('quantidade1')->default(0);
            $table->integer('porcentagem1')->default(0);
            $table->integer('quantidade2')->default(0);
            $table->integer('porcentagem2')->default(0);
            $table->integer('quantidade3')->default(0);
            $table->integer('porcentagem3')->default(0);
            $table->integer('quantidade4')->default(0);
            $table->integer('porcentagem4')->default(0);
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
        Schema::dropIfExists('descontos');
    }
};
