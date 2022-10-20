<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Post;
use App\User;

class UserController extends Controller
{
    public function pertional($id) {
        $posts = Post::where('user_id', $id)->where('deleted_status', -1)->paginate(9);
        $user = User::find($id);
        return view('pertional', [
            'posts' => $posts,
            'user' => $user,
         ]);
    }

    public function update(ProfileRequest $request, $id) {
        $user = User::find($id);
        $user->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
        ]);
        if ($request->hasFile('image')) {
            $imageName = $user->id . '-' . time() . '.' . substr($request->file('image')->getMimeType(), 6);
            $imagePath = $request->file('image')->storeAs('public/images', $imageName);
            $imagePath = substr($imagePath, strlen('public'));
            $user->image_path = $imagePath;
            $user->save();
        }
        return redirect()->route('user.profile', ['id' => $id]);
    }

    public function changePassword(Request $request) {

    }

    public function edit() {

        return view('editprofile');
    }

}
