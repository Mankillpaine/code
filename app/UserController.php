<?php

namespace App\Http\Controllers;
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Common;
use DB;
use Laravel\Lumen\Routing\Controller as BaseController;

class UserController extends Controller
{


    public function __construct(){
        $this -> getNowUser();
    }


    public function helper(){

        $state = $this -> checkLogin();

        if($state == 0){
            //未登录
            return "<script>window.location.href='/app/login'";
        }elseif($state == 1){
            //登录未验证
            return "<script>window.location.href='/app/check'";
        }elseif($state == 2){
            //正常状态
            $this -> platformid;
            //当前主播id
                  $this -> userid;
            //当前主播昵称
                 $this -> nickname;
        }



//        echo  $this ->username;
        return view('user')->with('state',$state);

    }


    /*
     *直播小秘书首页
     */
    public function Zhubocount( )
    {
        $state = $this -> checkLogin();

        if($state == 0){
            //未登录
            return "<script>window.location.href='/app/login';</script>";
        }elseif($state == 1){
            //登录未验证
            return "<script>alert('请先验证您的主播身份'); window.location.href='/app/check';</script>";
        }elseif($state == 2) {
            //正常状态
            $userid = $this->platformid;

            $url = "http://service.inke.com/api/live/now_publish?imsi=&uid=&proto=5&idfa=CC528020-8D86-4291-927E-FA712C636768&lc=0000000000000026&cc=TG0001&imei=&sid=20G45xJ7rO0qv38i1si1mxjsrj7svmbvypG23QXrfOEYLvGnmi0Mi3&cv=IK3.1.00_Iphone&devi=8c7b856e2895f4548c3c4083a3c6e1093e19109d&conn=Wifi&ua=iPhone&idfv=E2367328-B69B-4C6D-B12B-9CF7B49207E5&osversion=ios_9.300000&id=" . $userid . "&multiaddr=1";
            $re = Common::http_get($url);
            $json = json_decode($re);
            $follower = 'http://service.inke.com/api/user/relation/numrelations?imsi=&uid=121128781&proto=6&idfa=CC891948-3217-4F43-AE08-78374B32C37B&lc=0000000000000028&cc=TG0001&imei=&sid=20qTtiRQDJq4HD1i0BNXb8kH8zGVmxIo1nFMCGcLGGofaWi0A9i2Q9&cv=IK3.2.01_Iphone&devi=de3d60fd884e0400e9878733be9d1f22cfdb8025&conn=Wifi&ua=iPhone&idfv=0C4C9115-4964-47EF-8F10-29F259CA3FE6&osversion=ios_9.300000&id=' . $userid;
            $num_followers = file_get_contents($follower); //粉丝数
            if (isset($json->live)) {
                $id = $json->live->id;
                return view('zhibo')->with('id', $id)->with('userid', $userid)->with('num_followers', $num_followers);

            }
            return view('reset')->with('userid', $userid);
        }
    }




    /*
* 获取主播粉丝数
*/
    public function Getfans()
    {

        $state = $this->checkLogin();

        if ($state == 0) {
            //未登录
            return "<script>window.location.href='/app/login'";
        } elseif ($state == 1) {
            //登录未验证
            return "<script>window.location.href='/app/check'";
        } elseif ($state == 2) {
            //正常状态
            $userid = $this->platformid;

            $follower = 'http://service.inke.com/api/user/relation/numrelations?imsi=&uid=121128781&proto=6&idfa=CC891948-3217-4F43-AE08-78374B32C37B&lc=0000000000000028&cc=TG0001&imei=&sid=20qTtiRQDJq4HD1i0BNXb8kH8zGVmxIo1nFMCGcLGGofaWi0A9i2Q9&cv=IK3.2.01_Iphone&devi=de3d60fd884e0400e9878733be9d1f22cfdb8025&conn=Wifi&ua=iPhone&idfv=0C4C9115-4964-47EF-8F10-29F259CA3FE6&osversion=ios_9.300000&id=' . $userid;
            $num_followers = file_get_contents($follower); //粉丝数

            return $num_followers;
//            return view('spend')->with('num_followers',$num_followers);

        }
    }


