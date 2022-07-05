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
            $finalizado = $this->buscarDadosBling($count);
            print_r("\n Numero do contador CLIENTES $count \n");
            $count++;
        } while ($finalizado == false);

        print_r("\n *********** Finalizado! *********** \n");
    }

    public function buscarDadosBling($count)
    {
        try {
            $encontrou = false;

            while ($encontrou  == false) {
                $request = Http::get("https://bling.com.br/Api/v2/contatos/page=$count/json/&apikey=" . env('API_KEY_BLING'));

                if (isset($request['retorno']['contatos'])) {
                    $dados = $request['retorno']['contatos'];
                    SalvarClienteNoBancoJob::dispatch($dados);
                    break;
                } elseif ($request['retorno']['erros'][0]['erro']['cod'] == 18) {
                    sleep(1);
                } elseif ($request['retorno']['erros'][0]['erro']['cod'] == 14) {
                    return true;
                }
            }
            return false;
        } catch (\Throwable $th) {
        }
    }
}
