<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class TranslateMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->route()->getPrefix()=='translations'){
            $auth = auth()->user();
            if($auth->type!='admin') abort(404);
        }

        return $next($request);
    }
}
