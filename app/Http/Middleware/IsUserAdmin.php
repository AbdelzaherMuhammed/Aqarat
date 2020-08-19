<?php

namespace App\Http\Middleware;

use Closure;
use phpDocumentor\Reflection\DocBlock\Tags\Author;

class IsUserAdmin
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
        if (auth()->user()->admin != 1)
        {
            return redirect('login');
        }
        return $next($request);
    }
}
