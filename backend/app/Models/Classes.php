<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Classes extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasFactory;
    protected $fillable = [
        'name',
        'room_id'
    ];
    public function room():BelongsTo{
        return $this->belongsTo(Room::class);
    }
    public function student():HasMany{
        return $this->hasMany(Student::class);
    }
    public function schedule(): BelongsTo{
        return $this->belongsTo(Schedule::class);
    }
    public static function store($request, $id = null)
    {
        $classe = $request->only([
             'name',
             'room_id'
        ]);
        $classe = self::updateOrCreate(['id' => $id], $classe);
        return $classe;
    }
}