    /*
     * 获取主播贡献的前两百名
     */
    public function Getgp(){
        $state = $this -> checkLogin();

        if($state == 0){
            //未登录
            return "<script>window.location.href='/app/login'";
        }elseif($state == 1){
            //登录未验证
            return "<script>window.location.href='/app/check'";
        }elseif($state == 2) {
            //正常状态
            $userid = $this->platformid;

            $rank = 'http://service.ingkee.com/api/statistic/contribution?imsi=&uid=121128781&proto=5&idfa=CC528020-8D86-4291-927E-FA712C636768&lc=0000000000000026&cc=TG0001&imei=&sid=20Gi2Q71fr9Lw8ZJpLDssNPnuwvi1eUQxs1Lp7wlmJW4ksZwi1Vci3&cv=IK3.1.00_Iphone&devi=8c7b856e2895f4548c3c4083a3c6e1093e19109d&conn=Wifi&ua=iPhone&idfv=E2367328-B69B-4C6D-B12B-9CF7B49207E5&osversion=ios_9.300000&count=200&id=' . $userid . '&start=0';
            $gxs = file_get_contents($rank);
            return $gxs;
        }
    }

    /*
     * 主播首页
     */


    public function zbindex(){

        $state = $this -> checkLogin();
        
        if($state == 0){
            //未登录
            return "<script>window.location.href='/app/login'</script>";
        }elseif($state > 0){
            //正常状态

            //当前主播id
         $userid    =  $this -> userid;
            
//            return view('zbindex');
            
            $result =  DB::select("select `avatar`,`nickname`,`platform` from `tool_users` where id=".$userid ." ");

            return view('zbindex')->with('result',$result);
        }



    }


    /*
     *主播收入统计
     */
    public function zhincome(){
        $state = $this -> checkLogin();

        if($state == 0){
            //未登录
            return "<script>window.location.href='/app/login';</script>";
        }elseif($state == 1){
            //登录未验证
            return "<script>alert('请先验证您的主播身份'); window.location.href='/app/check';</script>";
        }elseif($state == 2) {
            //正常状态
            $userid = $this->platformid;
            $result = DB::select("SELECT `increase` ,`income`,`increase_rmb`,`idate`  FROM income_log where `platform` = 1 and `platformid` = " . $userid . " and idate > CURRENT_DATE() - 14 order by idate desc  ");
            if ($result) {
                return view('zhincome')->with('zbincome', $result);
            } else {
                return view('zhincome');
            }
        }
    }


    /*
     * 主播粉丝统计
     */

    public function zbfans(){
        $state = $this -> checkLogin();

        if($state == 0){
            //未登录
            return "<script>window.location.href='/app/login';</script>";
        }elseif($state == 1){
            //登录未验证
            return "<script>alert('请先验证您的主播身份'); window.location.href='/app/check';</script>";
        }elseif($state == 2) {
            //正常状态
            $userid = $this->platformid;

            $result = DB::select("SELECT `increase_follower` ,`follower`,`idate`  FROM income_log where `platform` = 1 and `platformid` = " . $userid . " and idate > CURRENT_DATE() - 14 order by idate desc");

            if ($result) {
                return view('zbfans')->with('zbfans', $result);
            }else{
                return view('zbfans');
            }
        }
    }


    /*
     * 主播信息       $_COOKIE["userid"]
     */
    public function info(){
		
        $state = $this -> checkLogin();

        if($state == 0){
            //未登录
            return "<script>window.location.href='/app/login';</script>";
        }
            //正常状态
            $userid = $this->platformid;

            $id = $_COOKIE["userid"];
            $fo = DB::select("SELECT  `platformid`  FROM `tool_users`  WHERE `id`= " . $id . "");

            if (!$fo[0]->platformid) {

                $result = DB::select("SELECT  `nickname` ,`gender` ,`birthday` , `avatar`, `cityname` FROM `users`  WHERE `platformid`= " . $userid . " and  `platform` =1");

            } else {

                $result = DB::select("select `nickname` ,`gender` , `borndate` as `birthday` ,`cityid`, `avatar`, `provinceid` as `cityname` from `tool_users` WHERE   `id`= " . $id . "");
            }

            $city_parent = DB::select("SELECT `id` , `province`  FROM `city_mini` WHERE `parent` =0 and id!=1");

            return view("zhinfo")->with('result', $result)->with('city_parent', $city_parent)->with('userid', $userid)->with('platformid', 1);
//			}


    }

