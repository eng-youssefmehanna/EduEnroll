<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasUuid;

class SchoolClass extends Model
{
    use hasUuid;
    
    protected $table = 'school_classes';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = ['school_id', 'name', 'grade_level'];

    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function students()
    {
        return $this->hasMany(User::class, 'class_id');
    }
}
