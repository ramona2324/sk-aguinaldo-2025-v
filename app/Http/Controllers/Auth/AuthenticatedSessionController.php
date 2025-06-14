<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Response;

class AuthenticatedSessionController extends Controller
{
    /**
     * Show the login page.
     */
    public function create(Request $request): Response
    {
        return Inertia::render('auth/Login', [
            'canResetPassword' => Route::has('password.request'),
            'status' => $request->session()->get('status'),
        ]);
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $user = Auth::user();

        // Check if official has pending status
        if ($user->isOfficial() && $user->isPending()) {
            return redirect()->route('pending-approval');
        }

        // Check if official was rejected
        if ($user->isOfficial() && $user->isRejected()) {
            Auth::logout();
            return back()->withErrors([
                'email' => 'Your SK Official account has been rejected. Please contact the administrator for more information.',
            ]);
        }

        // Redirect based on user type
        if ($user->isSuperAdmin()) {
            return redirect()->intended(route('superadmin.dashboard', absolute: false));
        }

        if ($user->isOfficial() && $user->isApproved()) {
            return redirect()->intended(route('official.dashboard', absolute: false));
        }

        if ($user->isMember()) {
            return redirect()->intended(route('dashboard', absolute: false));
        }

        return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
