<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::group(['prefix' => 'admin', 'middleware' => 'checklogin'], function(){
	Route::get('mydashboard', function(){
		return view('dashboard');
	})->name('mydashboard');
	Route::group(['prefix' => 'request'], function(){
		Route::get('list', 'RequestController@getList')->name('request.list');

		Route::get('tablerequest', 'RequestController@getTableRequestList');

		Route::get('myrequestlist/{username}', 'RequestController@getMyRequestList')->name('myrequest.list');
		Route::get('myrequestedlist/{username}', 'RequestController@getMyRequestedList')->name('myrequested.list');
		Route::get('managerrequestedlist/{username}', 'RequestController@getManagerRequestedList')->name('managerrequested.list');

		Route::get('recieverequest/{requestid}/{username}/{status}', 'RequestController@getReceiveRequest')->name('receive.request');
		Route::get('add', 'RequestController@getAdd');
		Route::post('add', 'RequestController@postAdd')->name('request.add');
		Route::get('requestdetail/{requestid}', 'RequestController@getDetailRequest');
		Route::get('edit/{id}', 'RequestController@getEdit');
		Route::post('edit/{id}', 'RequestController@postEdit')->name('request.edit');
		Route::get('myrequestdetail/{id}', 'RequestController@getMyRequestDetail');
		Route::get('myrequestedit/{id}', 'RequestController@getMyRequestEdit');
		Route::post('myrequestedit/{id}', 'RequestController@postMyRequestEdit')->name('request.myrequestedit');

		Route::get('myrequesteddetail/{id}', 'RequestController@getMyRequestedDetail');
		Route::get('myrequestededit/{id}', 'RequestController@getMyRequestedEdit');
		Route::post('myrequestededit/{id}', 'RequestController@postMyRequestedEdit')->name('request.myrequestededit');


		Route::get('managerrequestedit/{id}', 'RequestController@getManagerEdit');
		Route::post('managerrequestedit/{id}', 'RequestController@postManagerEdit')->name('request.manageredit');

		Route::get('delete/{id}', 'RequestController@getDelete')->name('request.delete');
	});

	Route::group(['prefix' => 'role'], function(){
		Route::get('list', 'RoleController@getList')->name('role.list');

		Route::get('add', 'RoleController@getAdd');
		Route::post('add', 'RoleController@postAdd')->name('role.add');
		
		Route::get('edit/{id}', 'RoleController@getEdit');
		Route::post('edit/{id}', 'RoleController@postEdit')->name('role.edit');

		Route::get('delete/{id}', 'RoleController@getDelete');

		Route::get('roleassignedit/{id}', 'RoleController@getRoleAssignEdit');
		Route::post('roleassignedit/{id}', 'RoleController@postRoleAssignEdit')->name('roleassign.edit');

	});

	Route::group(['prefix' => 'group'], function(){
		Route::get('list', 'GroupController@getList')->name('group.list');

		Route::get('add', 'GroupController@getAdd');
		Route::post('add', 'GroupController@postAdd');

		Route::get('edit/{id}', 'GroupController@getEdit');
		Route::post('edit/{id}', 'GroupController@postEdit');

		Route::get('delete/{id}', 'TheLoaiController@getDelete');
	
	});

	Route::group(['prefix' => 'employee'], function(){
		Route::get('list', 'EmployeeController@getList')->name('employee.list');

		Route::get('add', 'EmployeeController@getAdd');
		Route::post('add', 'EmployeeController@postAdd');
		
		Route::get('edit/{id}', 'EmployeeController@getEdit');
		Route::post('edit/{id}', 'EmployeeController@postEdit');

		Route::get('delete/{id}', 'EmployeeController@getDelete');
	});
	
	Route::group(['prefix' => 'role_assign'], function(){
		Route::get('list', 'RoleAssignController@getList')->name('role_assign.list');

		Route::get('add', 'RoleAssignController@getAdd');
		Route::post('add', 'RoleAssignController@postAdd')->name('role_assign.add');

		Route::get('edit/{id}', 'RoleAssignController@getEdit');
		Route::post('edit/{id}', 'RoleAssignController@postEdit')->name('role_assign.edit');

		Route::get('delete/{id}', 'RoleAssignController@getDelete');
	
	});
	Route::group(['prefix' => 'my_request'], function(){
		Route::get('list', 'MyRequestController@getList');

		Route::get('add', 'MyRequestController@getAdd');
		Route::post('add', 'MyRequestController@postAdd');

		Route::get('edit/{id}', 'MyRequestController@getEdit');
		Route::post('edit/{id}', 'MyRequestController@postEdit');

		Route::get('delete/{id}', 'MyRequestController@getDelete');
	
	});
	Route::group(['prefix' => 'my_task'], function(){
		Route::get('list', 'MyTaskController@getList');

		Route::get('add', 'MyTaskController@getAdd');
		Route::post('add', 'MyTaskController@postAdd');

		Route::get('edit/{id}', 'MyTaskController@getEdit');
		Route::post('edit/{id}', 'MyTaskController@postEdit');

		Route::get('delete/{id}', 'MyTaskController@getDelete');
	
	});

});


Route::get('/', 'PostLoginController@getLogin');

Route::get('login', 'PostLoginController@getLogin');
Route::post('login', 'PostLoginController@login')->name('login');
Route::post('logout', 'PostLoginController@logout')->name('logout');

Route::group(['middleware' => 'auth'], function () {
	Route::get('table-list', function () {
		return view('pages.table_list');
	})->name('table');

	Route::get('typography', function () {
		return view('pages.typography');
	})->name('typography');

	Route::get('icons', function () {
		return view('pages.icons');
	})->name('icons');

	Route::get('map', function () {
		return view('pages.map');
	})->name('map');

	Route::get('notifications', function () {
		return view('pages.notifications');
	})->name('notifications');

	Route::get('rtl-support', function () {
		return view('pages.language');
	})->name('language');

	Route::get('upgrade', function () {
		return view('pages.upgrade');
	})->name('upgrade');
	Route::get('request_manager', function () {
		return view('pages.request_manager');
	})->name('request_manager');
});

// Route::group(['middleware' => 'auth'], function () {
// 	Route::resource('user', 'UserController', ['except' => ['show']]);
// 	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
// 	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
// 	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
// });

// Route::get('restlogin', 'UserController@getLogin');
// Route::post('restlogin', 'UserController@postLogin');

// Route::get('thu', function(){
// 	return view('admin.theloai.list');
// });
Route::get('ajax-pagination','AjaxController@ajaxPagination')->name('ajax.pagination');

Route::get('/s', 'LiveSearchController@index');
Route::get('/s2', function(){
	return view('search.search2');
});
Route::get('/search', 'LiveSearchController@search');

Route::get('/sendEmail', 'sendEmailController@send');

Route::get('testEmail', function ()
{

    $data = [
        'key'     => 'value'
    ];

    Mail::send('emails.test', $data, function ($message) {
        $message->from('it-support@tanhoangminh.com.vn', 'My name');
        $message->subject('subject');
        $message->to('tunt1@tanhoangminh.com.vn');
    });

    dd(Mail::failures());
});

Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    return "Cache is cleared";
});