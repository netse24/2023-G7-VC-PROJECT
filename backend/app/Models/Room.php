<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Room extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
 
    use HasFactory;
    protected $fillable = [
        'name',
    ];
    public function schedule(): BelongsTo{
        return $this->belongsTo(Schedule::class);
    }
    public static function store($request, $id = null)
    {
        $room = $request->only([
             'name'
        ]);
        $room = self::updateOrCreate(['id' => $id], $room);
        return $room;
    }
}
