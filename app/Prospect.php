<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Prospect extends Model
{
	use Sortable;

    Protected $guarded = [];

    /*function prospectsCountry()
    {
        return $this->belongsTo('App\Country', 'country');
    }

    function prospectsState()
    {
        return $this->belongsTo('App\State', 'state');
    }*/
    
	public $sortable = ['fname', 'address', 'state', 'city', 'created_at'];
}
