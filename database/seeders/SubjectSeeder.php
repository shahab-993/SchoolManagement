<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Subject;

class SubjectSeeder extends Seeder
{
    public function run(): void
    {
        $subjects = [

            // =========================
            // Grade 1
            // =========================
            ['name' => 'Pashto', 'code' => 'G1-PAS', 'grade' => 'Grade 1'],
            ['name' => 'Dari', 'code' => 'G1-DAR', 'grade' => 'Grade 1'],
            ['name' => 'Mathematics', 'code' => 'G1-MATH', 'grade' => 'Grade 1'],
            ['name' => 'Islamic Studies', 'code' => 'G1-ISL', 'grade' => 'Grade 1'],
            ['name' => 'Quran', 'code' => 'G1-QUR', 'grade' => 'Grade 1'],
            ['name' => 'Skills', 'code' => 'G1-SKL', 'grade' => 'Grade 1'],
            ['name' => 'Drawing', 'code' => 'G1-DRW', 'grade' => 'Grade 1'],
            ['name' => 'Calligraphy', 'code' => 'G1-CAL', 'grade' => 'Grade 1'],

            // =========================
            // Grade 2
            // =========================
            ['name' => 'Pashto', 'code' => 'G2-PAS', 'grade' => 'Grade 2'],
            ['name' => 'Dari', 'code' => 'G2-DAR', 'grade' => 'Grade 2'],
            ['name' => 'Mathematics', 'code' => 'G2-MATH', 'grade' => 'Grade 2'],
            ['name' => 'Islamic Studies', 'code' => 'G2-ISL', 'grade' => 'Grade 2'],
            ['name' => 'Quran', 'code' => 'G2-QUR', 'grade' => 'Grade 2'],
            ['name' => 'Skills', 'code' => 'G2-SKL', 'grade' => 'Grade 2'],
            ['name' => 'Drawing', 'code' => 'G2-DRW', 'grade' => 'Grade 2'],
            ['name' => 'Calligraphy', 'code' => 'G2-CAL', 'grade' => 'Grade 2'],

            // =========================
            // Grade 3
            // =========================
            ['name' => 'Pashto', 'code' => 'G3-PAS', 'grade' => 'Grade 3'],
            ['name' => 'Dari', 'code' => 'G3-DAR', 'grade' => 'Grade 3'],
            ['name' => 'Mathematics', 'code' => 'G3-MATH', 'grade' => 'Grade 3'],
            ['name' => 'Islamic Studies', 'code' => 'G3-ISL', 'grade' => 'Grade 3'],
            ['name' => 'Quran', 'code' => 'G3-QUR', 'grade' => 'Grade 3'],
            ['name' => 'Skills', 'code' => 'G3-SKL', 'grade' => 'Grade 3'],
            ['name' => 'Drawing', 'code' => 'G3-DRW', 'grade' => 'Grade 3'],
            ['name' => 'Calligraphy', 'code' => 'G3-CAL', 'grade' => 'Grade 3'],

            // =========================
            // Grade 4
            // =========================
            ['name' => 'Pashto', 'code' => 'G4-PAS', 'grade' => 'Grade 4'],
            ['name' => 'Dari', 'code' => 'G4-DAR', 'grade' => 'Grade 4'],
            ['name' => 'Mathematics', 'code' => 'G4-MATH', 'grade' => 'Grade 4'],
            ['name' => 'Islamic Studies', 'code' => 'G4-ISL', 'grade' => 'Grade 4'],
            ['name' => 'Quran', 'code' => 'G4-QUR', 'grade' => 'Grade 4'],
            ['name' => 'Science', 'code' => 'G4-SCI', 'grade' => 'Grade 4'],
            ['name' => 'Social Studies', 'code' => 'G4-SOC', 'grade' => 'Grade 4'],
            ['name' => 'English', 'code' => 'G4-ENG', 'grade' => 'Grade 4'],
            ['name' => 'Drawing', 'code' => 'G4-DRW', 'grade' => 'Grade 4'],
            ['name' => 'Calligraphy', 'code' => 'G4-CAL', 'grade' => 'Grade 4'],

            // =========================
            // Grade 5
            // =========================
            ['name' => 'Pashto', 'code' => 'G5-PAS', 'grade' => 'Grade 5'],
            ['name' => 'Dari', 'code' => 'G5-DAR', 'grade' => 'Grade 5'],
            ['name' => 'Mathematics', 'code' => 'G5-MATH', 'grade' => 'Grade 5'],
            ['name' => 'Islamic Studies', 'code' => 'G5-ISL', 'grade' => 'Grade 5'],
            ['name' => 'Quran', 'code' => 'G5-QUR', 'grade' => 'Grade 5'],
            ['name' => 'Science', 'code' => 'G5-SCI', 'grade' => 'Grade 5'],
            ['name' => 'Social Studies', 'code' => 'G5-SOC', 'grade' => 'Grade 5'],
            ['name' => 'English', 'code' => 'G5-ENG', 'grade' => 'Grade 5'],
            ['name' => 'Drawing', 'code' => 'G5-DRW', 'grade' => 'Grade 5'],
            ['name' => 'Calligraphy', 'code' => 'G5-CAL', 'grade' => 'Grade 5'],

            // =========================
            // Grade 6
            // =========================
            ['name' => 'Pashto', 'code' => 'G6-PAS', 'grade' => 'Grade 6'],
            ['name' => 'Dari', 'code' => 'G6-DAR', 'grade' => 'Grade 6'],
            ['name' => 'Mathematics', 'code' => 'G6-MATH', 'grade' => 'Grade 6'],
            ['name' => 'Islamic Studies', 'code' => 'G6-ISL', 'grade' => 'Grade 6'],
            ['name' => 'Quran', 'code' => 'G6-QUR', 'grade' => 'Grade 6'],
            ['name' => 'Science', 'code' => 'G6-SCI', 'grade' => 'Grade 6'],
            ['name' => 'Social Studies', 'code' => 'G6-SOC', 'grade' => 'Grade 6'],
            ['name' => 'English', 'code' => 'G6-ENG', 'grade' => 'Grade 6'],
            ['name' => 'Drawing', 'code' => 'G6-DRW', 'grade' => 'Grade 6'],
            ['name' => 'Calligraphy', 'code' => 'G6-CAL', 'grade' => 'Grade 6'],

            // =========================
            // Grade 7
            // =========================
            ['name' => 'Pashto', 'code' => 'G7-PAS', 'grade' => 'Grade 7'],
            ['name' => 'Dari', 'code' => 'G7-DAR', 'grade' => 'Grade 7'],
            ['name' => 'English', 'code' => 'G7-ENG', 'grade' => 'Grade 7'],
            ['name' => 'Mathematics', 'code' => 'G7-MATH', 'grade' => 'Grade 7'],
            ['name' => 'Science', 'code' => 'G7-SCI', 'grade' => 'Grade 7'],
            ['name' => 'Physics', 'code' => 'G7-PHY', 'grade' => 'Grade 7'],
            ['name' => 'Chemistry', 'code' => 'G7-CHEM', 'grade' => 'Grade 7'],
            ['name' => 'Biology', 'code' => 'G7-BIO', 'grade' => 'Grade 7'],
            ['name' => 'History', 'code' => 'G7-HIS', 'grade' => 'Grade 7'],
            ['name' => 'Geography', 'code' => 'G7-GEO', 'grade' => 'Grade 7'],
            ['name' => 'Social Studies', 'code' => 'G7-SOC', 'grade' => 'Grade 7'],
            ['name' => 'Arabic', 'code' => 'G7-ARB', 'grade' => 'Grade 7'],
            ['name' => 'Fiqh', 'code' => 'G7-FIQ', 'grade' => 'Grade 7'],
            ['name' => 'Aqaid', 'code' => 'G7-AQD', 'grade' => 'Grade 7'],
            ['name' => 'Seerat', 'code' => 'G7-SIR', 'grade' => 'Grade 7'],
            ['name' => 'Tafsir', 'code' => 'G7-TAF', 'grade' => 'Grade 7'],
            ['name' => 'Tajweed', 'code' => 'G7-TAJ', 'grade' => 'Grade 7'],

            // =========================
            // Grade 8
            // =========================
            ['name' => 'Pashto', 'code' => 'G8-PAS', 'grade' => 'Grade 8'],
            ['name' => 'Dari', 'code' => 'G8-DAR', 'grade' => 'Grade 8'],
            ['name' => 'English', 'code' => 'G8-ENG', 'grade' => 'Grade 8'],
            ['name' => 'Mathematics', 'code' => 'G8-MATH', 'grade' => 'Grade 8'],
            ['name' => 'Science', 'code' => 'G8-SCI', 'grade' => 'Grade 8'],
            ['name' => 'Physics', 'code' => 'G8-PHY', 'grade' => 'Grade 8'],
            ['name' => 'Chemistry', 'code' => 'G8-CHEM', 'grade' => 'Grade 8'],
            ['name' => 'Biology', 'code' => 'G8-BIO', 'grade' => 'Grade 8'],
            ['name' => 'History', 'code' => 'G8-HIS', 'grade' => 'Grade 8'],
            ['name' => 'Geography', 'code' => 'G8-GEO', 'grade' => 'Grade 8'],
            ['name' => 'Social Studies', 'code' => 'G8-SOC', 'grade' => 'Grade 8'],
            ['name' => 'Arabic', 'code' => 'G8-ARB', 'grade' => 'Grade 8'],
            ['name' => 'Fiqh', 'code' => 'G8-FIQ', 'grade' => 'Grade 8'],
            ['name' => 'Aqaid', 'code' => 'G8-AQD', 'grade' => 'Grade 8'],
            ['name' => 'Seerat', 'code' => 'G8-SIR', 'grade' => 'Grade 8'],
            ['name' => 'Tafsir', 'code' => 'G8-TAF', 'grade' => 'Grade 8'],
            ['name' => 'Tajweed', 'code' => 'G8-TAJ', 'grade' => 'Grade 8'],

            // =========================
            // Grade 9
            // =========================
            ['name' => 'Pashto', 'code' => 'G9-PAS', 'grade' => 'Grade 9'],
            ['name' => 'Dari', 'code' => 'G9-DAR', 'grade' => 'Grade 9'],
            ['name' => 'English', 'code' => 'G9-ENG', 'grade' => 'Grade 9'],
            ['name' => 'Mathematics', 'code' => 'G9-MATH', 'grade' => 'Grade 9'],
            ['name' => 'Science', 'code' => 'G9-SCI', 'grade' => 'Grade 9'],
            ['name' => 'Physics', 'code' => 'G9-PHY', 'grade' => 'Grade 9'],
            ['name' => 'Chemistry', 'code' => 'G9-CHEM', 'grade' => 'Grade 9'],
            ['name' => 'Biology', 'code' => 'G9-BIO', 'grade' => 'Grade 9'],
            ['name' => 'History', 'code' => 'G9-HIS', 'grade' => 'Grade 9'],
            ['name' => 'Geography', 'code' => 'G9-GEO', 'grade' => 'Grade 9'],
            ['name' => 'Social Studies', 'code' => 'G9-SOC', 'grade' => 'Grade 9'],
            ['name' => 'Arabic', 'code' => 'G9-ARB', 'grade' => 'Grade 9'],
            ['name' => 'Fiqh', 'code' => 'G9-FIQ', 'grade' => 'Grade 9'],
            ['name' => 'Aqaid', 'code' => 'G9-AQD', 'grade' => 'Grade 9'],
            ['name' => 'Tafsir', 'code' => 'G9-TAF', 'grade' => 'Grade 9'],
            ['name' => 'Tajweed', 'code' => 'G9-TAJ', 'grade' => 'Grade 9'],

            // =========================
            // Grade 10
            // =========================
            ['name' => 'Pashto Literature', 'code' => 'G10-PAS', 'grade' => 'Grade 10'],
            ['name' => 'Dari Literature', 'code' => 'G10-DAR', 'grade' => 'Grade 10'],
            ['name' => 'English', 'code' => 'G10-ENG', 'grade' => 'Grade 10'],
            ['name' => 'Mathematics', 'code' => 'G10-MATH', 'grade' => 'Grade 10'],
            ['name' => 'Physics', 'code' => 'G10-PHY', 'grade' => 'Grade 10'],
            ['name' => 'Chemistry', 'code' => 'G10-CHEM', 'grade' => 'Grade 10'],
            ['name' => 'Biology', 'code' => 'G10-BIO', 'grade' => 'Grade 10'],
            ['name' => 'History', 'code' => 'G10-HIS', 'grade' => 'Grade 10'],
            ['name' => 'Geography', 'code' => 'G10-GEO', 'grade' => 'Grade 10'],
            ['name' => 'Social Studies', 'code' => 'G10-SOC', 'grade' => 'Grade 10'],
            ['name' => 'Computer', 'code' => 'G10-COMP', 'grade' => 'Grade 10'],
            ['name' => 'Islamic Studies', 'code' => 'G10-ISL', 'grade' => 'Grade 10'],
            ['name' => 'Tafsir', 'code' => 'G10-TAF', 'grade' => 'Grade 10'],

            // =========================
            // Grade 11
            // =========================
            ['name' => 'Pashto Literature', 'code' => 'G11-PAS', 'grade' => 'Grade 11'],
            ['name' => 'Dari Literature', 'code' => 'G11-DAR', 'grade' => 'Grade 11'],
            ['name' => 'English', 'code' => 'G11-ENG', 'grade' => 'Grade 11'],
            ['name' => 'Mathematics', 'code' => 'G11-MATH', 'grade' => 'Grade 11'],
            ['name' => 'Physics', 'code' => 'G11-PHY', 'grade' => 'Grade 11'],
            ['name' => 'Chemistry', 'code' => 'G11-CHEM', 'grade' => 'Grade 11'],
            ['name' => 'Biology', 'code' => 'G11-BIO', 'grade' => 'Grade 11'],
            ['name' => 'History', 'code' => 'G11-HIS', 'grade' => 'Grade 11'],
            ['name' => 'Geography', 'code' => 'G11-GEO', 'grade' => 'Grade 11'],
            ['name' => 'Social Studies', 'code' => 'G11-SOC', 'grade' => 'Grade 11'],
            ['name' => 'Computer', 'code' => 'G11-COMP', 'grade' => 'Grade 11'],
            ['name' => 'Islamic Studies', 'code' => 'G11-ISL', 'grade' => 'Grade 11'],
            ['name' => 'Tafsir', 'code' => 'G11-TAF', 'grade' => 'Grade 11'],

            // =========================
            // Grade 12
            // =========================
            ['name' => 'Pashto Literature', 'code' => 'G12-PAS', 'grade' => 'Grade 12'],
            ['name' => 'Dari Literature', 'code' => 'G12-DAR', 'grade' => 'Grade 12'],
            ['name' => 'English', 'code' => 'G12-ENG', 'grade' => 'Grade 12'],
            ['name' => 'Mathematics', 'code' => 'G12-MATH', 'grade' => 'Grade 12'],
            ['name' => 'Physics', 'code' => 'G12-PHY', 'grade' => 'Grade 12'],
            ['name' => 'Chemistry', 'code' => 'G12-CHEM', 'grade' => 'Grade 12'],
            ['name' => 'Biology', 'code' => 'G12-BIO', 'grade' => 'Grade 12'],
            ['name' => 'History', 'code' => 'G12-HIS', 'grade' => 'Grade 12'],
            ['name' => 'Geography', 'code' => 'G12-GEO', 'grade' => 'Grade 12'],
            ['name' => 'Social Studies', 'code' => 'G12-SOC', 'grade' => 'Grade 12'],
            ['name' => 'Computer', 'code' => 'G12-COMP', 'grade' => 'Grade 12'],
            ['name' => 'Islamic Studies', 'code' => 'G12-ISL', 'grade' => 'Grade 12'],
            ['name' => 'Tafsir', 'code' => 'G12-TAF', 'grade' => 'Grade 12'],
        ];

        foreach ($subjects as $subject) {
            Subject::create([
                ...$subject,
                'description' => null,
                'status' => 'active',
            ]);
        }
    }
}