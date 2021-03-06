<?php

namespace App\Http\Livewire\Pc;

use App\Models\Produto;
use Livewire\Component;
use Illuminate\Support\Facades\Cache;

class ShowProducts extends Component
{
    public $identificacaoProduto;
    public $quantidadeProduto;
    public $seconds = 10;
    public $listaProdutos = array();

    protected $rules = [
        'quantidadeProduto' => 'required',
        'identificacaoProduto' => 'required',
    ];

    public function render()
    {
        $key_cache = 'produtos_user_id_produtos' . auth()->user()->id;

        $produtos = Cache::get($key_cache);
        $produtosCache = Cache::get('listaProdutos', function () {
            return false;
        });

        return view('livewire.pc.show-products', compact('produtosCache', 'produtos'));
    }

    public function search()
    {
        $produtos = $this->listaProdutos;
        if (Produto::where('codigo', $this->identificacaoProduto)->first() != null) {
            $quantidade = $this->quantidadeProduto;
            $produto = Produto::where('codigo', $this->identificacaoProduto)->first();

            $totalDesconto = $this->calcDescontoEscalonado($produto, $quantidade);

            $key_cache = 'produtos_user_id_produtos' . auth()->user()->id;

            if (!$this->verificarProdutoExisteNaLista($this->identificacaoProduto, $key_cache)) {
                $descontoFiscal = $this->descontoFiscal($produto);

                $totalDesconto[2] = $totalDesconto[0] - ($totalDesconto[0] * ($descontoFiscal / 100));
                if (Cache::has($key_cache)) {
                    $produtos = Cache::get($key_cache);
                    Cache::forget($key_cache);
                }

                array_push($produtos, [$produto, $quantidade, $descontoFiscal, $totalDesconto]);

                Cache::add($key_cache, $produtos, 1200);
            } else {
                $this->addError('buscaProduto', 'Produto já existe na lista.');
            }
        } else {
            $this->addError('buscaProduto', 'Produto não encontado.');
        }
    }

    public function verificarProdutoExisteNaLista($id, $key)
    {
        $produtos = Cache::get($key);

        if ($produtos) {
            foreach ($produtos as $produto) {
                if ($produto[0]->codigo == $id) {
                    return true;
                }
            }
        }

        return false;
    }

    public function descontoFiscal($produto)
    {
        $cliente = Cache::get('produtos_user_id_cliente' . auth()->user()->id)[0];
        $tipoVenda = Cache::get('produtos_user_id_cliente' . auth()->user()->id)[1];
        $clienteNota = Cache::get('produtos_user_id_cliente' . auth()->user()->id)[2];

        try {

            $tipoCliente = $this->verificarTipoCliente($cliente);

            if ($tipoCliente == false) {

                /* Verifica se o cliente é de são paulo */
                if ($cliente->uf == "SP") {

                    /* Verifica se o cliente quer ou não nota */
                    if ($clienteNota == false) {
                        /* Pega os produtos que não são ST */
                        if (!strpos($produto->grupoProduto, 'ST')) {
                            return 12;
                        } else {
                            return 0;
                        }
                    } else {
                        return 0;
                    }
                } else {
                    return 0;
                }
            } elseif ($tipoCliente == true) {

                /* Verificar se é consumo e ou revenda */
                if ($tipoVenda == 'consumo') {

                    return $this->descontoUF($produto, $cliente, $clienteNota);
                } elseif ($tipoVenda == 'revenda') {
                    // dd(strpos($produto->grupoProduto, 'ST'));
                    if (strpos($produto->grupoProduto, 'ST') !== false) {
                        dd("Verificar produto!");
                    } else {
                        return $this->descontoUF($produto, $cliente, $clienteNota);
                    }
                }
            } else {
                return 0;
            }
            //code...
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function verificarTipoCliente($cliente)
    {

        switch ($cliente->contribuinte) {
            case '1':
                return true;
                break;

            case '2' || '9':
                return false;
                break;

            default:
                return 'Não encontrou';
                break;
        }
    }

    public function descontoUF($produto, $cliente, $clienteNota)
    {

        if ($cliente->uf == "SP") {

            /* Verifica se o cliente quer ou não nota */
            if ($clienteNota == 'false') {
                /* Pega os produtos que não são ST */
                if (!strpos($produto->grupoProduto, 'ST')) {
                    return 12;
                } else {
                    return 0;
                }
            } else {
                return 0;
            }
        } else {

            if ($produto->grupoProduto == 'Importado' || $produto->grupoProduto == 'importado') {
                if ($cliente->uf == 'RJ') {
                    return 12;
                } else {
                    return 14;
                }
            } elseif ($produto->grupoProduto == 'Nacional' || $produto->grupoProduto == 'nacional') {
                if ($cliente->uf == 'RJ') {
                    return 4;
                } elseif ($cliente->uf == 'PR' || $cliente->uf == 'MG' || $cliente->uf == 'RS') {
                    return 6;
                } else {
                    return 11;
                }
            } else {
                return 0;
            }
        }
    }

    public function definirPorcentagem($quantidadeProduto, $descontoEscalonado)
    {
        if (intval($quantidadeProduto) <= $descontoEscalonado['quantidade0']) {
            return $descontoEscalonado['porcentagem0'];
        } elseif (intval($quantidadeProduto) <= $descontoEscalonado['quantidade1'] && $descontoEscalonado['quantidade1'] != 0) {
            return $descontoEscalonado['porcentagem1'];
        } elseif (intval($quantidadeProduto) <= $descontoEscalonado['quantidade2'] && $descontoEscalonado['quantidade2'] != 0) {
            return $descontoEscalonado['porcentagem2'];
        } elseif (intval($quantidadeProduto) <= $descontoEscalonado['quantidade3'] && $descontoEscalonado['quantidade3'] != 0) {
            return $descontoEscalonado['porcentagem3'];
        } elseif (intval($quantidadeProduto) <= $descontoEscalonado['quantidade4'] && $descontoEscalonado['quantidade4'] != 0) {
            return $descontoEscalonado['porcentagem4'];
        } else {
            return 0;
        }
    }

    /* Função para remover item do cache baseado no arrey index do loop da view */
    public function removerProdutoLista($id)
    {
        $key_cache = 'produtos_user_id_produtos' . auth()->user()->id;
        $produtos = Cache::get($key_cache);

        Cache::pull($key_cache);
        unset($produtos[$id]);
        Cache::add($key_cache, $produtos, 1200);
    }

    public function calcDescontoEscalonado($produto, $quantidade)
    {
        $valorProduto = $produto->preco;

        if (isset($produto->desconto)) {
            $desconto = $produto->desconto;

            if ($quantidade >= $desconto->quantidade0) {
                $valorProduto -= ($valorProduto * $desconto->porcentagem0) / 100;
            }

            if ($quantidade >= $desconto->quantidade1) {
                $valorProduto -= ($valorProduto * $desconto->porcentagem1) / 100;
            }

            if ($quantidade >= $desconto->quantidade2) {
                $valorProduto -= ($valorProduto * $desconto->porcentagem2) / 100;
            }

            if ($quantidade >= $desconto->quantidade3) {
                $valorProduto -= ($valorProduto * $desconto->porcentagem3) / 100;
            }

            if ($quantidade >= $desconto->quantidade4) {
                $valorProduto -= ($valorProduto * $desconto->porcentagem4) / 100;
            }

            $porcentagemDesconto = (($produto->preco - $valorProduto) * 100) / $produto->preco;

            return [$valorProduto, $porcentagemDesconto];
        } else {
            return [$valorProduto, 0];
        }
    }
}
