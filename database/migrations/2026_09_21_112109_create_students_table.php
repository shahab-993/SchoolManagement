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
        Schema::create('students', function (Blueprint $table) {

            $table->id();

            // Student basic information
            $table->string('admission_no')->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('father_name');

            // Personal information
            $table->date('date_of_birth')->nullable();
            $table->string('gender');

            // Contact information
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->text('address')->nullable();

            // School information
            $table->date('admission_date');
            $table->foreignId('class_id')
                ->constrained('school_classes')
                ->cascadeOnDelete();

            // Additional information
            $table->string('photo')->nullable();
            $table->string('status')->default('active');
            $table->text('notes')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
