<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Course extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasFactory;
    protected $fillable = [
        'course'
    ];
    public function teacher():HasMany{
        return $this->hasMany(Teacher::class);
    }
    public static function store($request, $id = null)
    {
        $course = $request->only([
             'course',
        ]);
        $course = self::updateOrCreate(['id' => $id], $course);
        return $course;
    }
}