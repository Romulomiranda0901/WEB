<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\Usuarios::factory(10)->create();
        $this->call([
            RolSeeder::class,
            UsuariosSeeder::class,
            MenuSeeder::class,
            SubmenuSeeder::class,
            SubmenuHijosSeeder::class,
            PermiSeeder::class,
            PermisosSeeder::class,
        ]);

    }
}
