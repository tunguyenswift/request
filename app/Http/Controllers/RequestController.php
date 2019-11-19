<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use App\RoleAssign;
use App\Employee;
use App\RequestModel;
use App\RequestStatus;
use App\RequestPriority;
use App\RequestLog;
use Mail;
use Cookie;
use App\Http\Requests\SaveRequest;


class RequestController extends Controller
{  
    public function getList(Request $r)
    {
        // =====================================
        $activePage = 'request.list';
        $editPage = 'request.edit';
        $titlePage = 'Admin - Quản lý yêu cầu';
        // =====================================

        $username =  Cookie::get('usernamethm');
        $whereData = array();

        //--Filter
        $id = $r->get('search_id');
        $whereData[] = ['id', 'LIKE','%' . $id . '%'];
        //--Title
        $title =  $r->get('search_title');
        $whereData[] = ['title', 'LIKE','%' . $title . '%'];
        //--Priority
        $priority = $r->get('search_priority');
        if($priority != "")
            $whereData[] = ['priority', '=',$priority];
        //--Priority
        $status = $r->get('search_status');
        if($status != "") {
            $whereData[] = ['status', '=',$status];
        }
        if($r->get('length')) {
            $length = $r->get('length');
        } else {
            $length = 10;
        }

        // =====================================


        $request =  RequestModel::where($whereData)->orderBy('status', 'asc')->orderBy('deadline', 'asc')->orderBy('priority', 'desc')->orderBy('id', 'desc')->paginate($length);


        if ($r->ajax()) {

           return view('pages.requests.presult', compact('request','activePage', 'titlePage', 'length', 'username', 'priority', 'status', 'editPage'));
            // return view('pages.requests.test', compact('request'));
        }

        return view('pages.requests.list',compact('request', 'activePage', 'titlePage', 'length', 'username', 'priority', 'status', 'editPage'));

    }

    public function getTableRequestList(Request $r) {
        $activePage = 'request.list';
        $editPage = 'request.edit';
        $titlePage = 'Admin - Quản lý yêu cầu';
        // =====================================
        $username =  Cookie::get('usernamethm');
        $whereData = array();
        // =====
        $id = $r->get('id');
        $whereData[] = ['id', 'LIKE','%' . $id . '%'];
        //--Title
        $title =  $r->get('title');
        $whereData[] = ['title', 'LIKE','%' . $title . '%'];
        //--Priority
        $priority = $r->get('priority');
        if($priority != "")
            $whereData[] = ['priority', '=',$priority];
        //--Priority
        $status = $r->get('status');
        // echo $status;
        // exit();
        if($status != "") {
            $whereData[] = ['status', '=',$status];
        }


        if($r->get('sort')) {
            $sort = $r->get('sort');
        } else {
            $sort = 10;
        }

       
        $priority = $r->get('priority');
        $status = $r->get('status');
        $id = $r->get('id');

        // $created_at = $r->get('created_at');
        // $finish_at = $r->get('finish_at');

        // =====================================
        $request =  RequestModel::where($whereData)->orderBy('status', 'asc')->orderBy('deadline', 'asc')->orderBy('priority', 'desc')->orderBy('id', 'desc')->paginate($sort);


        if ($r->ajax()) {
            echo "<pre>";
            var_dump($r);

           return view('pages.requests.presult', compact('request','activePage', 'titlePage', 'sort', 'username', 'priority', 'status', 'editPage'));
            // return view('pages.requests.test', compact('request'));
        }

        return view('pages.requests.tablerequest',compact('request', 'activePage', 'titlePage', 'sort', 'username', 'priority', 'status', 'editPage'));
    }

