<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    public function meditation()
    {
        return $this->belongsTo(Meditation::class);
    }
}
