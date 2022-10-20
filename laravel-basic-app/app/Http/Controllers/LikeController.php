<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Comment;
use App\Post;
use App\User;
use App\Like;

class LikeController extends Controller
{
    public function store($id) {
        $like = new Like;
        $like->post_id = $id;
        $like->user_id = Auth::user()->id;
        $like->like_status = 1;
        $like->save();

        $like->post->num_like++;
        $like->post->save();

        return redirect()->action([PostController::class, 'show'],['post'=>$id]);
    }

    public function update($id) {
        $like = Like::find($id);
        if ($like->like_status == 0) {
            $like->post->num_like++;
            $like->like_status = 1;
        } else {
            $like->post->num_like--;
            $like->like_status = 0;
        }
        $like->save();
        $like->post->save();
        return redirect()->action([PostController::class, 'show'], ['post'=>$like->post_id]);
    }
}
