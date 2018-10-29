<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function domains(){
        return $this->belongsToMany(Domain::class);
    }

    public function payments(){
        return $this->hasMany(Payment::class);
    }

    public function students(){
        return $this->hasMany(StudentTutor::class,'id','student_id');
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function sentmessages(){
        return $this->hasMany(Message::class,'id','sent_to');
    }

    public function receivedmessages(){
        return $this->hasMany(Message::class,'id','sent_by');
    }
    // public function tutors(){
    //     return $this->belongsToMany(User::class,'student_id','tutor_id');
    // }
}
