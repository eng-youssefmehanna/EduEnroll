<?php

namespace App\Services;

use App\Models\User;

class StudentService
{
    public function getAll()
    {
        return User::where('is_admin', false)->with('schoolClass')->get();
    }

    public function create(array $data)
    {
        $data['is_admin'] = false;
        $data['password'] = bcrypt($data['password']);
        return User::create($data);
    }

    public function findById(string $id)
    {
        return User::findOrFail($id);
    }

    public function update(string $id, array $data)
    {
        $student = User::findOrFail($id);
        if (isset($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }
        $student->update($data);
        return $student;
    }

    public function delete(string $id)
    {
        User::findOrFail($id)->delete();
    }
}