    /*
     * 更新主播信息
     */
    public function updateinfo(Request $request){
        $state = $this -> checkLogin();

        if($state == 0){
            //未登录
            return "<script>window.location.href='/app/login'";
        }
            //正常状态

            $id = $_COOKIE["userid"];
            $avatar = $request->input('avatar');
            $nickname = $request->input('nickname');
            $gender = $request->input('gender');
            $birthday = $request->input('date');
            $cityname = $request->input('cityname');
            $city = $request->input('city');
            $userid = $request->input('userid');

            $re = DB::update("update `tool_users` set `avatar` ='" . $avatar . "',`nickname` = '" . $nickname . " ',`gender` = '" . $gender . "',`borndate` = '" . $birthday . "',`provinceid` ='" . $cityname . "',`cityid` ='" . $city . "',`platformid` = '" . $userid . "', `platform`=1 where id='" . $id . "' ");
            if ($re) {
                return "<script>window.location.href='/app/zbindex'</script>";
            }

    }

    /*
   * 个人信息
   */
    public function check(){
        $state = $this -> checkLogin();

        if($state == 0){
            //未登录
            return "<script>window.location.href='/app/login'</script>";
        }else  {
          //  $userid = $this->platformid;
            return view('checkplat');

        };
    }









    /*
     * 检测平台id
     */
    public function checkplat(){
        $state = $this -> checkLogin();
         $userid = $_GET['userid'];
        if($state == 0){
            //未登录
            return "<script>window.location.href='/app/login'</script>";
        }else {

                $rank = 'http://service.inke.com/api/user/search?imsi=&uid=&proto=5&idfa=CC528020-8D86-4291-927E-FA712C636768&lc=0000000000000026&cc=TG0001&imei=&sid=20C0VblbP5pbFi7Us7oyn8D4IFrjRHr3w49tzGCKi2ZYdulkDki3&cv=IK3.1.00_Iphone&devi=8c7b856e2895f4548c3c4083a3c6e1093e19109d&conn=Wifi&ua=iPhone&idfv=E2367328-B69B-4C6D-B12B-9CF7B49207E5&osversion=ios_9.300000&count=25&keyword=' . $userid;
                $gxs = file_get_contents($rank);
                echo $gxs;

            };
    }
    /*
* 显示城市区域
*/
    function cityarea(){
        $parentid  = $_GET['parentid'];
        $reulst  =  DB::select("SELECT  `id` , `city`   FROM `city_mini` WHERE `parent` =" .$parentid );
        if($reulst){
            echo(json_encode($reulst));
        }
    }















    /////////////////////////////////////////////////以下为身份验证基础类////////////////////////////////////////////////////


    //获取cookie中的用户信息，仅仅用来显示，需要配合checkLogin使用
    public function getNowUser(){

        if(isset($_COOKIE["nickname"])!=""){
            $this -> username = $_COOKIE["nickname"];
        }else{
            //没有取到用户信息
            $this -> username = "";
        }
        if(isset($_COOKIE["userid"])!=""){
            $this -> userid = $_COOKIE["userid"];
        }
        else{
            $this -> userid = "";
        }



    }


    //根据id和password从数据库判断身份是否有效
    public function checkLogin(){
        
        $re = 0;
        
        if(isset($_COOKIE["userid"]) && isset($_COOKIE["password"])){
            
            $userid = $_COOKIE["userid"];
            $password = $_COOKIE["password"];

            $result = DB::select("select * from tool_users where id=".$userid." and password='".$password."'");
            
            if(count($result) == 1){

                $this->getNowUser();

                if($result[0]->platformid != ""){
                    //如果已经验证平台id，返回2，为正式状态
                    
                    $this -> platform = $result[0]->platform;
                    $this -> platformid = $result[0]->platformid;
                    
                    $re = 2;
                }else{
                    //如果没有验证，返回1，为未验证状态
                    $re = 1;
                }
            }else{
                //返回0为身份无效，未登录状态
                $re = 0;
            }

        }else{

            $re = 0;

        }
        
        //echo "return : " . $re;
        
        return $re;

    }

}
