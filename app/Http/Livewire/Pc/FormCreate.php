<?php

namespace App\Http\Livewire\Pc;

use App\Models\Cliente;
use App\Models\Pagamento;
use App\Models\Proposta;
use App\Models\PropostaProduto;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

use function PHPSTORM_META\type;

class FormCreate extends Component
{
    public $selecaoPagamento;
    public $descontoVendedor = 0;
    public $selecaoParcelas;
    public $observacaoVendedor;
    public $formaPagamento = 0;
    public $formaPagamento2;

    public $podeParcelar = false;

    public $clienteTransportadora;
    public $clienteEnvio;
    public $pesoTotal = 0;
    public $clienteConsumoRevenda;
    public $clienteFrete;

    public $parcelaDia0;
    public $parcelaValor0;
    public $parcelaDescricao0;
    public $parcelaFormaPagamento0;

    public $parcelaDia1;
    public $parcelaValor1;
    public $parcelaDescricao1;
    public $parcelaFormaPagamento1;

    public $parcelaDia2;
    public $parcelaValor2;
    public $parcelaDescricao2;
    public $parcelaFormaPagamento2;

    public $parcelaDia3;
    public $parcelaValor3;
    public $parcelaDescricao3;
    public $parcelaFormaPagamento3;

    public $parcelaDia4;
    public $parcelaValor4;
    public $parcelaDescricao4;
    public $parcelaFormaPagamento4;

    public $parcelaDia5;
    public $parcelaValor5;
    public $parcelaDescricao5;
    public $parcelaFormaPagamento5;

    public $parcelaDia6;
    public $parcelaValor6;
    public $parcelaDescricao6;
    public $parcelaFormaPagamento6;

    public $parcelaDia7;
    public $parcelaValor7;
    public $parcelaDescricao7;
    public $parcelaFormaPagamento7;

    public $parcelaDia8;
    public $parcelaValor8;
    public $parcelaDescricao8;
    public $parcelaFormaPagamento8;

    public $parcelaDia9;
    public $parcelaValor9;
    public $parcelaDescricao9;
    public $parcelaFormaPagamento9;

    public $parcelaDia10;
    public $parcelaValor10;
    public $parcelaDescricao10;
    public $parcelaFormaPagamento10;

    public $parcelaDia11;
    public $parcelaValor11;
    public $parcelaDescricao11;
    public $parcelaFormaPagamento11;

    public $total = 0.00;
    public $totalDesc = 0.00;
    public $totalDescEsc = 0.00;
    public $totalFrete;


    protected $rules = [
        'descontoVendedor' => 'nullable|max:100|min:0',
        'selecaoParcelas' => 'nullable|max:12'
    ];

    public function render()
    {
        if ($this->selecaoParcelas == null) {
            $this->selecaoParcelas = 1;
        }

        $produtos = Cache::get('produtos_user_id_produtos' . auth()->user()->id);
        $this->formaPagamento = Pagamento::all()->whereIn('id_bling', ['50972', '69590', '777279', '777565', '787855', '789959', '789960', '797755', '947074', '947314', '1302911']);

        $this->formaPagamento2 = Pagamento::all()->whereIn('id_bling', ['50972', '777565']);

        $this->pesoTotal = $this->calcularPesoTotal($produtos);

        $valorParcelas = $this->dividirValorDasParcelas($this->calcTotal($produtos, $this->descontoVendedor));

        return view('livewire.pc.form-create', compact('produtos', 'valorParcelas'));
    }


    private function dividirValorDasParcelas($total)
    {
        $parcelas = array();

        for ($i = 0; $i < $this->selecaoParcelas; $i++) {
            array_push($parcelas, ($total / $this->selecaoParcelas));
        };

        return $parcelas;
    }

    private function calcularPesoTotal($produtos)
    {
        $peso = 0;

        if (isset($produtos)) {
            foreach ($produtos as $produto) {
                $peso += ($produto[0]->pesoBruto * $produto[1]);
            }
        }

        return $peso;
    }

