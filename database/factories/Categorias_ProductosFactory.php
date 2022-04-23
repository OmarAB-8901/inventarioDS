<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class Categorias_ProductosFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'descripcion' => $this->faker->sentence()
        ];
    }
}
