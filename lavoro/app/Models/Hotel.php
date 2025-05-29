<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'address', 'station', 'tel', 
        'image', 'start_time', 'end_time',
        'hot_spring', 'genre', 'group_room'
    ];

    public function plans()
    {
        return $this->hasMany(Plan::class);
    }

    public function likeUsers()
    {
        return $this->belongsToMany(User::class, 'likes')->withTimestamps();
    }
}
