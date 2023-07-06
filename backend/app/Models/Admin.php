<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;
    protected $fillable = [ 
        'user_id'
    ];
    public static function store($request, $id = null)
    {
        $admin = $request->only([
            'user_id',
        ]);
        $admin = self::updateOrCreate(['id' => $id], $admin);
        return $admin;
    }
}
