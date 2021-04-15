<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    /*
    * Devuelve todos los posts
    */
    public function index()
    {
        $posts = Post::paginate(15);

        return PostResource::collection($posts);
    }
}
