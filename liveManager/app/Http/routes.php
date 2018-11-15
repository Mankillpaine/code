<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/
$app->get('test','ExampleController@Apitest');
$app->get('toubuIndex','ExampleController@toubuIndex');

$app->get('/', 'RegisterController@index');
$app->get('star/topOnline','MangerController@topOnline');
$app->post('register','MangerController@Register1');//登陆

$app->post('login','RegisterController@Login');
//找回密码
$app->post('reset','RegisterController@Reset');
/*
 * 首页游览单页
 */
$app->get('company_sum/pageIndex','AdminController@pageIndex');

/*
 * 工会
 */
$app->post('companyDaily/income','AdminController@companyIncome');
$app->post('companyDaily/follower','AdminController@companyFollower');
$app->post('companyDaily/companyrmb','AdminController@companyrmb');

/*
 * 主播
 */
$app->post('company_sum/starDetail','AdminController@starDetail');//主播详情       //livehistrys
$app->post('company_sum/livehistrys','AdminController@livehistrys');

$app->post('starDaily/topOnline','AdminController@topOnline');
$app->post('starDaily/topFans','AdminController@topFans');
$app->post('company_sum/pageIndex','AdminController@pageIndex');
$app->post('starDaily/topIncome','AdminController@topIncome');
$app->post('starDaily/TopLivetime','AdminController@TopLivetime');
$app->post('company_sum/rateStar','AdminController@monthStarate');//月达标主播
$app->post('company_sum/unrateStar','AdminController@monthStarunrate');//月未达标主播
$app->post('company_sum/monthWork','AdminController@monthWork'); //月小组考勤
$app->post('company_sum/monthStarfans','AdminController@monthStarfans');
$app->post('company_sum/monthDetail','AdminController@monthDetail');
$app->post('company_sum/starManager','AdminController@starManager');
$app->post('starDaily/gourps','AdminController@gourps'); //日考勤主播
$app->post('starDaily/unrateStar','AdminController@unrateStar'); //日考勤主播
$app->post('starDaily/Starrate','AdminController@Starrate'); //日考勤主播
$app->post('starDaily/livehistry','AdminController@livehistry');
$app->post('starDaily/starLiveState','AdminController@starLiveState');  //主播考勤直播状态


/*
 * 平台
 */
 $app->post('company_sum/pageFllower_plat','AdminController@pageFllower_plat'); //平台增粉榜
$app->post('company_sum/pagePlatincome','AdminController@pagePlatincome');          //平台收入榜
$app->post('company_sum/pageFollower','AdminController@pageFollower');   //月增粉明細

/*
 * 小组
 */
$app->post('company_sum/groupIncome','AdminController@groupIncome');   //小组贡献榜
$app->post('company_sum/groupFollower','AdminController@groupFollower'); //小组粉丝榜

//单数
$app->post('company_sum/pageIncome','AdminController@pageIncome');//收入
$app->post('company_sum/pageFollowers','AdminController@pageFollowers');//粉丝
$app->post('company_sum/pageWork','AdminController@pageWork');//日考勤表单数
$app->post('company_sum/pagemonthWork','AdminController@pagemonthWork'); //月考勤单数
//主播管理
$app->post('stars/filter','AdminController@filter');
$app->post('stars/menu','AdminController@menu');
$app->post('company_sum/search','AdminController@search');
$app->post('company_sum/livelog','AdminController@MongoLiveLog');
$app->post('company_sum/liveUrl','AdminController@liveUrl');
/*
 * 工会设置
 */
$app->post('star/addagent','AdminController@addAgent');   //allStar
$app->post('star/allStar','AdminController@allStar');    //allStars

$app->post('star/allAgent','AdminController@allAgent');
$app->post('star/updateAgent','AdminController@updateAgent');
$app->post('star/deleteAgent','AdminController@deleteAgent');      //breakStar
$app->post('star/breakStar','AdminController@breakStar');
$app->post('star/allStars','AdminController@allStars');
$app->post('star/breakAgent','AdminController@breakAgent');   //
$app->post('star/searchAgent','AdminController@searchAgent');        //noneAgent
$app->post('star/noneAgent','AdminController@noneAgent');
$app->post('star/allLevel','AdminController@allLevel');    //
$app->post('star/editStar','AdminController@editStar');    //
$app->post('star/searchBreak','AdminController@searchBreak');
$app->post('star/noneStars','AdminController@noneStars');
$app->post('star/searchBreakagent','AdminController@searchBreakagent');
$app->post('star/addStar','AdminController@addStar'); //添加主播
$app->post('star/allPlatform','AdminController@allPlatform');
$app->post('star/addLevel','AdminController@addLevel');    //
$app->post('star/allLevelpage','AdminController@allLevelpage');
$app->post('star/deleteLevel','AdminController@deleteLevel');
$app->post('star/editLevel','AdminController@editLevel');

/*
 * 以下没有用！！！
 */

//$app->get('Manger','MangerController@Manger');//注册
//$app->get('excel/export','ExcelController@export');
$app->get('ee','ExampleController@MongoLiveLog');
$app->get('api','ExampleController@apiWord');
//
//$app->get('daylongStar','MangerController@daylongStar');
//
////$app->get('demo','BaseController@passAuthor');
//$app->get('t','AdminController@test');
//
////$app->get('register','RegisterController@Register');//登陆
////$app->post('register','RegisterController@Login');//登陆
////登录
////$app->get('login','RegisterController@Login');
//$app->get('reset','RegisterController@Reset');
////批量导入主播
//$app->post('setexcel','AdminController@Setexcel');
////$app->get('update','RegisterController@updateBat');
//$app->get('Excel','AdminController@Excel');


$app->post('star/daylist','StarassistantController@daylist');
$app->post('star/listmenu','StarassistantController@daylistmenu');
$app->post('star/rmball','StarassistantController@rmball');       //platmba
$app->post('star/platmba','StarassistantController@platmba');  //平台指数
$app->post('star/plathymba','StarassistantController@plathymba'); //平台活跃指数
$app->post('star/city','StarassistantController@city');  //城市菜单
$app->post('star/province','StarassistantController@province');  //城市菜单
$app->post('star/searchStar','StarassistantController@searchStar');
$app->post('star/stardetail','StarassistantController@stardetail');     //主播详情页
$app->post('star/zbincome','StarassistantController@zbincome');       //主播收入榜
$app->post('star/zbfan','StarassistantController@zbfan');              //主播粉丝榜

