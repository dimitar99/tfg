<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;

class PostsController extends Controller
{
    /*
    * Devuelve todos los posts
    */
    public function getPosts()
    {
        $posts = Post::paginate(15);

        return PostResource::collection($posts);
    }

    /*
    * Elimina un post
    */
    public function destroy(User $user, $id)
    {
        $post = Post::findOrFail($id);

        if ($user->id == $post->user_id){
            $post->forceDelete();
        }
    }
}
