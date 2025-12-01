<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentTaskController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/lang/{locale}', function ($locale) {
    if (in_array($locale, ['hr', 'en'])) {
        session(['locale' => $locale]);
    }
    return redirect()->back();
});

Route::middleware(['auth'])->group(function () {
    Route::middleware('role:teacher')->group(function () {
        Route::get('/tasks/create', [TaskController::class, 'create'])->name('tasks.create');
        Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
    });
});

Route::middleware(['auth', 'role:student'])->group(function () {
    Route::get('/student/tasks', [StudentTaskController::class, 'index'])->name('student.tasks.index');
});

Route::middleware(['auth', 'role:teacher'])->group(function () {
    Route::get('/teacher/applications', [TeacherApplicationController::class, 'index'])->name('teacher.applications.index');
    Route::post('/teacher/applications/{application}/accept', [TeacherApplicationController::class, 'accept'])->name('teacher.applications.accept');
});


require __DIR__.'/auth.php';
