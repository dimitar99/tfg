<?php

namespace Database\Seeders;

use App\Models\Routine;
use App\Models\RoutineType;
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
            'routine_type_id' => RoutineType::all()->random()->id,
            'description' => 'Esto es una prueba para crear una rutina y que la tabla no se quede vacia',
            'image' => 'imagen'
        ]);

        Routine::create([
            'name' => 'Rutina 2',
            'routine_type_id' => RoutineType::all()->random()->id,
            'description' => 'Esto es una prueba para crear una rutina y que la tabla no se quede vacia',
            'image' => 'imagen'
        ]);

        Routine::create([
            'name' => 'Rutina 3',
            'routine_type_id' => RoutineType::all()->random()->id,
            'description' => 'Esto es una prueba para crear una rutina y que la tabla no se quede vacia',
            'image' => 'imagen'
        ]);
    }
}
