<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  string  ...$roles
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        if (! Auth::check()) {
            return redirect()->route('login');
        }

        $userRole = Auth::user()->role ?? User::PELANGGAN;

        // Compare roles case-insensitively to avoid mismatches like 'Admin' vs 'admin'
        $normalizedUserRole = strtolower($userRole);
        $normalizedRoles = array_map('strtolower', $roles);

        if (! in_array($normalizedUserRole, $normalizedRoles, true)) {
            abort(403, 'Anda tidak memiliki hak akses.');
        }

        return $next($request);
    }
}





