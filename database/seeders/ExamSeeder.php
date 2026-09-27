<?php

namespace Database\Seeders;

use App\Models\Exam;
use Illuminate\Database\Seeder;

class ExamSeeder extends Seeder
{
    public function run(): void
    {
        Exam::create([
            'type' => 'midterm',
            'academic_year' => '2026-2027',
            'exam_date' => null,
        ]);

        Exam::create([
            'type' => 'annual',
            'academic_year' => '2026-2027',
            'exam_date' => null,
        ]);
    }
}