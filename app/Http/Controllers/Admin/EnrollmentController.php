<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Enrollment;

class EnrollmentController extends Controller
{
    public function index()
    {
        $enrollments = Enrollment::with(['student', 'course'])->latest('enrolled_at')->get();
        return view('admin.enrollments.index', compact('enrollments'));
    }
}
