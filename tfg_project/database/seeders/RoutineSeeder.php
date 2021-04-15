<?php

namespace Database\Seeders;

use App\Models\Routine;
use App\Models\RoutinesType;
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
            'type' => RoutinesType::all()->random()->id,
            'description' => 'Esto es una prueba para crear una rutina y que la tabla no se quede vacia',
            'video' => 'video'
        ]);

        Routine::create([
            'name' => 'Rutina 2',
            'type' => RoutinesType::all()->random()->id,
            'description' => 'Esto es una prueba para crear una rutina y que la tabla no se quede vacia',
            'video' => 'video'
        ]);

        Routine::create([
            'name' => 'Rutina 3',
            'type' => RoutinesType::all()->random()->id,
            'description' => 'Esto es una prueba para crear una rutina y que la tabla no se quede vacia',
            'video' => 'video'
        ]);
    }
}
