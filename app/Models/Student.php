<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'name', 
        'roll_no', 
        'reg_no', 
        'semester', 
        'shift', 
        'section', 
        'department_id',
        'phone_number',
        'email',
        'portfolio',
        'cgpa',
        'status'
    ];

    public function department()
    {
        return $this->belongsTo(\App\Models\Department::class);
    }
}