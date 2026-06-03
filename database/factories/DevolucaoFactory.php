<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class DevolucaoFactory extends Factory
{
    public function definition(): array
    {
        return [
            'codigo_rastreio' => fake()->randomElement([null, strtoupper(Str::random(13))]),
            'motivo' => fake()->randomElement(['Produto danificado', 'Tamanho incorreto', 'Arrependimento', 'Cor diferente']),
            'observacoes' => fake()->sentence(),
            'status' => fake()->randomElement(['solicitado', 'aguardando_envio', 'inspecao', 'reembolsado', 'recusado']),
            'created_at' => fake()->dateTimeBetween('-2 months', 'now'),
            'updated_at' => now(),
        ];
    }
}