<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = ['name', 'address', 'phone'];

    public function classes()
    {
        return $this->hasMany(SchoolClass::class, 'school_id');
    }
}
