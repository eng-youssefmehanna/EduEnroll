<?php

namespace App\Services;

use App\Models\Course;
use App\Models\Enrollment;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class EnrollmentService
{
    public function enroll(User $student, Course $course): array
    {
        $alreadyEnrolled = Enrollment::where('student_id', $student->id)
            ->where('course_id', $course->id)
            ->exists();

        if ($alreadyEnrolled) {
            return ['success' => false, 'message' => 'You are already enrolled in this course.'];
        }

        try {
            DB::transaction(function () use ($student, $course) {
                $current = Enrollment::where('course_id', $course->id)
                    ->lockForUpdate()
                    ->count();

                if ($course->max_students !== null && $current >= $course->max_students) {
                    throw new \Exception('This course is full.');
                }

                Enrollment::create([
                    'student_id'  => $student->id,
                    'course_id'   => $course->id,
                    'enrolled_at' => now(),
                ]);
            });
        } catch (\Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }

        return ['success' => true, 'message' => ''];
    }
}