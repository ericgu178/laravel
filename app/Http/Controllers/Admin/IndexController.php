<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Controllers\Controller;
class IndexController
{	
    public function index(){
    	$info = Session::get('info');
    	if(empty($info->username)){
    		return view('admin.login.login');
    	}
    	return view('admin.admin.index');
    }
}
