<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Topic;
use App\Models\User;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'content',
        'likes',
        'dislikes',
    ];
    public function topic(){
        return $this->belongsTo(Topic::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function replies(){
        return $this->hasMany(Reply::class);
    }
    public function likedByUsers()
{
    return $this->belongsToMany(User::class, 'comment_user_like')->withTimestamps();
}
}
