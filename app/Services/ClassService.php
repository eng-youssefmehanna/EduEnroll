<?php

namespace App\Services;

use App\Models\SchoolClass;

class ClassService
{
    public function getAll()
    {
        return SchoolClass::with('school')->get();
    }

    public function create(array $data)
    {
        return SchoolClass::create($data);
    }

    public function findById(string $id)
    {
        return SchoolClass::findOrFail($id);
    }

    public function update(string $id, array $data)
    {
        $class = SchoolClass::findOrFail($id);
        $class->update($data);
        return $class;
    }

    public function delete(string $id)
    {
        SchoolClass::findOrFail($id)->delete();
    }
}