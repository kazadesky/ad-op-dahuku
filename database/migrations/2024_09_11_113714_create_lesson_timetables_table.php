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
        Schema::create('lesson_timetables', function (Blueprint $table) {
            $table->id();
            $table->foreignId('teacher_id')
                ->constrained('users')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->foreignId('lesson_id')
                ->constrained('lessons')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->foreignId('class_id')
                ->constrained('class_rooms')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->foreignId('day_id')
                ->constrained('days')
                ->cascadeOnDelete();
            $table->foreignId('time_id')
                ->constrained('times')
                ->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lesson_timetables');
    }
};