    public function getMyRequestList($username, Request $r)
    {
        $username =  Cookie::get('usernamethm');

        // =====================================
        $activePage = 'myrequest.list';
        $titlePage = 'Danh sách Yêu cầu đi';
        $editPage = 'request.myrequestedit';
        // =====================================
        $whereData = array();
        //--Createed By
        $whereData[] = ['create_by', '=', $username];
        //--Filter
        $id = $r->get('search_id');
        $whereData[] = ['id', 'LIKE','%' . $id . '%'];
        //--Title
        $title =  $r->get('search_title');
        $whereData[] = ['title', 'LIKE','%' . $title . '%'];
        //--Priority
        $priority = $r->get('search_priority');
        if($priority != "")
            $whereData[] = ['priority', '=',$priority];
        //--Priority
        $status = $r->get('search_status');
        if($status != "") {
            $whereData[] = ['status', '=',$status];
        }
        if($r->get('length')) {
            $length = $r->get('length');
        } else {
            $length = 10;
        }
        $request =  RequestModel::where($whereData)->orderBy('status', 'asc')->orderBy('deadline', 'asc')->orderBy('priority', 'desc')->orderBy('id', 'desc')->paginate($length);
        if ($r->ajax()) {
            
           return view('pages.requests.presult', compact('request','activePage', 'titlePage', 'length', 'username', 'priority', 'status', 'editPage'));


        }
        return view('pages.requests.list',compact('request', 'activePage', 'titlePage', 'length', 'username', 'priority', 'status', 'editPage'));
    }
    public function  getMyRequestedList($username, Request $r)
    {
        // =====================================
        $activePage = 'myrequested.list';
        $titlePage = 'Danh sách Giao cho tôi';
        $editPage = 'request.myrequestededit';
        // =====================================
        // Lấy danh sách yêu cầu mới
        // ==================================
        // 1 - Lấy Role id trong RoleAssig
        $role_ids =  RoleAssign::where('index', '>', '0')->where('username', '=', $username)->get('role_id')->toArray();

        $requestStatus1 = array();

        foreach ($role_ids as $e) {
            # code...
           $role_id = $e['role_id'];
           // echo $role_id;
           $requests = RequestModel::where('status', '=', '1')->where('role_id', '=', $role_id)->orderBy('deadline', 'desc')->get(['id'])->toArray();
           //var_dump($requests);
           foreach ($requests as $e) {
               # code...
                $requestId = $e['id'];
                $request = RequestModel::find($requestId);
                $requestStatus1[] = $request;
           }

        }


        $requestStatus1 = array_unique($requestStatus1);
        // 2 - Lấy Request với Role_id , Status = 0
        // ==================================
        // Lấy danh sách yêu cầu mới
        // ==================================
        // =====================================
        $whereData = array();
        //--
        $whereData[] = ['support_user', '=', $username];
        //--Filter
        $id = $r->get('search_id');
        $whereData[] = ['id', 'LIKE','%' . $id . '%'];
        //--Title
        $title =  $r->get('search_title');
        $whereData[] = ['title', 'LIKE','%' . $title . '%'];
        //--Priority
        $priority = $r->get('search_priority');
        if($priority != "")
            $whereData[] = ['priority', '=',$priority];
        //--Priority
        $status = $r->get('search_status');
        if($status != "") {
            $whereData[] = ['status', '=',$status];
        }
        if($r->get('length')) {
            $length = $r->get('length');
        } else {
            $length = 10;
        }

        // $priority = $r->get('priority');
        // $status = $r->get('status');
        // $created_at = $r->get('created_at');
        // $finish_at = $r->get('finish_at');

        // =====================================
        $requestStatus2 = RequestModel::where('status', '=', '2')->where('support_user', '=', $username)->orderBy('deadline', 'asc')->orderBy('priority', 'desc')->get();
        // $request =  RequestModel::where('title', 'LIKE','%' . $keyword . '%')->where('support_user', '=', $username)->orderBy('id', 'desc')->paginate($sort);
        $request =  RequestModel::where($whereData)->orderBy('status', 'asc')->orderBy('deadline', 'asc')->orderBy('priority', 'desc')->orderBy('id', 'desc')->paginate($length);
        if ($r->ajax()) {
            // return "1234";
           return view('pages.requests.presult', compact('request','activePage', 'titlePage', 'length', 'username', 'priority', 'status', 'editPage' , 'requestStatus1'));
            // return view('pages.requests.test', compact('request'));
        }
        
        return view('pages.requests.myrequestedlist',compact('request', 'activePage', 'titlePage', 'length', 'username', 'priority', 'status', 'editPage' , 'requestStatus1', 'requestStatus2'));
    }

    public function getManagerRequestedList($username, Request $r)
    {
        // =====================================
        $activePage = 'managerrequested.list';
        $titlePage = 'Manager - Quản lý Yêu cầu';
        $editPage = 'request.manageredit';
        // =====================================

       
       
        // =====================================
        $whereData = array();
       
        //--Createed By

        $whereData[] = ['support_manager', '=', $username];

        // =====
        //--Filter
        $id = $r->get('search_id');
        $whereData[] = ['id', 'LIKE','%' . $id . '%'];
        //--Title
        $title =  $r->get('search_title');
        $whereData[] = ['title', 'LIKE','%' . $title . '%'];
        //--Priority
        $priority = $r->get('search_priority');
        if($priority != "")
            $whereData[] = ['priority', '=',$priority];
        //--Priority
        $status = $r->get('search_status');
        if($status != "") {
            $whereData[] = ['status', '=',$status];
        }
        if($r->get('length')) {
            $length = $r->get('length');
        } else {
            $length = 10;
        }

        // =====================================

        $request =  RequestModel::where($whereData)->orderBy('status', 'asc')->orderBy('deadline', 'asc')->orderBy('priority', 'desc')->orderBy('id', 'desc')->paginate($length);

        if ($r->ajax()) {
            // return "1234";
           return view('pages.requests.presult', compact('request','activePage', 'titlePage', 'length', 'username', 'priority', 'status', 'editPage'));
            // return view('pages.requests.test', compact('request'));
        }
        


        return view('pages.requests.list',compact('request', 'activePage', 'titlePage', 'length', 'username', 'priority', 'status', 'editPage'));
    }

