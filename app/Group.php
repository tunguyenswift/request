<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    //
    protected $table = "Group";

    public function Employee()
    {
    	return $this->hasMany('App\Employee', 'idGroup', 'id');
    }
}
