<?php

namespace App\Http\Controllers;  
use DB;  
//use App\Http\Requests\Request; 
//use App\Http\Request; 
//use llluminate\suport\Facades\Input;
use Illuminate\Http\Request;
//use App\Jobs\Job;  
use App\Http\Controllers;  
header('content-type:text/html;charset=utf8');  

class MyController extends Controller  
{  
    
    public  function index(){  
        return view('home/login');  
    }  
    //1.curd
    //添加  
    // public function add(){  
    //     $name = $_POST['name'];  
    //     $pwd = $_POST['password'];   
    //     //echo $name;echo $pwd;die;
    //    $re= DB::table('laravel')->insert(['name'=>$name,'password'=>$pwd]);

    //    if($re){  
    //         return redirect('show');  
    //    }  
    // }  
     

    //  //展示
    //  public function show(){
    //      //$data = DB::table('laravel')->paginate(3);
    //      $data = DB::table('laravel')->get();
    //      return view('home/show',['arr'=>$data]);
    //  }
   
    //   //删除     
    //   public function del(){
    //       $id = $_GET['id'];
    //       //echo $id;die;
    //       $data = DB::table('laravel')->where(['id'=>$id])->delete();
    //       if($data){
    //           return redirect('show');
    //       }else{
    //           echo '有问题，快修改一下！';
    //       }
    //   }

    //   //修改
    //    public function up(){
    //        $id = $_GET['id'];
    //        // var_dump($id);die;
    //        $arr = DB::table('laravel')->where(['id'=>$id])->get();
    //        //print_r($arr);die;
    //        return view('home/find',['arr'=>$arr[0]]);
    //    }

    
    //     public function upd(){
    //         $data = $_POST;
    //        // print_r($data);die;
    //         unset($data['_token']);
    //         $res = DB::table('laravel')->where(['id'=>$data['id']])->update($data);
    //         // var_dump($res);die;
    //         if($res){
    //             return redirect('show');
    //         }else{
    //             echo '修改失败，请重新修改';
    //         }
    //     }

    //2.
    //添加  
    public  function wenjian(){  
        return view('home/wenjian');  
    } 
    //文件上传成功
    public function doupload(){
       // $myfile = $_FILES['my'];
        $myfile=\Request::file('my');
        // $tmp=$myfile['tmp_name'];
        // $path="./uploads/".$myfile['name'];
        // $res=move_uploaded_file($tmp,$path);
        
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
                $path = $myfile -> move('./uploads',$newName);
               echo $path;die; 
               //move_uploaded_file($tmp,$path);
            }
       
        echo "<pre>";
       print_r($myfile);die;
          $uname="app/uploads";
           $a=move_uploaded_file($file,$uname);
           if($a){
            echo 11;
           }
    }
    public function add(){  
          // $queueId = $this->dispatch(new MyJob('key_'.str_random(4), str_random(10)));
          // dd($queueId);
          //die;
         $name=\Request::input('name');  
         $pass=md5(\Request::input('password'));
         $myfile=$_FILES['my'];
         //$myfile=\Input::file('my'); 
          //var_dump($myfile);die;
          $tmp_name = $myfile["tmp_name"];
          $path = "./uploads/".md5(time()+rand(1000,99999)).substr($myfile['name'],-4);
         // echo $path;die;
          move_uploaded_file($tmp_name,$path);
        // echo "<pre>"; 
        // print_r($myfile);die;
         // if($n_file->isValid()){
         //        //获取文件名称
         //        $clientName = $n_file -> getClientOriginalName();
         //        $realPath = $n_file -> getRealPath();
         //        //获取图片格式
         //        $entension = $n_file -> getClientOriginalExtension();
         //        //图片保存路径
         //        $mimeTye = $n_file -> getMimeType();
         //         $newName = md5(date('ymdhis').$clientName).".".$entension;  
         //        $path = $myfile -> move('./uploads',$newName);
             
         //    }
       
       $re= DB::table('laravel')->insert(['name'=>$name,'password'=>$pass,'img'=>$path]);  
       if($re){  
            return redirect('show');  
       }  
    }  
    //查询  
    public function show(){  
     $arr=DB::table('laravel')->get();  
        return view('home/show',['arr'=>$arr]);  
    }  
    //删除  
    public function del(){  
        $id=\Request::get('id');  
      $re=DB::table('laravel')->where(['id'=>$id])->delete();  
      if($re){  
          return redirect('show');  
      }  
    }  
    //修改  
    public function up(){  
        $id=\Request::get('id');  
        $arr=DB::table('laravel')->where(['id'=>$id])->first();  
        return view('home/find',['arr'=>$arr]);  
    }  
    public function upd(){  
        $id=\Request::input('id');  
        $name=\Request::input('name');  
        $password=\Request::input('password');  
        $arr=DB::table('laravel')->where(['id'=>$id])->update(['name'=>$name,'password'=>$password]);  
        if($arr){  
            return redirect('show');  
        }else{
            return redirect('show');
        }
    }  



}
