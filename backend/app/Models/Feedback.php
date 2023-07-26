<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;
    protected $fillable = [
        'feedback',
        'student_id',
        'teacher_id',
        'term_id',
    ];
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
    public function term()
    {
        return $this->belongsTo(Term::class);
    }
    public static function store($request, $id = null)
    {
        $feedback = $request->only([
            'feedback', 'student_id', 'teacher_id', 'term_id',
        ]);
        $feedback = self::updateOrCreate(['id' => $id], $feedback);
        return $feedback;
    }
}

