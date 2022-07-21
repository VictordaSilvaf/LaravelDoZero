<?php

namespace App\Http\Livewire\Pages;

use App\Jobs\EnviarPropostaBling;
use App\Models\Proposta;
use Livewire\Component;

class Propostas extends Component
{
    public $filtro = "todas";
    public $busca;

    public function render()
    {
        if (isset($this->busca)) {
            if ($this->filtro != 'todas') {
                $propostas = Proposta::whereHas('clientes', function ($query) {
                    $query->where('cnpj', 'LIKE', "$this->busca%");
                })->orderBy('updated_at', 'desc')->paginate(10);
            } else {
                $propostas = Proposta::whereHas('clientes', function ($query) {
                    $query->where('cnpj', 'LIKE', "$this->busca%");
                })->orderBy('updated_at', 'desc')->paginate(10);
            }
        } else {
            if ($this->filtro != 'todas') {
                $propostas = Proposta::where('status', $this->filtro)->orderBy('updated_at', 'desc')->paginate(10);
            } else {
                $propostas = Proposta::orderBy('updated_at', 'desc')->paginate(10);
            }
        }

        return view('livewire.pages.propostas', compact('propostas'))
            ->extends('livewire.layouts.dashboard-layout');
    }

    public function mudarEstadoPC($id, $estado)
    {
        $proposta = Proposta::all()->find($id);

        if ($estado == 1) {
            EnviarPropostaBling::dispatch($proposta);
        } else if ($estado == 2) {
            $proposta->status = 'recusada';
            $proposta->save();
        }
    }

    public function mudarFiltro($filtro)
    {
        $this->filtro = $filtro;
    }
}
