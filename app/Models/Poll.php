<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Answer;

class Poll extends Model
{
    use HasFactory;

    protected $fillable = [
        'question',
        'topicId',
        'moderatorId'
    ];
    public function answers(){
        return $this->hasMany(Answer::class);
    }
    public function topic(){
        return $this->belongsTo(Topic::class);
    }
    public function moderator(){
        return $this->belongsTo(User::class);
    }
}
