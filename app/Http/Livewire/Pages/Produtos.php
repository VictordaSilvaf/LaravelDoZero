<?php

namespace App\Http\Livewire\Pages;

use App\Exports\ProdutosExport;
use App\Imports\ProdutosImport;
use App\Models\Produto;
use Illuminate\Http\Request;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class Produtos extends Component
{
    public $skuProduto = 0;
    public $busca;

    public function render()
    {
        if (isset($this->busca)) {
            $produtos = Produto::where('descricaoComplementar', '<p>C-Vendas</p>' && 'estrutura' == null)->where('codigo', 'LIKE', "$this->busca%")->paginate(20);
        } else {
            $produtos = Produto::where('descricaoComplementar', '<p>C-Vendas</p>' && 'estrutura' == null)->paginate(16);
        }

        return view('livewire.pages.produtos', compact('produtos'))
            ->extends('livewire.layouts.dashboard-layout');
    }

    public function export()
    {
        return Excel::download(new ProdutosExport, 'produtos.xlsx');
    }

    public function import(Request $request)
    {
        Excel::import(new ProdutosImport, $request->file_input);
        return redirect()->back()->with('msg', 'Produtos adicionados com sucesso!');
    }

    public function removerAnuncio($id)
    {
        $produto = Produto::find($id);
        $produto->anuncio = true;
        $produto->save();

        return redirect()->back()->with('msg', 'Produto removido com sucesso!');
    }

    public function adicionarProduto(Request $request)
    {
        // dd(Produto::all()->where('codigo', $request->skuProduto)->where('anuncio', true));
        if (count(Produto::all()->where('codigo', $request->skuProduto)->where('anuncio', true)) == 1) {
            $produto = Produto::all()->where('codigo', $request->skuProduto)->first();
            $produto->anuncio = false;
            $produto->update();

            return redirect()->route('dashboard.produtos')
                ->with('msg', 'Produto cadastrado com sucesso.');
        } else {
            return redirect()->route('dashboard.produtos')
                ->with('msgErro', 'Produto não existe ou já cadastrado na lista.');
        }

        Produto::all()->where('codigo', $request->skuProduto);
    }
}
