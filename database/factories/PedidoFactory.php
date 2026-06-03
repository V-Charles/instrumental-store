<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PedidoFactory extends Factory
{
    public function definition(): array
    {
        return [
            'codigo' => strtoupper(Str::random(8)),
            'total' => fake()->randomFloat(2, 50, 5000),
            'status' => fake()->randomElement(['pendente', 'enviado', 'entregue', 'cancelado']),
            'forma_pagamento' => fake()->randomElement(['cartao', 'pix', 'boleto']),
            'cliente_nome' => fake()->name(),
            'cliente_email' => fake()->unique()->safeEmail(),
            'created_at' => fake()->dateTimeBetween('-6 months', 'now'),
            'updated_at' => now(),
        ];
    }
}