<?php

namespace App\Http\Livewire\Pages\Desconto;

use App\Models\Desconto;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class DescontoUpdate extends Component
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
        if (isset($request->id)) {
            $desconto = Desconto::all()->find($request->id);
            $this->identificacaoProduto = $desconto->produto_id;

            $produto = $desconto->produto;
            return view('livewire.pages.desconto.desconto-create', compact('produto', 'desconto'));
        }

        return view('livewire.pages.desconto.desconto-create');
    }

    public function update(Request $request)
    {
        $formData = array();
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

        $desconto = Desconto::all()->find($request->id);

        $produto = Produto::all()->where('codigo', $request->get('identificacaoProduto'))->first();
        $salvarDesconto = $desconto->update([
            'user_id' => Auth::id(),
            'produto_id' => $produto->id,
            'dados' => $formData,
        ]);

        try {
            if ($salvarDesconto->save()) {
                return redirect()->route('descontos.index')->with('msg',  'Desconto editado com sucesso!');
            } else {
                return redirect()->route('descontos.index')->with('msg', 'Não foi possivel adicionar o desconto');
            }
        } catch (\Throwable $th) {
            return redirect()->route('descontos.index')->with('msg', 'Não foi possivel adicionar o desconto');
        }
    }
}
