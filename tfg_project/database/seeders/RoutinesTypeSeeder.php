<?php

namespace Database\Seeders;

use App\Models\RoutinesType;
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
        RoutinesType::create(['name' => 'Pecho']);
        RoutinesType::create(['name' => 'Biceps']);
        RoutinesType::create(['name' => 'Triceps']);
        RoutinesType::create(['name' => 'Hombros']);
        RoutinesType::create(['name' => 'Espalda']);
        RoutinesType::create(['name' => 'Piernas']);
        RoutinesType::create(['name' => 'Abdominales']);
        RoutinesType::create(['name' => 'Cardio']);
    }
}
