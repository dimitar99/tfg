<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Dimitar',
            'surnames' =>  'Emilov Tochev',
            'nick' => 'dimitar99',
            'email' => 'dimitar1999.de@gmail.com',
            'password' => bcrypt('1234'),
        ]);

        User::create([
            'name' => 'Jose',
            'surnames' =>  'Manuel Garcia',
            'nick' => 'josema69',
            'email' => 'josema.de@gmail.com',
            'password' => bcrypt('1234'),
        ]);

    }
}
