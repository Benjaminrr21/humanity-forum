<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Role;
use App\Models\Topic;

use Illuminate\Contracts\Auth\MustVerifyEmail;
//use App\Models\Role;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
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
        'role_id'
        
    ];

    public function role() {
        return $this->belongsTo(Role::class,'role_id');
    }
    public function following(){
        return $this->belongsToMany(Topic::class);
    }
    //for moderators
    public function myTopics(){
        return $this->belongsToMany(Topic::class);
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
