<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /*
    * Devuelve el listado de post paginado
    */

    public function list()
    {
        $posts = Post::paginate(15);

        return view('posts.list', ['posts' => $posts]);
    }

    /*
    * Muestra el detalle de un post
    */

    public function show($id)
    {
        $post = Post::findOrFail($id);

        $image = "";

        if(Storage::exists($post->image)){
            $image = Storage::url($post->image);
        }

        return view('posts.show', compact('post', 'image'));
    }

    /*
    * Elimina un post
    */

    public function destroy(Post $post)
    {
        $post->forceDelete();

        return redirect()->route('posts.list');
    }
}
