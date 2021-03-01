<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function dashboard()
    {

        if (auth()->check()) {
            return view('UserAccount/dashboard', [
                'user' => auth()->user()
            ]);
        }
        flash('You have to be connected to access this page')->error();

        return back();
    }

    public function signout()
    {
        auth()->logout();

        return redirect("/connexion");
    }

    public function form_password_modification()
    {
        if (auth()->check()) {
            return view('UserAccount/password_modification');
        }
        flash('You have to be connected to access this page!')->error();
        return redirect('/connexion');
    }

    public function password_modification()
    {
        request()->validate([
            'password' => ['required', 'min:8', 'confirmed'],
            'password_confirmation' => ['required']
        ]);

        $user = auth()->user();

        $user->password = bcrypt(request('password'));
        $user->save();
        // OU
        // auth()->user()->update([
        //     'password' => bcrypt(request('password')),
        // ]);

        flash('Your password has been modified')->success();
        return redirect('/dashboard');
    }
}
