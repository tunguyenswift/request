<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Cookie;

class EmployeeController extends Controller
{
    //
    public function getList(Request $r)
    {
        $keyword =  $r->get('search');
        if($r->get('sort')) {
            $sort = $r->get('sort');
        } else {
            $sort = 10;
        }

        $employees = Employee::where('name', 'LIKE','%' . $keyword . '%')->paginate($sort);
        if ($r->ajax()) {
           return view('pages.employees.presult', compact('employees', 'keyword', 'sort'));
        }

    	return view('pages.employees.list',  compact('employees', 'keyword', 'sort'));
    }
    public function getAdd()
    {
    	return view('admin.employee.add');
    }
    public function getEdit()
    {
    	
    }
}
