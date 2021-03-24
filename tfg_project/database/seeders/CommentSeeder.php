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
        Comment::create([
            'user_id' => 1,
            'post_id' => 1,
            'content' => 'Esto es un comentario de prueba para rellenar la tabla y que no este vacia',
        ]);
    }
}
