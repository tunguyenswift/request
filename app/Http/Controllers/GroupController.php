<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Unit;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class GroupController extends Controller
{
    //
    public function getList()
    {
    	// phpinfo();
        $group = Unit::all();
        return view('pages.groups.list', ['group'=>$group]);
    }

    public function getAdd()
    {
        return view('admin.group.add');
    }

    public function postAdd(Request $request)
    {	
    	$this->validate(
            $request, 
            [
                'name' => 'required',
                'description' => 'required'
            ],
            [
                'name.required' => 'You need enter the name.',
                'description.required' => 'You need enter the description.',
            ]
        );
        $group =  new Group;
        $groupname = $request->name;
        $group->description = $request->description;

        $group->name = $request->name;
        $group->save();
        return redirect('admin/group/add')->with('thongbao', 'Add '.$groupname.' success.');

    }
    public function getEdit()
    {
    	
    }
}
