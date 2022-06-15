<?php

namespace App\Http\Livewire\Pages;

use App\Models\Desconto;
use App\Models\Produto;
use Livewire\Component;

class Produtos extends Component
{
    public function render()
    {
        $produtos = Produto::paginate(16);
        return view('livewire.pages.produtos', compact('produtos'));
    }
}
