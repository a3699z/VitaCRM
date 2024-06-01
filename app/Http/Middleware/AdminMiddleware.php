<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Http\Facades\Auth;
use Illuminate\Support\Facades\View;


class AdminMiddleware
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

        if (!Auth::admin()) {
            return redirect('/');
        }
        return $next($request);

    }


}
