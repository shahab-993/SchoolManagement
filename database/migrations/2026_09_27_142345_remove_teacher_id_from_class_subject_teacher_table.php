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
    Schema::table('class_subject_teacher', function (Blueprint $table) {

        $table->dropForeign(['teacher_id']);
        $table->dropColumn('teacher_id');

    });
}

public function down(): void
{
    Schema::table('class_subject_teacher', function (Blueprint $table) {

        $table->foreignId('teacher_id')
            ->constrained('teachers')
            ->cascadeOnDelete();

    });
}
};
