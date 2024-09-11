<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TeacherPicket extends Model
{
    use HasFactory;
    protected $fillable = [
        'teacher_id',
        'day_id',
        'substitute_picket_teacher_id',
        'action',
    ];

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function subtitute(): BelongsTo
    {
        return $this->belongsTo(User::class, 'subtitute_picket_teacher_id');
    }

    public function day(): BelongsTo
    {
        return $this->belongsTo(Day::class,'day_id');
    }
}
