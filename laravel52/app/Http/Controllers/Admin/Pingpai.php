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

class Pingpai extends Common
//class Pingpai extends Controller
{  
    
/*
*@作者 郝龙祥 
*@内容 产品管理
*@参数 无 @any
*@时间 2018-6-8 00:00 
*/  
	
    //品牌管理
  	public  function pingpai_add(){   
        $arr=DB::table('ding_shang')->get();  
        return view('admin/pingpai/add',['arr'=>$arr]);  
    } 
        //品牌管理
    public  function pingpai(Request $request){ 
        if($request->isMethod('post')){ //ajax接值
        $data = Input::all();
        $path = $this->img(\Request::file('pimg'));
       // echo $path;die;
        $data = [
            'pname' => $data['pname'],
            'pimg' => $path,
            'sid' => $data['sid'],
            'pxiang' => $data['pxiang'],
            'ptime' =>date('Y-m-d H:i:s',time()+3600*8),
            'static' => $data['static'],
        ];
        // echo "<pre>";
        // print_r($data);die;
         $re = DB::table('ding_ping')->insert($data); 
          if($re){  
                return redirect('pingpai');  
            }  
        }else{ 
            $ping = DB::table('ding_ping')->get(); 
            $ping = $this->tuo($ping);
            return view('admin/pingpai/product-brand',['arr'=>$ping]);  
        }
        
    } 
    private function img($myfile){
         if($myfile->isValid()){
                //获取文件名称
                $clientName = $myfile -> getClientOriginalName();

                $realPath = $myfile -> getRealPath();
                //获取图片格式
                //echo $realPath;die;
                $entension = $myfile -> getClientOriginalExtension();
                //图片保存路径
                $mimeTye = $myfile -> getClientMimeType();
                //echo $mimeTye;die;
                $newName = md5(date('ymdhis').$clientName).".".$entension;  
                $path = $myfile -> move('uploads',$newName);
                //$path = url($path);
               return $path;
            }else{
              echo "没有图片，请返回";
            }
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
   
}