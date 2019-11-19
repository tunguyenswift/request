<?php

namespace App;

use Cookie;
use Mail;
use App\RoleAssign;
use App\RequestModel;
use Illuminate\Database\Eloquent\Model;

class RequestLog extends Model
{
    //
    protected $table = "tbl_request_log";

    public function getStatus()
    {
        return $this->belongsTo('App\RequestStatus','status','id');
    }

    public static function boot() {
        parent::boot();
        self::saving(function ($model) {
          \Log::debug("Post - Saving");
        });
        self::saved( function ($model) {
          \Log::debug("Post - Saved");
            $username =  Cookie::get('usernamethm');
           	$request_id = $model->request_id;
            $request = RequestModel::find($request_id);

            // ==============1- Gửi Notify cho người tạo yêu cầu================
            

            $fromUser = $request->create_by;
            $toUser = $request->create_by;
            $toUserEmail = $request->CreateBy->email;

            switch ($request->status) {
            	case '1':
            		// =====Status = 1: Khởi tạo yêu cầu 
            		$title = 'Yêu cầu số '.$model->id.' khởi tạo thành công';
            		break;
            	default:
            		// =====Status != 1: Khởi tạo yêu cầu 
            		$title = 'Yêu cầu số '.$model->id.'có thay đổi';
            		break;
            }

            $linkUrl = $_SERVER['HTTP_HOST']."/request/admin/request/managerrequestedit/".$request->id;
            
            // self::sendViberNotify($fromUser, $toUser, $title, $request, $linkUrl);
            // self::sendEmailNotify($toUserEmail, $title, $request);

            // =====Status = 2 && Phân công mới

            // ==============2- Gửi Notify cho người Quản lý yêu cầu ================
            $fromUser = $request->create_by;
            $toUser = $request->support_manager;
            $toUserEmail = $request->getSupportManager->email;
            
            switch ($request->status) {
            	case '1':
            		// =====Status = 1: Khởi tạo yêu cầu 
            		$title = 'Yêu cầu số '.$request->id.' đang chờ phân công';
            		break;
            	default:
            		// =====Status != 1: Khởi tạo yêu cầu 
            		$title = 'Yêu cầu số '.$request->id.' có thay đổi';
            		break;
            }

            $linkUrl = $_SERVER['HTTP_HOST']."/request/admin/request/managerrequestedit/".$request->id;

            self::sendViberNotify($fromUser, $toUser, $title, $request, $linkUrl);
            self::sendEmailNotify($toUserEmail, $title, $request);

            // ==============3- Gửi Notify cho những người phải tiếp nhận yêu cầu================           

            switch ($model->status) {
            	case '1':
            		$title = 'Yêu cầu số '.$model->id.' đang chờ tiếp nhận';
            		$role_id = $request->role_id;
            		$employees =  RoleAssign::where('role_id', $role_id)->where('index', '!=', 0)->get();
            		foreach ($employees as $e) {
		           		$toUser = $e->username;
		           		$toUserEmail = $e->email;
		           		$linkUrl = $_SERVER['HTTP_HOST']."/request/admin/request/myrequestedlist/".$toUser."?myjobs";
		           		// self::sendViberNotify($fromUser, $toUser, $title, $request, $linkUrl);
            			// self::sendEmailNotify($toUserEmail, $title, $request);
		           	}
            		break;

            	case '2':
            		// $oldRequestLog = 
            		break;
            	default:
            		// =====Status != 1: Khởi tạo yêu cầu 
            		$title = 'Yêu cầu số '.$request->id.' có thay đổi';

            		$toUser = $request->support_user;
            		$toUserEmail = $request->getSupportUser->email;
            		$linkUrl = $_SERVER['HTTP_HOST']."/request/admin/request/myrequestededit/".$request->id;
            		// self::sendViberNotify($fromUser, $toUser, $title, $request, $linkUrl);
            		// self::sendEmailNotify($toUserEmail, $title, $request);
            		break;
            }
           	

           	

            // $description = "Lưu log";
            // self::saveRequestLog($model, $username, $description);
        });
    }

    public static function sendViberNotify($fromUser, $toUser, $title, $request, $linkUrl)
    {
    	// $request_id = $RequestModel->id;
        // // ============Request Title ===============
        $request_title = $request->title;
        // // ============Đơn vị yêu cầu ===============
        $create_by = $request->create_by;
        $create_by = Employee::where('username', $request->create_by)->firstOrFail();
        $create_by_name = $create_by['name'];
        $create_by_unit_name = $create_by->Unit['name'];


        // // ============Trạng Thái ===============
        $status_content = $request->getStatus->title;
        // // ============Độ ưu tiên ===============
        $priority_content = $request->getPriority->title;
        // // ============Ngày bắt đầu ===============
        $created_at = $request->created_at->format('d-m-Y');
        // // ============Deadline ===============
        $deadline =  date('d-m-Y', strtotime($request->deadline));

        // // =============Content
        $content = "Yêu cầu số ".$request->id."\n";
        $content = "Tiêu đề: ".$request_title."\n";
        $content.= "Người y/c: ".$create_by_name."\n";
        $content.= "Đơn vị: ".$create_by_unit_name."\n";
        $content.= "Ngày y/c: ".$created_at."\n";
        $content.= "Deadline: ".$deadline."(".$priority_content.")\n";
        $content.= "Trạng chái: ".$status_content."\n";

        $linkText = "Chi tiết";

        // =================================
        $service_url = 'https://viber.tanhoangminh.com.vn/api/viber/sendmessage';
        $curl = curl_init($service_url);
        $curl_post_data = json_encode(
            array(
                "fromUser"=> $fromUser,
                "toUser"=> $toUser,
                "title"=> $title,
                "content"=> $content,
                "messageLink"=> array(
                    "linkText"=> $linkText,
                    "linkUrl"=> $linkUrl
                )
            )
        );
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'AppId: QuanLyYeuCau',
            'AppKey: Qu@nlyYeuc@u!Thm',
            'Content-Type:application/json'
        ));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $curl_post_data);
        $curl_response = curl_exec($curl);
        if ($curl_response === false) {
            $info = curl_getinfo($curl);
            curl_close($curl);
            die('error occured during curl exec. Additioanl info: ' . var_export($info));
        }
        curl_close($curl);
        $decoded = json_decode($curl_response);
        if (isset($decoded->response->status) && $decoded->response->status == 'ERROR') {
            die('error occured: ' . $decoded->response->errormessage);
        }
        return ($decoded);	
    }

    public static function sendEmailNotify($toUser, $subject, $request)
    {
    	$from_name = 'IT Support';
        $from_email = 'it-support@tanhoangminh.com.vn';

        $to_name = 'Nguyễn Thế Tú';
        $to_email = $toUser;

        $data = array(
            'request' => $request
        );

        Mail::send('emails.content', $data, function($message) use ($to_name, $to_email, $from_name, $from_email, $subject) {
            $message->to($to_email, $to_name)->subject('Yêu cầu mới');
            $message->from($from_email, $from_name);
        });
    }
 
}
