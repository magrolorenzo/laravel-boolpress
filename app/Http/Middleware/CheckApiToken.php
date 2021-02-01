<?php

namespace App\Http\Middleware;

use Closure;
use App\User;

class CheckApiToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $auth_token = $request->header("authorization");
        // Verifica la presenza del token di auth

        if(empty($auth_token)){
            return response()->json([
                "success" =>false,
                "error" => "API Token mancante"
            ]);
        }
        // Faccio substring per togliere Bearer all inizio del auth token
        $token = substr($auth_token, 7);
        // Seleziono l'utente corrispondente al token api
        $user = User::where("api_token",$token)->first();

        // Da errore se il token passato non esiste nella tabella degli user
        if(!$user){
            return response()->json([
                "success" =>false,
                "error" => "API Token Errato"
            ]);
        }

        return $next($request);
    }
}
