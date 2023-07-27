<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Term extends Model
{
    use HasFactory;
    protected $fillable = [
        'term',
    ];

    public function courseScores():HasMany{
        return $this->hasMany(CourseScore::class);
    }
    public function feedbacks():HasMany{
        return $this->hasMany(Feedback::class);
    }
}
