<?php

namespace App\Http\Livewire\Pages\Proposta;

use App\Models\Proposta;
use Illuminate\Http\Request;
use Livewire\Component;

class Show extends Component
{
    public function render(Request $request)
    {
        $proposta = Proposta::all()->find($request->id);
        
        $produto1 = $proposta->produtosProposta->first()->produtos;
        return view('livewire.pages.proposta.show', compact('proposta'));
    }
}
