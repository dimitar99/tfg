<?php

namespace Database\Seeders;

use App\Models\Category;
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
        /*foreach(range(1,10) as $i){
            $post = Post::create([
                'user_id' => 1,
                'body' => 'Body de prueba',
            ]);
            $post->categories()->attach(Category::find(rand(1,3)));
        }*/

        $post = Post::create([
            'user_id' => 2,
            'body' => 'Despues un entrenamiento de espalda',
        ]);
        $post->categories()->attach(Category::find(rand(1,3)));

        $post = Post::create([
            'user_id' => 2,
            'body' => 'Nada como respirar un poco de aire fresco',
        ]);
        $post->categories()->attach(Category::find(rand(1,3)));

        // foreach(range(1,10) as $i){
        //     $post = Post::create([
        //         'user_id' => 1,
        //         'body' => 'Body de prueba',
        //         'image' => asset('/assets/images/big/img1.jpg')
        //     ]);
        //     $post->categories()->attach(Category::find(rand(1,3)));
        // }

        // foreach(range(1,10) as $i){
        //     $post = Post::create([
        //         'user_id' => 3,
        //         'body' => 'Body de prueba',
        //     ]);
        //     $post->categories()->attach(Category::find(rand(1,3)));
        // }
    }
}
