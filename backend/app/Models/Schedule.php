<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Schedule extends Model
{
    use HasFactory;
    protected $fillable = [
        'course_id', 'teacher_id', 'class_id', 'room_id', 'start_date', 'end_date', 'start_time', 'end_time'
    ];
    public function courses():HasMany{
        return $this->hasMany(Course::class);
    }
    public function teachers(): HasMany{
        return $this->hasMany(Teacher::class);
    }
    public function classes(): HasMany{
        return $this->hasMany(Classes::class);
    }
    public function rooms(): HasMany{
        return $this->hasMany(Room::class);
    }
}
