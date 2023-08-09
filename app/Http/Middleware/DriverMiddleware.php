<?php

namespace App\Http\Middleware;
use Auth;
use Closure;
use Illuminate\Http\Request;

class DriverMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {   $userid = auth()->user()->tokens();
        // $user = Auth::guard('user_driver')->user();
        dd($userid);
        if(!Auth::user()->role_as == '1'){
            return redirect('/home')->with('status','Access Denied.As you are not Admin');
        }
        return $next($request);
    }
}
