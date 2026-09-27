<?php

namespace App\Models;

use App\Models\SchoolClass;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
protected $fillable = [
    'admission_no',
    'first_name',
    'last_name',
    'father_name',
    'date_of_birth',
    'gender',
    'phone',
    'email',
    'address',
    'admission_date',
    'class_id',
    'photo',
    'status',
    'notes',
];
  public function schoolClass(){
    return $this->belongsTo(SchoolClass::class,'class_id');
  }
  public function marks()
{
    return $this->hasMany(Mark::class);
}

}
