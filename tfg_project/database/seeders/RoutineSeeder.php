<?php

namespace Database\Seeders;

use App\Models\Routine;
use Illuminate\Database\Seeder;

class RoutineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Routine::create([
            'name' => 'Rutina 1',
            'type' => 'Tipo 1',
            'description' => 'Esto es una prueba para crear una rutina y que la tabla no se quede vacia',
            'video' => 'video'
        ]);

        Routine::create([
            'name' => 'Rutina 2',
            'type' => 'Tipo 2',
            'description' => 'Esto es una prueba para crear una rutina y que la tabla no se quede vacia',
            'video' => 'video'
        ]);

        Routine::create([
            'name' => 'Rutina 3',
            'type' => 'Tipo 3',
            'description' => 'Esto es una prueba para crear una rutina y que la tabla no se quede vacia',
            'video' => 'video'
        ]);
    }
}
