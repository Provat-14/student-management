<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = ['name', 'subject_code', 'credit'];

    public function departments()
    {
        return $this->belongsToMany(Department::class);
    }
    public function teachers()
    {
        return $this->belongsToMany(Teacher::class);
    }
}