    public function getAdd()
    {
        // =====================================
        $activePage = 'myrequest.list';
        $titlePage = 'Thêm mới';
        // $editPage = 'request.myrequestededit';
        // =====================================

        $fullname =  Cookie::get('fullnamethm');
        $employee =  Employee::select('username', 'name')->get()->toArray();
        $roles = Role::all();
        $priority = RequestPriority::all();
        return view('pages.requests.add',compact('roles', 'priority', 'employee', 'fullname', 'activePage', 'titlePage'));
    }

    public function postAdd(Request $request)
    {
        
        $this->validate(
            $request, 
            [
                'title' => 'required | min:5| max:150',
                'content' => 'required',
                'role_id'=>'required',
                'deadline' => 'required|date|after:yesterday',
                'priority' => 'required',


            ],
            [
                'title.required' => '* Bạn chưa nhập tên yêu cầu',
                'content.required' => '* Bạn chưa nhập nội dung',
                'title.min' => 'Tên yêu cầu tối thiểu 5 kí tự',
                'title.max' => 'Tên yêu cầu tối thiểu 150 kí tự',
                'deadline.required' => '* Bạn chưa nhập deadline',
                'role_id.required' => '* Bạn chưa chọn đầu việc',
                'priority.required' => '* Bạn chưa lựa chọn độ ưu tiên',
                'deadline.after' => ' * Deadline phải lớn hơn hiện tại',
                'deadline.date' => '* Bạn nhập sai định dang dd/mm/YYYY',

            ]
        );

        $username =  Cookie::get('usernamethm');
        $RequestModel =  new RequestModel;


        $RequestModel->title = $request->title;
        $RequestModel->create_by = $username;
        $RequestModel->request_user = $request->request_user;
        $RequestModel->role_id = $request->role_id;
        $RequestModel->status = '1';
        $RequestModel->priority = $request->priority;
        $RequestModel->content = $request->content;
        $RequestModel->deadline = date('Y-m-d H:i:s', strtotime($request->deadline));
        $RequestModel->support_manager = $RequestModel->RoleAssignSupportManager->username;
        $RequestModel->save();
        
        //================= Save request log =======================
        $description = "Khởi tạo yêu cầu";
        $this->saveRequestLog($RequestModel, $username, $description);
        //================= End Save request log 
        return redirect('admin/request/myrequestlist/'.$username)->with('notify', 'Bạn đã thêm yêu cầu số '.$RequestModel->id.' thành công'); 

    }

    public function getEdit($id)
    {
        // =====================================
        $activePage = 'request.list';
        $editPage = 'request.edit';
        $titlePage = 'Admin - Quản lý yêu cầu';
        // =====================================

        $fullname =  Cookie::get('fullnamethm');
        $request = RequestModel::find($id);
        // return view('pages.requests.edit', ['request' => $request]);

        $employee =  Employee::select('username', 'name')->get()->toArray();
        $role = Role::all();
        $priority = RequestPriority::all();

        $requestLogs = RequestLog::where('request_id', $id)->orderBy('created_at', 'desc')->get();
       
        return view('pages.requests.edit',compact('role', 'activePage', 'titlePage', 'priority', 'employee', 'request', 'fullname', 'requestLogs'));

    }

    public function getDetailRequest($id)
    {
        // =====================================
        $activePage = 'request.list';
        $titlePage = 'Chi tiết yêu cầu';
        $editPage = 'request.myrequestedit';
        // =====================================
        $fullname =  Cookie::get('fullnamethm');
        $request = RequestModel::find($id);
        $requestLogs = RequestLog::where('request_id', $id)->orderBy('created_at', 'desc')->get();

        return view('pages.requests.detail',compact('request', 'fullname', 'requestLogs', 'activePage', 'titlePage','editPage'));

    }

