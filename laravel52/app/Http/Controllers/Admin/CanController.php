<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Symfony\Component\HttpFoundation\Session\Session;
use Illuminate\Support\Facades\Input;
use Redirect;
use App\Http\Controllers\Admin\Common;
header('content-type:text/html;charset=utf8');  

//class CanController extends Common
class CanController extends Controller
{  
    
/*
*@作者 郝龙祥 
*@内容 产品管理
*@参数 无 @any
*@时间 2018-6-7
*/  
	//品牌管理
    public  function ping(){  
        return view('admin/product-brand');  
    } 
    //分类管理
  	public  function fen(){  
        return view('admin/product-category');  
    } 
    //分类管添加
  	public  function fen_add(){  
        return view('admin/product-category-add');  
    } 
    //产品管理
    public  function chan(){  
        return view('admin/product-list');  
    } 
}