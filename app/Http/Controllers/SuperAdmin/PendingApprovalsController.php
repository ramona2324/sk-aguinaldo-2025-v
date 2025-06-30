<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PendingApprovalsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get all users with 'official' user_type and 'pending' status
        $pendingOfficialUsers = User::all()
            ->filter(function ($user) {
                return $user->isPending() && $user->isOfficial();
            });

        return Inertia::render('SuperAdmin/PendingApprovals', [
            'pendingOfficialUsers' => $pendingOfficialUsers,
        ]);
    }

    /**
     * Approve a pending user.
     */
    public function approve(Request $request, User $user)
    {
        // Validate that the user is pending and official
        if (!$user->isPending() || !$user->isOfficial()) {
            return redirect()->back()->with('error', 'SK Member is not eligible for approval.');
        }

        // Update user status to approved
        $user->update([
            'status' => 'approved',
        ]);

        return redirect()->back()->with('success', 'SK Official has been approved to be an admin.');
    }

    /**
     * Reject a pending user.
     */
    public function reject(Request $request, User $user)
    {
        // Validate that the user is pending and official
        if (!$user->isPending() || !$user->isOfficial()) {
            return redirect()->back()->with('error', 'SK Member is not eligible for rejection.');
        }

        // Update user status to rejected or delete the user
        $user->update([
            'status' => 'rejected',
        ]);

        // Alternative: Delete the user entirely
        // $user->delete();

        return redirect()->back()->with('success', 'SK Official Account has been rejected successfully.');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
