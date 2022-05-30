<?php

namespace App\Http\Livewire\Pc;

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

        if (Produtos::where('codigo', $this->identificacaoProduto)->first() != null) {
            $quantidade = $this->quantidadeProduto;
            $produto = Produtos::where('codigo', $this->identificacaoProduto)->first();
            $key_cache = 'produtos_user_id_produtos' . auth()->user()->id;

            if (Cache::has($key_cache)) {
                $produtos = Cache::get($key_cache);
                Cache::forget($key_cache);
                array_push($produtos, [$produto, $quantidade]);
            } else {
                array_push($produtos, [$produto, $quantidade]);
            }
            
            Cache::add($key_cache, $produtos, 1200);
        } else {
            $this->addError('identifiacaoCliente', 'Produto não encontado.');
        }

        /* dd($this->listaProdutos); */
    }
}
