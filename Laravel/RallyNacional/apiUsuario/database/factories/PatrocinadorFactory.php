<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PatrocinadorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'Nombre' => $this->faker->text(),
            'Logo' => $this->faker->url(),
        ];
    }
}
