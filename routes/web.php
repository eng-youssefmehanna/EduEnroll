<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\SchoolController;
use App\Http\Controllers\Admin\ClassController;
use App\Http\Controllers\Admin\CourseContentController;
use App\Http\Controllers\Admin\EnrollmentController;
use App\Http\Controllers\Student\CourseController as StudentCourseController;
use App\Http\Controllers\Student\EnrollmentController as StudentEnrollmentController;

// Public routes
Route::get('/', [StudentCourseController::class, 'index'])->name('courses.public.index');
Route::get('/courses/{course}', [StudentCourseController::class, 'show'])->name('courses.public.show');

// Student routes
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [StudentCourseController::class, 'dashboard'])->name('dashboard');
    Route::get('/my-courses/{course}', [StudentCourseController::class, 'content'])->name('my-courses.content');
    Route::post('/enroll/{course}', [StudentEnrollmentController::class, 'store'])->name('enroll');
});

// Admin routes
Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function () {
    Route::resource('schools', SchoolController::class);
    Route::resource('classes', ClassController::class);
    Route::resource('students', StudentController::class);
    Route::resource('courses', CourseController::class);
    Route::resource('courses.contents', CourseContentController::class);
    Route::get('enrollments', [EnrollmentController::class, 'index'])->name('enrollments.index');
});

require __DIR__.'/auth.php';