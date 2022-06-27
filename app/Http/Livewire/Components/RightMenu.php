<?php

namespace App\Http\Livewire\Components;

use App\Models\Proposta;
use Livewire\Component;

class RightMenu extends Component
{
    public function render()
    {
        $propostas = Proposta::take(4)
            ->get();
        return view('livewire.components.right-menu', compact('propostas'));
    }
}
