<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Session\Session;//session
use Illuminate\Support\Facades\Input;
use Redirect;
use DB;
use Illuminate\Support\Facades\Cookie;//cookie
header('content-type:text/html;charset=utf8');  

class AdminController extends Controller
{  
/*
*@作者 郝龙祥 
*@内容 后台首页
*@参数 无 @any
*@时间 2018-6-7
*/  
    //我的桌面
  	public  function welcome(){  
        return view('admin/welcome');  
    } 

    /*------------后台首页----------------*/ 
    public function index()
    {
    	 $session = new Session;
    	  // $session->set("admin_name",'张三');
    	  // $session->set("admin_id",1);
     //             $ss=$session->get("node_path");
     //             echo $ss;die;
      $admin_name=$session->get("admin_name");
     // echo $admin_name;die;
      if(!$admin_name){
      	//echo 1;die;
           //$this->success('未登录，管理员请先登录','admin/login');
           echo '<script>alert("管理员未登录,请先登录");location.href="login";</script>';
        }else{ 

           echo '<script>alert("您已登录，可以访问");location.href="quann";</script>';
             //$this->error("您已登录，可以访问",'admin/quann');
        }
        //return view('admin/index');  
    }

 /*------------郝龙祥后台登录----------------*/ 
    public function login(Request $request)
    {
 
        if($request->isMethod('post')){ //ajax接值
        //echo 1;die;
          $data=['adminName'=>Input::get('user'),'adminPwd'=>Input::get('pwd')];//名称密码
         // print_r($data);die;
          $us='/^1[357]\d{9}$/'; //用户  13,15,17开头 11位
         // if(preg_match($us,$data['username'])){
               $res = DB::table('app_admin')->where($data)->first();//查询数据库
          // }else{
          //   $res=['ok'=>300];
          // }
		   $res = json_decode(json_encode($res),true);	   
          // echo "<pre>";
          // print_r($res);die;
          $session = new Session;
    	 $session->set("admin_id",$res['adminId']);
    	 $session->set("admin_name",$res['adminName']);

          $date =['adminTime'=>date('Y-m-d H:i:s',time()+3600*8)];//登录时间

          $arr=DB::table('app_admin')->where(['adminId'=>$res['adminId']])->update($date);//修改管理员登录时间          
         // echo Db::table('app_admin')->getLastSql();die;
             Cookie::queue('admin_time',$date['adminTime']); 

          $this->jie($res);   //登录成功  $this  自身
        }else{
           return view('admin/login');
        }
    }  

  
/*
*@作者 郝龙祥 
*@内容 用户名称唯一性
*@参数 $username
*@时间 2018-4-28
*/
 
//加密函数
public function lock_url($txt,$key='www.jb51.net')
{
  $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789-=+";
  $nh = rand(0,64);
  $ch = $chars[$nh];
  $mdKey = md5($key.$ch);
  $mdKey = substr($mdKey,$nh%8, $nh%8+7);
  $txt = base64_encode($txt);
  $tmp = '';
  $i=0;$j=0;$k = 0;
  for ($i=0; $i<strlen($txt); $i++) {
    $k = $k == strlen($mdKey) ? 0 : $k;
    $j = ($nh+strpos($chars,$txt[$i])+ord($mdKey[$k++]))%64;
    $tmp .= $chars[$j];
  }
  return urlencode($ch.$tmp);
}
//解密函数
public function unlock_url($txt,$key='www.jb51.net')
{
  $txt = urldecode($txt);
  $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789-=+";
  $ch = $txt[0];
  $nh = strpos($chars,$ch);
  $mdKey = md5($key.$ch);
  $mdKey = substr($mdKey,$nh%8, $nh%8+7);
  $txt = substr($txt,1);
  $tmp = '';
  $i=0;$j=0; $k = 0;
  for ($i=0; $i<strlen($txt); $i++) {
    $k = $k == strlen($mdKey) ? 0 : $k;
    $j = strpos($chars,$txt[$i])-$nh - ord($mdKey[$k++]);
    while ($j<0) $j+=64;
    $tmp .= $chars[$j];
  }
  return base64_decode($tmp);
}
 /*------------郝龙祥接口封装----------------*/     
    public function jie($res){
          if(is_array($res)){
                $arr['ok']=100;
                $arr['coed']=0;
                $arr['dat']=$res;
                $arr['ms']="成功跳转";  //信息不能暴漏
              }else{
                $arr['ok']=200;
                $arr['coed']=10000011;
                $arr['dat']=array();
                $arr['ms']="服务器打盹"; //信息不能暴漏
              }
     echo json_encode($arr);
   }

/*------------郝龙祥权限展示----------------*/ 
     public function quan(){
		  $session = new Session;
    	  //$session->set("admin_id",1);
     //             $ss=
     //             echo $ss;die;
      $id= $session->get("admin_id");//id
      if(!$id){
      		echo '<script>location.href="admin_login";</script>';exit;
      }
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
      $quan=$this->digui($ak); // 调用递归
      // echo "<pre>";
      // print_r($quan);die;
      return $quan; //返回数据
    }
    //权限跳转
    public function quann(){
    	$session = new Session;
       $time =  date('Y-m-d H:i:s',time()+3600*8);
       //echo Cookie::get('admin_time');die;
       if(empty(Cookie::get('admin_time'))){
          echo '<script>alert("时间已过期");location.href="admin_login";</script>';exit;
       }
       $ku = strtotime(Cookie::get('admin_time'))+60;   //后台操作时间到1分钟  自动退出注销
       //$ku = strtotime(Cookie::get('admin_time'))+3600; //后台操作时间到1小时  自动退出注销
       $ku = date('Y-m-d H:i:s',$ku); 
       if($time>$ku){  //过期时间重登
         $session->set("admin_id",null);
         $session->set("admin_name",null);
         Cookie::queue("admin_time", '');
         echo '<script>alert("时间已过期");location.href="admin_login";</script>';
          exit;
       }
    	//echo 1;die;
       $quan = $this->quan();
      // echo "<pre>";
      // print_r($quan);die;
       $admin = $session->get('admin_name');
      // echo $admin;die;
       if(is_array($quan)){

            //return $this->fetch('admin/index',['quan'=>$quan,'admin'=>$admin]);
             return view('admin/index',['quan'=>$quan,'admin'=>$admin]);
      }else{
          return redirect('index');
      }
    }

//无限极调用  思路   二维数组加字段f 父亲jParent_id与jId相符加1  这种好用 二维前台直接判断f
   public static function digui(&$data,$path=0,$flog=1){
   // echo "<pre>";
   //    print_r($data);die;
      static $quan=array();
        foreach ($data as $v) {
          if($v['jParent_id']==$path){
            $v['f']=$flog;
            $quan[]=$v;
            self::digui($data,$v['jId'],$flog+1);
          }
        }
        return $quan;
    }

//无限极调用  思路   二维数组加字段f 多加条件son 父亲jParent_id与jId相符加1  通过son前台循环 麻烦每次循环
     public function erdigui($data,$path=0,$flag=1){
         $quan=array();
          foreach ($data as $key => $v) {
            if($v['jParent_id']==$path){
              $v['f']=$flag;
              $quan[$key]=$v;
              $quan[$key]['son']=$this->digui($data,$v['jId'],$flag+1);
            }
          }
        return $quan;
        }

 

}