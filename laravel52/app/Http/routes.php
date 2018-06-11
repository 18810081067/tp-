<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//路由
// Route::get('/', function () {
//     return view('Index/login');
// });
//Route::get('/','Wen\MyController@index');

//后台首页
Route::any('admin_login','Admin\AdminController@index');//首页
Route::match(['get','post'],'login','Admin\AdminController@login');//登录
Route::any('quann','Admin\AdminController@quann');//权限

Route::any('welcome','Admin\AdminController@welcome');//修改  
//产品管理
Route::any('product-brand','Admin\CanController@ping'); //品牌管理
Route::any('product-category','Admin\CanController@fen');//分类管理
Route::any('product-category-add','Admin\CanController@fen_add');//分类添加 add
Route::any('product-list','Admin\CanController@chan'); //产品管理

//商家  用户  品牌  活动  城市  
Route::any('chengshi','Admin\Chengshi@chengshi'); //城市管理
Route::any('chengshi-add','Admin\Chengshi@chengshi_add'); //城市添加

Route::any('shangjia','Admin\Shangjia@shangjia'); //商家管理
Route::any('shangjiaadd','Admin\Shangjia@shangjia_add'); //商家添加

Route::any('yonghu','Admin\Yonghu@yonghu'); //用户管理
Route::any('yonghuadd','Admin\Yonghu@yonghu_add'); //用户添加
Route::any('ydaochu','Admin\Yonghu@daochu'); //用户添加

Route::any('pingpai','Admin\Pingpai@pingpai'); //品牌管理
Route::any('pingpaiadd','Admin\Pingpai@pingpai_add'); //品牌添加

//前台首页  每回走接口openssl RSC加密
Route::any('index','Home\Index@index');//首页
Route::any('ce','Home\Ce@index');//首页

Route::get('api','Api\MyController@index');
Route::any('upload','MyController@doupload');//添加 

Route::any('wenjian','MyController@wenjian');//修改  

Route::get('/','MyController@index');  
Route::post('add','MyController@add');//添加  
Route::any('show','MyController@show');//查询  
Route::any('del','MyController@del');//删除  
Route::any('up','MyController@up');//修改  
Route::any('upd','MyController@upd');//修改  

// Route::get('foo', function () {
//     return 'hello  word';
// });
