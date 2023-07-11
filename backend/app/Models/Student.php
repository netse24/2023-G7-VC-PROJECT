<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Student extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'class_id',
        'generation',
    ];

    public function user():BelongsTo{
        return $this->belongsTo(User::class);
    }
    public function class():BelongsTo{
        return $this->belongsTo(Classes::class);
    }
    public static function store($request, $id = null)
    {
        $student = $request->only([
            'user_id', 'class_id', 'generation',
        ]);
        $student = self::updateOrCreate(['id' => $id], $student);
        return $student;
    }

}
