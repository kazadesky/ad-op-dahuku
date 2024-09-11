<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TeacherPresence extends Model
{
    use HasFactory;
    protected $fillable = [
        'teacher_picket_id',
        'teacher_id',
        'lesson_id',
        'class_id',
        'lesson_timetable_id',
        'status',
        'subtitute_teahcer_id',
    ];

    public function teacherPicket(): BelongsTo
    {
        return $this->belongsTo(User::class, 'teacher_picket_id');
    }
    public function teacher(): BelongsTo
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function lesson(): BelongsTo
    {
        return $this->belongsTo(Lesson::class, 'lesson_id');
    }

    public function classRoom(): BelongsTo
    {
        return $this->belongsTo(ClassRoom::class, 'class_id');
    }

    public function timetable(): BelongsTo
    {
        return $this->belongsTo(LessonTimetable::class, 'lesson_timetable_id');
    }

    public function subtituteTeacher(): BelongsTo
    {
        return $this->belongsTo(User::class, 'subtitute_teacher_id');
    }
}
