<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Category;
use App\Post;
use App\User;

class CategoryController extends Controller
{
    public function show($id) {
        $posts = Post::where([['category_id', $id], ['deleted_status', -1]])->orderBy('created_at', 'DESC')->paginate(9);

        return view('home', [
            'posts' => $posts,
        ]);
    }
}
