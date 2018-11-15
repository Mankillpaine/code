<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Common;
use DB;
class CountController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function Zhubocount(Request $request,$userid  )
    {

        $url = "http://service.inke.com/api/live/now_publish?imsi=&uid=&proto=5&idfa=CC528020-8D86-4291-927E-FA712C636768&lc=0000000000000026&cc=TG0001&imei=&sid=20G45xJ7rO0qv38i1si1mxjsrj7svmbvypG23QXrfOEYLvGnmi0Mi3&cv=IK3.1.00_Iphone&devi=8c7b856e2895f4548c3c4083a3c6e1093e19109d&conn=Wifi&ua=iPhone&idfv=E2367328-B69B-4C6D-B12B-9CF7B49207E5&osversion=ios_9.300000&id=" . $userid . "&multiaddr=1";
        $re = Common::http_get($url);
        $json = json_decode($re);
        $follower ='http://service.inke.com/api/user/relation/numrelations?imsi=&uid=121128781&proto=6&idfa=CC891948-3217-4F43-AE08-78374B32C37B&lc=0000000000000028&cc=TG0001&imei=&sid=20qTtiRQDJq4HD1i0BNXb8kH8zGVmxIo1nFMCGcLGGofaWi0A9i2Q9&cv=IK3.2.01_Iphone&devi=de3d60fd884e0400e9878733be9d1f22cfdb8025&conn=Wifi&ua=iPhone&idfv=0C4C9115-4964-47EF-8F10-29F259CA3FE6&osversion=ios_9.300000&id='.$userid;
        $num_followers = file_get_contents($follower); //粉丝数
        if (isset($json->live)) {
            $id = $json->live->id;
            return view('zhibo')->with('id', $id)->with('userid', $userid)->with('num_followers',$num_followers);

        }
        return view('reset')->with('userid',$userid);
    }




        /*
 * 获取主播粉丝数
 */
        public function Getfans(){

            $userid = $_GET['userid'];

            $follower ='http://service.inke.com/api/user/relation/numrelations?imsi=&uid=121128781&proto=6&idfa=CC891948-3217-4F43-AE08-78374B32C37B&lc=0000000000000028&cc=TG0001&imei=&sid=20qTtiRQDJq4HD1i0BNXb8kH8zGVmxIo1nFMCGcLGGofaWi0A9i2Q9&cv=IK3.2.01_Iphone&devi=de3d60fd884e0400e9878733be9d1f22cfdb8025&conn=Wifi&ua=iPhone&idfv=0C4C9115-4964-47EF-8F10-29F259CA3FE6&osversion=ios_9.300000&id='.$userid;
            $num_followers = file_get_contents($follower); //粉丝数

            return $num_followers;
//            return view('spend')->with('num_followers',$num_followers);

        }


    /*
     * 获取主播贡献的前两百名
     */
     public function Getgp(){
         $userid = $_GET['userid'];
         $rank = 'http://service.ingkee.com/api/statistic/contribution?imsi=&uid=121128781&proto=5&idfa=CC528020-8D86-4291-927E-FA712C636768&lc=0000000000000026&cc=TG0001&imei=&sid=20Gi2Q71fr9Lw8ZJpLDssNPnuwvi1eUQxs1Lp7wlmJW4ksZwi1Vci3&cv=IK3.1.00_Iphone&devi=8c7b856e2895f4548c3c4083a3c6e1093e19109d&conn=Wifi&ua=iPhone&idfv=E2367328-B69B-4C6D-B12B-9CF7B49207E5&osversion=ios_9.300000&count=200&id='.$userid.'&start=0' ;
         $gxs  = file_get_contents($rank);
         return $gxs;
     }

    /*
     * 主播首页
     */


    public function zbindex(){
        return view('zbindex');
    }


    /*
     *主播收入统计
     */
   public function zhincome(Request $request,$userid){
      $result  = DB::select("SELECT `increase` ,`income`,`increase_rmb`,`idate`  FROM income_log where `platform` = 1 and `platformid` = " . $userid .  " and idate > CURRENT_DATE() - 14 order by idate desc  ");
        if($result){
            return view('zhincome')->with('zbincome',$result);
        }
   }


    /*
     * 主播粉丝统计
     */

    public function zbfans(Request $request,$userid){
        $result = DB::select("SELECT `increase_follower` ,`follower`,`idate`  FROM income_log where `platform` = 1 and `platformid` = " . $userid . " and idate > CURRENT_DATE() - 14 order by idate desc");
        if($result){
            return view('zbfans')->with('zbfans',$result);
        }
    }

//    主播注册

    public function register(){
        return view('zhregister');
    }
}