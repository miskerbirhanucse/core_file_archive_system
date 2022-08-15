<?php

namespace App\Http\Middleware;

use App\Models\Users;
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
        if (auth()->check() && $request->user()->approved == Users::REJECTED || $request->user()->approved == Users::PENDING) {
            Auth::guard('web')->logout();
            return redirect()->route('login')->with('loginredirect', trans('Your account needs admin approval'));
        }
        return $next($request);
    }
}
