<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasUuid;

class School extends Model
{
     use HasUuid;
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = ['name', 'address', 'phone'];

    public function classes()
    {
        return $this->hasMany(SchoolClass::class, 'school_id');
    }
}
