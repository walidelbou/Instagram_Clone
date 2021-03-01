<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User as User;
use App\Models\Post as Post;
use App\Illuminate\Support\Facades;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::all();

        return view('Users/index', [
            'users' => $users
        ]);
    }

    public function show(int $id)
    {
        $user = User::all()->where('id', $id)->first();
        return view('Users/show', ['user' => $user]);
    }

    public function profile()
    {
        $email = request('email');
        $user = User::where('email', $email)->firstOrFail();
        $posts = Post::where('user_id', $user->id)->latest()->get();

        return view('Users/profil', [
            'user' => $user,
            'posts' => $posts
        ]);
    }

    public function follow()
    {
        $follower = auth()->user();
        $following = User::where('email', request('email'))->firstOrFail();

        $follower->following()->attach($following);

        //Envoyer un mail:
        Mail::to($following->email)->send(new SendMail());

        flash("You are now following $following->name ")->success();
        return back();
    }

    public function unfollow()
    {

        $follower = auth()->user();
        $following = User::where('email', request('email'))->firstOrFail();

        $follower->following()->detach($following);

        flash("You're no longer following $following->name ")->warning();
        return back();
    }
}
