<?php

namespace App\Services;

use App\Models\School;

class SchoolService
{
    public function getAll()
    {
        return School::all();
    }

    public function create(array $data)
{
    return School::create($data);
}

public function findById(string $id)
{
    return School::findOrFail($id);
}

public function update(string $id, array $data)
{
    $school = School::findOrFail($id);
    $school->update($data);
    return $school;
}

public function delete(string $id)
{
    School::findOrFail($id)->delete();
}
}