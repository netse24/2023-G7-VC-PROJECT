<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CourseScore extends Model
{
    use HasFactory;
    protected $fillable = [
        'course_id',
        'student_id',
        'score'
    ];
    public function students(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }
    public function courses(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }
}
