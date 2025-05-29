<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    protected $fillable = ['content'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function likeUsers() {
        return $this->belongsToMany(User::class, 'likes')->withTimestamps();
    }

    public function getLikeUsersCount() {
        return $this->likeUsers()->count();
    }

    // (point) likeUsersでUser要素を取得した後、プロパティで絞り込みを入れるなら plunk('プロパティ名')メソッド
    public function getLikeUsersNameArray() {
        return $this->likeUsers()->pluck('name');
    }
}
