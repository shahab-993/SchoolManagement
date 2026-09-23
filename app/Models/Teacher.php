<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
   protected $fillable = [
        'first_name',
        'last_name',
        'father_name',
        'education',
        'education_field',
        'phone',
        'email',
        'address',
        'date_of_birth',
        'gender',
        'subject',
        'joining_date',
        'photo',
        'status',
        'notes',
    ];
      public function subjects()
{
    return $this->belongsToMany(
        Subject::class,
        'subject_teacher',
        'teacher_id',
        'subject_id'
    );
}
}
