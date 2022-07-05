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

    public $quantidadeProduto0;
    public $porcentagemProduto0;
    public $quantidadeProduto1;
    public $porcentagemProduto1;
    public $quantidadeProduto2;
    public $porcentagemProduto2;
    public $quantidadeProduto3;
    public $porcentagemProduto3;
    public $quantidadeProduto4;
    public $porcentagemProduto4;

    public function render(Request $request)
    {

        if (isset($request->identificacaoProduto)) {
            $busca = $request->identificacaoProduto;
            if (count(Produto::all()->where('codigo', $request->identificacaoProduto)) == 1) {

                $produto = Produto::all()->where('codigo', $request->identificacaoProduto)->first();
                if (count(Desconto::all()->where('produto_id', $produto->id)) != 1) {
                    return view('livewire.pages.desconto.desconto-create', compact('produto', 'busca'));
                } else {
                    $erro = "Produto já tem desconto cadastrado.";
                    return view('livewire.pages.desconto.desconto-create', compact('erro'));
                }
            } else {
                $produtos = Produto::where('codigo', "LIKE",  "%" . $request->identificacaoProduto . "%")->paginate(6);
                if (count($produtos) > 0) {
                    return view('livewire.pages.desconto.desconto-create', compact('produtos', 'busca'));
                } else {
                    $erro = "Produto Não encontrado.";
                    return view('livewire.pages.desconto.desconto-create', compact('erro'));
                }
            }


            return view('livewire.pages.desconto.desconto-create');
        }

        return view('livewire.pages.desconto.desconto-create');
    }

    public function store(Request $request)
    {
        //função para impedir cadastrar 2 skus iguais
        $verificar_sku_duplicado = $this->verificarSkuDuplicado($request->identificacaoProduto);
        if ($verificar_sku_duplicado === 0) {
            $desconto = new Desconto();

            $produto = Produto::where('descricaoComplementar', '<p>C-Vendas</p>' && 'estrutura' == null)->where('codigo', $request->get('identificacaoProduto'))->first();

            try {
                $salvarDesconto = $desconto->create([
                    'user_id' => Auth::id(),
                    'produto_id' => $produto->id,
                    'quantidade0' => intval($request->get('quantidadeProduto0')),
                    'porcentagem0' => intval($request->get('porcentagemDesconto0')),
                    'quantidade1' => intval($request->get('quantidadeProduto1')),
                    'porcentagem1' => intval($request->get('porcentagemDesconto1')),
                    'quantidade2' => intval($request->get('quantidadeProduto2')),
                    'porcentagem2' => intval($request->get('porcentagemDesconto2')),
                    'quantidade3' => intval($request->get('quantidadeProduto3')),
                    'porcentagem3' => intval($request->get('porcentagemDesconto3')),
                    'quantidade4' => intval($request->get('quantidadeProduto4')),
                    'porcentagem4' => intval($request->get('porcentagemDesconto4')),
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
            return dd($this->identificacaoProduto);
        }
    }
}
