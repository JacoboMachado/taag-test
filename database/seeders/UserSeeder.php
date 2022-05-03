<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $users = [
            ['name' => $faker->name, 'email' => 'admin@admin.com', 'password' => Hash::make('123clave'), 'is_admin' => true],
            ['name' => $faker->name, 'email' => 'user1@prueba.com', 'password' => Hash::make('123clave'), 'is_admin' => false],
            ['name' => $faker->name, 'email' => 'user2@prueba.com', 'password' => Hash::make('123clave'), 'is_admin' => false],
            ['name' => $faker->name, 'email' => 'user3@prueba.com', 'password' => Hash::make('123clave'), 'is_admin' => false],
            ['name' => $faker->name, 'email' => 'user4@prueba.com', 'password' => Hash::make('123clave'), 'is_admin' => false],
            ['name' => $faker->name, 'email' => 'user5@prueba.com', 'password' => Hash::make('123clave'), 'is_admin' => false],
        ];
        
        
        User::insert($users);
    }
}
