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
>>>>>>> ca024fa76526cb65f52b796285b1734e279699e4


    public static function store($request, $id = null)
    {
        $role = $request->only(['name']);
        $role = self::updateOrCreate(['id' => $id], $role);
        return $role;
    }
}
