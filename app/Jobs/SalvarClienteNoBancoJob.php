<?php

namespace App\Jobs;

use App\Models\Cliente;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SalvarClienteNoBancoJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $clientes;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(
        public $lista_clientes
    ) {
        $this->clientes = $lista_clientes;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $clientes_com_erro = array();
        unset($this->clientes[0]);

        foreach ($this->clientes as $cliente) {
            try {
                if (Cliente::find($cliente['contato']['id'])) {
                } else {
                    $listarClientes = new Cliente();
                    $listarClientes->id = $cliente['contato']['id'];

                    $listarClientes->codigo = $cliente['contato']['codigo'];
                    $listarClientes->nome = $cliente['contato']['nome'];
                    $listarClientes->fantasia = $cliente['contato']['fantasia'];
                    $listarClientes->tipo = $cliente['contato']['tipo'];
                    $listarClientes->cnpj = $cliente['contato']['cnpj'];
                    $listarClientes->ie_rg = $cliente['contato']['ie_rg'];
                    $listarClientes->endereco = $cliente['contato']['endereco'];
                    $listarClientes->numero = $cliente['contato']['numero'];
                    $listarClientes->bairro = $cliente['contato']['bairro'];
                    $listarClientes->cep = $cliente['contato']['cep'];
                    $listarClientes->cidade = $cliente['contato']['cidade'];
                    $listarClientes->complemento = $cliente['contato']['complemento'];
                    $listarClientes->uf = $cliente['contato']['uf'];
                    $listarClientes->fone = $cliente['contato']['fone'];
                    $listarClientes->email = $cliente['contato']['email'];
                    $listarClientes->situacao = $cliente['contato']['situacao'];
                    $listarClientes->contribuinte = $cliente['contato']['contribuinte'];
                    $listarClientes->site = $cliente['contato']['site'];
                    $listarClientes->celular = $cliente['contato']['celular'];
                    $listarClientes->dataAlteracao = $cliente['contato']['dataAlteracao'];
                    $listarClientes->dataInclusao = $cliente['contato']['dataInclusao'];
                    $listarClientes->sexo = $cliente['contato']['sexo'];
                    $listarClientes->clienteDesde = $cliente['contato']['clienteDesde'];
                    $listarClientes->limiteCredito = intval($cliente['contato']['limiteCredito']);

                    if ($listarClientes->save()) {
                    } else {
                        print_r("erro, ");
                    }
                }
            } catch (\Throwable $th) {
                continue;
            }
        }
    }
}
