<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Illuminate\Support\Facades\Input;
use Redirect;
use App\Http\Controllers\Admin\AdminController;
use DB;
use Illuminate\Support\Facades\Redis; //redis
use Illuminate\Support\Facades\Cookie;
header('content-type:text/html;charset=utf8');  


class Common extends Controller
{  
/*
*@作者 郝龙祥 
*@内容 后台首页
*@参数 无 @any
*@时间 2018-6-8
*/  
	  public function __construct(){
      //$redis  =new Redis();
      //var_dump($redis);die;
       // Redis::set('kai',3);
       // echo Redis::get('kai');die;
          //统计网站的UV量
      $se = new Session; //session //操作多久重登
     $time =  date('Y-m-d H:i:s',time()+3600*8);
      if(empty(Cookie::get('admin_time'))){
          echo '<script>alert("时间已过期");location.href="admin_login";</script>';exit;
       }
     $ku = strtotime(Cookie::get('admin_time'))+60; //后台操作时间到1分钟  自动退出注销
     //$ku = strtotime(Cookie::get('admin_time'))+3600; //后台操作时间到1小时  自动退出注销
     $ku = date('Y-m-d H:i:s',$ku);
       if($time>$ku){
         $se->remove("admin_id");
         $se->remove("admin_name");
         Cookie::queue("admin_time", '');
          echo '<script>alert("时间已过期");location.href="admin_login";</script>';
          exit;
       }
    $user_IP =  $_SERVER["REMOTE_ADDR"];
    //echo $user_IP;die;
    //今天零点时间
    $today =  strtotime(date('Y-m-d'));
    //echo $today;die;
    setCookie('user_ip',$user_IP,$today+60*60*24);// $_COOKIE['user_ip']因为是变量找不到 使用bug
    if(empty($_COOKIE['user_ip'])){

      if(DB::table('ding_fang')->where('fdate',$today)->first()){
        DB::table('ding_fang')->where('fdate',$today)->increment('fuv');
      }else{
        DB::table('ding_fang')->insert(['fdate'=>$today,'fip'=>$user_IP,'fuv'=>1]);
      }
      
    }
    //统计网站的PV量
    if(DB::table('ding_fang')->where('fdate',$today)->first()){
      DB::table('ding_fang')->where('fdate',$today)->increment('fpv');
    }else{
      DB::table('ding_fang')->insert(['fdate'=>$today,'fip'=>$user_IP,'fpv'=>1]);
    }   
   // die;
	  	
	  	
        //parent::__construct();
        //判断用户是否登录	
		$session=$se->get('admin_name');

		if(empty($session)){
			echo '<script>alert("管理员未登录,请先登录");location.href="admin_login";</script>';
        }
        //echo 1;die;
         $id= $se->get("admin_id");//id
     // echo $id;die;
      //关系id子查询
      $data = Db::select("select DISTINCT app_jurisdiction.* from app_jurisdiction where jId in(select jId from app_role_jursdiction where roleId in(select roleId from app_admin_role where adminId='$id'))");       
      //$dat = $this->where($data)->get()->toArray();
      foreach ($data as $key => $v) {
      	$arr[] = json_encode($v);
      }
      foreach ($arr as $key => $v) {
      	$ak[] = json_decode($v,true);
      }
   
      $controller = explode('/',$_SERVER['REDIRECT_URL']);
		$controller = array_pop($controller);
        //$con = request()->route()->getAction();
        // Route::current();die;
       	// Route::currentRouteName();
       	// Route::currentRouteAction();
      //   echo "<pre>";
      // print_r($con);die;
		//$controller = substr($con['controller'],21);
		//echo $controller;die;
       	foreach ($ak as $key => $v) {
       		$ck[]=$v['jController'];
       	}
     	// echo "<pre>";
      //  	print_r($ck);
      //  	  die;       
        if(!in_array($controller,$ck)){
        	//echo 1;die;
        	//DB::connection()->enableQueryLog(); // 开启查询日志
          $res = DB::table('ding_yi')->where(['yname'=>$session])->get();//查询数据库
          // echo "<pre>";
          // print_r($res);die;
          $a = count($res);
          //echo $a;die;
          	//dd(DB::getQueryLog()); die;
          if($a>2){
   				 // $request->session()->forget('admin_name');
   				 // echo $request->session()->get('admin_name');die;
   				 $se->remove("admin_id");
				 $se->remove("admin_name");
				// echo $h;die;
				
					echo '<script>alert("您以异常操作3次,数据已记录注销");location.href="admin_login";</script>';exit;
				
					//return redirect('index');         		
          }
          @$ip = gethostbyname($_ENV['COMPUTERNAME']); //获取本机的局域网IP
        	$data = [
        		'yname' =>$session,
        		'ycontroller' =>$controller,
        		'ytime' =>date('Y-m-d H:i:s',time()+3600*8),
        		'static' =>1,
        		'sum' => 1,
        		'yxiang' =>'异常操作',
            'yip' => $ip
        	];
        	$re = DB::table('ding_yi')->insert($data);
        	echo '<script>alert("异常操作");</script>';
        	if($re){
        		 // echo '<script>alert("请先登录");history.go(-1)</script>';
           //  exit;
				echo '<script>alert("对不起，您没有此权限，请联系管理员！");history.back();</script>';
				//$this->error("对不起，您没有此权限，请联系管理员！11");
				die;
        	}
        }
     
    }  

}