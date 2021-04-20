<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
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
    * Crea un post
    */

    public function create(CreatePostRequest $request)
    {
        if ($request->createPost()) {
            return response()->json([
                'message' => 'Post creado correctamente'
            ], 200);
        }
        return response()->json([
            'message' => 'El post no ha sido creado'
        ], 400);
    }

    /*
    * Actualiza un post
    */

    public function update(UpdatePostRequest $request, $id)
    {
        $currentUser = $request->user();
        $post = $currentUser->posts()->findOrFail($id);

        if ($request->updatePost($post)) {
            return response()->json([
                'message' => 'Post actualizado correctamente'
            ], 200);
        }
        return response()->json([
            'message' => 'El post no ha sido actualizado'
        ], 400);
    }

    /*
    * Elimina un post
    */

    public function destroy(Request $request, $id)
    {
        $currentUser = $request->user();
        $post = $currentUser->posts()->findOrFail($id);

        if ($post->forceDelete()) {
            return response()->json([
                'message' => 'Eliminado correctamente'
            ], 200);
        }
        return response()->json([
            'message' => 'No se ha podido eliminar'
        ], 400);
    }
}
