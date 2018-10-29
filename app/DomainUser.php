<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DomainUser extends Model
{
    protected $fillable = [
        'name',
    ];

    protected $table = 'domain_user';
    
    public function tutors(){
        return $this->belongsToMany(User::class);
    }
}
