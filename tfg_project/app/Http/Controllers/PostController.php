<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /*
    * Devuelve el listado de post paginado
    */

    public function list()
    {
        $posts = Post::paginate(10);

        return view('posts.list', ['posts' => $posts]);
    }

    /*
    * Muestra el detalle de un post
    */

    public function show($id)
    {
        $post = Post::findOrFail($id);

        return view('posts.show', compact('post'));
    }

    /*
    * Elimina un post
    */

    public function destroy(Post $post)
    {
        $post->forceDelete();

        return redirect()->route('posts.index');
    }
}
