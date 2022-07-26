<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class Testes extends Component
{
    public $test;

    public function render()
    {
        dd($this->getFreteMandae());

        return $this->getFreteMandae();
    }

    public function getFreteMandae()
    {
        $frete = Cache::get('fretes_produtos_user_id_cliente' . auth()->user()->id);
        dd($frete);
    }
    // env('API_TOKEN_MANDAE')
}
