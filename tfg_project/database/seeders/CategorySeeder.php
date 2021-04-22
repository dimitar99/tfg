<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create(['name' => 'Entrenamiento']);
        Category::create(['name' => 'Alimentacion']);
        Category::create(['name' => 'Suplementacion']);
    }
}
