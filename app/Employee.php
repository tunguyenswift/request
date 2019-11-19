<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    //
    protected $table = "tbluser";

    public function Unit()
    {
    	return $this->belongsTo('App\Unit', 'unitid', 'unitid');
    }

}
