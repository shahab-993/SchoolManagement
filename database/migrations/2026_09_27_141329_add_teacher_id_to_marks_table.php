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
    if (!Schema::hasColumn('marks', 'teacher_id')) {

        Schema::table('marks', function (Blueprint $table) {

            $table->foreignId('teacher_id')
                ->after('exam_id')
                ->constrained('teachers')
                ->cascadeOnDelete();

        });

    }
}
public function down(): void
{
    Schema::table('marks', function (Blueprint $table) {

        $table->dropForeign([
            'teacher_id'
        ]);

        $table->dropColumn('teacher_id');

    });
}
};
