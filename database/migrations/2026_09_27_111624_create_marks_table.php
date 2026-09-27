<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('marks', function (Blueprint $table) {
            $table->id();


        $table->foreignId('student_id')
            ->constrained('students')
            ->cascadeOnDelete();

        $table->foreignId('subject_id')
            ->constrained('subjects')
            ->cascadeOnDelete();

        $table->foreignId('exam_id')
            ->constrained('exams')
            ->cascadeOnDelete();

        $table->unsignedInteger('marks');

        $table->unique([
            'student_id',
            'subject_id',
            'exam_id'
        ]); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('marks');
    }
};
