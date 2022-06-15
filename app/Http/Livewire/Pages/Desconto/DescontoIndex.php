<?php

namespace App\Http\Livewire\Pages\Desconto;

use App\Models\Desconto;
use Livewire\Component;

class DescontoIndex extends Component
{
    public function render()
    {
        $descontos = Desconto::paginate(8);
        return view('livewire.pages.desconto.desconto-index', compact('descontos'));
    }
}
