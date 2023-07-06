<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Room extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
    ];
    public static function store($request, $id = null)
    {
        $room = $request->only([
             'name'
        ]);
        $room = self::updateOrCreate(['id' => $id], $room);
        return $room;
    }
}
