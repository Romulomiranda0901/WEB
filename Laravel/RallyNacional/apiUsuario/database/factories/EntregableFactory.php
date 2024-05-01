<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EntregableFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'nombre' => $this->faker->text(),
            'Descripcion' => $this->faker->text(),
        ];
    }
}
