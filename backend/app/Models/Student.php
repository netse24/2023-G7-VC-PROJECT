<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'class_id',
        'generation',
    ];
    public static function store($request, $id = null)
    {
        $student = $request->only([
            'user_id', 'class_id', 'generation',
        ]);
        $student = self::updateOrCreate(['id' => $id], $student);
        return $student;
    }
}
