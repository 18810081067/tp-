<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Symfony\Component\HttpFoundation\Session\Session;
use Illuminate\Support\Facades\Input;
use Redirect;
header('content-type:text/html;charset=utf8');  

class Ce extends Controller 
{  
/*
*@作者 郝龙祥 
*@内容 前台首页
*@参数 无 @any
*@时间 2018-6-7
*/  
	//前台首页
    public  function index(){  
        return view('home/index');  
    } 
   

}