<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Symfony\Component\HttpFoundation\Session\Session;
use Illuminate\Support\Facades\Input;
use Redirect;
use DB; //数据库
use App\Http\Controllers\Home\Api\controller\preg\GoodPreg; //接口
use App\Http\Controllers\Home\Api\controller\CommonController; //接口安全
use App\Http\Controllers\Home\Api\model\GoodModel; //单例model
use App\Libs\openssl\Crypt;
header('content-type:text/html;charset=utf8');  //转码utf8

class Index extends CommonController implements GoodPreg //继承几口 有个bug
//class Admin extends Controller //继承几口 
{  
/*
*@作者 郝龙祥 
*@内容 后台首页
*@参数 无 @any
*@时间 2018-6-7
*/  
	//后台首页
    public  function index(){ 
      echo 1;die;
    	 $a = new Crypt();
       var_dump($a);die;
    	// var_dump($a->setKey());die;
    	//echo 1;die;
  //   	 DB::connection()->enableQueryLog(); // 开启查询日志  
  //   	 DB::table('laravel')->get();
  //   	 $queries = DB::getQueryLog(); // 获取查询日志  
		// echo "<pre>";
		// print_r($queries); // 即可查看执行的sql，传入的参数等等  
		// die;
     $list = GoodModel::i()->getlist();
      
      echo "<pre>";
    	print_r($list);die; 
    // 	echo 1;die;
        return view('admin/index');  
    } 

 

   

}