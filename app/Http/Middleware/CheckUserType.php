<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserType
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$types): Response
    {
        $user = auth()->user();

        if (!$user) {
            return redirect()->route('login');
        }

        // Check if user type is allowed
        if (!in_array($user->user_type, $types)) {
            abort(403, 'Unauthorized access.');
        }

        // Don't redirect pending officials if they're accessing the pending-approval page
        if ($request->routeIs('pending-approval')) {
            return $next($request);
        }

        // For officials, check if they are approved (except superadmin)
        if ($user->isOfficial() && !$user->isApproved()) {
            return redirect()->route('pending-approval');
        }

        return $next($request);
    }
}
