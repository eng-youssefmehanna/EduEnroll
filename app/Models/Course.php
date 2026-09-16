<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasUuid;

class Course extends Model
{
    use hasUuid;
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = ['title', 'description', 'instructor_name', 'max_students'];

    protected function casts(): array {
    return [
        'max_students' => 'integer',
    ];
    }
    public function contents()
    {
        return $this->hasMany(CourseContent::class)->orderBy('order');
    }

    public function students()
    {
        return $this->belongsToMany(User::class, 'enrollments', 'course_id', 'student_id')
                    ->withPivot('enrolled_at');
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }
}
