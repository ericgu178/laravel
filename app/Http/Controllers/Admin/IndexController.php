<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use DB;
use App\Http\Controllers\Controller;
class IndexController extends HomeController
{
    public function index(){
    	return view('admin.admin.index');
    }
}
