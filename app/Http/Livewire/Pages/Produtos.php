<?php

namespace App\Http\Livewire\Pages;

use App\Models\Produto;
use Illuminate\Http\Request;
use Livewire\Component;

class Produtos extends Component
{
    public $skuProduto = 0;

    public function render()
    {
        $produtos = Produto::where('anuncio', false)->paginate(16);

        if ($this->skuProduto != null) {
            $filtro = $this->skuProduto;
            $ListaProdutos = Produtos::where('descricao', 'LIKE', "%{$filtro}%")
                ->orWhere('id', 'LIKE', "%{$filtro}%")->paginate(6);

            $produtos = Produto::where('anuncio', false)->paginate(16);

            return view('livewire.pages.produtos', compact('produtos', 'listaProdutos', 'filtro'));
        }

        return view('livewire.pages.produtos', compact('produtos'));
    }

    public function search()
    {
    }

    public function adicionarProduto(Request $request)
    {
        if (count(Produto::all()->where('codigo', $request->skuProduto)->where('anuncio', true)) == 1) {
            $produto = Produto::all()->where('codigo', $request->skuProduto)->first();
            $produto->anuncio = false;
            $produto->update();

            return redirect()->route('dashboard.produtos')
                ->with('msg', 'Produto cadastrado com sucesso.');
        } else {
            return redirect()->route('dashboard.produtos')
                ->with('msgErro', 'Produto já existe na lista.');
        }

        Produto::all()->where('codigo', $request->skuProduto);
    }
}
