<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Inertia\Response;

class RegisteredUserController extends Controller
{
    /**
     * Show the registration type selection page
     */
    public function selectType(): Response
    {
        return Inertia::render('auth/RegisterSelect');
    }

    /**
     * Show the SK Member registration page.
     */
    public function createMember(): Response
    {
        return Inertia::render('auth/Register', [
            'userType' => 'member'
        ]);
    }

    /**
     * Show the SK Official registration page.
     */
    public function createOfficial(): Response
    {
        return Inertia::render('auth/Register', [
            'userType' => 'official'
        ]);
    }

    /**
     * Handle SK Member registration.
     */
    public function storeMember(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:'.User::class,
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'user_type' => 'member',
            'status' => 'approved', // Members are auto-approved
        ]);

        event(new Registered($user));
        Auth::login($user);

        return to_route('dashboard'); // Members go directly to dashboard
    }

    /**
     * Handle SK Official registration.
     */
    public function storeOfficial(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:'.User::class,
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'user_type' => 'official',
            'status' => 'pending', // Officials start as pending
        ]);

        event(new Registered($user));
        Auth::login($user);

        \Log::info('Redirecting to pending-approval for user: ' . $user->email);

        // Redirect to pending approval page instead of dashboard
//        return to_route('pending-approval');
        return redirect()->route('pending-approval');
    }



    /**
     * Show the registration page.
     */
//    public function create(): Response
//    {
//        return Inertia::render('auth/Register');
//    }
//
//    /**
//     * Handle an incoming registration request.
//     *
//     * @throws \Illuminate\Validation\ValidationException
//     */
//    public function store(Request $request): RedirectResponse
//    {
//        $request->validate([
//            'name' => 'required|string|max:255',
//            'email' => 'required|string|lowercase|email|max:255|unique:'.User::class,
//            'password' => ['required', 'confirmed', Rules\Password::defaults()],
//        ]);
//
//        $user = User::create([
//            'name' => $request->name,
//            'email' => $request->email,
//            'password' => Hash::make($request->password),
//        ]);
//
//        event(new Registered($user));
//
//        Auth::login($user);
//
//        return to_route('dashboard');
//    }
}
