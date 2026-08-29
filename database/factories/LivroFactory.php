<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Autor;
use App\Models\Livro;
use Illuminate\Database\Eloquent\Factories\Factory;
class LivroFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id'=> User::first()->id ?? User::factory(),
            'titulo' => fake()->sentence(3), 
            'genero' => fake()->word(),
            'numero_paginas' => fake()->numberBetween(50, 800),
            'data_publicacao' => fake()->date(), 
            'autor_id' => Autor::factory(), 
        ];
    }
}