<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = ['name', 'email','password','disability_id','type'];
    protected $hidden = [ 'password','remember_token', ];
    protected $casts = [ 'email_verified_at' => 'datetime',   'password' => 'hashed',];

    public function disability()
    {
        return $this->belongsTo(Disability::class, 'disability_id');
    }
    
    public function scores()
    {
        return $this->hasMany(Score::class, 'user_scoreId');
    }

    public function answers()
    {
        return $this->hasMany(Quiz::class, 'user_id');
    }
}
