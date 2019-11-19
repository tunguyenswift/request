<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use App\RoleAssign;
use App\Employee;
use Illuminate\Support\Facades\DB;
use Cookie;

class RoleController extends Controller
{
    //
    public function getList()
    {
        $roles = Role::all();
        $arrRoles = get_roles($roles, $parent = 0, $str="--");
        $roleassigns =  array();

        foreach ($arrRoles as $role) {

            $role_assign =  array();

            $role_assign['role_id'] = $role['role_id'];
            $role_assign['role_name'] = $role['name'];
            $role_assign['description'] = $role['description'];
            $role_assign['assign'] =  RoleAssign::where('role_id', $role['role_id'])->get();
            // $role_assign =
           
            $roleassigns[] = $role_assign;
        }
     
        return view('pages.roles.list', compact('roleassigns'));
    }
    public function getAdd()
    {
        $data =  Role::select('id', 'name', 'parent_id')->get()->toArray();
        // $employee =  Employee::select('username', 'name', 'unitid')->get();

        $employeeInfo =  new Employee;
    	return view('pages.roles.add', compact('employeeInfo', 'data'));
    }

    public function postAdd(Request $request)
    {
        $this->validate(
            $request, 
            [
                'name' => 'required | min:3| max:100',
                'description' => 'required',
                'manager_support' => 'required',
                'support_user_1' => 'required',
                // 'support_user_2' => 'required',
                // 'support_user_3' => 'required',
            ],
            [
                'name.required' => '* Bạn chưa nhập tên đầu việc',
                'name.min' => '* Tên thể loại phải có độ dài từ 3 kí tự đến 100 kí tự',
                'name.max' => '* Tên thể loại phải có độ dài từ 3 kí tự đến 100 kí tự',
                'description.required' => '* Bạn chưa nhập mô tả công việc',
                'manager_support.required' => '* Bạn chưa chọn người quản lý',
                'support_user_1.required' => '* Bạn chưa chọn Support User 1',
                // 'support_user_2.required' => '* Bạn chưa chọn Support User 2',
                // 'support_user_3.required' => '* Bạn chưa chọn Support User 3',
            ]
        );

        $role =  new Role;
        $role->name = $request->name;
        $role->description = $request->description;
        $role->parent_id = $request->parent_id;
        $role->status = '1';
        $role->save();
        $result = Role::all()->last();
        
        $role_id = $result->id;

        $role_assign0 =  new RoleAssign;
        $role_assign0->role_id = $role_id;
        $role_assign0->username =  $request->manager_support;
        $role_assign0->index = 0;
        $role_assign0->save();

        $role_assign1 =  new RoleAssign;
        $role_assign1->role_id = $role_id;
        $role_assign1->username =  $request->support_user_1;
        $role_assign1->index = 1;
        $role_assign1->save();

        $role_assign2 =  new RoleAssign;
        $role_assign2->role_id = $role_id;
        $role_assign2->username =  $request->support_user_2;
        $role_assign2->index = 2;
        $role_assign2->save();
        
        $role_assign3 =  new RoleAssign;
        $role_assign3->role_id = $role_id;
        $role_assign3->username =  $request->support_user_3;
        $role_assign3->index = 3;
        $role_assign3->save();
        

       
        return redirect('admin/role/list')->with('notify', 'Thêm thành công đầu việc '.$role->name);

    }

    public function getEdit($id)
    {
        

        $role = Role::find($id);
        $data =  Role::select('id', 'name', 'parent_id')->get()->toArray();

        $roleassigns =  RoleAssign::where('role_id', '=', $id)->get();

        $users = array();
        foreach ($roleassigns as $roleassign) {
            # code...
            $employee =  Employee::where('username', $roleassign['username'])->first();
            $username = $employee->username;
            $name = $employee->name;
            $unit = $employee->Unit->name ;

            $arr = array();
            $arr['username'] = $username;
            $arr['name'] = $name.' - '.$unit;
           
            if($roleassign['index'] == 0) $users[0] = $arr;
            if($roleassign['index'] == 1) $users[1] = $arr;
            if($roleassign['index'] == 2) $users[2] = $arr;
            if($roleassign['index'] == 3) $users[3] = $arr;

        }
    	// $parent =  Role::select('id', 'name', 'parent_id')->get()->toArray();
        $employeeInfo =  new Employee;
        return view('pages.roles.edit', compact('data', 'role', 'users', 'employeeInfo'));
    }

    public function postEdit(Request $request, $id)
    {
        $this->validate(
            $request, 
            [
                'name' => 'required | min:3| max:100',
                'description' => 'required',
                'manager_support' => 'required',
                'support_user_1' => 'required',
                'support_user_2' => 'required',
                'support_user_3' => 'required',
            ],
            [
                'name.required' => '* Bạn chưa nhập tên đầu việc',
                'name.min' => '* Tên thể loại phải có độ dài từ 3 kí tự đến 100 kí tự',
                'name.max' => '* Tên thể loại phải có độ dài từ 3 kí tự đến 100 kí tự',
                'description.required' => '* Bạn chưa nhập mô tả công việc',
                'manager_support.required' => '* Bạn chưa chọn người quản lý',
                'support_user_1.required' => '* Bạn chưa chọn Support User 1',
                'support_user_2.required' => '* Bạn chưa chọn Support User 2',
                'support_user_3.required' => '* Bạn chưa chọn Support User 3',
            ]
        );

        $role = Role::find($id);
        $role->name = $request->name;
        $role->description = $request->description;
        $role->parent_id = $request->parent_id;
        $role->status = '1';
       
        try {
             $role->save();
        } catch (Exception $e) {
            report($e);

            return false;
        }

        
        return redirect('admin/role/list')->with('notify', 'Sửa thành công phân công '.$role->name);

    }

    public function getDelete($id)
    {
        $role = Role::find($id);
        $deletedName = $role->title;
        $role->delete();

        $role_assign = RoleAssign::where('role_id', $id)->delete();


        return redirect('admin/role/list')->with('thongbao', 'Đã xóa '.$deletedName.' thành công');
    }

    public function getRoleAssignEdit($id)
    {
        $role_assign =  RoleAssign::find($id);
        $employee =  Employee::where('username', $role_assign->username)->first();
        return view('pages.roles.roleassignedit', compact('employee', 'role_assign'));
    }

    public function postRoleAssignEdit(Request $request, $id)
    {
        $role_assign =  RoleAssign::find($id);
        $role_assign->username = $request->username;
        $role_assign->save();
        return redirect('admin/role/list');
    }

}
