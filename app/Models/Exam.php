<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $fillable = [
        'type',
        'academic_year',
        'exam_date',
    ];
    public function marks()
    {
        return $this->hasMany(Mark::class);
    }
}
