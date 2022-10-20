<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Comment;
use App\Post;
use App\User;

class CommentController extends Controller
{
    public function store(Request $request) {
        $comment = new Comment;
        $comment->body = $request->comment;
        $comment->user_id = Auth::user()->id;
        $comment->post_id = $request->post_id;
        $comment->save();
        $comment->post->num_comment++;
        $comment->post->save();
        return redirect()->action([PostController::class, 'show'], ['post'=>$comment->post_id]);
    }

}
