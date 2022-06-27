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
        $desconto = Desconto::all()->find($request->id);
        $produto = Produto::all()->where('codigo', $request->get('identificacaoProduto'))->first();

        try {
            $desconto->update([
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
            $desconto->save();
            return redirect()->route('descontos.index')->with('msg',  'Desconto editado com sucesso!');
        } catch (\Throwable $th) {
            return redirect()->route('descontos.index')->with('msg', 'Não foi possivel editar o desconto');
        }
    }
}
