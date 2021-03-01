<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class VerificationConnexion
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->guest()) {
            flash('Vous devez être connecté pour voir cette page')->error();

            return redirect('/connexion');
        }


        return $next($request);
    }
}
