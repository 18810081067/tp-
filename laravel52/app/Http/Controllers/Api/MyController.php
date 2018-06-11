<?php

namespace App\Http\Controllers\Api;  
use DB;  
//use App\Http\Requests\Request; 
//use App\Http\Request; 
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
header('content-type:text/html;charset=utf8');  

class MyController extends Controller 
{  
    
    public  function index(){  
       // return view('Index/wenjian');  
       return 111;
        $page=School::find(1);  
          
        return response()->json(['status'=>1,'msg'=>'查询成功！','data'=>$page->toArray()]);  
    } 


}