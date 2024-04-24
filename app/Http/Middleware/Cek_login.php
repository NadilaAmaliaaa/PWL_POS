<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Cek_login
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $roles): Response
    {
        // Function to check if a user is logged in (possibly using Laravel's built-in Auth::check())
        if (!Auth::check()) {
            return redirect('login');
        }

        // Save the logged-in user data in a variable named $user
        $user = Auth::user();

        // Check if the user's level matches the specified roles
        if ($user->level_id == $roles) {
            return $next($request);
        }

        // If user level doesn't match or user is not logged in, redirect to login with an error message
        return redirect('login')->with('error', 'Maaf anda tdak memiliki akses');
    }
}
