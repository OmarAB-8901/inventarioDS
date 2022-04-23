<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductosFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'sku' => $this->faker->randomNumber(5, true),
            'nombre' => $this->faker->word(),
            'id_categoria' => $this->faker->numberBetween(1, 10),
            'descripcion' => $this->faker->sentence(16),
            'precio' => $this->faker->randomFloat(1, 100, 999),
            'cantidad' => $this->faker->randomNumber(3, false),
            'estado' => $this->faker->numberBetween(1, 2),
            'eliminado' => 0,
            // 'productImage' => $this->faker->imageUrl(640, 480, 'animals', true),
        ];
    }

    // function imageUrl(
    //     int $width = 640,
    //     int $height = 480,
    //     ?string $category = null, /* used as text on the image */
    //     bool $randomize = true,
    //     ?string $word = null,
    //     bool $gray = false
    // ): string;
}
