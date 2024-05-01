<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ArchivoGeneralFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombre' => $this->faker->text(),
            'Descripcion' => $this->faker->text(),
            'url' => $this->faker->text(),
            "id_user" => $this->faker->numberBetween(1,2),
        ];
    }
}
