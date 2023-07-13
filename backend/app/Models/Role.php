<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model
{
    use  HasFactory;
    protected $fillable = [
        'name'
    ];
<<<<<<< HEAD
    public function user():HasMany{
        return $this->hasMany(User::class);
    }
 
=======
>>>>>>> e91a672f0103173d97b8498441449e64dfed80a6


    public static function store($request, $id = null)
    {
        $role = $request->only(['name']);
        $role = self::updateOrCreate(['id' => $id], $role);
        return $role;
    }
}
