<?php

namespace App\Http\Livewire\Pages;

use App\Models\Proposta;
use Illuminate\Http\Request;
use Livewire\Component;

class Propostas extends Component
{
    public $filtro = "todas";
    public $busca;

    public function render()
    {
        if ($this->filtro == 'todas') {
            $propostas = Proposta::paginate(10);
        } else {
            $propostas = Proposta::where('status', '==', $this->filtro)->paginate(10);
        }

        return view('livewire.pages.propostas', compact('propostas'))
            ->extends('livewire.layouts.dashboard-layout');
    }

    public function buscarPropostas()
    {
        if ($this->filtro == 'todas') {
            $propostas = Proposta::paginate(10);
        } else {
            $propostas = Proposta::where('status', $this->filtro)->paginate(10);
        }

        return view('livewire.pages.propostas', compact('propostas'))
            ->extends('livewire.layouts.dashboard-layout');
    }

    public function mudarEstadoPC($id, $estado)
    {
        $proposta = Proposta::all()->find($id);

        if ($estado == 1) {
            $proposta->status = 'aceita';
        } else if ($estado == 2) {
            $proposta->status = 'recusada';
        }

        $proposta->save();

        return redirect()->back();
    }

    public function mudarFiltro($filtro)
    {
        $this->filtro = $filtro;
    }
}
