<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = factory(User::class)->create([
            'name'=>'Andrés David Solarte Vidal',
            'email'=>'andresdavidsolartevidal@gmail.com',
            'password' => bcrypt('123456789'),
        ]);
        $user = factory(User::class)->create([
            'name'=>'Usuario de Prueba',
            'email'=>'test@test.com',
            'password' => bcrypt('123456789'),
        ]);

        factory(User::class, 7)->create();
    }
}
