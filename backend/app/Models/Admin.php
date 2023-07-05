<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;
    protected $fillable = [
        'first_name',
        'last_name', 
        'email', 
        'password', 
        'role_id'
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    public static function store($request, $id = null)
    {
        $admin = $request->only([
            'first_name','last_name', 'email', 'password', 'role_id',
        ]);
        $admin = self::updateOrCreate(['id' => $id], $admin);
        return $admin;
    }
}
