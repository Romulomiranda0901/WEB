<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PropuestaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombre' => $this->faker->unique()->word(),
            'categoria_id' => $this->faker->numberBetween(1,2)
        ];
    }
}
