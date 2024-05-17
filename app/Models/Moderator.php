<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Topic;

class Moderator extends Model
{
    use HasFactory;

    protected $fillable = [
        'firstname',
        'lastname',
        'gender',
        'city',
        'country',
        'dateofbirth',
        'JMBG',
        'phone',
        'photo',
        'email',
        'password',

    ];
    public function topics(){
        return $this->hasMany(Topic::class);
    }
    public function role() {
        return $this->belongsTo(Role::class);
    }
}
