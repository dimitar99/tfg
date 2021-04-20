<?php

namespace Database\Seeders;

use App\Models\Comment;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (range(1, 10) as $i){
            Comment::create([
                'user_id' => 1,
                'post_id' => 1,
                'body' => 'Esto es un comentario de prueba para rellenar la tabla y que no este vacia',
            ]);
            Comment::create([
                'user_id' => 1,
                'post_id' => 2,
                'body' => 'Esto es un comentario de prueba para rellenar la tabla y que no este vacia',
            ]);
            Comment::create([
                'user_id' => 1,
                'post_id' => 3,
                'body' => 'Esto es un comentario de prueba para rellenar la tabla y que no este vacia',
            ]);
        }
    }
}
