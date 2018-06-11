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

class Shangjia extends Common
//class Shangjia extends Controller
{  
    
/*
*@作者 郝龙祥 
*@内容 产品管理
*@参数 无 @any
*@时间 2018-6-8 00:00 
*/  
	
    //商家管理
  	public  function shangjia_add(){  
        $data = DB::table('ding_city')->get();  
         $ak = $this->tuo($data);
              $quan=$this->di($ak);
         //       echo "<pre>";
         // print_r($quan);die;
        return view('admin/shangjia/add',['arr'=>$quan]);  
    } 
        //商家管理
    public  function shangjia(Request $request){ 
        if($request->isMethod('post')){ //ajax接值
        $data = Input::all();
        $data = [
            'sname' => $data['sname'],
            'cid' => $data['cid'],
            'sphone' => $data['sphone'],
            'stime' =>date('Y-m-d H:i:s',time()+3600*8),
            'static' => $data['static']
        ];
        // echo "<pre>";
        // print_r($data);die;
         $re = DB::table('ding_shang')->insert($data); 
          if($re){  
                return redirect('shangjia');  
            }  
        }else{
            $data = DB::table('ding_shang')->get(); 
            $data = $this->tuo($data);
            return view('admin/shangjia/product-brand',['arr'=>$data]);  
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
   
}