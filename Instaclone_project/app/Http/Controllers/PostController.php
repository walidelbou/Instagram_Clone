<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Post as Post;
use App\Models\User;

class PostController extends Controller
{
    public function new_post()
    {
        if (auth()->guest()) {
            flash('You have to be connected to acces this page.', 'error');
            return redirect('/connexion');
        }

        request()->validate([
            'content' => ['required']
        ]);

        // $url_image = cloudinary()->upload(request()->file('file'))->getrealpath()->getSecurePath();

        auth()->user()->posts()->create([
            'content' => request('content'),
            'user_id' => auth()->id(),
            'title' => request('title'),
            'url_image' => ""
        ]);

        flash('Your post has been added', 'success');
        return back();
    }

    public function postIndex()
    {
        $posts = Post::with('user')->get();


        return view('welcome', [
            'posts' => $posts,
        ]);
    }
}
