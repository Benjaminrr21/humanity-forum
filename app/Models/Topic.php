<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Comment;
use App\Models\Moderator;
use App\Models\User;
use App\Models\Poll;

class Topic extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'numOfFollowers',
        'isOpen',
        'content',
        'moderator_id'
    ];
    public function comments(){
        return $this->hasMany(Comment::class);
    }
    public function moderator(){
        return $this->belongsTo(User::class,'owner_id');
    }
    public function followers(){
        return $this->belongsToMany(User::class);
    }
    public function polls(){
        return $this->hasMany(Poll::class);
    }
}
