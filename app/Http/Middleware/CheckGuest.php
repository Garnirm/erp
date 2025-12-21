<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckGuest
{
    public function handle(Request $request, \Closure $next): mixed
    {
        if (Auth::check()) {
            if ($request->ajax()) {
                return response()->json([ 'success' => false, 'errors' => [ 'Authenticated.' ] ], 403);
            }

            return redirect('/');
        }

        return $next($request);
    }
}
