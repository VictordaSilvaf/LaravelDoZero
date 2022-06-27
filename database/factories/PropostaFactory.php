<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Proposta>
 */
class PropostaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'users_id' => auth()->user()->id,
            'clientes_id' => $cliente[0]->id,
            'consumo_revenda' => $cliente[1],
            'observacaoVendedor' => $this->observacaoVendedor,
            'transportadora' => $this->clienteTransportadora,
            'modo_envio' => $this->clienteEnvio,
            'frete' => (float) $this->clienteFrete,
            'peso_total' => (float) $this->pesoTotal,
            'parcelas' => $parcelas,
            'desconto_vendedor' => (float) $this->descontoVendedor,
            'desconto_total' => (float) $this->descontoVendedor, // Calcular o desconto total
            'total' => (float) $this->calcTotal($produtos, $this->descontoVendedor),
        ];
    }
}
