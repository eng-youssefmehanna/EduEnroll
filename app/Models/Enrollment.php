<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use App\Traits\HasUuid;


class Enrollment extends Model
{
    use HasUuid;

    protected $keyType = 'string';
    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = ['student_id', 'course_id', 'enrolled_at'];

    protected $casts = [
        'enrolled_at' => 'datetime',
    ];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
