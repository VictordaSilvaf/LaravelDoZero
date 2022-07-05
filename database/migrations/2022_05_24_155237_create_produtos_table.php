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
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idProduto');
            $table->string('codigo');
            $table->string('descricao')->nullable();
            $table->char('tipo')->nullable();
            $table->string('situacao')->nullable();
            $table->string('unidade')->nullable();
            $table->string('preco');
            $table->string('precoCusto')->nullable();
            $table->text('descricaoCurta')->nullable();
            $table->text('descricaoComplementar')->nullable();
            $table->string('dataInclusao')->nullable();
            $table->string('dataAlteracao')->nullable();
            $table->text('imageThumbnail')->nullable();
            $table->string('urlVideo')->nullable();
            $table->string('nomeFornecedor')->nullable();
            $table->string('codigoFabricante')->nullable();
            $table->string('marca')->nullable();
            $table->string('class_fiscal')->nullable();
            $table->string('cest')->nullable();
            $table->integer('origem')->nullable();
            $table->integer('idGrupoProduto')->nullable();
            $table->string('linkExterno')->nullable();
            $table->text('observacoes')->nullable();
            $table->string('grupoProduto')->nullable();
            $table->integer('garantia')->nullable();
            $table->string('descricaoFornecedor')->nullable();
            $table->bigInteger('idFabricante')->nullable();
            $table->json('categoria')->nullable(); /* Array */
            $table->float('pesoLiq', 8, 2)->nullable();
            $table->float('pesoBruto', 8, 2)->nullable();
            $table->float('estoqueMinimo', 8, 2)->nullable();
            $table->float('estoqueMaximo', 8, 2)->nullable();
            $table->float('estoqueAtual', 8, 2)->nullable();
            $table->bigInteger('gtin')->nullable();
            $table->bigInteger('gtinEmbalagem')->nullable();
            $table->float('larguraProduto', 8, 2)->nullable();
            $table->float('alturaProduto', 8, 2)->nullable();
            $table->float('profundidadeProduto', 8, 2)->nullable();
            $table->string('unidadeMedida')->nullable();
            $table->integer('itensPorCaixa')->nullable();
            $table->integer('volumes')->nullable();
            $table->string('localizacao')->nullable();
            $table->integer('crossdocking')->nullable();
            $table->string('condicao')->nullable();
            $table->string('freteGratis')->nullable();
            $table->char('producao')->nullable();
            $table->string('dataValidade')->nullable();
            $table->integer('spedTipoItem')->nullable();
            $table->boolean('anuncio')->default(true);
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
        Schema::dropIfExists('produtos');
    }
};
