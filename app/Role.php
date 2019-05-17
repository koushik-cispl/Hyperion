<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    Protected $guarded = [];

    function users()
    {
        return $this->hasMany('App\AdminUser', 'id');
    }
}
