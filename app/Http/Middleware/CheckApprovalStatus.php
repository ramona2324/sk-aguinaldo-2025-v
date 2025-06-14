<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckApprovalStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();

        if (!$user) {
            return redirect()->route('login');
        }

        // Allow access to pending-approval page
        if ($request->routeIs('pending-approval')) {
            return $next($request);
        }

        // For officials, check approval status
        if ($user->isOfficial()) {
            if ($user->isPending()) {
                return redirect()->route('pending-approval')->with('message', 'Your account has still pending status. Please wait for administrator approval.');
            }

            if ($user->isRejected()) {
                auth()->logout();
                return redirect()->route('login')->withErrors([
                    'email' => 'Your SK Official account has been rejected. Please contact the administrator.',
                ]);
            }

            if (!$user->isApproved()) {
                return redirect()->route('pending-approval');
            }
        }

        return $next($request);
    }
}
