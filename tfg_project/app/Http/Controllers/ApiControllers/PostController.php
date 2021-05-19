<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

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
    * Devuelve los posts de los usuarios seguidos
    */

    public function getPostsFromFollowed(Request $request)
    {
        $followed = $request->user()->followed()->get()->pluck('id');
        $posts_from_followed = PostResource::collection(Post::whereIn('user_id', $followed)->get());

        return response()->json([
            'posts' => $posts_from_followed,
        ]);
    }

    /*
    * Crea un post
    */

    public function create(CreatePostRequest $request)
    {
        $post = new Post([
            'user_id' => $request->user()->id,
            'body' => $request->body,
        ]);

        $post->categories()->attach($request->categorias);

        if ($post->save()) {

            if ($request->image) {
                $path = 'posts/image_' . $post->id . '.' . $request->image->getClientOriginalExtension();

                $image = Image::make($request->image)->encode('jpg', 90);
                $image->resize(null, 800, function ($constraint) {
                    $constraint->aspectRatio();
                });

                Storage::put($path, (string) $image);

                $post->update(['image' => $path]);
            }
            return response()->json([
                'message' => trans('tfg.api.responses.post_created')
            ], 200);
        }

        return response()->json([
            'message' => trans('tfg.api.responses.post_not_created')
        ], 400);
    }

    /*
    * Actualiza un post
    */

    public function update(UpdatePostRequest $request, $id)
    {
        $currentUser = $request->user();
        $post = $currentUser->posts()->find($id);

        $post->fill([
            'body' => $request->body
        ]);

        if ($post->update()) {

            $post->categories()->sync($request->categorias);

            if ($request->image) {
                $path = 'posts/image_' . $post->id . '.' . $request->image->getClientOriginalExtension();

                if (Storage::exists($path)) {
                    Storage::delete($path);
                }

                $image = Image::make($request->image)->encode('jpg', 90);
                $image->resize(null, 800, function ($constraint) {
                    $constraint->aspectRatio();
                });

                Storage::put($path, (string) $image);

                $post->update(['image' => $path]);
            }
            return response()->json([
                'message' => trans('tfg.api.responses.post_updated')
            ], 200);
        }

        return response()->json([
            'message' => trans('tfg.api.responses.post_not_updated')
        ], 400);
    }

    /*
    * Elimina un post
    */

    public function destroy(Request $request, $id)
    {
        $currentUser = $request->user();
        $post = $currentUser->posts()->findOrFail($id);

        if(Storage::exists($post->getOriginal('image'))){
            Storage::delete($post->getOriginal('image'));
        }
        if ($post->forceDelete()) {
            return response()->json([
                'message' => trans('tfg.api.responses.post_deleted')
            ], 200);
        }
        return response()->json([
            'message' => trans('tfg.api.responses.post_not_deleted')
        ], 400);
    }

    /*
    * Like/Dislike a un post
    */

    public function likeDislike(Request $request, $id)
    {
        $currentUser = $request->user();
        $post = $currentUser->posts()->find($id);

        if ($post->likes()->where('user_id', $currentUser->id)->first()) {
            $post->likes()->detach($currentUser->id);
            return response()->json([
                'message' => trans('tfg.api.responses.post_liked')
            ], 200);
        }

        $post->likes()->attach($currentUser->id);

        return response()->json([
            'message' => trans('tfg.api.responses.post_disliked')
        ], 200);
    }
}
