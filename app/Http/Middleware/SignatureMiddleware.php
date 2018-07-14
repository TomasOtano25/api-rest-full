<?php

namespace App\Http\Middleware;

use Closure;

class SignatureMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $header = 'X-Name') // Las cabezeras personalizadas deben de comenzar con una X
    {
        $response = $next($request); // respuesta
        $response->headers->set($header, config('app.name'));   
        return $response;
    }
}
