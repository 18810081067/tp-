<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Illuminate\Support\Facades\Input;
use Redirect;
use App\Http\Controllers\Admin\Common;
use DB;
header('content-type:text/html;charset=utf8');  

class Chengshi extends Common
//class Chengshi extends Controller
{  
    
/*
*@作者 郝龙祥 
*@内容 产品管理
*@参数 无 @any
*@时间 2018-6-8 00:00 
*/  
	//城市管理
    public  function chengshi(Request $request){ 
        if($request->isMethod('post')){ //ajax接值
        //echo 1;die;
        $data = Input::all();
        $data = [
            'cname' => $data['cname'],
            'cpid' => $data['cpid'],
            'ctime' =>date('Y-m-d H:i:s',time()+3600*8),
            'static' => $data['static']
        ];
        // echo "<pre>";
        // print_r($data);die;
         $re = DB::table('ding_city')->insert($data); 
          if($re){  
                return redirect('chengshi');  
            }  
        }else{
            $data = DB::table('ding_city')->get();  
            //$ar = $this->di($arr); //递归无限极
             foreach ($data as $key => $v) {
                $arr[] = json_encode($v);
              }
              foreach ($arr as $key => $v) {
                $ak[] = json_decode($v,true);
              }
              $quan=$this->di($ak);
            // echo "<pre>";
            // print_r($quan);die;
            return view('admin/chengshi/product-brand',['arr'=>$quan]);  
        }
        
    } 
    //无限极调用  思路   二维数组加字段f 父亲jParent_id与jId相符加1  这种好用 二维前台直接判断f
   public static function di(&$data,$path=0,$flog=1){
   // echo "<pre>";
   //    print_r($data);die;
      static $quan=array();
        foreach ($data as $v) {
          if($v['cpid']==$path){
            $v['f']=$flog;
            $quan[]=$v;
            self::di($data,$v['cid'],$flog+1);
          }
        }
        return $quan;
    }

    //无限极调用  思路   二维数组加字段f 多加条件son 父亲jParent_id与jId相符加1  通过son前台循环 麻烦每次循环
     public function erdi($data,$path=0,$flag=1){
         $quan=array();
          foreach ($data as $key => $v) {
            if($v['cpid']==$path){
              $v['f']=$flag;
              $quan[$key]=$v;
              $quan[$key]['son']=$this->erdi($data,$v['cid'],$flag+1);
            }
          }
        return $quan;
        }

     //城市添加
    public  function chengshi_add(){  
        $data=DB::table('ding_city')->get();  
        foreach ($data as $key => $v) {
                $arr[] = json_encode($v);
              }
              foreach ($arr as $key => $v) {
                $ak[] = json_decode($v,true);
              }
              $quan=$this->erdi($ak);
              // echo "<pre>";
              // print_r($quan);die;
        return view('admin/chengshi/add',['arr'=>$quan]);  
    } 
    //品牌管理
  	public  function pingpai(){  
        return view('admin/product-category-add');  
    } 
    //用户管理
    public  function yonghu(){  
        return view('admin/product-list');  
    } 
     //活动管理
    public  function huodong(){  
        return view('admin/product-list');  
    } 
}