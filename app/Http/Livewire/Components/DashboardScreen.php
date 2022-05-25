<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;

class DashboardScreen extends Component
{
    public function render()
    {
        return view('livewire.components.pages.dashboard-screen')
            ->extends('layouts.dashboard');
    }
}
