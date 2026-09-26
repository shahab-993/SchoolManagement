<?php

namespace App\Http\Controllers;

use App\Models\SchoolClass;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{

public function index(Request $request)
{
    $query = $request->input('search');

    $students = Student::with('schoolClass')
        ->when($query, function ($q) use ($query) {

            $q->where(function ($q) use ($query) {

                $q->where('id', 'like', "%{$query}%")
                    ->orWhere('admission_no', 'like', "%{$query}%")
                    ->orWhere('first_name', 'like', "%{$query}%")
                    ->orWhere('last_name', 'like', "%{$query}%");

            });

        })
        ->paginate(12)
        ->withQueryString();

    return view('students.index', compact(
        'students',
        'query'
    ));
}    public function store(Request $request)
    {
        $request->validate([


            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'father_name' => 'required|string|max:100',
            'date_of_birth' => 'nullable|date',
            'gender' => 'required|in:Male,Female',
            'phone' => 'nullable|string|max:30',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string',
            'admission_date' => 'required|date',
            'class_id' => 'required|exists:school_classes,id',
            'status' => 'required|in:active,inactive',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'notes' => 'nullable|string',
        ]);
        $photoPath = null;

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('students', 'public');
        }
        $lastStudent = Student::latest('id')->first();

        $nextNumber = $lastStudent ? $lastStudent->id + 1 : 1;

        $admissionNo = 'STU-' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);

        Student::create([
            'admission_no' => $admissionNo,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'father_name' => $request->father_name,
            'date_of_birth' => $request->date_of_birth,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
            'admission_date' => $request->admission_date,
            'class_id' => $request->class_id,
            'photo' => $photoPath,
            'status' => $request->status,
            'notes' => $request->notes,
        ]);
        return redirect()
            ->route('students.index')
            ->with('success', 'Student created successfully.');
    }

    public function create()
    {
        $classes = SchoolClass::all();
        return view('students.create', compact('classes'));
    }
    public function show(Student $student)
    {
        return view('students.show', compact('student'));
    }

    public function edit(Student $student)
    {
        $classes = SchoolClass::all();
        return view('students.edit', compact('classes', 'student'));
    }
    public function update(Request $request, Student $student)
    {
        $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'father_name' => 'required|string|max:100',
            'date_of_birth' => 'nullable|date',
            'gender' => 'required|in:Male,Female',
            'phone' => 'nullable|string|max:30',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string',
            'admission_date' => 'required|date',
            'class_id' => 'required|exists:school_classes,id',
            'status' => 'required|in:active,inactive',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'notes' => 'nullable|string',
        ]);

        $photoPath = $student->photo;

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('students', 'public');
        }

        $student->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'father_name' => $request->father_name,
            'date_of_birth' => $request->date_of_birth,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
            'admission_date' => $request->admission_date,
            'class_id' => $request->class_id,
            'photo' => $photoPath,
            'status' => $request->status,
            'notes' => $request->notes,
        ]);

        return redirect()
            ->route('students.index')
            ->with('success', 'Student updated successfully.');
    }
    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('students.index')->with('success', 'Student deleted successfully.');
    }
}
