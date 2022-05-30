<?php

namespace App\Http\Livewire\Pc\Components;

use App\Models\FormaPagamento;
use App\Models\Pagamento;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class SelectPayments extends Component
{
    public $formaPagamento = "";
    public $identificacaoFormaPagamento = "";

    public function render()
    {
        $this->formaPagamento = Pagamento::all()->whereIn('id_bling', ['50972', '69590', '777279', '777565', '787855', '789959', '789960', '797755', '947074', '947314', '1302911']);
        return view('livewire.pc.components.select-payments');
    }

    public function changePayment()
    {
        $key_cache = 'produtos_user_id_pagamento' . auth()->user()->id;

        if (Cache::has($key_cache)) {
            Cache::forget($key_cache);
        }

        Cache::add($key_cache, $this->identificacaoFormaPagamento, 1200);
    }
}
