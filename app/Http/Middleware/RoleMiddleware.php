<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string $roles): Response
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        $user = Auth::user();
        $allowedRoles = array_map('trim', explode('-', $roles));
        $allowedRoles = array_map('strtolower', $allowedRoles);
        $userRole = strtolower(trim($user->role));
        if (in_array($userRole, $allowedRoles)) {
            return $next($request);
        }
        return abort(403, 'Unauthorized action.');
        // return redirect('/home');
    }
}