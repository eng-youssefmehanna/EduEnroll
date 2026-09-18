<?php

namespace App\Services;

use App\Models\Course;

class CourseService
{
    public function getAll()
    {
        return Course::with('contents')->get();
    }

    public function create(array $data)
    {
        return Course::create($data);
    }

    public function findById(string $id)
    {
        return Course::findOrFail($id);
    }

    public function update(string $id, array $data)
    {
        $course = Course::findOrFail($id);
        $course->update($data);
        return $course;
    }

    public function delete(string $id)
    {
        Course::findOrFail($id)->delete();
    }
}