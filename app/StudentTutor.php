<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentTutor extends Model
{
    protected $table = 'student_tutor';

    public function student(){
        return $this->belongsTo(User::class,'student_id');
    }
    public function tutor(){
        return $this->belongsTo(User::class,'tutor_id');
    }
}
