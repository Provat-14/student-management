<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
   protected $fillable = ['name', 'designation', 'email', 'phone'];

    public function subjects()
    {
        return $this->belongsToMany(Subject::class);
    }
}
