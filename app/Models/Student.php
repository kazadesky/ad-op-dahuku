<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Student extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'nis',
        'nisn',
        'class_id',
        'place_of_birth',
        'date_of_birth',
        'gender',
        'address',
    ];

    public function classRoom():BelongsTo
    {
        return $this->belongsTo(ClassRoom::class, 'class_id');
    }
}
