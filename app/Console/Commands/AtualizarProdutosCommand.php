<?php

namespace App\Console\Commands;

use App\Jobs\BuscarProdutosBlingJob;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Bus;

class AtualizarProdutosCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'atualizar-tabela-produtos';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Listar todos os produtos do bling.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Bus::batch([
            new BuscarProdutosBlingJob,
        ])->name('Batch_Listar_produtos')->dispatch();
    }
}
