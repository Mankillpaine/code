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

$app->get('/', 'PcController@toubu');

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


$app->get('income','WechatController@income');
$app->get('income/platform/{platform}','WechatController@getFoname');
$app->get('detail/num/{num}','WechatController@Searchdetail');
$app->get('attention/num/{num}','WechatController@Attention');
$app->get('incomelist','WechatController@incomelist');

$app->post('attention','WechatController@AttentionPost');

$app->get('list','WechatController@fanslist');


$app->get('fans','WechatController@fans');
$app->get('mencache','WechatController@mencache');
$app->get('fans/platform/{platform}','WechatController@getFans');

$app->get('state','UserController@helper');
$app->get('test','UserController@test');



//主播小秘书页面
$app->get('zhubo','UserController@Zhubocount');
$app->get('getfans','UserController@Getfans');
$app->get('getgp','UserController@Getgp');
$app->get('livezhubo','UserController@livezhubo');

//主播首页
$app->get('zbindex','UserController@zbindex') ;

//粉丝排行
$app->get('zbfans','UserController@zbfans');
//收入排行
$app->get('srph','UserController@zhincome');

//注册
$app->get('reg','LoginController@register');
$app->post('reg','LoginController@register');
$app->get('sendRegcode','LoginController@sendRegcode');


/*登陆 */

$app->post('login','LoginController@login');
$app->get('login','LoginController@login');


/*主播信息页 */
$app->post('info','UserController@updateinfo');
//$app->get('info/userid/{userid}','UserController@info');
$app->get('info','UserController@info');
$app->get('cityname','UserController@cityarea');

//$app->get('register','UserController@register') ;

/*检测主播个人信息*/
$app->get('checkplat','UserController@checkplat');

//检测主播是否验证
$app->get('check','UserController@check');

//退出登录
$app->get('logout','LoginController@logout');

//一直播礼物信息
$app->get('yzbgift','UserController@yzbgitft');

//主播分享
$app->get('share/id/{id}','UserController@share');
$app->post('saveLiveData','UserController@saveLiveData');
$app->get('saveLiveData','UserController@saveLiveData');

$app->get('saveData','UserController@saveData');

//城市在线榜单
$app->get('bd','UserController@bd');
$app->get('t','UserController@t');


$app->group(['namespace' => 'App\api'], function() use ($app) {
    // 控制器在「App\Http\Controllers\Admin\User」命名空间
    //api     getDateilydata
    $app->get("api/getSumData",'ApiController@getSumData');
 $app->get('api/getPlatformData','ApiController@getPlatformData');
    $app->get('api/getStarsFromGuild','ApiController@getStarsFromGuild');
    $app->get('api/getDailyData','ApiController@getDailyData');


});

//首页
$app->get('toubu','PcController@toubu');
//文章详情页
$app->get('articl_detail','PcController@articl_detail');
//文章分页
$app->get('get_page_list','PcController@get_page_list');
//多级菜单
$app->get('searchStar','PcController@searchStar');
//首页banner图
$app->get('getBanner','PcController@getBanner');
//观察banner图
$app->get('viewbanner','PcController@viewbanner');
//主播详情页
$app->get('zbdetail','PcController@zbdetail');
//文章搜索
$app->get('searchArticle','PcController@searchArticle');
//文章搜索接口
$app->get('searchArticles','PcController@searchArticles');
//收入榜
$app->get('allincome','PcController@allincome');
//粉丝榜
$app->get('dayfans','PcController@dayfans');
//主播指数
$app->get('mba','PcController@mba');
///娱乐主播活跃指数
$app->get('dayhot','PcController@dayhot');
//$app->get('sumlist','PcController@sumlist');

//观察
$app->get('observe','PcController@observe');
$app->get('server','PcController@server');

//主播综合指数总榜
$app->get('rmball','PcController@rmball');
//行业指数榜
$app->get('hymba','PcController@hymba');
$app->get('industryrmb','PcController@industryrmb');

//行业指数接口
$app->get('platmba','PcController@platmba');
//平台活跃指数接口
$app->get('plathymba','PcController@plathymba');

//平台指数榜
$app->get('terracermb','PcController@terracermb');
//热门主播列表
$app->get('authorlist','PcController@authorlist');
//城市列表及人数
$app->get('hostlist','PcController@hostlist');

//返回平台名字
$app->get('platname','PcController@platname');

// 主播收入统计
$app->get('zbincome','PcController@zbincome');
 // 主播粉丝统计
$app->get('zbfan','PcController@zbfan');



$app->get('check_lives','PcController@check_lives');
$app->get('everyplat','PcController@everyplat');




/*京东*/
$app->get('JDsocket','ExampleController@JDsocket');
$app->get('jddata','ExampleController@jddata');

$app->get('demo222','ExampleController@getCurrentAction');