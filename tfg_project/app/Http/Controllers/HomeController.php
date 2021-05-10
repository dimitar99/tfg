<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Routine;
use App\Models\RoutineType;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

        $categories = Category::withCount('posts')->get();
        $categories_names = $categories->pluck('name')->toArray();
        $count_post = $categories->pluck('posts_count')->toArray();

        $routine_types = RoutineType::withCount('routines')->get();
        $routine_types_names = $routine_types->pluck('name')->toArray();
        $count_routine = $routine_types->pluck('routines_count')->toArray();

    return view('home', compact('users_count', 'posts_count', 'comments_count', 'routines_count', 'categories_names', 'count_post', 'routine_types_names', 'count_routine'));
    }
}
