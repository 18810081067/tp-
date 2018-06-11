<?php

namespace App\Http\Controllers\Home\Api\controller;

use App\Http\Controllers\Controller;
//use think\Request;
use Illuminate\Support\Facades\Input; //接值
use App\Libs\openssl\Crypt;
class CommonController extends Controller {   //控制器  所有CURD
    protected $param;
    const APP_KEY = 'ahsdfdksksvkfkvfdv';
    const ERROR_CODE = 1;
    const SUCCESS_CODE = 0;
    static $return =[
        'code' => 0,
        'data' =>[],
        'msg' =>'ok'
    ];
    const OUT_TIME=60;


    public function __construct() {  //初始化
      echo 2;die;
      //parent::_initialize();Input::get('old_pwd');
       define('NOW_TIME',Input::get('server.REQUEST_TIME'));
      //print_r(input('get.rsa'));die;
      $rsa = Input::get('rsa');

     $query = static::decrypt($rsa);
    // print_r($query);die;
     parse_str($query,$this->param);
     
      // print_r(static::getSign($param));
      // print_r(static::checkSign($param));die;
      //print_r($this->param);die;
      
     // if(static::checkSign($param)){
     //    //self::$return['error'] = self::ERROR_CODE;
     //    return static::errorkey('签名验证失败');
     // }
     //return static::successkey('签名成功');
     //先注释  回头开启
      ($this->param['res_time']>(NOW_TIME + self::OUT_TIME) && static::errorkey('请求超时'));
     (!static::checkSign($this->param) && static::errorkey('签名验证失败'));
      
      // if(!static::checkSign($this->param)){
      //   //echo '1<br>';die;
      //   print_r($this->param);die;
      //   return static::successkey($this->param);die;
      // }
      

    }  
    
    private static function decrypt($rsa){
         $crypt = new Crypt();
        // $crypt = new \openssl\Crypt();  //引入对象
      // print_r($crypt);die;
         $crypt->loadKey();
         return $crypt->privateDecrypt($rsa);
    }

     private static function checkSign($param){
         // print_r($param);die; 
         $sign = $param['sign'];
          //print_r($sign);die;
         unset($param['sign']);
        // print_r($sign);die;
         // echo 1;die;
        //print_r(static::getSign($param ));die;
        if($sign!=static::getSign($param)){
            return false;
        }
        return true;
    }

     private static function getSign($param){
        //去除数组空值
        foreach ($param as $key => $v) {
          if($v =='' ||is_null($v)){
                unset($param[$key]);
          }
        }
        ksort($param);
        foreach ($param as $ke => $val) {
            $arr[] = $ke.'='.$val;
        }
       // print_r($arr);die;
        $query = implode('&',$arr);

        //print_r($query);die;
        return md5($query . self::APP_KEY);
    }

    protected static function errorkey($msg){
        self::$return['code'] = self::ERROR_CODE;
        self::$return['msg'] = $msg;
        //self::json();
        return self::$return;
    }

    protected static function successkey($data, $msg='ok'){
      //print_r($data);die;
        self::$return['code'] = self::ERROR_CODE;
        self::$return['msg'] = $data;
        //self::json();
        return self::$return;
    }
    protected static function json(){
      exit(json_encode(self::$return));
    }

}
