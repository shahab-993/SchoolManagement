<?php

namespace App\Http\Controllers;

use App\Models\ClassSubjectTeacher;
use App\Models\SchoolClass;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;

class ClassSubjectTeacherController extends Controller
{
public function index(Request $request)
{
    $query = $request->input('search');

    $assignments = ClassSubjectTeacher::with([
        'schoolClass',
        'subject',
        'teacher'
    ])
        ->when($query, function ($q) use ($query) {

            $q->where(function ($q) use ($query) {

                $q->where('id', 'like', "%{$query}%")

                    ->orWhereHas('schoolClass', function ($q) use ($query) {
                        $q->where('name', 'like', "%{$query}%");
                    })

                    ->orWhereHas('subject', function ($q) use ($query) {
                        $q->where('name', 'like', "%{$query}%");
                    })

                    ->orWhereHas('teacher', function ($q) use ($query) {
                        $q->where('first_name', 'like', "%{$query}%")
                            ->orWhere('last_name', 'like', "%{$query}%");
                    });

            });

        })
        ->paginate(12)
        ->withQueryString();

    return view('assignments.index', compact(
        'assignments',
        'query'
    ));
}

    public function create()
    {
        $classes = SchoolClass::all();
        $subjects = Subject::all();
        $teachers = Teacher::all();

        return view('assignments.create', compact(
            'classes',
            'subjects',
            'teachers'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'class_id' => 'required|exists:school_classes,id',
            'subject_id' => 'required|exists:subjects,id',
            'teacher_id' => 'required|exists:teachers,id',
        ]);

        ClassSubjectTeacher::create([
            'class_id' => $request->class_id,
            'subject_id' => $request->subject_id,
            'teacher_id' => $request->teacher_id,
        ]);

        return redirect()
            ->route('assignments.index')
            ->with('success', 'Assignment created successfully.');
    }
    public function edit(ClassSubjectTeacher $assignment)
    {
        $classes = SchoolClass::all();
        $subjects = Subject::all();
        $teachers = Teacher::all();

        return view('assignments.edit', compact(
            'assignment',
            'classes',
            'subjects',
            'teachers'
        ));
    }

    public function update(Request $request, ClassSubjectTeacher $assignment)
    {
        $request->validate([
            'class_id' => 'required|exists:school_classes,id',
            'subject_id' => 'required|exists:subjects,id',
            'teacher_id' => 'required|exists:teachers,id',
        ]);

        $assignment->update([
            'class_id' => $request->class_id,
            'subject_id' => $request->subject_id,
            'teacher_id' => $request->teacher_id,
        ]);

        return redirect()
            ->route('assignments.index')
            ->with('success', 'Assignment updated successfully.');
    }

    public function destroy(ClassSubjectTeacher $assignment)
    {
        $assignment->delete();

        return redirect()
            ->route('assignments.index')
            ->with('success', 'Assignment deleted successfully.');
    }
}
