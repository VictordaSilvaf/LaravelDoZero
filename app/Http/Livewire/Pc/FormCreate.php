<?php

namespace App\Http\Livewire\Pc;

use App\Models\Pagamento;
use App\Models\Produto;
use App\Models\ProdutoProposta;
use App\Models\Proposta;
use App\Models\PropostaComercial;
use App\Models\PropostaProduto;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

use function PHPSTORM_META\type;

class FormCreate extends Component
{
    public  $selecaoPagamento;
    public $descontoVendedor;
    public $selecaoParcelas = 1;
    public $observacaoVendedor;

    public $clienteTransportadora;
    public $clienteEnvio;
    public $pesoTotal;
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

    public $parcelaDia12;
    public $parcelaValor12;
    public $parcelaDescricao12;
    public $parcelaFormaPagamento12;

    protected $rules = [
        'descontoVendedor' => 'nullable|max:100|min:0',
        'selecaoParcelas' => 'nullable|max:12'
    ];

    public function render()
    {
        $this->formaPagamento = Pagamento::all()->whereIn('id_bling', ['50972', '69590', '777279', '777565', '787855', '789959', '789960', '797755', '947074', '947314', '1302911']);
        return view('livewire.pc.form-create');
    }

    public function submit()
    {
        // $this->validate();
        $produtos = Cache::get('produtos_user_id_produtos' . auth()->user()->id);
        $cliente = Cache::get('produtos_user_id_cliente' . auth()->user()->id);
        $id_formaPagamento = Cache::get('produtos_user_id_pagamento' . auth()->user()->id);

        $parcelas = $this->buildParcels();
        $pc = Proposta::create([
            'users_id' => auth()->user()->id,
            'clientes_id' => $cliente->id,
            'pagamentos_id' => $id_formaPagamento,

            'consumo_revenda' => $this->clienteConsumoRevenda,
            'observacaoVendedor' => $this->observacaoVendedor,
            'transportadora' => $this->clienteTransportadora,
            'modo_envio' => $this->clienteEnvio,
            'frete' => (float) $this->clienteFrete,
            'peso_total' => (float) $this->pesoTotal,
            'parcelas' => $parcelas,
            'desconto_vendedor' => (float) $this->descontoVendedor,
            'desconto_total' => (float) $this->descontoVendedor, // Calcular o desconto total
            'total' => (float) $this->descontoVendedor, // Calcular o desconto total
        ]);

        $this->storeProdutos($pc, $produtos);
    }

    // Salvar os produtos na tabela many-to-many 
    public function storeProdutos($pc, $produtos)
    {
        try {

            $produtoProposta = new PropostaProduto();

            foreach ($produtos as $produto) {

                $produtoProposta->create([
                    'propostas_id' => $pc['id'],
                    'produtos_id' => strval(Produto::all()->find($produto['0']['id'])->id),
                    'users_id' => auth()->user()->id,
                    'quantidade' => $produto['1'],
                ]);

                $produtoProposta->save();
            }

            Cache::forget('produtos_user_id_produtos');
            Cache::forget('produtos_user_id_cliente');
            Cache::forget('produtos_user_id_pagamento');
            return redirect()->route('propostaComercial.index')->with('msg', 'Proposta salva com sucesso!');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    // Montar o json de parcelas
    public function buildParcels()
    {
        return [
            "parcela0" => [
                'dia' => $this->parcelaDia0,
                'valor' => $this->parcelaValor0,
                'descricao' => $this->parcelaDescricao0,
                'forma_pagamento' => $this->parcelaFormaPagamento0,
            ],
            "parcela1" => [
                'dia' => $this->parcelaDia1,
                'valor' => $this->parcelaValor1,
                'descricao' => $this->parcelaDescricao1,
                'forma_pagamento' => $this->parcelaFormaPagamento1,
            ],
            "parcela2" => [
                'dia' => $this->parcelaDia2,
                'valor' => $this->parcelaValor2,
                'descricao' => $this->parcelaDescricao2,
                'forma_pagamento' => $this->parcelaFormaPagamento2,
            ],
            "parcela3" => [
                'dia' => $this->parcelaDia3,
                'valor' => $this->parcelaValor3,
                'descricao' => $this->parcelaDescricao3,
                'forma_pagamento' => $this->parcelaFormaPagamento3,
            ],
            "parcela4" => [
                'dia' => $this->parcelaDia4,
                'valor' => $this->parcelaValor4,
                'descricao' => $this->parcelaDescricao4,
                'forma_pagamento' => $this->parcelaFormaPagamento4,
            ],
            "parcela5" => [
                'dia' => $this->parcelaDia5,
                'valor' => $this->parcelaValor5,
                'descricao' => $this->parcelaDescricao5,
                'forma_pagamento' => $this->parcelaFormaPagamento5,
            ],
            "parcela6" => [
                'dia' => $this->parcelaDia6,
                'valor' => $this->parcelaValor6,
                'descricao' => $this->parcelaDescricao6,
                'forma_pagamento' => $this->parcelaFormaPagamento6,
            ],
            "parcela7" => [
                'dia' => $this->parcelaDia7,
                'valor' => $this->parcelaValor7,
                'descricao' => $this->parcelaDescricao7,
                'forma_pagamento' => $this->parcelaFormaPagamento7,
            ],
            "parcela8" => [
                'dia' => $this->parcelaDia8,
                'valor' => $this->parcelaValor8,
                'descricao' => $this->parcelaDescricao8,
                'forma_pagamento' => $this->parcelaFormaPagamento8,
            ],
            "parcela9" => [
                'dia' => $this->parcelaDia9,
                'valor' => $this->parcelaValor9,
                'descricao' => $this->parcelaDescricao9,
                'forma_pagamento' => $this->parcelaFormaPagamento9,
            ],
            "parcela10" => [
                'dia' => $this->parcelaDia10,
                'valor' => $this->parcelaValor10,
                'descricao' => $this->parcelaDescricao10,
                'forma_pagamento' => $this->parcelaFormaPagamento10,
            ],
            "parcela11" => [
                'dia' => $this->parcelaDia11,
                'valor' => $this->parcelaValor11,
                'descricao' => $this->parcelaDescricao11,
                'forma_pagamento' => $this->parcelaFormaPagamento11,
            ]
        ];
    }
}
