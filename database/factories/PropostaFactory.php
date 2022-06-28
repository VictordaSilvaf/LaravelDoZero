<?php

namespace Database\Factories;

use App\Models\Cliente;
use App\Models\Pagamento;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

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
        $transportadoras = ["JADLOG.COM", "JADLOG.PACKAGE", "SEDEX - EXPRESSO CORREIOS", "PAC - ECONÔMICO CORREIOS", "JONAS VIEIRA", "PEX", "RETIRAR", "OUTROS"];

        $envios = ["R", "D", "T", "3", "4", "S",];

        $parcelas = array();
        for ($i = 0; $i < $this->faker->random_int(0, 11); $i++) {
            array_push(
                $parcelas,
                [
                    "parcela" . $i => [
                        'dia' => $this->faker->random_int(1, 31),
                        'valor' => $this->faker->random_int(1, 250),
                        'descricao' => $this->faker->paragraph,
                        'forma_pagamento' => random_int(0, Pagamento::all()->count()),
                    ]
                ],
            );
        };

        return [
            'users_id' => random_int(0, User::all()->count()),
            'clientes_id' => random_int(0, Cliente::all()->count()),
            'consumo_revenda' => (rand(0, 1) == 0) ? 'consumo' : 'revenda',
            'observacaoVendedor' => $this->faker->paragraph,
            'transportadora' => $transportadoras[array_rand($transportadoras)],
            'modo_envio' => $envios[array_rand($envios)],
            'frete' => $this->faker->random_int(1, 10000),
            'peso_total' => $this->faker->random_int(20, 200),
            'parcelas' => $parcelas,
            'desconto_vendedor' => $this->faker->random_int(1, 15),
            'desconto_total' => $this->faker->random_int(1, 15),
            'total' => $this->faker->random_int(1, 10000),
        ];
    }
}
