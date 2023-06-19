<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Enums\UsersTypesEnums;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{

    public function handle(Request $request, Closure $next)
    {
        // dd(Auth::user()->type == UsersTypesEnums::ADMIN , Auth::user());
     if (Auth::user()->type == UsersTypesEnums::ADMIN) {
        return $next($request);
     }
     abort(403);



     }
}
