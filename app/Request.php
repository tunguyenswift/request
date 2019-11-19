<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    //
    protected $table = "Request";

    public function Role()
    {
    	return $this->belongsTo('App\Role', 'role_id', 'id');
    }

    static $validationRules = [
    'title' => 'required'
  	];

  	public function save(array $options = array())
	  {
	    if ($this->isValid()) {
	      parent::save($options);
	    } else {
	      throw new \Exception("Error Saving User", 1);
	    }
	  }
	public function isValid()
  {
    $values = $this->getAttributes();
    <strong>$values['connection'] = $this->getConnectionName();</strong>
    // parsing validation rules
    $rules = self::$validationRules;
    array_walk($rules, function (&$rule, $key) use ($values) {
      $rule = nvsprintf($rule, $values);
    });
    $v = \Validator::make($values, $rules);
    <del>$v->getPresenceVerifier()->setConnection($this->getConnectionName());</del>
    $isValid = !$v->fails();
    $this->errors = $isValid ? new \Illuminate\Support\MessageBag() : $v->messages();
    return $isValid;
  }
}
