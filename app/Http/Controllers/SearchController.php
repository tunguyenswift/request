<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    //
    public function index()
	{
		return view('admin.search');
	}
	public function search(Request $request)
	{
		// echo "000000000";
		if($request->ajax())
		{
			$output="";

			$users=DB::table('tbluser')->where('username','LIKE','%'.$request->search."%")->get();

			if($users)

			{

				foreach ($users as $key => $user) 
				{

					$output.='<tr>'.

					'<td>'.$user->username.'</td>'.

					'<td>'.$user->name.'</td>'.

					'</tr>';
				}

			}
			return Response($output);
		}
	}

}
