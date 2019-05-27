<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminUser extends Model
{
    Protected $guarded = [];

    function userRoles()
    {
        return $this->belongsTo('App\Role', 'role_id');
    }

    function prospects()
    {
        return $this->hasMany('App\Prospect', 'id');
    }
}
