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
        'likes'
    ];
    public function topic(){
        return $this->belongsTo(Topic::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
