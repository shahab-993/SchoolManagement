<?php

namespace App\Http\Controllers;

use App\Models\SchoolClass;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(){
        $students= Student::with('schoolClass')->get();
        return view('students.index',compact('students'));
    }

    public function create(){
        $classes= SchoolClass::all();
        return view('students.create',compact('classes'));
    }
}
