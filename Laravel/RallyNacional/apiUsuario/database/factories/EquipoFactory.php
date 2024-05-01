<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EquipoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "sede_id" => $this->faker->numberBetween(1,2),
            "desafio_id" => 1,
            "nombre" => $this->faker->company(),
        ];
    }
}
