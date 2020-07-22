<?php

namespace App\Http\Middleware;

use Closure;
use App\User;

class userAuth
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
        $token = $request->token;
        $user = User::where('token',$token)->first();
        if($user)
        {
            $request->user = $user;
        }
        else
        {
            return response()->json([
                'status' => false,
                'message' => 'Authentication required',
            ]);
        }
        return $next($request);
    }
}
