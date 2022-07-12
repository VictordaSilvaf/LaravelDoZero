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
            $propostas = Proposta::paginate(10)->where('status', '==', $this->filtro);
        }

        return view('livewire.pages.propostas', compact('propostas'))
            ->extends('livewire.layouts.dashboard-layout');
    }

    public function buscarPropostas()
    {
        if ($this->filtro == 'todas') {
            $propostas = Proposta::all();
        } else {
            $propostas = Proposta::where('status', $this->filtro);
        }

        if (isset($this->busca)) {
            // dd($propostas->first()->clientes);
            $propostas = $propostas->with(
                [
                    'clientes' => function ($query) {
                        $query->where('clientes.cnpj', 'LIKE', "%$this->filtro%");
                    }
                ]
            );
        } else {
            $propostas = Proposta::all();
        }
        $propostas->paginate(10);

        return view('livewire.pages.propostas', compact('propostas'))
            ->extends('livewire.layouts.dashboard-layout');
    }

    public function mudarFiltro($filtro)
    {
        $this->filtro = $filtro;
    }
}
