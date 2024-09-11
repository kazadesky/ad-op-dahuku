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
        Schema::create('teacher_presences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('teacher_picket_id')
                ->constrained('users')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->foreignId('teacher_id')
                ->constrained('users')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->foreignId('lesson_id')
                ->constrained('lessons')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignId('class_id')
                ->constrained('class_rooms')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignId('lesson_timetable_id')
                ->constrained('lesson_timetables')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->enum('status', ['Hadir', 'Tidak Hadir', 'Izin']);
            $table->foreignId('substitute_teacher_id')
                ->nullable()
                ->constrained('users')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teacher_presences');
    }
};
