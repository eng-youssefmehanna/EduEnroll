<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::with('contents')->get();
        return view('student.courses.index', compact('courses'));
    }

    public function show(Course $course)
    {
        $course->load('contents');
        $isEnrolled = false;

        if (Auth::check()) {
            $isEnrolled = $course->enrollments()->where('student_id', Auth::id())->exists();
        }

        return view('student.courses.show', compact('course', 'isEnrolled'));
    }

    public function dashboard()
    {
        $courses = Auth::user()->courses()->with('contents')->get();
        return view('student.dashboard', compact('courses'));
    }

    public function content(Course $course)
    {
        $isEnrolled = $course->enrollments()->where('student_id', Auth::id())->exists();

        if (!$isEnrolled) {
            return redirect()->route('courses.public.show', $course)
                ->with('error', 'You are not enrolled in this course.');
        }

        $contents = $course->contents()->orderBy('order')->get();
        return view('student.courses.content', compact('course', 'contents'));
    }
}
