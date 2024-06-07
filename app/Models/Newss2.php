<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Topic;

class Newss2 extends Model
{
    use HasFactory;
    protected $fillable = [
        'content'
    ];
    public function topic(){
        return $this->belongsTo(Topic::class);
    }
}
