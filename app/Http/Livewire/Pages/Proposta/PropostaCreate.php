<?php

namespace App\Http\Livewire\Pages\Proposta;

use App\Models\Proposta;
use Livewire\Component;

class PropostaCreate extends Component
{
    public function render()
    {
        /* dd(Proposta::all()->first()->produtosProposta->first()->produtos->desconto); */
        return view('livewire.pages.proposta.create');
    }
}
