<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class MyAuth
{

    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        if (Session::get('isLogin')) {
            return $next($request);
        }
        return redirect("/login");
    }
}
