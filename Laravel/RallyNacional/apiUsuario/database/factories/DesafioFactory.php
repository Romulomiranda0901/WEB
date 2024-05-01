<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DesafioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'Titulo' => $this->faker->text(),
            'Descripcion' => $this->faker->text(),
        ];
    }
}
