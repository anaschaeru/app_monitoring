<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AttendanceController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

Route::middleware(['auth', 'role:siswa'])->group(function () {
    Route::resource('attendances', AttendanceController::class);
    Route::post('/attendances/{attendance}/checkout', [AttendanceController::class, 'checkout'])->name('attendances.checkout');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('dashboard.index');
    })->name('admin.dashboard');
});

Route::middleware(['auth', 'role:siswa'])->group(function () {
    Route::get('/student/dashboard', function () {
        return view('students.index');
    })->name('student.dashboard');
});

Route::middleware(['auth', 'role:pembimbing_sekolah'])->group(function () {
    Route::get('/school/dashboard', function () {
        return view('dashboard.index');
    })->name('school.dashboard');
});

Route::middleware(['auth', 'role:pembimbing_perusahaan'])->group(function () {
    Route::get('/company/dashboard', function () {
        return view('dashboard.index');
    })->name('company.dashboard');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__ . '/auth.php';
