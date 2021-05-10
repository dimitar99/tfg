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

        User::create([
            'name' => 'Jose',
            'surnames' =>  'Manuel Garcia',
            'nick' => 'aaaa',
            'email' => 'aaaaa@gmail.com',
            'password' => bcrypt('1234'),
        ]);

        User::create([
            'name' => 'Jose',
            'surnames' =>  'Manuel Garcia',
            'nick' => 'bbbbb',
            'email' => 'bbbb@gmail.com',
            'password' => bcrypt('1234'),
        ]);

        User::create([
            'name' => 'Jose',
            'surnames' =>  'Manuel Garcia',
            'nick' => 'cccc',
            'email' => 'cccccc.de@gmail.com',
            'password' => bcrypt('1234'),
        ]);

        User::create([
            'name' => 'Jose',
            'surnames' =>  'Manuel Garcia',
            'nick' => 'dddddd',
            'email' => 'dddddd.de@gmail.com',
            'password' => bcrypt('1234'),
        ]);

        User::create([
            'name' => 'Jose',
            'surnames' =>  'Manuel Garcia',
            'nick' => 'qqqqqqq',
            'email' => 'qqqqqq.de@gmail.com',
            'password' => bcrypt('1234'),
        ]);

        User::create([
            'name' => 'Jose',
            'surnames' =>  'Manuel Garcia',
            'nick' => 'wwwwww',
            'email' => 'wwwww.de@gmail.com',
            'password' => bcrypt('1234'),
        ]);

        User::create([
            'name' => 'Jose',
            'surnames' =>  'Manuel Garcia',
            'nick' => 'eeeeeeee',
            'email' => 'eeeeeee.de@gmail.com',
            'password' => bcrypt('1234'),
        ]);

        User::create([
            'name' => 'Jose',
            'surnames' =>  'Manuel Garcia',
            'nick' => 'fffffff',
            'email' => 'fffffffff.de@gmail.com',
            'password' => bcrypt('1234'),
        ]);

        foreach (range(1, 50) as $i) {
            User::create([
                'name' => 'Jose',
                'surnames' =>  'Manuel Garcia',
                'nick' => Str::random(12),
                'email' => Str::random(5).'@gmail.com',
                'password' => bcrypt('1234'),
            ]);
        }
    }
}
