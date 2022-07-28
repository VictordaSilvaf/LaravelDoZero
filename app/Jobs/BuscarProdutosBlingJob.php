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

class BuscarProdutosBlingJob implements ShouldQueue
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
            print_r("Numero do contador PRODUTOS $count \n ");
            $count++;
        } while ($finalizado == false);
        print_r("\n *********** Finalizado! ***********");
    }

    /**
     *   Função que busca produtos do bling, se não encontrado busca denovo 3 vezes, caso encontre retorna *   false, caso finalize a busca retorna true
     *
     *   @return bool
     */
    public function buscarDadosBling($count)
    {
        try {
            $encontrou = false;

            while ($encontrou  == false) {
                $request = Http::get("https://bling.com.br/Api/v2/produtos/page=$count/json/&estoque=S&apikey=" . env('API_KEY_BLING'));

                if (isset($request['retorno']['produtos'])) {
                    $dados = $request['retorno']['produtos'];
                    SalvarProdutoNoBancoJob::dispatch($dados);
                    break;
                } elseif ($request['retorno']['erros'][0]['erro']['cod'] == 18) {
                    sleep(1);
                } elseif ($request['retorno']['erros'][0]['erro']['cod'] == 14) {
                    return true;
                }
            }
            return false;
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}
