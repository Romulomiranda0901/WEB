<?php

namespace Database\Seeders;

use App\Models\Propuesta;
use Illuminate\Database\Seeder;

class PropuestaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Propuesta::factory()
            ->count(10)
            ->create();
    }
}
