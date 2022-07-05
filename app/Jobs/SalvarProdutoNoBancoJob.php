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
        public $dados
    ) {
        $this->produtos = $dados;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach ($this->produtos as $produto) {
            try {
                $item = Produto::where('idProduto', $produto['produto']['id'])->first();
                if (!isset($item)) {
                    Produto::where('idProduto', $produto['produto']['id'])->firstOrCreate([
                        'idProduto' => $produto['produto']['id'],
                        'codigo' => $produto['produto']['codigo'],
                        'descricao' => $produto['produto']['descricao'],
                        'tipo' => $produto['produto']['tipo'],
                        'situacao' => $produto['produto']['situacao'],
                        'unidade' => $produto['produto']['unidade'],
                        'preco' => $produto['produto']['preco'],
                        'precoCusto' => $produto['produto']['precoCusto'],
                        'descricaoCurta' => $produto['produto']['descricaoCurta'],
                        'descricaoComplementar' => $produto['produto']['descricaoComplementar'],
                        'dataInclusao' => $produto['produto']['dataInclusao'],
                        'dataAlteracao' => $produto['produto']['dataAlteracao'],
                        'imageThumbnail' => $produto['produto']['imageThumbnail'],
                        'urlVideo' => $produto['produto']['urlVideo'],
                        'nomeFornecedor' => $produto['produto']['nomeFornecedor'],
                        'codigoFabricante' => $produto['produto']['codigoFabricante'],
                        'marca' => $produto['produto']['marca'],
                        'class_fiscal' => $produto['produto']['class_fiscal'],
                        'cest' => $produto['produto']['cest'],
                        'origem' => intval($produto['produto']['origem']),
                        'idGrupoProduto' => intval($produto['produto']['idGrupoProduto']),
                        'linkExterno' => $produto['produto']['linkExterno'],
                        'observacoes' => $produto['produto']['observacoes'],
                        'grupoProduto' => $produto['produto']['grupoProduto'],
                        'garantia' => intval($produto['produto']['garantia']),
                        'descricaoFornecedor' => $produto['produto']['descricaoFornecedor'],
                        'idFabricante' => intval($produto['produto']['idFabricante']),
                        'categoria' => json_encode($produto['produto']['categoria']),
                        'pesoLiq' => floatval($produto['produto']['pesoLiq']),
                        'pesoBruto' => floatval($produto['produto']['pesoBruto']),
                        'estoqueAtual' => floatval($produto['produto']['estoqueAtual']),
                        'estoqueMinimo' => floatval($produto['produto']['estoqueMinimo']),
                        'estoqueMaximo' => floatval($produto['produto']['estoqueMaximo']),
                        'gtin' => intval($produto['produto']['gtin']),
                        'gtinEmbalagem' => intval($produto['produto']['gtinEmbalagem']),
                        'larguraProduto' => floatval($produto['produto']['larguraProduto']),
                        'alturaProduto' => floatval($produto['produto']['alturaProduto']),
                        'profundidadeProduto' => floatval($produto['produto']['profundidadeProduto']),
                        'unidadeMedida' => $produto['produto']['unidadeMedida'],
                        'itensPorCaixa' => intval($produto['produto']['itensPorCaixa']),
                        'volumes' => intval($produto['produto']['volumes']),
                        'localizacao' => $produto['produto']['localizacao'],
                        'crossdocking' => intval($produto['produto']['crossdocking']),
                        'condicao' => $produto['produto']['condicao'],
                        'freteGratis' => $produto['produto']['freteGratis'],
                        'producao' => $produto['produto']['producao'],
                        'dataValidade' => $produto['produto']['dataValidade'],
                        'spedTipoItem' => intval($produto['produto']['spedTipoItem'])
                    ]);
                } else {
                    $item->$item->idProduto = $produto['produto']['id'];
                    $item->codigo = $produto['produto']['codigo'];
                    $item->descricao = $produto['produto']['descricao'];
                    $item->tipo = $produto['produto']['tipo'];
                    $item->situacao = $produto['produto']['situacao'];
                    $item->unidade = $produto['produto']['unidade'];
                    $item->preco = $produto['produto']['preco'];
                    $item->precoCusto = $produto['produto']['precoCusto'];
                    $item->descricaoCurta = $produto['produto']['descricaoCurta'];
                    $item->descricaoComplementar = $produto['produto']['descricaoComplementar'];
                    $item->dataInclusao = $produto['produto']['dataInclusao'];
                    $item->dataAlteracao = $produto['produto']['dataAlteracao'];
                    $item->imageThumbnail = $produto['produto']['imageThumbnail'];
                    $item->urlVideo = $produto['produto']['urlVideo'];
                    $item->nomeFornecedor = $produto['produto']['nomeFornecedor'];
                    $item->codigoFabricante = $produto['produto']['codigoFabricante'];
                    $item->marca = $produto['produto']['marca'];
                    $item->class_fiscal = $produto['produto']['class_fiscal'];
                    $item->cest = $produto['produto']['cest'];
                    $item->origem = intval($produto['produto']['origem']);
                    $item->idGrupoProduto = intval($produto['produto']['idGrupoProduto']);
                    $item->linkExterno = $produto['produto']['linkExterno'];
                    $item->observacoes = $produto['produto']['observacoes'];
                    $item->grupoProduto = $produto['produto']['grupoProduto'];
                    $item->garantia = intval($produto['produto']['garantia']);
                    $item->descricaoFornecedor = $produto['produto']['descricaoFornecedor'];
                    $item->idFabricante = intval($produto['produto']['idFabricante']);
                    $item->categoria = json_encode($produto['produto']['categoria']);
                    $item->pesoLiq = floatval($produto['produto']['pesoLiq']);
                    $item->pesoBruto = floatval($produto['produto']['pesoBruto']);
                    $item->estoqueAtual = floatval($produto['produto']['estoqueAtual']);
                    $item->estoqueMinimo = floatval($produto['produto']['estoqueMinimo']);
                    $item->estoqueMaximo = floatval($produto['produto']['estoqueMaximo']);
                    $item->gtin = intval($produto['produto']['gtin']);
                    $item->gtinEmbalagem = intval($produto['produto']['gtinEmbalagem']);
                    $item->larguraProduto = floatval($produto['produto']['larguraProduto']);
                    $item->alturaProduto = floatval($produto['produto']['alturaProduto']);
                    $item->profundidadeProduto = floatval($produto['produto']['profundidadeProduto']);
                    $item->unidadeMedida = $produto['produto']['unidadeMedida'];
                    $item->itensPorCaixa = intval($produto['produto']['itensPorCaixa']);
                    $item->volumes = intval($produto['produto']['volumes']);
                    $item->localizacao = $produto['produto']['localizacao'];
                    $item->crossdocking = intval($produto['produto']['crossdocking']);
                    $item->condicao = $produto['produto']['condicao'];
                    $item->freteGratis = $produto['produto']['freteGratis'];
                    $item->producao = $produto['produto']['producao'];
                    $item->dataValidade = $produto['produto']['dataValidade'];
                    $item->spedTipoItem = intval($produto['produto']['spedTipoItem']);

                    $item->save();
                }
            } catch (\Throwable $th) {
                return false;
            }
        }
        return true;
    }
}
