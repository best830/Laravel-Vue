<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    public function receiver(){
        return $this->belongsTo(User::class,'sent_to');
    }

    public function sender(){
        return $this->belongsTo(User::class,'sent_by');
    }
}
