<?php

namespace App\Http\Livewire\Layouts;

use Livewire\Component;

class DashboardLayout extends Component
{
    public function render()
    {
        return view('livewire.layouts.dashboard-layout')
            ->extends('layouts.dashboard-layout');
    }
}
