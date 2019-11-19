<?php

namespace App\Http\Controllers;

use App\Role;
use App\Employee;
use App\RoleAssign;
use Illuminate\Http\Request;

class RoleAssignController extends Controller
{
    //
    public $arr = 10;
    public function getList()
    {
        // $role_assign = RoleAssign::where('role_id', '6')->get();
        
        $roles = Role::all();
        // // echo "<pre>";
        // // var_dump($roles);
        // $arr =  10;
        // $stt = 2;
        $arrRoles = get_roles($roles, $parent = 0, $str="--");
        // echo "<pre>";
        // var_dump($arrRoles);
        // exit();
        $roleassigns =  array();
        foreach ($arrRoles as $role) {
            # code...
            $role_assign =  array();
            $role_assign['role_name'] = $role['name'];
            $role_assign['assign'] =  RoleAssign::where('role_id', $role['role_id'])->get();
            // $role_assign =
           
            $roleassigns[] = $role_assign;
        }
        return view('pages.role_assign.list', ['roleassigns'=>$roleassigns]);
    }

    public function getAdd()
    {
    	$employee =  Employee::select('username', 'name')->get()->toArray();
    	// var_dump($employee);
    	$parent =  Role::select('id', 'name', 'parent_id')->get()->toArray();
    	return view('pages.role_assign.add', compact('employee','parent'));
    }

    public function postAdd(Request $request)
    {
    	$this->validate(
            $request, 
            [
                'username' => 'required',
                'role_id' => 'required'
            ],
            [
                'username.required' => 'Bạn chưa chọn nhân viên',
                'role_id.min' => 'Bạn chưa chọn đầu việc',
            ]
        );

        $roleassign =  new RoleAssign;
        $roleassign->username = $request->username;
        $roleassign->role_id = $request->role_id;
        $roleassign->index = $request->index;
        // return ($theloai->TenKhongDau);
       
        try {
            // Validate the value...
                 $roleassign->save();
        } catch (Exception $e) {
            report($e);

            return false;
        }

       
        return redirect('admin/role_assign/add')->with('thongbao', 'Thêm thành công');
    }

    public function getEdit($id)
    {
        $role_assign =  RoleAssign::find($id);
        $employee =  Employee::select('username', 'name', 'unitid')->get();
        $employeeInfo = new Employee;
        return view('pages.role_assign.edit', compact('employee', 'role_assign', 'employeeInfo'));
    }

    public function postEdit(Request $request, $id)
    {
        $role_assign =  RoleAssign::find($id);
        $role_assign->username = $request->username;
        $role_assign->save();
        return redirect('admin/role_assign/list');
    }

    public function getDelete($id)
    {
        $request = RoleAssign::find($id);
        
        $request->delete();
        return redirect('admin/role_assign/list');
    }
}
