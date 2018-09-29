<?php

/*
|--------------------------------------------------------------------------
| Web Routes 网站的路由
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// 前台路由
Route::get('/',"Home\IndexController@index");

// 后台路由
//登录注册
Route::any('/admin/login',"Admin\LoginController@login");
/*
|--------------------------------------------------------------------------
| 管理员管理
|--------------------------------------------------------------------------
*/
// 后台模态框
Route::get('/admin/admin/model/addadmin',function(){
	return view('/admin/admin/model/addadmin');
});
Route::get('/admin/admin/model/updateadmin',function(){
	return view('/admin/admin/model/updateadmin');
});
// 逻辑代码
Route::get('/admin',"Admin\IndexController@index");
// 管理员管理
Route::resource('/admin/admin',"Admin\AdminController");
// 管理员修改状态
route::post('/admin/admin/status',"Admin\AdminController@status");
/*
|--------------------------------------------------------------------------
| 会员管理
|--------------------------------------------------------------------------
*/
route::resource('/admin/users','Admin\UsersController');
route::post('/admin/users/status',"Admin\UsersController@status");
route::post('/admin/users/search',"Admin\UsersController@search");
/*
|--------------------------------------------------------------------------
| 分类管理
|--------------------------------------------------------------------------
*/
// 后台模态框
Route::get('/admin/types/model/addtypes',function(){
	return view('/admin/types/model/addtypes');
});
Route::get('/admin/types/model/updatetypes',function(){
	return view('/admin/types/model/updatetypes');
});
route::resource('/admin/types','Admin\TypesController');


