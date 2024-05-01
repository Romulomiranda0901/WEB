<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CoordinadorSedeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "cedula" => $this->faker->bothify("###-######-####?"),
            "nombres" => $this->faker->firstName(),
            "apellidos" => $this->faker->lastName(),
            "genero_id" => $this->faker->numberBetween(1,2),
            "sede_id" => $this->faker->numberBetween(1,2),
            "tipo_cordinadors_id" => $this->faker->numberBetween(1,2)
        ];
    }
}
