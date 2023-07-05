<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;
    protected $fillable = [
        'first_name',
        'last_name', 
        'email', 
        'password', 
        'role_id',
        'admin_id',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    public static function store($request , $id = null){
        $teacher = $request->only(['first_name','last_name', 'email', 'password', 'role_id','admin_id']);
        $teacher = self::updateOrCreate(['id'=>$id], $teacher);
        return $teacher;
    }
}
