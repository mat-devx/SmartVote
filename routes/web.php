<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;





Route::get('/', function () {
    return redirect()->route('login');
});
Route::get('/dashboard', function () {
    /** @var \App\Models\User|null $user */
    $user = Auth::user();

    // fallback to 'student' if role not present
    $role = $user?->role ?? 'student';

    if ($role === 'admin') {
        return redirect()->route('admin.index');
    }

    return redirect()->route('student.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Dashboards
Route::middleware(['auth'])->group(function () {
    Route::view('/admin/dashboard', 'Admin.adminDashboard')
        ->name('admin.index');

    // ensure this matches your file: resources/views/Student/studentDashboard.blade.php
    Route::view('/student/dashboard', 'Student.studentDashboard')
        ->name('student.index');
});

require __DIR__ . '/auth.php';
