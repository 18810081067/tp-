<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Illuminate\Support\Facades\Input;
use Redirect;
use App\Http\Controllers\Admin\Common;
use DB;
use Excel;
header('content-type:text/html;charset=utf8');  

class Yonghu extends Common
//class Yonghu extends Controller
{  
    
/*
*@作者 郝龙祥 
*@内容 产品管理
*@参数 无 @any
*@时间 2018-6-8 00:00 
*/  
	
    //商家管理
  	public  function yonghu_add(){   
        return view('admin/yonghu/add');  
    } 
        //商家管理
    public  function yonghu(Request $request){ 
        if($request->isMethod('post')){ //ajax接值
        $data = Input::all();
        $data = [
            'yuser' => $data['yname'],
            'ypwd' => $data['ypwd'],
            'yphone' => $data['yphone'],
            'ytime' =>date('Y-m-d H:i:s',time()+3600*8),
            'static' => $data['static'],
            'ytoken' => $this->getAuthToken(),
        ];
        // echo "<pre>";
        // print_r($data);die;
         $re = DB::table('ding_yong')->insert($data); 
          if($re){  
                return redirect('yonghu');  
            }  
        }else{
            $data = DB::table('ding_yong')->get(); 
           $data = $this->tuo($data);
            return view('admin/yonghu/product-brand',['arr'=>$data]);  
        }
        
    } 
     public function getAuthToken()//uniqid函数基于以微秒计的当前时间,生成一个唯一的 ID
    {
        return md5(uniqid().rand(1000,9999));
    }

    public function tuo($data){
      foreach ($data as $key => $v) {
                $arr[] = json_encode($v);
              }
              foreach ($arr as $key => $v) {
                $ak[] = json_decode($v,true);
              }
              return $ak;
    }

    public function daochu(){
      $data = DB::table('ding_yong')->get(); 
           $data = $this->tuo($data);
           // echo "<pre>";
           // print_r($data);die;
           $yong = [['用户账号','用户密码','用户手机号','注册时间','用户状态','用户唯一token']];
           foreach ($data as $key => $v) {
              $arr[] =[$v['yuser'],$v['ypwd'],$v['yphone'],$v['ytime'],$v['static'],$v['ytoken']];
           }
           $cellData= array_merge($yong,$arr);
            Excel::create('用户信息',function ($excel) 
              use ($cellData)
              {
                $excel->sheet('用户信息管理', function ($sheet) use ($cellData)
             {
                  $sheet->rows($cellData);
                });
            })->export('xls');die;

        }
   
}