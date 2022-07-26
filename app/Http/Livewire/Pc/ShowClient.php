<?php

namespace App\Http\Livewire\Pc;

use App\Models\Cliente;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Illuminate\Support\Facades\Cache;

class ShowClient extends Component
{
    public $identificacaoCliente = '25.782.134/0001-32';
    public $clienteConsumoRevenda;
    public $clienteNota = false;

    public function render()
    {
        $key_cache = 'produtos_user_id_cliente' . auth()->user()->id;
        $cliente = Cache::get($key_cache);

        return view('livewire.pc.show-client', compact('cliente'));
    }

    /* Verifica se existe ou não o cliente no banco, se não existir busca ele do banco de dados. */
    public function search()
    {
        if (!$this->validadorCpfCnpj($this->identificacaoCliente)) {
            if (Cliente::where('cnpj', $this->identificacaoCliente)->first()) {
                $cliente = Cliente::where('cnpj', $this->identificacaoCliente)->first();
                $key_cache = 'produtos_user_id_cliente' . auth()->user()->id;
                $key_cache_produtos = 'produtos_user_id_produtos' . auth()->user()->id;

                if (Cache::has($key_cache)) {
                    Cache::forget($key_cache);
                }

                if (Cache::has($key_cache_produtos)) {
                    Cache::forget($key_cache_produtos);
                }

                Cache::add($key_cache, [$cliente, $this->clienteConsumoRevenda, $this->clienteNota], 1200);
            } else {
                $cliente = $this->getCliente($this->identificacaoCliente);
            }
        } else {
            $this->addError('identificacaoCliente', 'Digite um CPF / CNPJ valido por gentileza.');
        }
    }

    /* Validar CPF/CNPJ */
    public function validadorCpfCnpj($identifiacaoCliente)
    {
        $validator = \Validator::make(
            ['cpf_ou_cnpj' => $identifiacaoCliente],
            ['cpf_ou_cnpj' => 'formato_cpf_ou_cnpj']
        );

        return $validator->fails();
    }

    /* Buscar cliente no bling */
    public function getCliente($clienteCPF)
    {
        $clienteCPF = str_replace('/', '', $clienteCPF);

        $responseCliente = Http::get("https://bling.com.br/Api/v2/contato/$clienteCPF/json&apikey=" . env('API_KEY_BLING'));

        // Verifica de a response tem retorno 
        if ($responseCliente) {
            //adicionar retorno no banco, e percorrendo o array/json
            //verifica se retonar erro caso não encontrado no api
            if (isset($cliente['erro']['cod'])) {
                if ($cliente['erro']['cod'] === 14) {
                    return 0;
                }
            } elseif (isset($responseCliente['retorno']['contatos'][0]['contato'])) {
                $cliente = $responseCliente['retorno']['contatos'][0]['contato'];
                $cliente = $this->store($cliente);

                return $this->search($clienteCPF);
            } else {
                return $this->addError('identificacaoCliente', 'Cliente não encontado.');
            }
        }
    }

    public function store($dado)
    {
        $cliente = new Cliente($dado);

        if ($cliente->save()) {
            return $cliente;
        } else {
            $this->addError('identificacaoCliente', 'Digite um CPF / CNPJ existente por gentileza.');
        }
    }
}
