<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
   public function index()
   {
    $teacher = Teacher::all();
    return view('teachers.index',compact('teacher'));
   }
   public function create()
{
    return view('teachers.create');
}
}
