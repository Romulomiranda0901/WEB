<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ParticipanteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "genero_id" => $this->faker->numberBetween(1,2),
            "nombres" => $this->faker->firstName(),
            "apellidos" => $this->faker->lastName(),
            "cedula" => $this->faker->bothify("###-######-####?"),
            "grupo_etnicos_id" => $this->faker->numberBetween(1,22),

        ];
    }
}
