<?php

namespace App\Http\Livewire\Pages;

use App\Models\Proposta;
use Livewire\Component;

class Propostas extends Component
{
    public $estado = 0;
    public $name;
    public $test;

    public function render()
    {
        $propostas = Proposta::paginate(10);
        return view('livewire.pages.propostas', compact('propostas'))
            ->extends('livewire.layouts.dashboard-layout');
    }

    public function filtrarEstado($estado)
    {
        $this->estado = $estado;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
}
