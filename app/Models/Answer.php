<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Poll;

class Answer extends Model
{
    use HasFactory;
    protected $fillable = [
        'content',
        'votes'
    ];
    public function poll(){
        return $this->belongsTo(Poll::class);
    }
}
