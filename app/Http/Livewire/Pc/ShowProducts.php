<?php

namespace App\Http\Livewire\Pc;

use App\Models\Produto;
use App\Models\Produtos;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Facades\Cache;

class ShowProducts extends Component
{
    public $identificacaoProduto;
    public $quantidadeProduto;
    public $seconds = 10;
    public $listaProdutos = array();

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
            $key_cache = 'produtos_user_id_produtos' . auth()->user()->id;

            $descontoFiscal = $this->descontoFiscal($produto);
            dd($descontoFiscal);

            if (Cache::has($key_cache)) {
                $produtos = Cache::get($key_cache);
                Cache::forget($key_cache);

                array_push($produtos, [$produto, $quantidade, $descontoFiscal]);
            } else {
                array_push($produtos, [$produto, $quantidade, $descontoFiscal]);
            }

            Cache::add($key_cache, $produtos, 1200);
        } else {
            $this->addError('buscaProduto', 'Produto não encontado.');
        }

        /* dd($this->listaProdutos); */
    }

    public function descontoFiscal($produto)
    {
        $cliente = Cache::get('produtos_user_id_cliente' . auth()->user()->id)[0];
        $tipoVenda = Cache::get('produtos_user_id_cliente' . auth()->user()->id)[1];
        $clienteNota = Cache::get('produtos_user_id_cliente' . auth()->user()->id)[2];
        $id_formaPagamento = Cache::get('produtos_user_id_pagamento' . auth()->user()->id);

        $tipoCliente = $this->verificarTipoCliente($cliente);

        if ($tipoCliente == true) {

            /* Verifica se o cliente é de são paulo */
            if ($cliente->uf == "SP") {
                /* Verifica se o cliente quer ou não nota */
                if (!$clienteNota) {
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
        } elseif ($tipoCliente == false) {
            /* Verificar se é consumo e ou revenda */
            if ($tipoVenda == 'consumo') {
                return $this->descontoUF($produto, $cliente, $clienteNota);
            } elseif ($tipoVenda == 'revenda') {
                if (strpos($produto->grupoProduto, 'ST')) {
                    dd("Verificar produto!");
                } else {
                    return $this->descontoUF($produto, $cliente, $clienteNota);
                }
            }
        } else {
            return 0;
        }
    }

    public function verificarTipoCliente($cliente)
    {

        switch ($cliente->contribuinte) {
            case '1':
                return false;
                break;

            case '2' || '9':
                return true;
                break;

            default:
                return 'n encontro';
                break;
        }
    }

    public function descontoUF($produto, $cliente, $clienteNota)
    {
        if ($cliente->uf == "SP") {
            /* Verifica se o cliente quer ou não nota */
            if (!$clienteNota) {
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
            }
        }
    }
}
