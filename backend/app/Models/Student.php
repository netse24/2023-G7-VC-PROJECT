<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Student extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'class_id',
        'generation_id',
    ];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function courseScores(): HasMany
    {
        return $this->hasMany(CourseScore::class);
    }
    public function class(): BelongsTo
    {
        return $this->belongsTo(Classes::class);
    }
    public function generation(): BelongsTo
    {
        return $this->belongsTo(Generation::class);
    }
    public function feedbacks(): HasMany
    {
        return $this->hasMany(Feedback::class);
    }
    public static function store($request, $id = null)
    {
        $student = $request->only([
            'user_id', 'class_id', 'generation_id',
        ]);
        $student = self::updateOrCreate(['id' => $id], $student);
        return $student;
    }
}
