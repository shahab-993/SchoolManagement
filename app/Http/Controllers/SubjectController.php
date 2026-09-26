<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('search');

        $subjects = Subject::query()
            ->when($query, function ($q) use ($query) {

                $q->where(function ($q) use ($query) {

                    $q->where('id', 'like', "%{$query}%")
                        ->orWhere('name', 'like', "%{$query}%")
                        ->orWhere('code', 'like', "%{$query}%");
                });
            })
            ->paginate(12)
            ->withQueryString();

        return view('subjects.index', compact(
            'subjects',
            'query'
        ));
    }
    public function create()
    {
        return view('subjects.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'code' => 'required|string|max:50|unique:subjects,code',
            'description' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);

        Subject::create([
            'name' => $request->name,
            'code' => $request->code,
            'description' => $request->description,
            'status' => $request->status,
        ]);
        return redirect()->route('subjects.index')->with('success', 'Subject created successfully.');
    }
    public function show(Subject $subject)
    {
        return view('subjects.show', compact('subject'));
    }
    public function edit(Subject $subject)
    {
        return view('subjects.edit', compact('subject'));
    }
    public function update(Request $request, Subject $subject)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'code' => 'required|string|max:50|unique:subjects,code',
            'description' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);
        $subject->update([
            'name' => $request->name,
            'code' => $request->code,
            'description' => $request->description,
            'status' => $request->status,
        ]);
        return redirect()->route('subjects.index')->with('success', 'Subject updated successfully.');
    }
    public function destroy(Subject $subject)
    {
        $subject->delete();
        return redirect()->route('subjects.index')->with('success', 'Subject deleted successfully.');
    }
}
