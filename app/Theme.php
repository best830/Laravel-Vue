<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    public function receiver(){
        return $this->belongsTo(User::class,'sent_to');
    }

    public function sender(){
        return $this->belongsTo(User::class,'sent_by');
    }
    public function comments(){
        return $this->hasMany(Comment::class);
    }
}
