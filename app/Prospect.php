<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prospect extends Model
{
    Protected $guarded = [];

    function prospectsCountry()
    {
        return $this->belongsTo('App\Country', 'country');
    }

    function prospectsState()
    {
        return $this->belongsTo('App\State', 'state');
    }
}
