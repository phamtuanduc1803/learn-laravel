<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Images;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Category;
use App\Post;
use App\User;
use App\Like;
use App\Comment;

class PostController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('post.create',[
            'categories' => $categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        $post = Post::created($request->all());
        $post->user_id = Auth::user()->id;

        $imageName = $post->id . '_' . time() . '.' . substr($request->file('image')->getMimeType(), 6);
        $imagePath = $request->file('image')->storeAs('public/images', $imageName);
        $imagePath = substr($imagePath, strlen('public'));
        $post->image_path = $imagePath;

        $post->save();

        return redirect()->action([PostController::class, 'show'], ["post"=>$post->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        $post->num_view++;
        $post->save();
        $comments = $post->comments;
        if (Auth::check()){
            $like = Like::where([['user_id',Auth::user()->id ],['post_id', $id]])->first();
        } else $like = null;
        $populars = Post::where('category_id', $post->category_id)->paginate(3);

        return view('post.view',[
            'post' => $post,
            'comments' => $comments,
            'like' => $like,
            'populars' => $populars
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        $categories = Category::all();
        return view('post.edit', [
            'post' => $post,
            'categories' => $categories,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StorePostRequest $request, $id)
    {
        $post = Post::find($id);
        $post->update([
            'title' => $request->title,
            'body' => $request->body,
            'category_id' => $request->category_id,
        ]);

        if($request->hasFile('image')) {
            $imageName = $post->id . '_' . time() . '.' . substr($request->file('image')->getMimeType(), 6);
            $imagePath = $request->file('image')->storeAs('public/images', $imageName);
            $imagePath = substr($imagePath, strlen('public'));
            $post->image_path = $imagePath;
            $post->save();
        }
        return redirect()->action([PostController::class, 'show'], ['post'=>$id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->deleted_status = 1;
        $post->save();

        return redirect()->route('user.profile', ['id' => $post->user_id]);
    }

}


