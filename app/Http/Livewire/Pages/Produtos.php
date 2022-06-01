<?php

namespace App\Http\Livewire\Pages;

use App\Models\Produto;
use Livewire\Component;

class Produtos extends Component
{
    public function render()
    {
        $produtos = Produto::all();
        return view('livewire.pages.produtos', compact('produtos'));
    }
}
