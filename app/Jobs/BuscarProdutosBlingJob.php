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
            try {

                $request = Http::get("https://bling.com.br/Api/v2/produtos/page=$count/json/&estoque=S&apikey=9e9423b85ebb62aac022e74a212a2fa643dd9704753fdfebe07457803cc475c0c78211b2&loja=203345790%22");

                $list_produtos = json_decode($request, true);
                $list_produtos = array_shift($list_produtos);
                $list_produtos = array_shift($list_produtos);

                if (!isset(array_shift($list_produtos[0])['cod'])) {
                    /* Chamando o worker para cadastrar os produtos no banco */
                    SalvarProdutoNoBancoJob::dispatch($list_produtos);
                    ++$count;
                } else {
                    /* Deu erro */
                    $finalizado = true;
                }
            } catch (\Throwable $th) {
            }
        } while ($finalizado == false);
    }
}
