<?php

namespace App\Jobs;

use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class BuscarPagamentosBling implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $finalizado = false;
        $count = 1;

        try {

            $request = Http::get("https://bling.com.br/Api/v2/formaspagamento/json&apikey=" . env('API_KEY_BLING'));


            $forma_pagamento = json_decode($request, true);
            $forma_pagamento = array_shift($forma_pagamento);
            $forma_pagamento = array_shift($forma_pagamento);
            SalvarPagamentosBling::dispatch($forma_pagamento);
        } catch (\Throwable $th) {
        }
    }
}
