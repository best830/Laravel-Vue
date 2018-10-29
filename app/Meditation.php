<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meditation extends Model
{
    public function tutor(){
        return $this->belongsTo(User::class,'tutor_id');
    }

    public function student(){
        return $this->belongsTo(User::class,'student_id');
    }

    public function domain(){
        return $this->belongsTo(Domain::class);
    }

    public function payment(){
        return $this->belongsTo(Payment::class);
    }

    public function sessions(){
        return $this->hasMany(Session::class);
    }
}
