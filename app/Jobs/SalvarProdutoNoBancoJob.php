<?php

namespace App\Jobs;

use App\Models\Produto;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SalvarProdutoNoBancoJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $produtos;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(
        public $dados
    ) {
        $this->produtos = $dados;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach ($this->produtos as $produto) {
            try {
                $produto['produto']['estrutura'] = isset($produto['produto']['estrutura'])
                    ? json_encode($produto['produto']['estrutura'])
                    : '[]';
                $produto['produto']['depositos'] = isset($produto['produto']['depositos'])
                    ? json_encode($produto['produto']['depositos'])
                    : '[]';
                $produto['produto']['categoria'] = isset($produto['produto']['categoria'])
                    ? json_encode($produto['produto']['categoria'])
                    : '[]';

                Produto::updateOrCreate(
                    ['id' =>  $produto['produto']['id']],
                    $produto['produto']
                )->save();
            } catch (\Throwable $th) {
                return dd($th);
            }
        }
        return true;
    }
}
