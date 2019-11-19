<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Employee;
class LiveSearchController extends Controller
{
    //
    public function index()
    {
    	$users = DB::table('tbluser')->get();
    	return view('search.search', compact('users'));

        // $employees = Employee::where('username', 'LIKE', '%tunt%')->get();
        //     if ($employees) {
        //         foreach ($employees as $e) {
        //             echo "<pre>";
        //             var_dump($e->Unit);
                  
        //         }
        //     }
        //     exit();
    }
    public function search(Request $request)
    {
    	if ($request->ajax()) {

            $arr = array();
            $arr1 = array();
            $users = DB::table('tbluser')->where('username', 'LIKE', '%' . $request->q . '%')->orwhere('name', 'LIKE', '%' . $request->q . '%')->orwhere('email', 'LIKE', '%' . $request->q . '%')->orwhere('mobile', 'LIKE', '%' . $request->q . '%')->get();

            
            if ($users) {
                foreach ($users as $key => $user) {


                   $newArray = array();

                   $newArray['username'] = $user->username;
                   $newArray['name'] = $user->name;
                   $arr[] = $newArray;
                }
            }

            $employees = Employee::where('username', 'LIKE', '%' . $request->q . '%')->orwhere('name', 'LIKE', '%' . $request->q . '%')->orwhere('email', 'LIKE', '%' . $request->q . '%')->orwhere('mobile', 'LIKE', '%' . $request->q . '%')->get();

            if ($employees) {
                foreach ($employees as $e) {

                   $newArray = array();

                   $newArray['username'] = $e->username;
                   $newArray['name'] = $e->name.' - '.$e->Unit['name'];
                   $arr1[] = $newArray;
                }
            }
            
            return response()->json($arr1);
        }
    }
}
