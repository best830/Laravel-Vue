<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Domain extends Model
{
    protected $fillable = [
        'name',
    ];

    public function tutors(){
        return $this->belongsToMany(User::class);
    }

    public function payments(){
        return $this->belongsToMany('App\Payment')->withPivot('total_no_of_meditations', 'remaining_no_of_meditations');
    }
}
