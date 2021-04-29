<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\Routine;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();

        $users_count = User::all()->count();
        $posts_count = Post::all()->count();
        $comments_count = Comment::all()->count();
        $routines_count = Routine::all()->count();

        return view('home', compact('users_count', 'posts_count', 'comments_count', 'routines_count'));
    }
}
