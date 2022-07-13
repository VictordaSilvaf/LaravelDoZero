<?php

namespace App\Http\Livewire\Pages\Desconto;

use App\Models\Desconto;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class DescontoCreate extends Component
{
    public $quantidadeParcelas = 5;

    public $identificacaoProduto;
    public $busca;

    public $produto;

    public $quantidadeProduto0;
    public $porcentagemDesconto0;
    public $quantidadeProduto1;
    public $porcentagemDesconto1;
    public $quantidadeProduto2;
    public $porcentagemDesconto2;
    public $quantidadeProduto3;
    public $porcentagemDesconto3;
    public $quantidadeProduto4;
    public $porcentagemDesconto4;

    public function render(Request $request)
    {
        return view('livewire.pages.desconto.desconto-create')->extends('livewire.layouts.dashboard-layout');
    }

    public function store()
    {
        //função para impedir cadastrar 2 skus iguais
        $verificar_sku_duplicado = $this->verificarSkuDuplicado($this->identificacaoProduto);
        if ($verificar_sku_duplicado === 0) {
            $desconto = new Desconto();

            $produto = Produto::where('descricaoComplementar', '<p>C-Vendas</p>' && 'estrutura' == null)->where('codigo', $this->identificacaoProduto)->first();

            try {
                $salvarDesconto = $desconto->create([
                    'user_id' => Auth::id(),
                    'produto_id' => $produto->id,
                    'quantidade0' => intval($this->quantidadeProduto0),
                    'porcentagem0' => intval($this->porcentagemDesconto0),
                    'quantidade1' => intval($this->quantidadeProduto1),
                    'porcentagem1' => intval($this->porcentagemDesconto1),
                    'quantidade2' => intval($this->quantidadeProduto2),
                    'porcentagem2' => intval($this->porcentagemDesconto2),
                    'quantidade3' => intval($this->quantidadeProduto3),
                    'porcentagem3' => intval($this->porcentagemDesconto3),
                    'quantidade4' => intval($this->quantidadeProduto4),
                    'porcentagem4' => intval($this->porcentagemDesconto4),
                ]);
            } catch (\Throwable $th) {
                return redirect()->route('descontos.index')->with('msgErro',  'Não foi possivel adicionar o desconto.');
            }

            try {
                if ($salvarDesconto->save()) {
                    return redirect()->route('descontos.index')->with('msg',  'Desconto adicionado com sucesso!');
                } else {
                    return redirect()->route('descontos.index')->with('msgErro', 'Não foi possivel adicionar o desconto');
                }
            } catch (\Throwable $th) {
                return redirect()->route('descontos.index')->with('msgErro', 'Não foi possivel adicionar o desconto');
            }
        } else {

            return redirect()->route('descontos.index')->with('Esse produto já está cadastrado');
        }
    }

    public function verificarSkuDuplicado($sku)
    {
        $retorno = 1;
        try {
            $verificar = Desconto::where('sku_produto', $sku)->firstOrFail();
        } catch (\Throwable $th) {
            $retorno = 0;
        }

        return $retorno;
    }

    public function buscarProduto()
    {

        if ($this->identificacaoProduto != null) {
            $this->busca = $this->identificacaoProduto;

            if (count(Produto::all()->where('codigo', $this->identificacaoProduto)) == 1) {
                $this->produto  = Produto::all()->where('codigo', $this->identificacaoProduto)->first();
            } else {
                $produtos = Produto::where('codigo', "LIKE",  "%" . $this->identificacaoProduto . "%")->paginate(6);
                if (count($produtos) > 0) {
                    return view('livewire.pages.desconto.desconto-create', compact('produtos', 'busca'))
                        ->extends('livewire.layouts.dashboard-layout');
                } else {
                    $erro = "Produto Não encontrado.";
                    return view('livewire.pages.desconto.desconto-create', compact('erro'))
                        ->extends('livewire.layouts.dashboard-layout');
                }
            }


            return view('livewire.pages.desconto.desconto-create')->extends('livewire.layouts.dashboard-layout');
        }
    }
}
