<?php

namespace App\Http\Livewire\Pages\Proposta;

use App\Models\Proposta;
use Livewire\Component;

class PropostaCreate extends Component
{
    public function render()
    {
        return view('livewire.pages.proposta.create')
            ->extends('livewire.layouts.dashboard-layout');
    }
}
