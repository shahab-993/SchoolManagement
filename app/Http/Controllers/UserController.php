<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Display Users
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {
        $query = $request->input('search');

        $users = User::with('role')
            ->when($query, function ($q) use ($query) {
                $q->where(function ($q) use ($query) {
                    $q->where('id', 'like', "%{$query}%")
                        ->orWhere('name', 'like', "%{$query}%")
                        ->orWhere('email', 'like', "%{$query}%");
                });
            })
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('users.index', compact(
            'users',
            'query'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | Show Create User Form
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        $roles = Role::all();

        return view('users.create', compact('roles'));
    }

    /*
    |--------------------------------------------------------------------------
    | Store New User
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',

            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email',
            ],

            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
            ],

            'role_id' => [
                'required',
                'exists:roles,id',
            ],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
        ]);

        return redirect()
            ->route('users.index')
            ->with('success', 'User created successfully.');
    }

    /*
    |--------------------------------------------------------------------------
    | Show Edit User Form
    |--------------------------------------------------------------------------
    */

    public function edit(User $user)
    {
        $roles = Role::all();

        return view('users.edit', compact(
            'user',
            'roles'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | Update User
    |--------------------------------------------------------------------------
    */

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:100',

            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')
                    ->ignore($user->id),
            ],

            'role_id' => [
                'required',
                'exists:roles,id',
            ],

            'password' => [
                'nullable',
                'string',
                'min:8',
                'confirmed',
            ],
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role_id = $request->role_id;

        /*
        |--------------------------------------------------------------------------
        | Update Password Only If New Password Was Entered
        |--------------------------------------------------------------------------
        */

        if ($request->filled('password')) {
            $user->password = Hash::make(
                $request->password
            );
        }

        $user->save();

        return redirect()
            ->route('users.index')
            ->with('success', 'User updated successfully.');
    }

    /*
    |--------------------------------------------------------------------------
    | Delete User
    |--------------------------------------------------------------------------
    */

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()
            ->route('users.index')
            ->with('success', 'User deleted successfully.');
    }
}