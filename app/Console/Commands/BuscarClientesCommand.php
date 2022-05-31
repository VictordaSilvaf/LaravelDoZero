<?php

namespace App\Console\Commands;

use App\Jobs\BuscarClientesBlingJob;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Bus;

class BuscarClientesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'buscar-clientes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Preencher banco com os clientes do bling.';

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
            new BuscarClientesBlingJob,
        ])->name('Batch_Listar_clientes')->dispatch();
    }
}
