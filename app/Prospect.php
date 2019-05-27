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

    function prospectCreatedUser()
    {
        return $this->belongsTo('App\AdminUser', 'created_by');
    }
    
	public $sortable = ['fname', 'address', 'state', 'city', 'created_at'];
}
