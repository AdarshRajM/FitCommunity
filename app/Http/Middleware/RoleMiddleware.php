<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        $user = Auth::user();
        
        // Map role string to ID
        $roleMap = [
            'admin' => 1,
            'user' => 2,
            'doctor' => 3,
            'trainer' => 4
        ];

        if (!isset($roleMap[$role]) || $user->role_id != $roleMap[$role]) {
            abort(403, 'Unauthorized Access - Invalid Role.');
        }

        return $next($request);
    }
}
