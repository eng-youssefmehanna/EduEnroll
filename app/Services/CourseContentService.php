<?php

namespace App\Services;

use App\Models\Course;
use App\Models\CourseContent;

class CourseContentService
{
    public function getForCourse(Course $course)
    {
        return $course->contents()->orderBy('order')->get();
    }

    public function create(Course $course, array $data)
    {
        $course->contents()->create($data);
    }

    public function update(CourseContent $content, array $data)
    {
        $content->update($data);
    }

    public function delete(CourseContent $content)
    {
        $content->delete();
    }
}
