<?php

namespace Database\Seeders;

use App\Models\RoutineType;
use Illuminate\Database\Seeder;

class RoutinesTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RoutineType::create(['name' => 'Pecho']);
        RoutineType::create(['name' => 'Biceps']);
        RoutineType::create(['name' => 'Triceps']);
        RoutineType::create(['name' => 'Hombros']);
        RoutineType::create(['name' => 'Espalda']);
        RoutineType::create(['name' => 'Piernas']);
        RoutineType::create(['name' => 'Abdominales']);
        RoutineType::create(['name' => 'Cardio']);
        RoutineType::create(['name' => 'Cuerpo Completo']);
    }
}
