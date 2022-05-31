<?php

namespace App\Jobs;

use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class BuscarClientesBlingJob implements ShouldQueue
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

        do {
            try {

                $request = Http::get("https://bling.com.br/Api/v2/contatos/page=$count/json/&apikey=9e9423b85ebb62aac022e74a212a2fa643dd9704753fdfebe07457803cc475c0c78211b2&loja=203345790%22");

                $lista_clientes = json_decode($request, true);
                $lista_clientes = array_shift($lista_clientes);
                $lista_clientes = array_shift($lista_clientes);
                if (!isset(array_shift($lista_clientes[0])['cod'])) {
                    /* Chamando o worker para cadastrar os cliente no banco */
                    SalvarClienteNoBancoJob::dispatch($lista_clientes);
                    ++$count;
                } else {
                    /* Deu erro */
                    $finalizado = true;
                }
            } catch (\Throwable $th) {
                dd($th);
            }
        } while ($finalizado == false);
    }
}
