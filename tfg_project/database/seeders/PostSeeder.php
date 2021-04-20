<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach(range(1,10) as $i){
            Post::create([
                'user_id' => 1,
                'body' => 'Body de prueba',
            ]);
        }
    }
}