    public function getMyRequestDetail($id)
    {
        // =====================================
        $activePage = 'myrequest.list';
        $titlePage = 'Chi tiết yêu cầu';
        $editPage = 'request.myrequestedit';
        // =====================================
        $fullname =  Cookie::get('fullnamethm');
        $request = RequestModel::find($id);
        $requestLogs = RequestLog::where('request_id', $id)->orderBy('created_at', 'desc')->get();

        return view('pages.requests.myrequestdetail',compact('request', 'fullname', 'requestLogs', 'activePage', 'titlePage','editPage'));

    }
    public function getMyRequestEdit($id)
    {

        // =====================================
        $activePage = 'myrequest.list';
        $titlePage = 'Chỉnh sửa';
        // =====================================

        $fullname =  Cookie::get('fullnamethm');
        $request = RequestModel::find($id);
        $employee =  Employee::select('username', 'name')->get()->toArray();

        $role = Role::all();
        $priority = RequestPriority::all();
        $requestLogs = RequestLog::where('request_id', $id)->orderBy('created_at', 'desc')->get();       
        return view('pages.requests.myrequestedit',compact('role', 'priority', 'employee', 'request', 'fullname', 'requestLogs', 'activePage', 'titlePage'));

    }

    public function getMyRequestedDetail($id)
    {
        // =====================================
        $activePage = 'requested.list';
        $titlePage = 'Chi tiết yêu cầu';
        $editPage = 'request.myrequestededit';
        // =====================================
        $fullname =  Cookie::get('fullnamethm');
        $request = RequestModel::find($id);
        $requestLogs = RequestLog::where('request_id', $id)->orderBy('created_at', 'desc')->get();

        return view('pages.requests.myrequesteddetail',compact('request', 'fullname', 'requestLogs', 'activePage', 'titlePage','editPage'));

    }

    public function getMyRequestedEdit($id)
    {
        // =====================================
        $activePage = 'myrequested.list';
        $titlePage = 'Chỉnh sửa yêu cầu';
        // =====================================

        $fullname =  Cookie::get('fullnamethm');
        $request = RequestModel::find($id);
        // return view('pages.requests.edit', ['request' => $request]);

        $employee =  Employee::select('username', 'name')->get()->toArray();
        $role = Role::all();
        $priority = RequestPriority::all();

        $requestLogs = RequestLog::where('request_id', $id)->orderBy('created_at', 'desc')->get();
       
        return view('pages.requests.myrequestededit',compact('role', 'priority', 'employee', 'request', 'fullname', 'requestLogs', 'activePage', 'titlePage'));
    }

    public function getReceiveRequest($id, $username, $status)
    {
        $RequestModel =  RequestModel::find($id);
        $RequestModel->support_user = $username;
        $RequestModel->status = $status;
        $RequestModel->save();
        //================= Save request log =======================
        $description = 'Tiếp nhận công việc';
        $this->saveRequestLog($RequestModel, $username, $description);
        //================= End Save request log =======================
        return redirect('admin/request/myrequestedlist/'.$username)->with('notify', 'Bạn đã tiếp nhận yêu cầu số'.$RequestModel->id ); 
    }

    public function getManagerEdit($id)
    {
        // =====================================
        $activePage = 'managerrequested.list';
        $titlePage = 'Quản lý yêu cầu thuộc quản lý của tôi';
        // =====================================
        $fullname =  Cookie::get('fullnamethm');
        $request = RequestModel::find($id);
        $role = Role::all();
        $priority = RequestPriority::all();

        $requestLogs = RequestLog::where('request_id', $id)->orderBy('created_at', 'desc')->get();
       
        return view('pages.requests.managerrequestededit',compact('role', 'priority', 'request', 'fullname', 'requestLogs', 'activePage', 'titlePage'));
    }

