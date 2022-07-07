<?php

namespace App\Jobs;

use App\Models\Cliente;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class BuscarCliente implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $cnpj;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($cnpj)
    {
        $this->cnpj = $cnpj;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $request = Http::get("https://bling.com.br/Api/v2/contato/$this->cnpj/json/&apikey=" . env('API_KEY_BLING'));

        if (isset($request['retorno']['contatos'])) {
            $dado = $request['retorno']['contatos'];
            dd($dado);

            $listarClientes = new Cliente([
                'id' => $dado['contato']['id'],
                'codigo' => $dado['contato']['codigo'],
                'nome' => $dado['contato']['nome'],
                'fantasia' => $dado['contato']['fantasia'],
                'tipo' => $dado['contato']['tipo'],
                'cnpj' => $dado['contato']['cnpj'],
                'ie_rg' => $dado['contato']['ie_rg'],
                'endereco' => $dado['contato']['endereco'],
                'numero' => $dado['contato']['numero'],
                'bairro' => $dado['contato']['bairro'],
                'cep' => $dado['contato']['cep'],
                'cidade' => $dado['contato']['cidade'],
                'complemento' => $dado['contato']['complemento'],
                'uf' => $dado['contato']['uf'],
                'fone' => $dado['contato']['fone'],
                'email' => $dado['contato']['email'],
                'situacao' => $dado['contato']['situacao'],
                'contribuinte' => $dado['contato']['contribuinte'],
                'site' => $dado['contato']['site'],
                'celular' => $dado['contato']['celular'],
                'dataAlteracao' => $dado['contato']['dataAlteracao'],
                'dataInclusao' => $dado['contato']['dataInclusao'],
                'sexo' => $dado['contato']['sexo'],
                'clienteDesde' => $dado['contato']['clienteDesde'],
                'limiteCredito' => intval($dado['contato']['limiteCredito']),
            ]);

            if ($listarClientes->save()) {
            } else {
                print_r("erro, ");
            }
            break;
        } elseif ($request['retorno']['erros'][0]['erro']['cod'] == 18) {
            sleep(1);
        } elseif ($request['retorno']['erros'][0]['erro']['cod'] == 14) {
            return true;
        }
    }
}
