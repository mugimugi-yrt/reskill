<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = 
    [
        'name', 'ruby', 'email', 'password', 'address', 'tel', 'company', 'birthday', 'gender', 'get_notice', 
    ];

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
    
    public function likeHotels()
    {
        return $this->belongsToMany(Hotel::class, 'likes')->withTimestamps();
    }
}
