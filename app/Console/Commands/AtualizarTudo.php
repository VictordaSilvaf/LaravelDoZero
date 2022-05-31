<?php

namespace App\Console\Commands;

use App\Jobs\BuscarClientesBlingJob;
use App\Jobs\BuscarPagamentosBling;
use App\Jobs\BuscarProdutosBlingJob;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Bus;

class AtualizarTudo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'all';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Atualiza todas as tabelas ao mesmo tempo';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Bus::batch([
            new BuscarPagamentosBling,
            new BuscarProdutosBlingJob,
            new BuscarClientesBlingJob,
        ])->name('Batch_Att_All')->dispatch();
    }
}
