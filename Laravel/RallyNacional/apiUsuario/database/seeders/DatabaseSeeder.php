<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CoordinadorSede;
use App\Models\EventoSede;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            UserRoleSeeder::class,
            EventoSeeder::class,
            UserSeeder::class,
            InstitucionesSeeder::class,
            RegionSeeder::class,
            DepartamentoSeeder::class,
            MunicipioSeeder::class,
            SedeSeeder::class,
            GeneroSeeder::class,
            CategoriasSeeder::class,
            PatrocinadorSeeder::class,
            DesafioSeeder::class,
            TipoArchivoSeeder::class,

            GrupoEtnicoSeeder::class,
            TipoCordinadorSeeder::class,
            PropuestaSeeder::class,


        ]);


        CoordinadorSede::factory(2)->create();

        $this->call(EventoSedeSeeder::class);

        \App\Models\Equipo::factory(5)
            ->has(\App\Models\Participante::factory(5), "participantes")
        ->create();

        $this->call( CriterioSeeder::class);
        $this->call( EntregableSeeder::class);

        $this->call(  EvaluacionPorSedeSeeder::class);
        $this->call(   EvaluacionPorNacionalSeeder::class);
    }
}
