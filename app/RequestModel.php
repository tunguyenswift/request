<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\RequestLog;
use Cookie;

class RequestModel extends Model
{
    //
    protected $table = "tbl_request";

    public function Role()
    {
    	return $this->belongsTo('App\Role', 'role_id', 'id');
    }
    public function CreateBy()
    {
    	return $this->belongsTo('App\Employee','create_by','username');
    }

    public function getSupportManager()
    {
        return $this->belongsTo('App\Employee','support_manager','username');
    }
    public function getSupportUser()
    {
        return $this->belongsTo('App\Employee','support_user','username');
    }


    public function getStatus()
    {
        return $this->belongsTo('App\RequestStatus','status','id');
    }
    public function getPriority()
    {
        return $this->belongsTo('App\RequestPriority','priority','id');
    }




    public function RoleAssignSupportManager()
    {
        return $this->belongsTo('App\RoleAssign', 'role_id', 'role_id')->where('index', '0');
    }
     public function RoleAssignSupportUser01()
    {
        return $this->belongsTo('App\RoleAssign', 'role_id', 'role_id')->where('index', '1');
    }
     public function RoleAssignSupportUser02()
    {
        return $this->belongsTo('App\RoleAssign', 'role_id', 'role_id')->where('index', '2');
    }
     public function RoleAssignSupportUser03()
    {
        return $this->belongsTo('App\RoleAssign', 'role_id', 'role_id')->where('index', '3');
    }

    // public static function boot() {
    //     parent::boot();
    //     static::saving(function($model){
    //         $username =  Cookie::get('usernamethm');
    //         $description = "Lưu log";
    //         saveRequestLog($model, $username, $description);
            
    //     });
    // }
    
   // public function save(array $options = array())
   //  {
   //    parent::save($options);
      
   //    $user = $options['user'];
   //    $post = $options['post'];
      
   //    \Event::fire(new PostAdded($user, $post));
   //  }
    // public static function boot() {
    //     parent::boot();
    //     self::saving(function ($model) {
    //       \Log::debug("Post - Saving");
    //     });
    //     self::saved( function ($model) {
    //       \Log::debug("Post - Saved");
    //         $username =  Cookie::get('usernamethm');
    //         // $description = "Lưu log";
    //         self::saveRequestLog($model, $username, $description);
    //     });
    // }

    // public static function saveRequestLog($RequestModel, $username, $description){
    //     $RequestLog = new RequestLog;
    //     $RequestLog->request_id = $RequestModel->id;
    //     $RequestLog->support_user = $RequestModel->support_user;
    //     $RequestLog->support_manager = $RequestModel->support_manager;
    //     $RequestLog->description = $description;
    //     $RequestLog->status = $RequestModel->status;
    //     $RequestLog->owner = $username;
    //     $RequestLog->save();
    // }

}
