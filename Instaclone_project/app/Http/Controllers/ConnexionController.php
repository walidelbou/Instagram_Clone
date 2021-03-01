<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

class ConnexionController extends Controller
{
    //function qui retourne le formulaire de connexio
    //Formulaire de connexion email & password
    public function form()
    {
        return view('Connexion/connexion');
    }
    //fonction qui va traiter notre formulaire de
    //Utiliser les methode de la class authenticable
    //On va pouvoir identifier si les user qui se connecte a deja un compte
    //Si le user exixte on le redirige vers sa page profil
    //si il n'existe pas redirige vers le formulaire de connexion ou on le redirige vers inscription 
    public function connexion()
    {
        request()->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'min:8'],
        ]);

        $result = auth()->attempt([
            'email' => request('email'),
            'password' => request('password'),
        ]);



        if ($result) {
            return redirect('/dashboard');
        }

        return back()->withErrors([
            'email' => 'Les informations ne sont pas bonnes ! Reessayer !'
        ]);
    }
}
