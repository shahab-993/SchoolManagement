<?php

namespace App\Http\Controllers;

use App\Models\ClassSubjectTeacher;
use App\Models\SchoolClass;
use App\Models\Subject;
use Illuminate\Http\Request;

class ClassSubjectTeacherController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('search');

        $assignments = ClassSubjectTeacher::with([
            'schoolClass',
            'subject'
        ])
            ->when($query, function ($q) use ($query) {

                $q->where(function ($q) use ($query) {

                    $q->where('id', 'like', "%{$query}%")

                        ->orWhereHas('schoolClass', function ($q) use ($query) {
                            $q->where('name', 'like', "%{$query}%");
                        })

                        ->orWhereHas('subject', function ($q) use ($query) {
                            $q->where('name', 'like', "%{$query}%");
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

        return view('assignments.create', compact(
            'classes',
            'subjects'
        ));
    }


    public function store(Request $request)
    {
        $request->validate([
            'class_id' => 'required|exists:school_classes,id',

            'subject_id' => [
                'required',
                'array',
                'min:1',
            ],

            'subject_id.*' => [
                'required',
                'exists:subjects,id',
            ],
        ]);


        foreach ($request->subject_id as $subjectId) {

            ClassSubjectTeacher::firstOrCreate([
                'class_id' => $request->class_id,
                'subject_id' => $subjectId,
            ]);

        }


        return redirect()
            ->route('assignments.index')
            ->with(
                'success',
                'Subjects assigned successfully.'
            );
    }


    public function edit(ClassSubjectTeacher $assignment)
    {
        $classes = SchoolClass::all();
        $subjects = Subject::all();

        return view('assignments.edit', compact(
            'assignment',
            'classes',
            'subjects'
        ));
    }


    public function update(
        Request $request,
        ClassSubjectTeacher $assignment
    ) {
        $request->validate([
            'class_id' => 'required|exists:school_classes,id',

            'subject_id' => [
                'required',
                'exists:subjects,id',
            ],
        ]);


        $assignment->update([
            'class_id' => $request->class_id,
            'subject_id' => $request->subject_id,
        ]);


        return redirect()
            ->route('assignments.index')
            ->with(
                'success',
                'Subject assignment updated successfully.'
            );
    }


    public function destroy(ClassSubjectTeacher $assignment)
    {
        $assignment->delete();

        return redirect()
            ->route('assignments.index')
            ->with(
                'success',
                'Subject assignment deleted successfully.'
            );
    }


    public function subjects(SchoolClass $schoolClass)
    {
        $subjects = ClassSubjectTeacher::with('subject')
            ->where('class_id', $schoolClass->id)
            ->get()
            ->unique('subject_id');

        return view('classes.subjects', compact(
            'schoolClass',
            'subjects'
        ));
    }
}
