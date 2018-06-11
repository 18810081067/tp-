<?php 
namespace App\Http\Controllers\Home\Api\model;

use Illuminate\Database\Eloquent\Model;
use DB;

abstract class CommonModel extends Model {
	public static $services;

	// private function __construct($data = array()){
	// 	parent::__construct($data);
	// }

	private function __clone(){}

	public static function i(){
		//instanceof 判断一个对象是否是另一个类实例化结构
		
		if(!(self::$services instanceof static)){
			self::$services = new static();
		}
		return self::$services;
	}

}




 ?>