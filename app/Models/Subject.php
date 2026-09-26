<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
      protected $fillable = [
        'name',
        'code',
        'grade',
        'description',
        'status',
    ];
public function classes()
{
    return $this->belongsToMany(
        SchoolClass::class,
        'class_subject',
        'subject_id',
        'class_id'
    );
}
public function teachers()
{
    return $this->belongsToMany(
        Teacher::class,
        'subject_teacher',
        'subject_id',
        'teacher_id'
    );
}
}
