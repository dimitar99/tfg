<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        $post = new Post([
            'user_id' => $request->user()->id,
            'body' => $request->body
        ]);

        if ($post->save()) {
            if ($request->image) {
                $path = 'posts/image_' . $post->id . '.' . $request->image->getClientOriginalExtension();
                Storage::put($path, file_get_contents($request->image));
                $post->update(['image' => $path]);
            }
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

        $post->fill([
            'body' => $request->body
        ]);

        if ($post->update()) {
            if ($request->image) {
                $path = 'posts/image_' . $post->id . '.' . $request->image->getClientOriginalExtension();

                if (Storage::exists($path)) {
                    Storage::delete($path);
                }

                Storage::put($path, file_get_contents($request->image));
                $post->update(['image' => $path]);
            }
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

    /*
    * Like/Dislike a un post
    */

    public function likeDislike(Request $request, $id)
    {
        $currentUser = $request->user();
        $post = $currentUser->posts()->findOrFail($id);

        if ($post->likes()->where('user_id', $currentUser->id)->first()){
            $post->likes()->detach($currentUser->id);
            return response()->json([
                'message' => 'Dislike a post'
            ], 200);
        }

        $post->likes()->attach($currentUser->id);

        return response()->json([
            'message' => 'Like a post'
        ], 200);
    }


    /*
    * Follow/Unfollow a un user
    */

    public function followUnfollow(Request $request, $id)
    {
        $currentUser = $request->user();
        $user = User::where()
    }
}
