<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Approval
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
        if (auth()->check() && $request->user()->approved == User::REJECTED || $request->user()->approved == User::PENDING) {
            Auth::guard('web')->logout();
            return redirect()->route('login')->with('loginredirect', trans('Your account needs admin approval'));
        }
        return $next($request);
    }
}
