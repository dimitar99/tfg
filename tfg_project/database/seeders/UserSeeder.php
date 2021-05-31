<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

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
            'bio' => Str::random(50),
            'email' => 'dimitar1999.de@gmail.com',
            'password' => bcrypt('1234'),
        ]);

        User::create([
            'name' => 'Jose',
            'surnames' =>  'Manuel Garcia',
            'nick' => 'josema_train',
            'bio' => Str::random(50),
            'email' => 'josema@gmail.com',
            'password' => bcrypt('1234'),
        ]);

        User::create([
            'name' => 'Miguel',
            'surnames' =>  'Garcia Jimenez',
            'nick' => 'magaji1223',
            'bio' => Str::random(50),
            'email' => 'magaji@gmail.com',
            'password' => bcrypt('1234'),
        ]);

        foreach (range(1, 50) as $i) {
            User::create([
                'name' => 'Luis',
                'surnames' =>  'Manuel Garcia',
                'nick' => Str::random(12),
                'email' => Str::random(5).'@gmail.com',
                'password' => bcrypt('1234'),
            ]);
        }
    }
}
