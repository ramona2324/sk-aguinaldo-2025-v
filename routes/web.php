<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

// SK member dashboard
Route::get('dashboard', function () {
    return Inertia::render('SKMemberDashboard');
})->middleware(['auth', 'verified', 'user.type:member'])->name('dashboard');

// SK official dashboard (requires approval)
Route::get('official/dashboard', function () {
    return Inertia::render('SKOfficialDashboard');
})->middleware(['auth', 'verified', 'user.type:official', 'approval.status'])->name('official.dashboard');

// SuperAdmin Dashboard
Route::get('superadmin/dashboard', function () {
    return Inertia::render('SuperAdminDashboard');
})->middleware(['auth', 'verified', 'user.type:superadmin'])->name('superadmin.dashboard');

// Pending Approval Page for Officials
Route::get('pending-approval', function () {
    return Inertia::render('auth/PendingApproval');
})->middleware(['auth', 'verified'])->name('pending-approval');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
