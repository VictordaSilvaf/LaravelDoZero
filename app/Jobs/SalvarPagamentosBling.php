<?php

namespace App\Jobs;

use App\Models\Pagamento;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SalvarPagamentosBling implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $pagamentos;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(
        public $forma_pagamento
    ) {
        $this->pagamentos = $forma_pagamento;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        unset($this->pagamentos[0]);

        foreach ($this->pagamentos as $pagamento) {
            try {
                if (Pagamento::where('id_bling', $pagamento['formapagamento']['id_bling'])->count() >= 1) {
                    $listarPagamentos = Pagamento::find($pagamento['formapagamento']['id'])->first();
                } else {
                    $listarPagamentos = new Pagamento();
                }

                $listarPagamentos->id_bling = $pagamento['formapagamento']['id'];
                $listarPagamentos->descricao = $pagamento['formapagamento']['descricao'];
                $listarPagamentos->codigoFiscal = $pagamento['formapagamento']['codigoFiscal'];
                $listarPagamentos->padrao = $pagamento['formapagamento']['padrao'];
                $listarPagamentos->situacao = intval($pagamento['formapagamento']['situacao']);
                $listarPagamentos->fixa = intval($pagamento['formapagamento']['fixa']);

                if ($listarPagamentos->save()) {
                    print_r("salvo, ");
                } else {
                    print_r("erro, ");
                }
            } catch (\Throwable $th) {
                continue;
            }
        }
    }
}