    public function mudarFormaPagamento()
    {

        if ($this->parcelaFormaPagamento0 !=  null) {
            /* Selecionando formas de pagamento que podem parcelar */
            $items = ['787855', '69590', '789959'];

            if ($items[0] == $this->parcelaFormaPagamento0 || $items[1] == $this->parcelaFormaPagamento0 || $items[2] == $this->parcelaFormaPagamento0) {
                $this->podeParcelar = 1;
            } else {
                $this->selecaoParcelas = 1;
                $this->podeParcelar = 0;
            }

            /* 3% de desconto do pix */
            if ($this->parcelaFormaPagamento0 === '1302911') {
                return 3;
            }
        }
        return '0';
    }

    public function calcTotalSemDesconto($produtos)
    {
        if (isset($produtos)) {
            $total = 0;
            foreach ($produtos as $produto) {

                $total += doubleval($produto[0]->preco) * doubleval($produto[1]);
            }

            return $total;
        } else {
            return 0;
        }
    }

    public function calcTotal($produtos, $descontoVendedor = 0)
    {
        $total = 0;

        if (isset($produtos)) {

            foreach ($produtos as $produto) {
                $total += $produto[3][2] * $produto[1];
            }

            if (isset($descontoVendedor) && $descontoVendedor <= 15 && $descontoVendedor > 0) {
                $total -= ($total * $descontoVendedor) / 100;
            }

            /* 3% é o desconto caso o modo de pagamento for pix */
            if ($this->parcelaFormaPagamento0 == '1302911') {
                $total -= ($total * 3) / 100;
            }

            if ($this->totalFrete > 0) {
                $total += floatval($this->totalFrete);
            }
        }

        return $total;
    }

    public function submit()
    {
        $this->validate();

        $produtos = Cache::get('produtos_user_id_produtos' . auth()->user()->id);
        $cliente = Cache::get('produtos_user_id_cliente' . auth()->user()->id);
        $total = $this->calcTotal($produtos, $this->descontoVendedor);
        $parcelas = $this->buildParcels($total);

        if (isset($produtos)) {
            $pc = Proposta::create([
                'users_id' => auth()->user()->id,
                'cliente_id' => $cliente[0]->id,

                'consumo_revenda' => $cliente[1],
                'observacaoVendedor' => $this->observacaoVendedor,
                'transportadora' => $this->clienteTransportadora,
                'modo_envio' => $this->clienteEnvio,
                'frete' => (float) $this->clienteFrete,
                'peso_total' => (float) $this->pesoTotal,
                'parcelas' => $parcelas,
                'desconto_vendedor' => (float) $this->descontoVendedor,
                'desconto_total' => (float) $this->descontoVendedor, // Calcular o desconto total
                'total' => floatval(number_format($total, 2, '.', '')),
            ]);

            if ($this->storeProdutos($pc, $produtos)) {
                Cache::forget('produtos_user_id_produtos');
                Cache::forget('produtos_user_id_cliente');
                Cache::forget('produtos_user_id_pagamento');

                if ($pc->save()) {
                    session()->flash('message', 'Proposta aceita com sucesso!');
                    return redirect()->route('propostas.index');
                } else {
                    session()->flash('message', 'Erro ao aceitar propostas.');
                };
            } else {
                session()->flash('Adicione produtos a lista para cadastrar a proposta.');
            };
        } else {
            session()->flash('Adicione produtos a lista para cadastrar a proposta.');
        }
    }

