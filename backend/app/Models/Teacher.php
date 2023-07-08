<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'course_id',
    ];
    public static function store($request, $id = null)
    {
        $teacher = $request->only([
            'user_id', 'course_id'
        ]);
        $teacher = self::updateOrCreate(['id' => $id], $teacher);
        return $teacher;
    }
}
