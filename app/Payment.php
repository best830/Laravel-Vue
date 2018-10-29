<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    public function domains(){
        return $this->belongsToMany('App\Domain')
                    ->withPivot('total_no_of_meditations', 'remaining_no_of_meditations');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
