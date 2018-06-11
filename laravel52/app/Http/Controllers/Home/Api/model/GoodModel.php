<?php 
namespace App\Http\Controllers\Home\Api\model;

use App\Http\Controllers\Home\Api\model\CommonModel;
 //redis
use DB;

class GoodModel extends CommonModel {
	var $table='laravel';
	var $priKey = 'id';
	var $defaultWhere = [
        'static' => 1
    ];
	
	function getlist(){
    DB::connection()->enableQueryLog(); // 开启查询日志
    //echo 1;die;
		return DB::table($this->table)->get();
    dd(DB::getQueryLog()); 
	}

}



