<?php

namespace App\Http\Middleware;

use App\Enum\User\UserRoleEnum;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsRole
{
    /**
     * @param Request $request
     * @param Closure $next
     * @return \Illuminate\Http\RedirectResponse|mixed
     */
    public function handle(Request $request, Closure $next): mixed
    {
        if (Auth::check() && Auth::user()->role == UserRoleEnum::ADMIN) {
            return $next($request);
        }

       return to_route('home');
    }
}
