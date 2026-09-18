<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\SchoolService;
use App\Http\Requests\StoreSchoolRequest;
use App\Http\Requests\UpdateSchoolRequest;

class SchoolController extends Controller
{
private SchoolService $schoolService;

public function __construct(SchoolService $schoolService)
{
    $this->schoolService = $schoolService;
}  



    public function index()
    {
       $schools= $this->schoolService->getAll();
         return view('admin.schools.index', compact('schools'));
    }

   public function create()
{
    return view('admin.schools.create');
}

public function store(StoreSchoolRequest $request)
{
    $this->schoolService->create($request->validated());
    return redirect()->route('schools.index')->with('success', 'School created successfully');
}

public function edit(string $id)
{
    $school = $this->schoolService->findById($id);
    return view('admin.schools.edit', compact('school'));
}

public function update(UpdateSchoolRequest $request, string $id)
{
    $this->schoolService->update($id, $request->validated());
    return redirect()->route('schools.index')->with('success', 'School updated successfully');
}

public function destroy(string $id)
{
    $this->schoolService->delete($id);
    return redirect()->route('schools.index')->with('success', 'School deleted successfully');
}
}
