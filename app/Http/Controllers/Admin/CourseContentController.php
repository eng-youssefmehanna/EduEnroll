<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseContent;
use App\Services\CourseContentService;
use App\Http\Requests\Admin\StoreCourseContentRequest;
use App\Http\Requests\Admin\UpdateCourseContentRequest;

class CourseContentController extends Controller
{
    public function __construct(protected CourseContentService $service) {}

    public function index(Course $course)
    {
        $contents = $this->service->getForCourse($course);
        return view('admin.contents.index', compact('course', 'contents'));
    }

    public function create(Course $course)
    {
        return view('admin.contents.create', compact('course'));
    }

    public function store(StoreCourseContentRequest $request, Course $course)
    {
        $this->service->create($course, $request->validated());
        return redirect()->route('courses.contents.index', $course)
            ->with('success', 'Content added successfully.');
    }

    public function edit(Course $course, CourseContent $content)
    {
        return view('admin.contents.edit', compact('course', 'content'));
    }

    public function update(UpdateCourseContentRequest $request, Course $course, CourseContent $content)
    {
        $this->service->update($content, $request->validated());
        return redirect()->route('courses.contents.index', $course)
            ->with('success', 'Content updated successfully.');
    }

    public function destroy(Course $course, CourseContent $content)
    {
        $this->service->delete($content);
        return redirect()->route('courses.contents.index', $course)
            ->with('success', 'Content deleted successfully.');
    }
}