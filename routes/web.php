<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\Admin\SchoolController;
use App\Http\Controllers\Admin\ClassController;


Route::prefix('admin')->middleware(['auth','isAdmin'])->group(function () {
    Route::resource('schools', SchoolController::class);
    Route::resource('classes', ClassController::class);
    });

    Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

require __DIR__.'/auth.php';
