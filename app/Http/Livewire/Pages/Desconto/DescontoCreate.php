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
        $formData = array();
        //função para impedir cadastrar 2 skus iguais
        $verificar_sku_duplicado = $this->verificarSkuDuplicado($request->identificacaoProduto);
        // dd($request->all());
        if ($verificar_sku_duplicado === 0) {
            array_push($formData, [
                'quantidade0' => $request->get('quantidadeProduto0'),
                'porcentagem0' => $request->get('porcentagemDesconto0'),
                'quantidade1' => $request->get('quantidadeProduto1'),
                'porcentagem1' => $request->get('porcentagemDesconto1'),
                'quantidade2' => $request->get('quantidadeProduto2'),
                'porcentagem2' => $request->get('porcentagemDesconto2'),
                'quantidade3' => $request->get('quantidadeProduto3'),
                'porcentagem3' => $request->get('porcentagemDesconto3'),
                'quantidade4' => $request->get('quantidadeProduto4'),
                'porcentagem4' => $request->get('porcentagemDesconto4'),
            ]);

            $desconto = new Desconto();

            $produto = Produto::all()->where('codigo', $request->get('identificacaoProduto'))->first();
            $salvarDesconto = $desconto->create([
                'user_id' => Auth::id(),
                'produto_id' => $produto->id,
                'dados' => $formData,
            ]);

            try {
                if ($salvarDesconto->save()) {
                    return redirect()->route('descontos.index')->with('msg',  'Desconto adicionado com sucesso!');
                } else {
                    return redirect()->route('descontos.index')->with('msg', 'Não foi possivel adicionar o desconto');
                }
            } catch (\Throwable $th) {
                return redirect()->route('descontos.index')->with('msg', 'Não foi possivel adicionar o desconto');
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
