<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Services\StudentService;
use App\Services\ClassService;

class StudentController extends Controller
{
    private StudentService $studentService;
    private ClassService $classService;

    public function __construct(StudentService $studentService, ClassService $classService)
    {
        $this->studentService = $studentService;
        $this->classService = $classService;
    }

    public function index()
    {
        $students = $this->studentService->getAll();
        return view('admin.students.index', compact('students'));
    }

    public function create()
    {
        $classes = $this->classService->getAll();
        return view('admin.students.create', compact('classes'));
    }

    public function store(StoreStudentRequest $request)
    {
        $this->studentService->create($request->validated());
        return redirect()->route('students.index')->with('success', 'Student created successfully');
    }

    public function edit(string $id)
    {
        $student = $this->studentService->findById($id);
        $classes = $this->classService->getAll();
        return view('admin.students.edit', compact('student', 'classes'));
    }

    public function update(UpdateStudentRequest $request, string $id)
    {
        $this->studentService->update($id, $request->validated());
        return redirect()->route('students.index')->with('success', 'Student updated successfully');
    }

    public function destroy(string $id)
    {
        $this->studentService->delete($id);
        return redirect()->route('students.index')->with('success', 'Student deleted successfully');
    }
}