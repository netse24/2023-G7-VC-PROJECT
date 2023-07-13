<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Teacher extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'course_id',
    ];

    public function user():BelongsTo{
        return $this->belongsTo(User::class);
    }
    public function schedule(): BelongsTo{
        return $this->belongsTo(Schedule::class);
    }
    public function course():BelongsTo{
        return $this->belongsTo(Course::class);
    }
    public static function store($request, $id = null)
    {
        $teacher = $request->only([
            'user_id', 'course_id'
        ]);
        $teacher = self::updateOrCreate(['id' => $id], $teacher);
        return $teacher;
    }
}
