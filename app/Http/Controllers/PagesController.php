<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    //
    function getLogin()
    {
    	return view('login');
    }

    function postLogin(Request $request)
    {
    	$email = $request->email;
    	$password = $request->password;
    }
}