    public function postEdit(Request $request, $id) 
    {
        $username =  Cookie::get('usernamethm');

        $RequestModel = RequestModel::find($id);
        $RequestModel->title = $request->title;
        $RequestModel->priority = $request->priority;
        $RequestModel->status = $request->status;
        $RequestModel->content = $request->content;
        $RequestModel->support_user = $request->support_user;
       
        try {
            // Validate the value...
            $RequestModel->save();
        } catch (Exception $e) {
            report($e);

            return false;
        }

        //================= Save request log =======================
        $this->saveRequestLog($RequestModel, $username);
        //================= End Save request log =======================
        // ============Trạng Thái ===============
        $status = [
          '1' => 'Khởi tạo',
          '2' => 'Đang thực hiện',
          '3' => 'Tạm dừng',
          '4' => 'Hoàn Thành'
        ];
        foreach ($status as $key => $value) {
          if($request->status == $key) {
            $status_content = $value;
          } 
        }
        // ============Độ ưu tiên ===============
        $priorities = [
          '1' => 'Thực hiện trong ngày',
          '2' => 'Thực hiện trong 4h',
          '3' => 'Thực hiện trong 2h',
          '4' => 'Thực hiện trong 1h',
          '5' => 'Thực hiện ngay lập tức'
        ];
        foreach ($priorities as $key => $value) {
          if($request->priority == $key) {
            $priority_content = $value;
          } 
        }
        // ============Độ ưu tiên ===============
        $fromUser = $username;
        $toUser = $RequestModel->support_user;
        $title = "Mã công việc: ".$RequestModel->id." - ".$RequestModel->Role->name;
        $content = $request->title."\n".$request->content."\n"."";
        $content .= "Trạng thái:".$status_content."\n";
        $content .= "Độ ưu tiên:".$priority_content."\n";
        $linkText = "Xem công việc";
        $linkUrl = $_SERVER['HTTP_HOST']."admin/request/edit/".$RequestModel->id;
        // ===============================Send Notify Viber =========================
        // $this->sendNotifyViber($fromUser, $toUser, $title, $content, $linkText, $linkUrl);
        // ===============================Send Notify Viber =========================
        return redirect('admin/request/list')->with('notify', 'Sửa thành công đầu việc số'.$RequestModel->id);   
    }

    public function postMyRequestEdit(Request $request, $id)
    {
        // $validated = $request->validated();
        $this->validate(
            $request, 
            [
                
                'description'=>'required',
            ],
            [
                 
                'description.required' => '* Bạn chưa nhập ghi chú',
            ]
        );

        $username =  Cookie::get('usernamethm');
        $RequestModel = RequestModel::find($id);

        $oldStatus = $RequestModel->status;
        $RequestModel->status = $request->status;
        $RequestModel->save();
        //================= Save request log =======================
        $description = $request->description;
        $this->saveRequestLog($RequestModel, $username, $description);
        //================= End Save request log =======================

        return redirect('admin/request/myrequestlist/'.$username)->with('notify', 'Sửa thành công đầu việc số'.$RequestModel->id);

    }

    public function postMyRequestedEdit(Request $request, $id)
    {
        $this->validate(
            $request, 
            [
                'description'=>'required',
            ],
            [
                'description.required' => '* Bạn chưa nhập ghi chú',
            ]
        );

        $username =  Cookie::get('usernamethm');

        $RequestModel = RequestModel::find($id);
        $oldStatus = $RequestModel->status;
        $newStatus = $request->status;

        $RequestModel->status = $request->status;
        if($RequestModel->status == '5' &&  $RequestModel->finish_at == null ) {
            $RequestModel->finish_at = date("d/m/Y");
        }
        $RequestModel->save();
        

        //================= Save request log =======================
        $description = $request->description;
        $this->saveRequestLog($RequestModel, $username, $description);
        //================= End Save request log =======================

        return redirect('admin/request/myrequestedlist/'.$username)->with('notify', 'Sửa thành công đầu việc số'.$RequestModel->id); 
    }
    public function postManagerEdit(Request $request, $id)
    {
        $this->validate(
            $request, 
            [
            ],
            [
            ]
        );
        $username =  Cookie::get('usernamethm');

        $RequestModel = RequestModel::find($id);

        $oldSupportUser = $RequestModel->support_user;


        $RequestModel->support_user = $request->support_user;

        $RequestModel->status = "2";

        try {
            // Validate the value...
            $RequestModel->save();
        } catch (Exception $e) {
            report($e);

            return false;
        }

        //================= Save request log =======================
        $description = "Phân công - ".$request->description;
        $this->saveRequestLog($RequestModel, $username, $description);
        //================= End Save request log ======================
        return redirect('admin/request/managerrequestedlist/'.$username)->with('notify', 'Đã phân công đầu việc '.$RequestModel->id.' thành công');   
    }
    
    public function getDelete($id) {
        $request = RequestModel::find($id);
        $deletedName = $request->title;
        $request->delete();
        return redirect('admin/request/list')->with('notify', 'Đã xóa '.$deletedName.' thành công');
    }

    public function saveRequestLog($RequestModel, $username, $description){
        $RequestLog = new RequestLog;
        $RequestLog->request_id = $RequestModel->id;
        $RequestLog->support_user = $RequestModel->support_user;
        $RequestLog->support_manager = $RequestModel->support_manager;
        $RequestLog->description = $description;
        $RequestLog->status = $RequestModel->status;
        $RequestLog->owner = $username;
        $RequestLog->save();
    }



}
