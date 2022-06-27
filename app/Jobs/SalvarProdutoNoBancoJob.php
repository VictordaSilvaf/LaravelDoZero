<?php

namespace App\Jobs;

use App\Models\Produto;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SalvarProdutoNoBancoJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $produtos;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(
        public $list_produtos
    ) {
        $this->produtos = $list_produtos;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $produtos_com_erro = array();
        unset($this->produtos[0]);

        foreach ($this->produtos as $produto) {
            try {
                if (Produto::find($produto['produto']['id'])) {
                    $listarProdutos = Produto::findOrFail($produto['produto']['id'])->first();
                } else {
                    $listarProdutos = new Produto();
                    $listarProdutos->id = $produto['produto']['idProduto'];
                }

                $listarProdutos->codigo = $produto['produto']['codigo'];
                $listarProdutos->descricao = $produto['produto']['descricao'];
                $listarProdutos->tipo = $produto['produto']['tipo'];
                $listarProdutos->situacao = $produto['produto']['situacao'];
                $listarProdutos->unidade = $produto['produto']['unidade'];
                $listarProdutos->preco = $produto['produto']['preco'];
                $listarProdutos->precoCusto = $produto['produto']['precoCusto'];
                $listarProdutos->descricaoCurta = $produto['produto']['descricaoCurta'];
                $listarProdutos->descricaoComplementar = $produto['produto']['descricaoComplementar'];
                $listarProdutos->dataInclusao = $produto['produto']['dataInclusao'];
                $listarProdutos->dataAlteracao = $produto['produto']['dataAlteracao'];
                $listarProdutos->imageThumbnail = $produto['produto']['imageThumbnail'];
                $listarProdutos->urlVideo = $produto['produto']['urlVideo'];
                $listarProdutos->nomeFornecedor = $produto['produto']['nomeFornecedor'];
                $listarProdutos->codigoFabricante = $produto['produto']['codigoFabricante'];
                $listarProdutos->marca = $produto['produto']['marca'];
                $listarProdutos->class_fiscal = $produto['produto']['class_fiscal'];
                $listarProdutos->cest = $produto['produto']['cest'];
                $listarProdutos->origem = intval($produto['produto']['origem']);
                $listarProdutos->idGrupoProduto = intval($produto['produto']['idGrupoProduto']);
                $listarProdutos->linkExterno = $produto['produto']['linkExterno'];
                $listarProdutos->observacoes = $produto['produto']['observacoes'];
                $listarProdutos->grupoProduto = $produto['produto']['grupoProduto'];
                $listarProdutos->garantia = intval($produto['produto']['garantia']);
                $listarProdutos->descricaoFornecedor = $produto['produto']['descricaoFornecedor'];
                $listarProdutos->idFabricante = intval($produto['produto']['idFabricante']);
                $listarProdutos->categoria = json_encode($produto['produto']['categoria']);
                $listarProdutos->pesoLiq = floatval($produto['produto']['pesoLiq']);
                $listarProdutos->pesoBruto = floatval($produto['produto']['pesoBruto']);
                $listarProdutos->estoqueAtual = floatval($produto['produto']['estoqueAtual']);
                $listarProdutos->estoqueMinimo = floatval($produto['produto']['estoqueMinimo']);
                $listarProdutos->estoqueMaximo = floatval($produto['produto']['estoqueMaximo']);
                $listarProdutos->gtin = intval($produto['produto']['gtin']);
                $listarProdutos->gtinEmbalagem = intval($produto['produto']['gtinEmbalagem']);
                $listarProdutos->larguraProduto = floatval($produto['produto']['larguraProduto']);
                $listarProdutos->alturaProduto = floatval($produto['produto']['alturaProduto']);
                $listarProdutos->profundidadeProduto = floatval($produto['produto']['profundidadeProduto']);
                $listarProdutos->unidadeMedida = $produto['produto']['unidadeMedida'];
                $listarProdutos->itensPorCaixa = intval($produto['produto']['itensPorCaixa']);
                $listarProdutos->volumes = intval($produto['produto']['volumes']);
                $listarProdutos->localizacao = $produto['produto']['localizacao'];
                $listarProdutos->crossdocking = intval($produto['produto']['crossdocking']);
                $listarProdutos->condicao = $produto['produto']['condicao'];
                $listarProdutos->freteGratis = $produto['produto']['freteGratis'];
                $listarProdutos->producao = $produto['produto']['producao'];
                $listarProdutos->dataValidade = $produto['produto']['dataValidade'];
                $listarProdutos->spedTipoItem = intval($produto['produto']['spedTipoItem']);


                if ($listarProdutos->save()) {
                } else {
                }
            } catch (\Throwable $th) {
                continue;
            }

            /* Feature: Enviar por email produtos que estão com problema de preenchimento */
        }
    }
}
