<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Services\EnrollmentService;
use Illuminate\Support\Facades\Auth;

class EnrollmentController extends Controller
{
    public function __construct(protected EnrollmentService $service) {}

    public function store(Course $course)
    {
        $result = $this->service->enroll(Auth::user(), $course);

        if (!$result['success']) {
            return redirect()->route('courses.public.show', $course)
                ->with('error', $result['message']);
        }

        return redirect()->route('my-courses.content', $course)
            ->with('success', 'Successfully enrolled!');
    }
}