<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\StudentController;
 use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\SchoolController;
use App\Http\Controllers\Admin\ClassController;
use App\Http\Controllers\Admin\CourseContentController;


Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function () {
    Route::resource('schools', SchoolController::class);
    Route::resource('classes', ClassController::class);
    Route::resource('students', StudentController::class);
    Route::resource('courses', CourseController::class);
    Route::resource('courses.contents', CourseContentController::class);
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

require __DIR__.'/auth.php';
