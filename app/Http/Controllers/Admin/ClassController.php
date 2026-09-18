<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreClassRequest;
use App\Http\Requests\UpdateClassRequest;
use App\Services\ClassService;
use App\Services\SchoolService;

class ClassController extends Controller
{
    private ClassService $classService;
    private SchoolService $schoolService;

    public function __construct(ClassService $classService, SchoolService $schoolService)
    {
        $this->classService = $classService;
        $this->schoolService = $schoolService;
    }

    public function index()
    {
        $classes = $this->classService->getAll();
        return view('admin.classes.index', compact('classes'));
    }

    public function create()
    {
        $schools = $this->schoolService->getAll();
        return view('admin.classes.create', compact('schools'));
    }

    public function store(StoreClassRequest $request)
    {
        $this->classService->create($request->validated());
        return redirect()->route('classes.index')->with('success', 'Class created successfully');
    }

    public function edit(string $id)
    {
        $class = $this->classService->findById($id);
        $schools = $this->schoolService->getAll();
        return view('admin.classes.edit', compact('class', 'schools'));
    }

    public function update(UpdateClassRequest $request, string $id)
    {
        $this->classService->update($id, $request->validated());
        return redirect()->route('classes.index')->with('success', 'Class updated successfully');
    }

    public function destroy(string $id)
    {
        $this->classService->delete($id);
        return redirect()->route('classes.index')->with('success', 'Class deleted successfully');
    }
}