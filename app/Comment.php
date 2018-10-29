<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function theme(){
        return $this->belongsTo(Theme::class);
    }
}
