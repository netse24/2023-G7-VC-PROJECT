<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CourseScore extends Model
{
    use HasFactory;
    protected $fillable = [
        'course_id',
        'student_id',
        'score',
        'term_id',
    ];
    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }
    public function term(): BelongsTo
    {
        return $this->belongsTo(Term::class);
    }
}
