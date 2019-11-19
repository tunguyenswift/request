<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoleAssign extends Model
{
    //
    protected $table = "tbl_roles_assign";

    public function Employee()
    {
    	return $this->belongsTo('App\Employee', 'username', 'username');
    }
    public function Role()
    {
    	return $this->belongsTo('App\Role', 'role_id', 'id');
    }
}
