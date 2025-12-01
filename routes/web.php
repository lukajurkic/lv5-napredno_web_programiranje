<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentTaskController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TeacherApplicationController;
use App\Http\Controllers\StudentApplicationController;
use App\Http\Controllers\UserController; // za admin

Route::get('/', function () {
    return view('welcome');
});

// Dashboard preusmjeravanje po ulozi
Route::get('/dashboard', function(){
    $user = auth()->user();

    if($user->role === 'student'){
        return redirect()->route('student.tasks.index');
    } elseif($user->role === 'teacher'){
        return redirect()->route('tasks.create');
    } elseif($user->role === 'admin'){
        return redirect()->route('users.index');
    }
})->middleware(['auth'])->name('dashboard');

// Profile rute (Breeze)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Promjena jezika
Route::get('/lang/{locale}', function ($locale) {
    if (in_array($locale, ['hr', 'en'])) {
        session(['locale' => $locale]);
    }
    return redirect()->back();
});

// Teacher rute
Route::middleware(['auth', 'role:teacher'])->group(function () {
    Route::get('/tasks/create', [TaskController::class, 'create'])->name('tasks.create');
    Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');

    Route::get('/teacher/applications', [TeacherApplicationController::class, 'index'])->name('teacher.applications.index');
    Route::post('/teacher/applications/{application}/accept', [TeacherApplicationController::class, 'accept'])->name('teacher.applications.accept');
});

// Student rute
Route::middleware(['auth', 'role:student'])->group(function () {
    Route::get('/student/tasks', [StudentTaskController::class, 'index'])->name('student.tasks.index');
    Route::post('/tasks/{task}/apply', [StudentApplicationController::class, 'apply'])->name('tasks.apply');
});

// Admin rute
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::post('/users/{user}/role', [UserController::class, 'updateRole'])->name('users.updateRole');
});

require __DIR__.'/auth.php';
