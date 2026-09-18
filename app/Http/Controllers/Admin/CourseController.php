<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Services\CourseService;

class CourseController extends Controller
{
    private CourseService $courseService;

    public function __construct(CourseService $courseService)
    {
        $this->courseService = $courseService;
    }

    public function index()
    {
        $courses = $this->courseService->getAll();
        return view('admin.courses.index', compact('courses'));
    }

    public function create()
    {
        return view('admin.courses.create');
    }

    public function store(StoreCourseRequest $request)
    {
        $this->courseService->create($request->validated());
        return redirect()->route('courses.index')->with('success', 'Course created successfully');
    }

    public function edit(string $id)
    {
        $course = $this->courseService->findById($id);
        return view('admin.courses.edit', compact('course'));
    }

    public function update(UpdateCourseRequest $request, string $id)
    {
        $this->courseService->update($id, $request->validated());
        return redirect()->route('courses.index')->with('success', 'Course updated successfully');
    }

    public function destroy(string $id)
    {
        $this->courseService->delete($id);
        return redirect()->route('courses.index')->with('success', 'Course deleted successfully');
    }
}