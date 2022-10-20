<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request) {
        $posts = Post::where('title', 'like', '%'.$request->search_key.'%')->paginate(9);
        return view('home', [
            'posts' => $posts,
        ]);
    }
}
