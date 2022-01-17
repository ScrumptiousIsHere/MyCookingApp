<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class checkUser
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
        $user=Auth::user();
        if($user){
            $ft=User::where('id',$user->id)->first();

            if($ft->first_time){
                return response()->view('setdata');
            }
            else{
                return response()->view('programulmeu');
            }
        }

        return $next($request);
    }
}
