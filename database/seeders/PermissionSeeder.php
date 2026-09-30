<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            // Students
            [
                'name' => 'view_students',
                'display_name' => 'View Students',
            ],
            [
                'name' => 'create_students',
                'display_name' => 'Create Students',
            ],
            [
                'name' => 'edit_students',
                'display_name' => 'Edit Students',
            ],
            [
                'name' => 'delete_students',
                'display_name' => 'Delete Students',
            ],

            // Teachers
            [
                'name' => 'view_teachers',
                'display_name' => 'View Teachers',
            ],
            [
                'name' => 'create_teachers',
                'display_name' => 'Create Teachers',
            ],
            [
                'name' => 'edit_teachers',
                'display_name' => 'Edit Teachers',
            ],
            [
                'name' => 'delete_teachers',
                'display_name' => 'Delete Teachers',
            ],

            // Classes
            [
                'name' => 'view_classes',
                'display_name' => 'View Classes',
            ],
            [
                'name' => 'create_classes',
                'display_name' => 'Create Classes',
            ],
            [
                'name' => 'edit_classes',
                'display_name' => 'Edit Classes',
            ],
            [
                'name' => 'delete_classes',
                'display_name' => 'Delete Classes',
            ],

            // Subjects
            [
                'name' => 'view_subjects',
                'display_name' => 'View Subjects',
            ],
            [
                'name' => 'create_subjects',
                'display_name' => 'Create Subjects',
            ],
            [
                'name' => 'edit_subjects',
                'display_name' => 'Edit Subjects',
            ],
            [
                'name' => 'delete_subjects',
                'display_name' => 'Delete Subjects',
            ],

            // Marks
            [
                'name' => 'view_marks',
                'display_name' => 'View Marks',
            ],
            [
                'name' => 'create_marks',
                'display_name' => 'Create Marks',
            ],
            [
                'name' => 'edit_marks',
                'display_name' => 'Edit Marks',
            ],

            // Results
            [
                'name' => 'view_results',
                'display_name' => 'View Results',
            ],
            [
                'name' => 'print_results',
                'display_name' => 'Print Results',
            ],
            // Users
            [
                'name' => 'view_users',
                'display_name' => 'View Users',
            ],
            [
                'name' => 'create_users',
                'display_name' => 'Create Users',
            ],
            [
                'name' => 'edit_users',
                'display_name' => 'Edit Users',
            ],
            [
                'name' => 'delete_users',
                'display_name' => 'Delete Users',
            ],
        ];

        foreach ($permissions as $permission) {
            Permission::updateOrCreate(
                ['name' => $permission['name']],
                ['display_name' => $permission['display_name']]
            );
        }
    }
}
