<?php

namespace App\Http\Controllers;

use App\Models\ClassSubjectTeacher;
use App\Models\SchoolClass;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;

class DashboardController extends Controller
{
    public function index()
    {
        $studentCount = Student::count();
        $teacherCount = Teacher::count();
        $classCount = SchoolClass::count();
        $subjectCount = Subject::count();

        $assignments = ClassSubjectTeacher::with([
            'schoolClass',
            'subject',
        
        ])->get();

        return view('dashboard', compact(
            'studentCount',
            'teacherCount',
            'classCount',
            'subjectCount',
            'assignments'
        ));
    }
}
