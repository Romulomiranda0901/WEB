<?php

namespace Database\Seeders;


use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        (new User(
            [
            'name' => 'admin',
            'password' => bcrypt('secret'),
           'evento_id' => 1
        ],

        ))->save();

        (new User(
            [
                'name' => 'aldo.berrios',
                'password' => bcrypt('secret'),
                'evento_id' => 1
            ],

        ))->save();

        (new User(
            [
                'name' => 'equipo',
                'password' => bcrypt('secret'),
                'evento_id' => 1
            ],

        ))->save();



        $user1 = User::find(1);
        $user1->assignRole('admin');
        $user2 = User::find(2);
        $user2->assignRole('coordinador_sede');
        $user3 = User::find(3);
        $user3->assignRole('equipo');

    }



}
