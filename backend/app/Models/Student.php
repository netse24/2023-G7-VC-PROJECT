<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $fillable = [
        'first_name',
        'last_name', 
        'email', 
        'password', 
        'role_id',
        'admin_id',
        'teacher_id',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    public static function store($request, $id = null)
    {
        $student = $request->only([
            'first_name','last_name', 'email', 'password', 'role_id','admin_id','teacher_id'
        ]);
        $student = self::updateOrCreate(['id' => $id], $student);
        return $student;
    }
}
