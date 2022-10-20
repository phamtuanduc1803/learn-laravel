<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;
use App\Category;
use App\Comment;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

     public function index() {
        $posts = Post::where('deleted_status', -1)->orderBy('created_at', 'DESC')->paginate(9);
        return view('home', [
            'posts' => $posts,
        ]);
     }
}