    // Salvar os produtos na tabela many-to-many 
    public function storeProdutos($pc, $produtos)
    {
        try {
            $produtoProposta = new PropostaProduto();

            foreach ($produtos as $produto) {
                $produtoProposta->create([
                    'propostas_id' => $pc->id,
                    'produtos_id' => $produto['0']['id'],
                    'users_id' => auth()->user()->id,
                    'quantidade' => $produto['1'],
                ])->save();
            }

            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    // Montar o json de parcelas
    public function buildParcels($total)
    {
        $parcelas = [
            "0" => [
                'dia' => $this->parcelaDia0,
                'valor' => 0,
                'descricao' => $this->parcelaDescricao0,
                'forma_pagamento' => $this->parcelaFormaPagamento0,
                'status' => false,
            ],
            "1" => [
                'dia' => $this->parcelaDia1,
                'valor' => 0,
                'descricao' => $this->parcelaDescricao1,
                'forma_pagamento' => $this->parcelaFormaPagamento1,
                'status' => false,
            ],
            "2" => [
                'dia' => $this->parcelaDia2,
                'valor' => 0,
                'descricao' => $this->parcelaDescricao2,
                'forma_pagamento' => $this->parcelaFormaPagamento2,
                'status' => false,
            ],
            "3" => [
                'dia' => $this->parcelaDia3,
                'valor' => 0,
                'descricao' => $this->parcelaDescricao3,
                'forma_pagamento' => $this->parcelaFormaPagamento3,
                'status' => false,
            ],
            "4" => [
                'dia' => $this->parcelaDia4,
                'valor' => 0,
                'descricao' => $this->parcelaDescricao4,
                'forma_pagamento' => $this->parcelaFormaPagamento4,
                'status' => false,
            ],
            "5" => [
                'dia' => $this->parcelaDia5,
                'valor' => 0,
                'descricao' => $this->parcelaDescricao5,
                'forma_pagamento' => $this->parcelaFormaPagamento5,
                'status' => false,
            ],
            "6" => [
                'dia' => $this->parcelaDia6,
                'valor' => 0,
                'descricao' => $this->parcelaDescricao6,
                'forma_pagamento' => $this->parcelaFormaPagamento6,
                'status' => false,
            ],
            "7" => [
                'dia' => $this->parcelaDia7,
                'valor' => 0,
                'descricao' => $this->parcelaDescricao7,
                'forma_pagamento' => $this->parcelaFormaPagamento7,
                'status' => false,
            ],
            "8" => [
                'dia' => $this->parcelaDia8,
                'valor' => 0,
                'descricao' => $this->parcelaDescricao8,
                'forma_pagamento' => $this->parcelaFormaPagamento8,
                'status' => false,
            ],
            "9" => [
                'dia' => $this->parcelaDia9,
                'valor' => 0,
                'descricao' => $this->parcelaDescricao9,
                'forma_pagamento' => $this->parcelaFormaPagamento9,
                'status' => false,
            ],
            "10" => [
                'dia' => $this->parcelaDia10,
                'valor' => 0,
                'descricao' => $this->parcelaDescricao10,
                'forma_pagamento' => $this->parcelaFormaPagamento10,
                'status' => false,
            ],
            "11" => [
                'dia' => $this->parcelaDia11,
                'valor' => 0,
                'descricao' => $this->parcelaDescricao11,
                'forma_pagamento' => $this->parcelaFormaPagamento11,
                'status' => false,
            ]
        ];

        if ($this->parcelaValor0 != null) {
            $total -= $this->parcelaValor0;
            $parcelas[0]['valor'] = floatval($this->parcelaValor0);
            $parcelas[0]['status'] = true;

            for ($i = 1; $i < $this->selecaoParcelas; $i++) {
                $parcelas[$i]['valor'] = ($total / $this->selecaoParcelas);
                $parcelas[$i]['status'] = true;
            }
        } else {
            for ($i = 0; $i < $this->selecaoParcelas; $i++) {
                $parcelas[$i]['valor'] = ($total / $this->selecaoParcelas);
                $parcelas[$i]['status'] = true;
            }
        }

        return $parcelas;
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
                return null;
                break;
        }
    }

    public function definirParcela($parcela)
    {
        $this->selecaoParcelas = $parcela;
    }

    public function descontoPagamento()
    {
        $key_cache = 'produtos_user_id_pagamento' . auth()->user()->id;

        $formaPagamento = Cache::get($key_cache);

        return $formaPagamento;
    }
}
