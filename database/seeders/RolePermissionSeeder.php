<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Admin Permissions
        |--------------------------------------------------------------------------
        */

        $admin = Role::where('name', 'admin')->first();

        $admin->permissions()->sync(
            Permission::all()
        );


        /*
        |--------------------------------------------------------------------------
        | Teacher Permissions
        |--------------------------------------------------------------------------
        */

        $teacher = Role::where('name', 'teacher')->first();

        $teacherPermissions = Permission::whereIn('name', [

            'view_students',

            'view_marks',
            'create_marks',
            'edit_marks',

            'view_results',
            'print_results',

        ])->get();

        $teacher->permissions()->sync(
            $teacherPermissions
        );
    }
}