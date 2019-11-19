<?php

namespace App\Http\Controllers;
use Mail;

use Illuminate\Http\Request;

class sendEmailController extends Controller
{
    //
    public function send()
    {

    	$to_name = 'IT Support';
		$to_email = 'tunt1@tanhoangminh.com.vn';
		$info =  array();
		$info['content'] = 'Máy in tầng 5';
		$info['deadline'] = '15/09/2019';
    	$data = array(
    		'info' => $info
    	);


		Mail::send('emails.content', $data, function($message) use ($to_name, $to_email) {
			$message->to($to_email, $to_name)->subject('Laravel Test Mail');
			$message->from('it-support@tanhoangminh.com.vn','Test Mail');
		});

      	echo "Basic Email Sent. Check your inbox.";
    }

    public function basic_email() {
      $data = array('name'=>"Virat Gandhi");
   
      Mail::send(['text'=>'mail'], $data, function($message) {
         $message->to('abc@gmail.com', 'Tutorials Point')->subject
            ('Laravel Basic Testing Mail');
         $message->from('xyz@gmail.com','Virat Gandhi');
      });
      echo "Basic Email Sent. Check your inbox.";
   }
}
