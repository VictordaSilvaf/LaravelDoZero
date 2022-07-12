<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Testes extends Component
{
    public $test;

    public function render()
    {
        return view('livewire.testes')
            ->extends('livewire.layouts.dashboard-layout');
    }
}
