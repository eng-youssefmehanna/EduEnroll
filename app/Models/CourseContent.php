<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseContent extends Model
{
    protected $table = 'course_contents';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = ['course_id', 'title', 'type', 'content_url_or_text', 'order'];

    protected function casts(): array
{
    return [
        'order' => 'integer',
    ];
}   

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
