<?php

use App\Http\Controllers\SuperAdmin\PendingApprovalsController;
use App\Http\Controllers\SuperAdmin\UserManagementController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

// SK member dashboard
Route::get('dashboard', function () {
    return Inertia::render('SKMemberDashboard');
})->middleware(['auth', 'verified', 'user.type:Member'])->name('dashboard');

// SK official dashboard (requires approval)
Route::get('official/dashboard', function () {
    return Inertia::render('SKOfficialDashboard');
})->middleware(['auth', 'verified', 'user.type:Official', 'approval.status'])->name('official.dashboard');

// SuperAdmin Dashboard
Route::get('superadmin/dashboard', function () {
    return Inertia::render('SuperAdminDashboard');
})->middleware(['auth', 'verified', 'user.type:Superadmin'])->name('superadmin.dashboard');

// Pending Approval Page for Officials
Route::get('pending-approval', function () {
    return Inertia::render('auth/PendingApproval');
})->middleware(['auth', 'verified'])->name('pending-approval');

// Superadmin sidebar routes
Route::middleware(['auth', 'verified', 'user.type:Superadmin'])->group(function () {
   Route::get('/pending/approvals', [PendingApprovalsController::class, 'index'])->name('pending.approvals.index');
   Route::patch('/pending/approvals/{user}/approve', [PendingApprovalsController::class, 'approve'])->name('pending.approvals.approve');
   Route::patch('/pending/approvals/{user}/reject', [PendingApprovalsController::class, 'reject'])->name('pending.approvals.reject');

   Route::get('/user/management', [UserManagementController::class, 'index'])->name('user.management.index');
   Route::get('/user/{user}/edit', [UserManagementController::class, 'edit'])->name('user.edit');
});


require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
