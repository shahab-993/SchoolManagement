<?php

namespace App\Http\Controllers;

use App\Models\SchoolClass;
use Illuminate\Http\Request;

class SchoolClassController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('search');

        $classes = SchoolClass::withCount('students')
            ->when($query, function ($q) use ($query) {

                $q->where(function ($q) use ($query) {

                    $q->where('id', 'like', "%{$query}%")
                        ->orWhere('name', 'like', "%{$query}%");

                });

            })
            ->paginate(12)
            ->withQueryString();

        return view('classes.index', compact(
            'classes',
            'query'
        ));
    }


    public function create()
    {
        return view('classes.create');
    }


    public function show(SchoolClass $class)
    {
        return view('classes.show', compact(
            'class'
        ));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'section' => 'required|string|max:50',
            'description' => 'nullable|string',
        ]);

        SchoolClass::create([
            'name' => $request->name,
            'section' => $request->section,
            'description' => $request->description,
        ]);

        return redirect()
            ->route('classes.index')
            ->with(
                'success',
                'Class created successfully.'
            );
    }


    public function students(SchoolClass $class)
    {
        $students = $class->students;

        return view('classes.students', compact(
            'class',
            'students'
        ));
    }


    public function edit(SchoolClass $class)
    {
        return view('classes.edit', compact(
            'class'
        ));
    }


    public function update(
        Request $request,
        SchoolClass $class
    ) {
        $request->validate([
            'name' => 'required|string|max:100',
            'section' => 'required|string|max:50',
            'description' => 'nullable|string',
        ]);

        $class->update([
            'name' => $request->name,
            'section' => $request->section,
            'description' => $request->description,
        ]);

        return redirect()
            ->route('classes.index')
            ->with(
                'success',
                'Class updated successfully.'
            );
    }


    public function destroy(SchoolClass $class)
    {
        $class->delete();

        return redirect()
            ->route('classes.index')
            ->with(
                'success',
                'Class deleted successfully.'
            );
    }
}
