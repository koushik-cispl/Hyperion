<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    Protected $guarded = [];

    function prospectsS()
    {
        return $this->hasMany('App\Prospect', 'id');
    }
}
