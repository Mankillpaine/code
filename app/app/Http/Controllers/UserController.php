<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Xxtea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Common;
use DB;
use Cache;
use Memcached;
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
            return "<script>if(confirm('您登录后可使用主播小秘书的全部功能，是否马上登录？')){window.location.href='/app/login';}else{history.go(-1);}</script>";
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

//   验证主播是否在直播
    public function livezhubo(){
        $state = $this -> checkLogin();

        if($state == 0){
            //未登录
            return "<script>window.location.href='/app/login';</script>";
        }elseif($state == 1){
            //登录未验证
            return "<script>alert('请先验证您的主播身份'); window.location.href='/app/check';</script>";
        }elseif($state == 2) {
            $userid = $_GET['userid'];
            if ($this->platform == 1) {
                $url = "http://service.inke.com/api/live/now_publish?imsi=&uid=&proto=5&idfa=CC528020-8D86-4291-927E-FA712C636768&lc=0000000000000026&cc=TG0001&imei=&sid=20G45xJ7rO0qv38i1si1mxjsrj7svmbvypG23QXrfOEYLvGnmi0Mi3&cv=IK3.1.00_Iphone&devi=8c7b856e2895f4548c3c4083a3c6e1093e19109d&conn=Wifi&ua=iPhone&idfv=E2367328-B69B-4C6D-B12B-9CF7B49207E5&osversion=ios_9.300000&id=" . $userid . "&multiaddr=1";
                $re = Common::http_get($url);
                $json = json_decode($re);
                if (isset($json->live)) {
                    $id = $json->live->id;
                    echo 1;
                }else{
                    echo 0;
                }
            }else if($this->platform ==7){
                $liveid =  Xxtea::getLiveId($userid);
                if($liveid !=""){
                    echo 1;
                }else {
                    echo 0;
                }
            }else if($this->platform ==3){
                $rand = rand(100000000,9999999999);
                $time = time();
                $line = "deviceid=3ccc323a0a7828d54b54af7d7d4a8475netspeed=0network=Wi-Fiplatform=iosrand=".$rand."time=".$time."userid=52611531version=3.8.0eac63e66d8c4a6f0303f00bc76d0217c";
                $guid = MD5($line);
                $url =  "http://live.huajiao.com/feed/getUserFeeds?deviceid=3ccc323a0a7828d54b54af7d7d4a8475&netspeed=0&network=Wi-Fi&platform=ios&rand=".$rand."&time=".$time."&userid=52611531&version=3.8.0&guid=".$guid."&model=iPhone6,1&channel=Apple&clientip=&dui=3ccc323a0a7828d54b54af7d7d4a8475&num=40&privacy=Y&uid=".$userid;
                $gxs = Common::http_get($url);

                $info  = json_decode($gxs);

                if($info->data->feeds[0]->type =='1'){
                   echo 1;
                } else{
                    echo 0;
                }
            }
        }
    }





    /*
     *直播小秘书首页
     */
    public function Zhubocount( )
    {
        $state = $this -> checkLogin();

        if($state == 0){
            //未登录
            return "<script>if(confirm('您登录后可使用主播小秘书的全部功能，是否马上登录？')){window.location.href='/app/login';}else{history.go(-1);}</script>";
        }elseif($state == 1){
            //登录未验证
            return "<script>alert('请先验证您的主播身份'); window.location.href='/app/check';</script>";
        }elseif($state == 2) {
            //正常状态
            $userid = $this->platformid;
            if($this->platform ==1) {
                $url = "http://service.inke.com/api/live/now_publish?imsi=&uid=&proto=5&idfa=CC528020-8D86-4291-927E-FA712C636768&lc=0000000000000026&cc=TG0001&imei=&sid=20G45xJ7rO0qv38i1si1mxjsrj7svmbvypG23QXrfOEYLvGnmi0Mi3&cv=IK3.1.00_Iphone&devi=8c7b856e2895f4548c3c4083a3c6e1093e19109d&conn=Wifi&ua=iPhone&idfv=E2367328-B69B-4C6D-B12B-9CF7B49207E5&osversion=ios_9.300000&id=" . $userid . "&multiaddr=1";
                $re = Common::http_get($url);
                $json = json_decode($re);

                $follower = 'http://service.inke.com/api/user/relation/numrelations?imsi=&uid=121128781&proto=6&idfa=CC891948-3217-4F43-AE08-78374B32C37B&lc=0000000000000028&cc=TG0001&imei=&sid=20qTtiRQDJq4HD1i0BNXb8kH8zGVmxIo1nFMCGcLGGofaWi0A9i2Q9&cv=IK3.2.01_Iphone&devi=de3d60fd884e0400e9878733be9d1f22cfdb8025&conn=Wifi&ua=iPhone&idfv=0C4C9115-4964-47EF-8F10-29F259CA3FE6&osversion=ios_9.300000&id=' . $userid;
                $num_followers = file_get_contents($follower); //粉丝数
                if (isset($json->live)) {
                    $id = $json->live->id;
                    $GLOBALS['city'] = $json->live->city;
                    return view('zhibo')->with('id', $id)->with('userid', $userid)->with('num_followers', $num_followers)->with('platformid',$this->platform)->with('live',$id);

                }
            }else if($this->platform ==7){
			  if($userid === "1234qwe"){
				  echo "1";
			  	$liveid = "l6taXhBtMKJ9Z9-B";
				$fanslist = array();
			  }else{
				 echo "2";
				$fanslist = Xxtea::getMembers($userid);
              	$liveid =  Xxtea::getLiveId($userid);
			  }
                if($liveid !=""){
                    return view('zhibo')->with('fanslist', $fanslist)->with('userid', $userid)->with('platformid',$this->platform)->with('live',$liveid)->with('fanslist',$fanslist);
                }else{
                    return view('reset')->with('userid', $userid);
                }
            }else if($this->platform ==3){
                $rand = rand(10000000,9999999);
                $time = time();
                $line = "deviceid=3ccc323a0a7828d54b54af7d7d4a8475netspeed=0network=Wi-Fiplatform=iosrand=".$rand."time=".$time."userid=52611531version=3.8.0eac63e66d8c4a6f0303f00bc76d0217c";
                $guid = MD5($line);
                $url =  "http://live.huajiao.com/feed/getUserFeeds?deviceid=3ccc323a0a7828d54b54af7d7d4a8475&netspeed=0&network=Wi-Fi&platform=ios&rand=".$rand."&time=".$time."&userid=52611531&version=3.8.0&guid=".$guid."&model=iPhone6,1&channel=Apple&clientip=&dui=3ccc323a0a7828d54b54af7d7d4a8475&num=40&privacy=Y&uid=".$userid;
                $gxs = Common::http_get($url);
                $info  = json_decode($gxs);

                if($info->data->feeds[0]->type==1){
                    $liveid =  $info->data->feeds[0]->feed->relateid;
                    $cityname = $info->data->feeds[0]->feed->location;//城市名
                    return view('zhibo')->with('userid', $userid)->with('platformid',$this->platform)->with('live',$liveid);
                }else{
                    return view('reset')->with('userid', $userid);
                }


            }

            return view('reset')->with('userid', $userid);
           // return view('zhibo');
        }

    }

    /*
     * 主播是否在榜单里面
     */





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
            if($this->platform ==1)  {

            $rank = 'http://service.ingkee.com/api/statistic/contribution?imsi=&uid=121128781&proto=5&idfa=CC528020-8D86-4291-927E-FA712C636768&lc=0000000000000026&cc=TG0001&imei=&sid=20Gi2Q71fr9Lw8ZJpLDssNPnuwvi1eUQxs1Lp7wlmJW4ksZwi1Vci3&cv=IK3.1.00_Iphone&devi=8c7b856e2895f4548c3c4083a3c6e1093e19109d&conn=Wifi&ua=iPhone&idfv=E2367328-B69B-4C6D-B12B-9CF7B49207E5&osversion=ios_9.300000&count=200&id=' . $userid . '&start=0';
            $gxs = file_get_contents($rank);
            return $gxs;
            }else if($this->platform ==7){
                $fanslist     =   Xxtea::getMembers($userid);
                return $fanslist;
            }else if($this->platfom ==3){
                $num = rand(100000000,9999999999);
               $rank = "http://webh.huajiao.com/live/rankList?fmt=json&uid=".$userid."&name=fans&_=".$num;
                $gxs = Common::http_get($rank);
                return $gxs;
            }
        }
    }

    /*
     * 主播首页
     */


    public function zbindex(){

        $state = $this -> checkLogin();

        if($state == 0){
            //未登录
            /*return "<script>window.location.href='/app/login'</script>";*/

			$result = Array();

			$data =  new \stdClass();
			$data -> avatar = "";
			$data -> nickname = "未登录主播";
			$data -> platform = 0;

			array_push($result,$data);
			
			return view('zbindex')->with('result',$result) -> with('state',$state);
			
        }elseif($state > 0){
            //正常状态

            //当前主播id
         $userid    =  $this -> userid;
            
//            return view('zbindex');
            
            $result =  DB::select("select `avatar`,`nickname`,`platform` from `tool_users` where id=".$userid ." ");

            return view('zbindex')->with('result',$result) -> with('state',$state);
        }

		

    }


    /*
     *主播收入统计
     */
    public function zhincome(){
        $state = $this -> checkLogin();

        if($state == 0){
            //未登录
            return "<script>if(confirm('您登录后可使用主播小秘书的全部功能，是否马上登录？')){window.location.href='/app/login';}else{history.go(-1);}</script>";
        }elseif($state == 1){
            //登录未验证
            return "<script>alert('请先验证您的主播身份'); window.location.href='/app/check';</script>";
        }elseif($state == 2) {
            //正常状态
            $userid = $this->platformid;
            $result = DB::select("SELECT `increase` ,`income`,`increase_rmb`,`idate`  FROM income_log where `platform` = ".$userid = $this->platform." and `platformid` = " . $userid . " and idate > date_sub(CURRENT_DATE(), interval 14 day) order by idate desc  ");
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
            return "<script>if(confirm('您登录后可使用主播小秘书的全部功能，是否马上登录？')){window.location.href='/app/login';}else{history.go(-1);}</script>";
        }elseif($state == 1){
            //登录未验证
            return "<script>alert('请先验证您的主播身份'); window.location.href='/app/check';</script>";
        }elseif($state == 2) {
            //正常状态
            $userid = $this->platformid;

            $result = DB::select("SELECT `increase_follower` ,`follower`,`idate`  FROM income_log where `platform` = ".$userid = $this->platform." and `platformid` = " . $userid . " and idate > date_sub(CURRENT_DATE(), interval 14 day) order by idate desc");

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

    public function info(Request $request){

        $state = $this -> checkLogin();
        if($state == 0){
            //未登录
            return "<script>window.location.href='/app/login'";
        }else if($state ==1 && !isset($_GET['userid']) ){
            return "<script>alert('请先验证您的主播身份'); window.location.href='/app/check';</script>";
        }

        if(isset($_GET['platid'])){
            $platid = $_GET['platid'];
        }else {
            $platid= $this->platform;
        }

           if(isset($_GET['userid'])){
             $userid = $_GET['userid'];

           }
           else{
               $userid = $this->platformid;
           }
        if(isset($_GET['userid']) && isset($_GET['platid'])){

            //验证成功，尝试在users中写入数据，避免用户在主表不存在
            $sql = "insert ignore into users(platform,platformid) values(".$platid.",".$userid.");";
            DB::insert($sql);

        }
            //正常状态

            $id = $_COOKIE["userid"];
             $city_parent = DB::select("SELECT `id` , `province`  FROM `city_mini` WHERE `parent` =0 and id!=1");

            $fo = DB::select("SELECT  `platformid`  FROM `tool_users`  WHERE `id`= '" . $id . "'");
            if (!$fo[0]->platformid) {
                if($platid ==1) {
                    $result = 'http://service.inke.com/api/user/search?imsi=&uid=&proto=5&idfa=CC528020-8D86-4291-927E-FA712C636768&lc=0000000000000026&cc=TG0001&imei=&sid=20C0VblbP5pbFi7Us7oyn8D4IFrjRHr3w49tzGCKi2ZYdulkDki3&cv=IK3.1.00_Iphone&devi=8c7b856e2895f4548c3c4083a3c6e1093e19109d&conn=Wifi&ua=iPhone&idfv=E2367328-B69B-4C6D-B12B-9CF7B49207E5&osversion=ios_9.300000&count=25&keyword=' . $userid;
                    $gxs =  file_get_contents($result);
                }else if($platid ==7){
                    //一直播验证
                     $gxs   = Xxtea::getUserInfo($userid);
                    //cho $gxs;                         
                    //echo 11;
                } if($platid ==3){
                    $rand = rand(100000000,9999999999);
                    $time = time();
                    $line = "deviceid=3ccc323a0a7828d54b54af7d7d4a8475netspeed=0network=Wi-Fiplatform=iosrand=".$rand."time=".$time."userid=52611531version=3.8.0eac63e66d8c4a6f0303f00bc76d0217c";
                    $guid = MD5($line);
                    $url =  "http://live.huajiao.com/feed/getUserFeeds?deviceid=3ccc323a0a7828d54b54af7d7d4a8475&netspeed=0&network=Wi-Fi&platform=ios&rand=".$rand."&time=".$time."&userid=52611531&version=3.8.0&guid=".$guid."&model=iPhone6,1&channel=Apple&clientip=&dui=3ccc323a0a7828d54b54af7d7d4a8475&num=40&privacy=Y&uid=".$userid;
                    $gxs = file_get_contents($url);


                    $result  = '' ;
                }
               //echo $gxs;
                return view("zhinfo")->with('gxs',$gxs)->with('city_parent', $city_parent)->with('userid', $userid)->with('platformid', $platid);



//                $result = DB::select("SELECT  `nickname` ,`gender` ,`birthday` , `avatar`, `city` FROM `users`  WHERE `platformid`= " . $userid . " and  `platform` =1");

            } else {
                $result = DB::select("select `nickname` ,`gender` , `borndate` as `birthday` ,`cityid`, `avatar`, `provinceid` as `cityname` from `tool_users` WHERE   `id`= " . $id . "");
                return view("zhinfo")->with('result', $result)->with('city_parent', $city_parent)->with('userid', $userid)->with('platformid', $platid);

            }



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
            $platform =  $request->input('platformid');
        $re = DB::update("update `tool_users` set `avatar` ='" . $avatar . "',`nickname` = '" . $nickname . " ',`gender` = '" . $gender . "',`borndate` = '" . $birthday . "',`provinceid` ='" . $cityname . "',`cityid` ='" . $city . "',`platformid` = '" . $userid . "', `platform`='".$platform."' where id='" . $id . "' ");

        $sql = "update `users` set `nickname` = '" . $nickname . "',avatar='".$avatar."' where platformid= " . $userid . " and platform=".$platform;

        $re = DB::select($sql);


        return "<script> alert('保存成功');     window.location.href='/app/zbindex';</script>";

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
            $userid = $this->userid;
            return view('checkplat')->with('userid',$userid);

        };
    }
    
    /*
     * 检测平台id
     */
    public function checkplat(){
        $state = $this -> checkLogin();
         $userid = $_GET['userid'];
         $platid = $_GET['platid'];
        if($state == 0){
            //未登录
            return "<script>window.location.href='/app/login'</script>";
        }else {
             if($platid == 1){
                $rank = 'http://service.inke.com/api/user/search?imsi=&uid=&proto=5&idfa=CC528020-8D86-4291-927E-FA712C636768&lc=0000000000000026&cc=TG0001&imei=&sid=20C0VblbP5pbFi7Us7oyn8D4IFrjRHr3w49tzGCKi2ZYdulkDki3&cv=IK3.1.00_Iphone&devi=8c7b856e2895f4548c3c4083a3c6e1093e19109d&conn=Wifi&ua=iPhone&idfv=E2367328-B69B-4C6D-B12B-9CF7B49207E5&osversion=ios_9.300000&count=25&keyword=' . $userid;
                $gxs = file_get_contents($rank);
                echo $gxs;
             }else if($platid ==7){
                 $rank =Xxtea::getUserInfo($userid);
                 echo $rank;
//                 echo "我在验证一直播";
             }else if($platid==3){
                 $rand = rand(100000000,9999999999);
                 $time = time();
                 $line = "deviceid=3ccc323a0a7828d54b54af7d7d4a8475netspeed=0network=Wi-Fiplatform=iosrand=".$rand."time=".$time."userid=52611531version=3.8.0eac63e66d8c4a6f0303f00bc76d0217c";
                 $guid = MD5($line);
                 $url =  "http://live.huajiao.com/feed/getUserFeeds?deviceid=3ccc323a0a7828d54b54af7d7d4a8475&netspeed=0&network=Wi-Fi&platform=ios&rand=".$rand."&time=".$time."&userid=52611531&version=3.8.0&guid=".$guid."&model=iPhone6,1&channel=Apple&clientip=&dui=3ccc323a0a7828d54b54af7d7d4a8475&num=40&privacy=Y&uid=".$userid;
                 $gxs = file_get_contents($url);
                 echo $gxs;
             }
            };
    }
    /*
     *
     * 主播分享页
     */
    function share(Request $request,$id){
		
		$state = $this -> checkLogin();
		
		$result  =  DB::select("select case share.platform when 1 then '映客' when 3 then '花椒' when 7 then '一直播' end as plat,share.*,users.`nickname` ,users.`avatar` ,users.`intro` ,users.`veri_info`  from `share` inner join users on  share.`platform` = users.`platform` and `share`.`platformid` = users.`platformid`  where share.id=" . $id );
		
		if($result){
			$re = $result[0];
			
			if($state == 2 && ($re -> platform == $this->platform && $re -> platformid == $this->platformid)){
				$isMe = 1;		
			}else{
				$isMe = 0;		
			}
			
		}else{
			$re = null;
		}
		
		return view('share')->with('userinfo',$re)->with('isMe',$isMe);

    }
	
	
	function saveLiveData(Request $request){
	
		//print_r($_POST);
		
		$percent = 0.0;
		$online = $_REQUEST["maxnum"];
		
		//计算percent
		$percent = $this -> getPercent($online);
		//
		
		$state = $this -> checkLogin();
		
		if($state == 0 || $state == 1){
			
			echo "未登录";
				
		}else{
					
			$data = array(
				'platform' => $this->platform, 
				'platformid' => $this -> platformid , 
				'itime' => $_REQUEST["start_t"] , 
				'percent' => $percent , 
				'duration' => $_REQUEST["duration"] , 
				'follower' => $_REQUEST["follower"] , 
				'gold' => $_REQUEST["gold"],
				'income_top' => $_REQUEST["income_top"],
				'giftlog' => $_REQUEST["giftlog"],
				'online' => $online
			);
			
			
			$id = DB::table('share')->insertGetId($data);
			
			if(is_numeric($id)){
				echo $id;
			}else{
				echo "";	
			}
				
		}
		
	
    }
	
	
	
	function saveData(Request $request){
		
		print_r($_GET);
		
		$data = array(
				'platform' => $_GET["platform"], 
				'platformid' => $_GET["platformid"], 
				'liveid' => $_GET["liveid"],
				'online' => $_GET["online"],
				'gold' => $_GET["gold"],
				'goldfans' => $_GET["goldfans"],
				'fans' => $_GET["fans"],
				'chat' => $_GET["chat"],
			);
			
			$id = DB::table('tool_livelog')->insertGetId($data);
			
			echo $id;
    }
	
	
	
	function getPercent($online){
		
		if($online == 0){
			$percent = 0.0;
		}elseif($online > 0 and $online <= 100){//20
			$percent = 0 + ($online - 0)/100 * 20;
		}elseif($online > 100 and $online <= 1000){//40
			$percent = 20 + ($online - 100)/900 * 20;	
		}elseif($online > 1000 and $online <= 5000){//60
			$percent = 40 + ($online - 1000)/4000 * 20;		
		}elseif($online > 5000 and $online <= 10000){//80
			$percent = 60 + ($online - 5000)/5000 * 20;			
		}elseif($online > 10000 and $online <= 50000){//90
			$percent = 80 + ($online - 10000)/40000 * 10;		
		}elseif($online > 50000 and $online <= 500000){//99
			$percent = 90 + ($online - 50000)/500000 * 9;	
		}elseif($online > 500000){//99+
			$percent = 99.8;
		}
		
		return $percent;
			
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



    //一直播礼物接口
    public function yzbgitft(){
        $url = 'http://www.yizhibo.com/gift/h5api/get_gift_list_h5';
        $gxs = file_get_contents($url);
        echo $gxs;
    }


    //城市榜单
    public function bd(){
        $state = $this -> checkLogin();
        $userid =  $this -> platformid;
         $platform =  $this -> platform;
//        $userid = 104679089;
//        $platform = 1;
        $result = DB::select("SELECT id,province,city FROM `city_mini`");
        $lenght = count($result);
        $citymini = array();
        for($i=0;$i<$lenght;$i++){
            if(isset($result[0]->city)){
                $citymini[$result[$i]->city] = (int)$result[$i]->id;
            }
            if(isset($result[0]->province)){
                $citymini[$result[$i]->province] = (int)$result[$i]->id;
            }
        }
        $connect = new Memcached;
        $connect->setOption(Memcached::OPT_COMPRESSION, false);
        $connect->setOption(Memcached::OPT_BINARY_PROTOCOL, true);
        $connect->addServer('60.205.105.239', 11211);
        $tops = $connect->get("Tops");
//        $tops = '{"1": {"22307171": [[25, "9003"]], "51589172": [[37, "230"]], "185838233": [[30, "1845"]], "52205019": [[34, "875"]], "15191112": [[44, "230"]], "310048": [[32, "9001"]], "2439720": [[30, "703"]], "173224775": [[13, "19"]], "66354507": [[9, "2459"]], "3674598": [[1, "9003"]], "51961675": [[21, "703"]], "3988982": [[3, "9002"]], "14270302": [[11, "2824"]], "68379049": [[40, "2"]], "86433621": [[29, "1651"]], "9326501": [[41, "36"]], "11588005": [[31, "3063"]], "205569104": [[42, "2459"]], "3207364": [[2, "703"]], "9604730": [[5, "2459"]], "141897572": [[24, "2459"]], "84401663": [[29, "3191"]], "7642595": [[16, "36"]], "9789186": [[2, "9003"]], "135693938": [[49, "496"]], "158962775": [[32, "230"]], "46574865": [[5, "9001"]], "16760659": [[2, "1114"]], "169216424": [[35, "2721"]], "64827396": [[48, "2285"]], "23894275": [[23, "2425"]], "19303770": [[48, "230"]], "2078240": [[41, "857"]], "112389729": [[32, "1975"]], "62360312": [[37, "9001"]], "66268956": [[34, "1114"]], "88508351": [[32, "1252"]], "4598576": [[19, "875"]], "198838318": [[45, "9002"]], "46261465": [[33, "2498"]], "54119901": [[47, "2824"]], "10294387": [[12, "9002"]], "14282669": [[32, "2125"]], "231211684": [[32, "372"]], "60948385": [[5, "875"]], "115014692": [[13, "2721"]], "1955628": [[3, "2824"]], "15890836": [[29, "496"]], "8452701": [[42, "9001"]], "15668412": [[36, "1651"]], "134020605": [[25, "1479"]], "211753791": [[21, "2459"]], "119731343": [[32, "2721"]], "9654035": [[4, "230"]], "56018429": [[43, "1252"]], "238147303": [[41, "2425"]], "11753858": [[12, "1001"]], "2921728": [[7, "703"]], "170534609": [[30, "2285"]], "152710094": [[17, "1356"]], "21862857": [[17, "1114"]], "7900548": [[1, "703"]], "70591700": [[14, "1356"]], "213658967": [[24, "2721"]], "149862102": [[35, "9001"]], "4505220": [[34, "703"]], "105793084": [[26, "1114"]], "141899244": [[27, "9002"]], "8414695": [[19, "2"]], "102999502": [[30, "2125"]], "67194150": [[39, "2498"]], "60767141": [[15, "2425"]], "62017929": [[4, "875"]], "7124850": [[26, "2"]], "177200499": [[48, "1356"]], "64083315": [[31, "1114"]], "123126411": [[9, "3512"]], "148169825": [[26, "2498"]], "4473007": [[6, "9001"]], "34566194": [[16, "2824"]], "6263600": [[11, "19"]], "112617829": [[18, "2125"]], "7678603": [[2, "496"]], "400436048": [[11, "1252"]], "80924359": [[45, "1001"]], "102019983": [[30, "2425"]], "51673014": [[18, "1252"]], "4264757": [[17, "2"]], "62711621": [[43, "496"]], "9319226": [[1, "2425"]], "48008389": [[34, "9001"]], "54353385": [[20, "372"]], "9854886": [[27, "2125"]], "92655284": [[14, "3063"]], "49497785": [[7, "372"]], "95699845": [[1, "2125"]], "9538281": [[26, "1479"]], "119241508": [[10, "2721"]], "182352339": [[6, "1252"]], "14971952": [[49, "19"]], "41936033": [[38, "1252"]], "61315935": [[46, "9001"]], "143622525": [[36, "19"]], "12173037": [[30, "19"]], "110929862": [[19, "3191"]], "62356461": [[50, "2721"]], "116930988": [[16, "1114"]], "80978326": [[10, "1479"]], "186626013": [[23, "2721"]], "16716693": [[24, "1356"]], "16341871": [[6, "2498"]], "101717126": [[19, "857"]], "209691739": [[29, "2425"]], "61924494": [[3, "2721"]], "114219143": [[28, "9001"]], "19241273": [[27, "9001"]], "128425510": [[12, "19"]], "63118234": [[2, "2125"]], "19220506": [[14, "9001"]], "50101160": [[38, "703"]], "197463019": [[20, "2721"]], "3436090": [[15, "496"]], "51496891": [[40, "3191"]], "149626847": [[45, "19"]], "2657305": [[3, "19"]], "68396284": [[33, "1651"]], "94905526": [[29, "3063"]], "56717564": [[38, "36"]], "4980785": [[36, "703"]], "26837461": [[40, "372"]], "40595339": [[29, "1479"]], "3020054": [[25, "2721"]], "8506083": [[5, "1845"]], "117706471": [[20, "2824"]], "60987007": [[39, "1845"]], "172092500": [[31, "372"]], "5352278": [[1, "1114"]], "3271292": [[12, "2721"]], "5557272": [[11, "1001"]], "14418938": [[33, "3191"]], "229680431": [[11, "3891"]], "151752717": [[44, "2125"]], "84780434": [[9, "2721"]], "138972099": [[32, "2459"]], "58278489": [[31, "2425"]], "150357185": [[41, "3191"]], "198156156": [[14, "2"]], "53323363": [[6, "2425"]], "216069603": [[32, "1479"]], "206628763": [[11, "1651"]], "134958454": [[29, "2721"]], "46260033": [[27, "1001"]], "38640634": [[36, "372"]], "58167838": [[50, "496"]], "24344863": [[14, "2285"]], "43921477": [[34, "372"]], "92795456": [[36, "857"]], "87072434": [[4, "1356"]], "56535197": [[34, "2459"]], "98951645": [[14, "3191"]], "16332749": [[39, "2459"]], "7915913": [[10, "9003"]], "56882572": [[20, "19"]], "204158412": [[41, "9003"]], "177524461": [[10, "36"]], "44122327": [[22, "36"]], "151296231": [[38, "1114"]], "4480516": [[40, "857"]], "9502438": [[4, "372"]], "17229252": [[47, "2721"]], "149631130": [[15, "2824"]], "49274885": [[15, "1252"]], "14486675": [[32, "1845"]], "226781453": [[5, "3512"]], "4898080": [[10, "703"]], "67344515": [[38, "2824"]], "34150915": [[22, "1975"]], "5804962": [[37, "19"]], "196309487": [[43, "2498"]], "7683485": [[49, "9002"]], "48753799": [[46, "1252"]], "57416249": [[23, "9001"]], "47655605": [[14, "1975"]], "10012161": [[17, "372"]], "133688088": [[7, "857"]], "20186020": [[38, "372"]], "4080728": [[6, "2125"]], "143502": [[8, "1479"]], "155768967": [[41, "1651"]], "152743083": [[35, "703"]], "2029731": [[20, "1479"]], "5319530": [[7, "2459"]], "197018981": [[22, "2824"]], "83498773": [[47, "2285"]], "58257988": [[43, "2721"]], "172108005": [[21, "9002"]], "59465566": [[20, "2425"]], "3217637": [[34, "19"]], "19236687": [[31, "1479"]], "24288382": [[35, "1479"]], "104326992": [[43, "9001"]], "74565726": [[36, "1252"]], "7693190": [[5, "36"]], "52076527": [[5, "2125"]], "45252822": [[42, "857"]], "51799048": [[43, "3191"]], "2935550": [[50, "36"]], "148197251": [[30, "230"]], "8764283": [[31, "2"]], "634752": [[17, "1479"]], "27859939": [[15, "2498"]], "9461184": [[21, "1001"]], "7076180": [[36, "1001"]], "52628236": [[37, "2125"]], "119323044": [[17, "1975"]], "70481104": [[48, "2459"]], "71247062": [[37, "1356"]], "12079298": [[17, "9001"]], "60383233": [[18, "9002"]], "16744227": [[24, "230"]], "7921638": [[22, "3063"]], "53139079": [[9, "1975"]], "91756569": [[27, "857"]], "16522866": [[12, "3063"]], "12294576": [[26, "1356"]], "4030177": [[13, "1356"]], "56600910": [[35, "372"]], "4675153": [[34, "1001"]], "117646078": [[22, "2425"]], "80166170": [[42, "1479"]], "181966594": [[47, "2"]], "51470496": [[5, "1356"]], "53328897": [[31, "3191"]], "42865406": [[5, "1479"]], "2143840": [[26, "9003"]], "5357408": [[2, "2498"]], "103782190": [[46, "3063"]], "66785181": [[38, "19"]], "116688358": [[29, "1001"]], "116066359": [[47, "857"]], "183955943": [[30, "2721"]], "213471493": [[10, "2425"]], "17461740": [[27, "230"]], "68819240": [[18, "1356"]], "100695744": [[35, "3063"]], "63429340": [[14, "9002"]], "29165452": [[29, "36"]], "232748717": [[9, "19"]], "40168579": [[22, "1001"]], "43435192": [[8, "36"]], "12907529": [[10, "1975"]], "54870038": [[8, "230"]], "31265926": [[49, "857"]], "97030279": [[50, "3063"]], "36338147": [[3, "1114"]], "36471736": [[43, "9003"]], "8490857": [[12, "1845"]], "59608748": [[3, "1975"]], "98637562": [[9, "3191"]], "10174119": [[20, "2125"]], "57530752": [[23, "9003"]], "183660200": [[47, "2498"]], "3532024": [[8, "703"]], "14627463": [[44, "2824"]], "4732099": [[25, "496"]], "206516762": [[43, "2"]], "152349894": [[49, "703"]], "45535772": [[39, "703"]], "219295338": [[48, "2721"]], "49691474": [[46, "1479"]], "46469938": [[1, "857"]], "92302940": [[10, "1356"]], "63231372": [[46, "857"]], "221390343": [[47, "1975"]], "34415489": [[36, "2285"]], "84115841": [[24, "2285"]], "7377297": [[19, "703"]], "51744449": [[27, "2498"]], "69752125": [[32, "2498"]], "141855172": [[46, "3191"]], "8547307": [[43, "703"]], "54375412": [[38, "1001"]], "111217755": [[17, "3063"]], "112901250": [[28, "875"]], "4850023": [[15, "703"]], "144503194": [[28, "2498"]], "66176115": [[15, "3063"]], "45303576": [[6, "1651"]], "102630724": [[22, "1356"]], "3318728": [[5, "2"]], "134256167": [[36, "2459"]], "12391339": [[26, "875"]], "35019712": [[45, "857"]], "205281362": [[48, "1252"]], "11003361": [[43, "1651"]], "5251198": [[33, "19"]], "37410123": [[15, "19"]], "119190953": [[10, "2125"]], "201767590": [[26, "1975"]], "97997550": [[18, "1114"]], "84231763": [[23, "230"]], "9169770": [[12, "9003"]], "188407132": [[12, "2125"]], "93181039": [[10, "3891"]], "47885955": [[7, "1845"]], "58508719": [[37, "2285"]], "6659177": [[5, "3891"]], "195798820": [[44, "2721"]], "135473026": [[23, "2824"]], "2115567": [[35, "9003"]], "8762096": [[26, "496"]], "58458375": [[8, "3891"]], "4996249": [[11, "2498"]], "170584674": [[39, "2285"]], "2618773": [[48, "36"]], "25772344": [[44, "496"]], "135180385": [[47, "9003"]], "72879474": [[33, "1252"]], "134427687": [[46, "230"]], "107857547": [[27, "372"]], "105522111": [[35, "1114"]], "238594794": [[42, "2721"]], "50578220": [[3, "36"]], "4262984": [[25, "703"]], "128000262": [[36, "1356"]], "74677070": [[33, "3063"]], "57424274": [[6, "857"]], "45418907": [[18, "230"]], "173476875": [[46, "1356"]], "90920883": [[20, "1114"]], "124218124": [[8, "1975"]], "51285441": [[5, "2721"]], "5786681": [[6, "1975"]], "106434734": [[49, "1114"]], "53060198": [[50, "372"]], "4608222": [[4, "3063"]], "55265870": [[11, "875"]], "44427184": [[16, "2498"]], "15183468": [[31, "2498"]], "413825": [[7, "2"]], "12730773": [[14, "372"]], "183091837": [[47, "1845"]], "21615746": [[6, "2285"]], "231395481": [[19, "1114"]], "17928365": [[2, "3063"]], "143390219": [[24, "9001"]], "4359535": [[16, "703"]], "12445358": [[2, "1651"]], "45823474": [[2, "372"]], "69479809": [[49, "2285"]], "44732908": [[21, "2425"]], "2805733": [[3, "372"]], "150962135": [[35, "1356"]], "7590927": [[35, "496"]], "80825225": [[22, "2"]], "5097090": [[2, "19"]], "45941220": [[28, "1651"]], "2826370": [[1, "1001"]], "6922533": [[12, "36"]], "112729905": [[25, "2824"]], "211040761": [[11, "9002"]], "67009087": [[25, "3191"]], "1002685": [[19, "9003"]], "16586147": [[23, "372"]], "55747584": [[37, "1252"]], "88098200": [[30, "3191"]], "121142653": [[49, "1356"]], "235146573": [[41, "2721"]], "64382262": [[40, "2498"]], "40042625": [[27, "2459"]], "238578162": [[43, "857"]], "3626109": [[7, "3063"]], "152334879": [[4, "3191"]], "118377101": [[31, "1001"]], "121031345": [[19, "2285"]], "182687181": [[39, "2425"]], "39119854": [[49, "1001"]], "93957168": [[31, "9002"]], "6368788": [[7, "1479"]], "7658809": [[39, "857"]], "40983142": [[13, "1114"]], "59448266": [[15, "2721"]], "118866915": [[33, "2"]], "60362716": [[32, "875"]], "107563697": [[14, "496"]], "59475052": [[45, "1252"]], "4635139": [[30, "9001"]], "2945304": [[6, "2"]], "20198950": [[30, "1001"]], "49102253": [[16, "1252"]], "36157427": [[35, "1252"]], "170419193": [[4, "1001"]], "52601749": [[2, "2285"]], "223190678": [[14, "2459"]], "75100780": [[48, "703"]], "94306781": [[48, "3063"]], "145059454": [[41, "1845"]], "45973386": [[13, "2824"]], "144131855": [[34, "9002"]], "6733076": [[20, "857"]], "25611288": [[29, "1845"]], "12789319": [[40, "703"]], "525414": [[24, "9003"]], "53961380": [[23, "1252"]], "52083405": [[16, "9003"]], "14075630": [[44, "857"]], "81603444": [[29, "2"]], "68735267": [[3, "875"]], "22710617": [[33, "230"]], "41414959": [[18, "372"]], "86111382": [[8, "1114"]], "7327997": [[33, "36"]], "71623149": [[32, "1651"]], "104783021": [[50, "2459"]], "17466985": [[20, "1651"]], "40032692": [[1, "36"]], "13983703": [[32, "1114"]], "4672638": [[30, "496"]], "210380903": [[29, "1114"]], "71640009": [[35, "875"]], "110715649": [[39, "36"]], "116362805": [[37, "9003"]], "218986": [[15, "2459"]], "65843609": [[49, "2125"]], "95604962": [[3, "9001"]], "48855835": [[12, "2498"]], "2176152": [[4, "1479"]], "238296876": [[30, "9002"]], "118332773": [[14, "2721"]], "90756295": [[31, "1356"]], "55724120": [[15, "230"]], "176219876": [[40, "9002"]], "27658648": [[37, "372"]], "145990121": [[34, "857"]], "22225709": [[16, "1356"]], "9025188": [[4, "2824"]], "10333735": [[47, "1252"]], "137630829": [[41, "372"]], "2512772": [[3, "2459"]], "57013595": [[11, "2125"]], "11040547": [[18, "1001"]], "34326492": [[33, "372"]], "104558204": [[39, "1651"]], "11518646": [[39, "1479"]], "156566609": [[44, "1651"]], "140252436": [[33, "1001"]], "2692995": [[17, "875"]], "9152555": [[15, "1479"]], "215953504": [[38, "875"]], "23020098": [[13, "1479"]], "212106431": [[16, "2721"]], "180625907": [[49, "1845"]], "65124235": [[43, "2459"]], "51596759": [[18, "3191"]], "41438991": [[45, "3063"]], "64850193": [[32, "2824"]], "51817580": [[16, "2285"]], "142373069": [[47, "36"]], "26769233": [[20, "875"]], "128881492": [[42, "2425"]], "5184854": [[31, "703"]], "101581613": [[16, "1845"]], "116471595": [[49, "2824"]], "99814719": [[7, "9002"]], "7041615": [[8, "19"]], "236357401": [[33, "2285"]], "6261970": [[26, "372"]], "134802157": [[3, "1845"]], "1836561": [[5, "2824"]], "60161514": [[21, "1479"]], "107412391": [[26, "1252"]], "10400371": [[44, "9003"]], "14151542": [[21, "1651"]], "6681859": [[1, "2459"]], "195501773": [[38, "1479"]], "192658526": [[5, "372"]], "104327351": [[26, "2425"]], "3754691": [[32, "19"]], "51065005": [[21, "36"]], "17838878": [[9, "1356"]], "150182311": [[6, "2721"]], "54722616": [[12, "3512"]], "150685345": [[44, "9001"]], "55641828": [[31, "2285"]], "112950641": [[21, "1356"]], "15321437": [[31, "9001"]], "98610890": [[43, "1845"]], "132147024": [[15, "3191"]], "16267049": [[20, "1845"]], "35198165": [[4, "9002"]], "8115108": [[44, "3063"]], "92288346": [[2, "3512"]], "4179398": [[18, "703"]], "175990552": [[38, "2125"]], "10840798": [[46, "19"]], "34553220": [[17, "2459"]], "101228294": [[25, "1651"]], "6702925": [[23, "19"]], "11513413": [[13, "496"]], "214711250": [[46, "2459"]], "87009379": [[14, "2425"]], "2471894": [[31, "9003"]], "107727516": [[3, "3891"]], "67265935": [[11, "1975"]], "7645248": [[8, "9003"]], "12211958": [[38, "9001"]], "11456593": [[43, "1114"]], "189888688": [[42, "1114"]], "106705511": [[37, "1975"]], "180625644": [[49, "1651"]], "37096395": [[7, "1975"]], "86476778": [[17, "2721"]], "101754777": [[27, "1845"]], "9882669": [[22, "9001"]], "140041475": [[29, "2824"]], "82398554": [[43, "875"]], "66470795": [[14, "1845"]], "31006214": [[7, "1651"]], "231409981": [[32, "9002"]], "34722593": [[29, "1252"]], "145736384": [[3, "3191"]], "54512704": [[39, "3191"]], "41030489": [[12, "372"]], "157761797": [[49, "230"]], "10274112": [[14, "230"]], "10127854": [[35, "2498"]], "104455233": [[46, "2498"]], "3772223": [[47, "9002"]], "53746133": [[12, "857"]], "11896315": [[48, "2498"]], "85870235": [[10, "1001"]], "6426989": [[6, "2824"]], "10097758": [[8, "9001"]], "37982915": [[16, "3191"]], "53250793": [[21, "857"]], "174143927": [[46, "9002"]], "54026701": [[30, "36"]], "12700670": [[33, "2125"]], "142431370": [[44, "9002"]], "3398817": [[3, "857"]], "9606901": [[14, "36"]], "68065506": [[1, "2285"]], "142383668": [[12, "1975"]], "21594922": [[43, "230"]], "59517785": [[30, "1975"]], "20201006": [[39, "2824"]], "16681610": [[25, "2"]], "7141430": [[14, "1252"]], "138446300": [[41, "3063"]], "82043486": [[30, "875"]], "2739391": [[6, "703"]], "51576514": [[41, "1975"]], "91066346": [[33, "1114"]], "16656032": [[31, "1975"]], "55660263": [[30, "372"]], "109650539": [[37, "1651"]], "66437118": [[10, "19"]], "2109757": [[9, "1845"]], "12003924": [[17, "230"]], "58545087": [[5, "703"]], "66682821": [[50, "1651"]], "104679089": [[1, "2"]], "4842579": [[2, "1356"]], "55667366": [[24, "9002"]], "100665382": [[49, "2"]], "237284934": [[31, "1252"]], "43978581": [[36, "1975"]], "46721195": [[19, "230"]], "67372998": [[8, "2721"]], "5134391": [[24, "1479"]], "65868941": [[9, "2125"]], "155269887": [[14, "19"]], "60741905": [[12, "1356"]], "97139432": [[42, "2824"]], "67733458": [[28, "2425"]], "95523212": [[29, "2125"]], "186680269": [[36, "2824"]], "80850403": [[32, "2425"]], "16314792": [[2, "2824"]], "96942245": [[23, "2498"]], "224635973": [[18, "2285"]], "130645255": [[23, "3063"]], "225614707": [[25, "2285"]], "2731016": [[6, "496"]], "7343843": [[42, "496"]], "39690373": [[41, "230"]], "131884941": [[36, "2425"]], "135985528": [[47, "875"]], "182624634": [[30, "1356"]], "197034500": [[40, "2721"]], "4728447": [[3, "1356"]], "3420567": [[27, "19"]], "145941349": [[43, "372"]], "56253454": [[25, "2498"]], "5176746": [[44, "19"]], "72565548": [[43, "1356"]], "59223673": [[29, "1356"]], "9291245": [[24, "2125"]], "29297883": [[1, "496"]], "20988166": [[35, "2425"]], "15487727": [[33, "9001"]], "80891422": [[43, "2824"]], "109785310": [[36, "9002"]], "58790250": [[39, "2721"]], "183567": [[21, "2824"]], "34305751": [[41, "1479"]], "238041": [[41, "2"]], "2452690": [[15, "9003"]], "6638497": [[9, "2425"]], "3812959": [[14, "2498"]], "177488689": [[36, "9001"]], "112885163": [[33, "1975"]], "10916572": [[21, "230"]], "7889663": [[6, "372"]], "17082556": [[26, "1651"]], "168250471": [[34, "2824"]], "2474708": [[6, "230"]], "11288218": [[5, "230"]], "119134705": [[45, "2459"]], "7476247": [[48, "496"]], "56717607": [[50, "3191"]], "37326650": [[29, "372"]], "30651678": [[10, "1252"]], "189747709": [[9, "36"]], "10503893": [[15, "2125"]], "120138699": [[4, "2459"]], "21434061": [[28, "9003"]], "123733702": [[18, "2721"]], "40192758": [[23, "2285"]], "98338502": [[1, "3891"]], "10992303": [[16, "1975"]], "56680356": [[2, "1001"]], "55332057": [[34, "1845"]], "92823805": [[15, "1356"]], "208630119": [[25, "2459"]], "136252193": [[44, "2"]], "31628930": [[40, "2125"]], "39191339": [[22, "1114"]], "237127659": [[50, "2285"]], "5373424": [[15, "1845"]], "192816003": [[36, "3063"]], "35236184": [[8, "372"]], "210731498": [[32, "496"]], "66203253": [[6, "9002"]], "84006806": [[20, "1975"]], "151683934": [[45, "372"]], "68174848": [[22, "1651"]], "61115284": [[28, "1252"]], "12007542": [[44, "1479"]], "4356163": [[1, "19"]], "74172526": [[46, "2425"]], "4802502": [[35, "857"]], "21637794": [[48, "9001"]], "6703041": [[16, "19"]], "94500979": [[45, "2721"]], "15631432": [[13, "2498"]], "5245017": [[47, "496"]], "139337947": [[47, "1356"]], "11028560": [[26, "3191"]], "19290039": [[4, "857"]], "113088834": [[26, "36"]], "100689679": [[47, "2125"]], "7173236": [[8, "1651"]], "116686483": [[5, "1001"]], "2035677": [[17, "2125"]], "131616249": [[4, "3512"]], "889137": [[9, "2"]], "6375495": [[17, "703"]], "25431883": [[13, "857"]], "11723316": [[35, "1001"]], "34628075": [[30, "2"]], "44514587": [[8, "2459"]], "14317858": [[8, "857"]], "3779058": [[42, "2"]], "923415": [[21, "496"]], "5100350": [[13, "9001"]], "92548298": [[49, "1975"]], "100114254": [[23, "1114"]], "54425663": [[29, "1975"]], "146774514": [[28, "1356"]], "128499810": [[44, "1252"]], "235381646": [[4, "3891"]], "59749066": [[44, "875"]], "50616103": [[22, "1845"]], "201883893": [[35, "9002"]], "11236387": [[10, "372"]], "47093355": [[9, "703"]], "81922754": [[38, "2459"]], "1086481": [[23, "1651"]], "7349986": [[40, "19"]], "148168200": [[11, "2285"]], "23019678": [[39, "230"]], "16800595": [[45, "496"]], "66526308": [[32, "703"]], "17150238": [[25, "857"]], "185194086": [[4, "2721"]], "14785962": [[21, "3191"]], "45839286": [[34, "36"]], "2516835": [[13, "1845"]], "56410370": [[38, "2"]], "137974453": [[35, "1845"]], "55510254": [[48, "857"]], "148385174": [[45, "2285"]], "237050276": [[38, "1356"]], "64391154": [[31, "1845"]], "64869977": [[18, "1845"]], "143249102": [[26, "2824"]], "2426529": [[1, "9002"]], "71670177": [[22, "2285"]], "120206555": [[23, "36"]], "233639645": [[37, "2721"]], "179030992": [[1, "1252"]], "93151732": [[9, "1252"]], "56614094": [[43, "3063"]], "10140240": [[23, "2459"]], "56044446": [[18, "3063"]], "55425393": [[18, "1975"]], "58637828": [[9, "230"]], "440895": [[2, "2425"]], "2137155": [[40, "496"]], "34551488": [[34, "2498"]], "111336178": [[32, "9003"]], "213509703": [[37, "36"]], "117066510": [[24, "1845"]], "39840630": [[44, "3191"]], "238518054": [[40, "1975"]], "8441812": [[25, "9001"]], "2321841": [[3, "2"]], "15994317": [[24, "1651"]], "46710327": [[7, "36"]], "171549166": [[12, "2459"]], "6239479": [[37, "496"]], "157200821": [[12, "2425"]], "176406511": [[10, "3191"]], "236350769": [[46, "2285"]], "8351455": [[18, "9003"]], "62139402": [[50, "1975"]], "13971700": [[20, "9002"]], "17855062": [[3, "2285"]], "3188675": [[6, "19"]], "35054477": [[15, "1975"]], "7602589": [[1, "3191"]], "56262052": [[25, "3063"]], "69733784": [[45, "1651"]], "8860984": [[29, "875"]], "2314372": [[1, "1479"]], "40409136": [[48, "1001"]], "199416836": [[14, "875"]], "59601082": [[28, "230"]], "81016326": [[28, "1114"]], "101805245": [[42, "875"]], "1926560": [[20, "2"]], "10103037": [[42, "2498"]], "186197780": [[26, "1001"]], "83583063": [[44, "1001"]], "11341992": [[38, "857"]], "53597009": [[37, "2824"]], "59840935": [[1, "2721"]], "65256883": [[36, "3191"]], "185563615": [[10, "2"]], "39979962": [[22, "19"]], "58403315": [[19, "1845"]], "4894790": [[40, "1114"]], "58775708": [[45, "2824"]], "45906974": [[34, "2125"]], "44784826": [[5, "1975"]], "10650376": [[47, "230"]], "17001080": [[24, "857"]], "2508429": [[7, "875"]], "9263620": [[19, "19"]], "65378793": [[28, "2459"]], "54449188": [[45, "230"]], "13816681": [[36, "2125"]], "98599613": [[24, "1114"]], "136245596": [[13, "3512"]], "63731797": [[10, "2824"]], "8444809": [[35, "230"]], "54248299": [[13, "9003"]], "4556668": [[41, "1114"]], "36651119": [[50, "2125"]], "53518700": [[45, "875"]], "192320505": [[22, "1479"]], "99950916": [[9, "9002"]], "237954758": [[49, "2425"]], "168977971": [[38, "2721"]], "72319100": [[46, "2125"]], "40188027": [[13, "875"]], "11043113": [[11, "857"]], "36490962": [[47, "3191"]], "19870170": [[36, "875"]], "12001041": [[16, "875"]], "16681498": [[6, "1356"]], "21227480": [[37, "875"]], "164494690": [[2, "3191"]], "109099639": [[46, "1845"]], "8406831": [[10, "9002"]], "59557078": [[42, "1845"]], "174516447": [[22, "703"]], "2658429": [[16, "2459"]], "154685502": [[26, "9002"]], "5600442": [[42, "1975"]], "148050929": [[33, "1356"]], "22242789": [[27, "1252"]], "59018993": [[33, "857"]], "131166347": [[49, "2721"]], "7188400": [[18, "2824"]], "209037544": [[11, "2459"]], "11906102": [[17, "1001"]], "60892285": [[42, "36"]], "60823250": [[39, "1114"]], "10985708": [[47, "1114"]], "5461987": [[14, "1001"]], "98334325": [[41, "703"]], "15427398": [[30, "1252"]], "61124276": [[46, "875"]], "99013775": [[11, "3191"]], "51432065": [[33, "1479"]], "37403141": [[35, "36"]], "4991146": [[37, "3063"]], "9751881": [[47, "372"]], "6706031": [[29, "9001"]], "123064750": [[38, "1975"]], "6687554": [[11, "496"]], "134643899": [[47, "1001"]], "21606133": [[38, "1651"]], "4013117": [[4, "496"]], "11642670": [[23, "2"]], "157492930": [[50, "2425"]], "34389968": [[5, "9003"]], "153590991": [[43, "1975"]], "11092222": [[46, "2"]], "9188710": [[28, "496"]], "7605297": [[10, "875"]], "16842934": [[12, "875"]], "5359501": [[14, "9003"]], "93838790": [[33, "875"]], "8245414": [[36, "9003"]], "5890181": [[27, "496"]], "15279964": [[5, "857"]], "18879590": [[39, "3063"]], "50695243": [[27, "2285"]], "194461982": [[19, "2721"]], "158498002": [[41, "1356"]], "15883004": [[6, "1001"]], "178093808": [[38, "2498"]], "36786638": [[27, "2425"]], "238279636": [[36, "2721"]], "2377710": [[24, "703"]], "27496620": [[25, "2125"]], "86344516": [[7, "2824"]], "9914445": [[2, "2721"]], "80265561": [[45, "2125"]], "11659518": [[32, "1356"]], "123135984": [[43, "2125"]], "61925049": [[10, "2459"]], "101912060": [[32, "2285"]], "128028275": [[10, "2498"]], "17165645": [[27, "1114"]], "5054015": [[1, "230"]], "52027498": [[16, "372"]], "2250324": [[45, "2"]], "7010377": [[40, "9003"]], "181846222": [[44, "1114"]], "119553662": [[34, "2721"]], "15811967": [[27, "3191"]], "2587739": [[4, "1845"]], "107533530": [[46, "1114"]], "38170727": [[34, "1479"]], "17652814": [[9, "1001"]], "111927319": [[5, "1651"]], "94988352": [[24, "1252"]], "24806325": [[6, "3063"]], "129394040": [[42, "230"]], "37017100": [[31, "875"]], "119621261": [[4, "1975"]], "34602065": [[2, "230"]], "130667120": [[42, "2285"]], "17215439": [[13, "3063"]], "101769903": [[42, "2125"]], "121686426": [[13, "230"]], "29609628": [[7, "3891"]], "238534467": [[35, "2459"]], "39093827": [[34, "3191"]], "17679586": [[21, "3063"]], "50272615": [[19, "372"]], "54415254": [[19, "2498"]], "44458037": [[28, "1479"]], "116942773": [[31, "2721"]], "58459027": [[20, "9003"]], "50625610": [[43, "19"]], "175990549": [[28, "1975"]], "7107481": [[10, "857"]], "133718940": [[48, "9002"]], "7781773": [[33, "703"]], "218078663": [[16, "9001"]], "119003125": [[12, "1651"]], "2079697": [[34, "496"]], "146514229": [[38, "2285"]], "3267239": [[4, "1651"]], "15380478": [[26, "19"]], "63410430": [[15, "9002"]], "122836757": [[24, "875"]], "59500692": [[33, "2824"]], "58394665": [[42, "372"]], "7059766": [[10, "3063"]], "10575696": [[9, "1479"]], "156494002": [[34, "2"]], "62150848": [[10, "3512"]], "108588612": [[23, "3191"]], "47949991": [[40, "1356"]], "15570175": [[4, "2425"]], "22297409": [[32, "1001"]], "10929279": [[39, "875"]], "136420661": [[47, "3063"]], "84608774": [[11, "372"]], "144147379": [[18, "875"]], "44259792": [[40, "1651"]], "4955058": [[39, "9003"]], "3156297": [[29, "19"]], "81079367": [[11, "3512"]], "16506264": [[31, "1651"]], "184280255": [[3, "1001"]], "39143137": [[22, "1252"]], "2478186": [[18, "9001"]], "9324086": [[8, "2498"]], "131088418": [[45, "3191"]], "152042855": [[41, "2824"]], "42540654": [[26, "9001"]], "56419770": [[47, "9001"]], "2502147": [[49, "9003"]], "19837526": [[29, "2498"]], "13987636": [[3, "2425"]], "16026114": [[17, "2425"]], "5559328": [[7, "1356"]], "114933732": [[50, "2824"]], "137425003": [[36, "1845"]], "81763970": [[18, "36"]], "236061533": [[5, "2498"]], "59383640": [[13, "1252"]], "80633655": [[36, "1479"]], "36452824": [[40, "3063"]], "170441287": [[50, "2498"]], "121613754": [[10, "1845"]], "11017046": [[42, "3063"]], "14278640": [[37, "1845"]], "116079349": [[28, "36"]], "22259192": [[48, "1651"]], "71292841": [[50, "1114"]], "121164391": [[46, "496"]], "4971085": [[7, "19"]], "40864929": [[17, "857"]], "114834480": [[31, "19"]], "43795947": [[46, "1651"]], "119786727": [[4, "36"]], "11320538": [[16, "3063"]], "37770852": [[1, "3913"]], "30952399": [[35, "19"]], "133622830": [[17, "2824"]], "19630126": [[50, "9003"]], "39041982": [[22, "2125"]], "104915983": [[40, "36"]], "53389519": [[11, "703"]], "198926083": [[41, "2459"]], "4287615": [[19, "496"]], "8572086": [[7, "1252"]], "227974563": [[36, "2"]], "11981148": [[40, "1845"]], "6385020": [[1, "1651"]], "103181371": [[35, "1651"]], "81658590": [[7, "2498"]], "59256143": [[40, "230"]], "45505811": [[7, "2125"]], "19614936": [[7, "230"]], "85053658": [[48, "19"]], "19011451": [[25, "1356"]], "118943844": [[6, "1114"]], "215895441": [[50, "857"]], "7173280": [[19, "36"]], "127608678": [[48, "1845"]], "188290587": [[38, "3191"]], "69502538": [[23, "1479"]], "4665349": [[9, "1651"]], "44673358": [[36, "36"]], "2732015": [[28, "9002"]], "16291538": [[19, "2125"]], "4238347": [[2, "1975"]], "134610697": [[46, "1001"]], "35800160": [[16, "496"]], "156169821": [[37, "2"]], "58250382": [[12, "230"]], "11868089": [[24, "1975"]], "62366043": [[39, "9001"]], "33800155": [[38, "496"]], "108331171": [[5, "3191"]], "59223103": [[45, "1975"]], "14436734": [[23, "1845"]], "7418335": [[8, "496"]], "20774643": [[27, "3063"]], "63439951": [[4, "9003"]], "148254329": [[49, "36"]], "9765348": [[17, "1252"]], "5671813": [[27, "9003"]], "105466180": [[17, "2498"]], "188653846": [[44, "2459"]], "9474639": [[18, "2498"]], "189662561": [[29, "2285"]], "42460883": [[25, "9002"]], "52699979": [[27, "2"]], "59970340": [[13, "372"]], "57415372": [[38, "3063"]], "408156": [[10, "9001"]], "169905066": [[7, "1001"]], "9438863": [[3, "9003"]], "34684616": [[8, "2125"]], "39214913": [[26, "2125"]], "8437795": [[15, "2"]], "69166214": [[42, "1252"]], "237082867": [[38, "9002"]], "43462548": [[2, "1479"]], "115562224": [[24, "3191"]], "34389161": [[23, "2125"]], "44122909": [[45, "1479"]], "4805156": [[1, "372"]], "40421528": [[37, "703"]], "92723194": [[8, "1001"]], "1863314": [[39, "496"]], "58035082": [[8, "2425"]], "232994612": [[31, "230"]], "7425406": [[34, "2425"]], "8457327": [[4, "1252"]], "49439853": [[38, "2425"]], "92540240": [[24, "2425"]], "89386803": [[30, "2459"]], "13818708": [[25, "1845"]], "42797259": [[25, "1114"]], "4758982": [[4, "9001"]], "142806442": [[50, "1252"]], "55898454": [[3, "2125"]], "98754594": [[49, "9001"]], "192737863": [[27, "1975"]], "84132895": [[44, "1356"]], "135365618": [[40, "2285"]], "92591419": [[35, "2285"]], "137294986": [[3, "1252"]], "40999818": [[8, "3063"]], "53053329": [[39, "2"]], "53886582": [[40, "875"]], "229785167": [[11, "2425"]], "15752246": [[42, "703"]], "10707998": [[24, "2"]], "59650167": [[20, "2285"]], "39045969": [[40, "1001"]], "39341941": [[32, "3063"]], "165001": [[44, "2285"]], "65706286": [[8, "875"]], "163950949": [[18, "496"]], "171928674": [[25, "1252"]], "66578559": [[48, "2425"]], "57765120": [[9, "9003"]], "10477538": [[8, "2285"]], "2085132": [[2, "9001"]], "8168432": [[29, "9003"]], "113003018": [[18, "857"]], "49240254": [[46, "372"]], "3734056": [[6, "2459"]], "2426052": [[34, "9003"]], "10979942": [[20, "703"]], "3580158": [[11, "36"]], "136811365": [[23, "857"]], "43460979": [[48, "3191"]], "6617287": [[3, "703"]], "2356076": [[12, "2824"]], "51717316": [[48, "372"]], "66832195": [[6, "3191"]], "46207767": [[28, "1845"]], "237560794": [[11, "1845"]], "42912623": [[34, "1356"]], "71905275": [[25, "875"]], "58271395": [[45, "2498"]], "10701347": [[21, "2285"]], "224381768": [[15, "2285"]], "67990476": [[49, "3191"]], "56664303": [[46, "36"]], "61368660": [[39, "372"]], "158426272": [[35, "2"]], "99006301": [[30, "2824"]], "66067035": [[21, "1114"]], "1023487": [[17, "36"]], "37363812": [[41, "496"]], "104838474": [[39, "1356"]], "98827956": [[32, "3191"]], "53317640": [[18, "1479"]], "4594481": [[3, "496"]], "2255348": [[22, "9003"]], "187191703": [[9, "496"]], "238533761": [[23, "1356"]], "6892624": [[14, "2125"]], "12902194": [[37, "1479"]], "518399": [[7, "9003"]], "50767092": [[8, "1845"]], "23552991": [[28, "703"]], "35489699": [[16, "9002"]], "105896084": [[40, "2824"]], "229670673": [[26, "857"]], "112735001": [[41, "9002"]], "13064248": [[2, "875"]], "238587180": [[43, "2285"]], "198180127": [[49, "1252"]], "180072379": [[31, "2459"]], "121080830": [[6, "3512"]], "49803277": [[31, "857"]], "4886258": [[28, "2125"]], "6604427": [[31, "496"]], "6535497": [[2, "36"]], "5354705": [[49, "875"]], "12693183": [[49, "2459"]], "14645420": [[36, "496"]], "47554626": [[14, "1651"]], "147787958": [[22, "372"]], "56726708": [[34, "230"]], "54790006": [[20, "2459"]], "50634218": [[13, "1975"]], "12398960": [[12, "1479"]], "42940470": [[9, "3891"]], "39728292": [[21, "875"]], "235979476": [[47, "703"]], "68967279": [[28, "2285"]], "209005172": [[50, "230"]], "53978007": [[43, "1479"]], "37905752": [[50, "2"]], "192706678": [[26, "2459"]], "6747050": [[10, "1651"]], "10618503": [[11, "1479"]], "178776402": [[27, "2824"]], "3771424": [[15, "1114"]], "46426387": [[21, "2125"]], "4246431": [[12, "2"]], "37813027": [[11, "230"]], "36415512": [[2, "9002"]], "2023931": [[24, "2498"]], "51376528": [[36, "2498"]], "52459343": [[22, "875"]], "58543346": [[29, "857"]], "47127679": [[14, "1114"]], "44933885": [[19, "3063"]], "24207945": [[6, "1479"]], "214945030": [[45, "1114"]], "16982706": [[25, "372"]], "43334584": [[29, "703"]], "107930926": [[15, "875"]], "45036279": [[34, "1651"]], "86825150": [[24, "2824"]], "7035001": [[35, "3191"]], "20305098": [[10, "2285"]], "64059485": [[1, "1975"]], "9479941": [[8, "1252"]], "130656130": [[50, "9001"]], "117655097": [[46, "2824"]], "14119878": [[4, "2498"]], "63776180": [[21, "19"]], "6112854": [[21, "2498"]], "137344546": [[15, "3512"]], "91154401": [[40, "1252"]], "30781362": [[14, "2824"]], "6420757": [[3, "230"]], "2379022": [[16, "230"]], "178017267": [[31, "2125"]], "83677717": [[11, "1356"]], "132536272": [[20, "36"]], "104497216": [[26, "1845"]], "61875636": [[19, "1356"]], "177986965": [[44, "1845"]], "8365980": [[37, "1114"]], "153673319": [[40, "2425"]], "151582158": [[46, "2721"]], "4739917": [[44, "372"]], "14064969": [[38, "9003"]], "139723494": [[37, "9002"]], "37472272": [[9, "2285"]], "89090784": [[47, "2425"]], "113943448": [[2, "2459"]], "12927090": [[24, "3063"]], "205102792": [[19, "1479"]], "457186": [[18, "1651"]], "46570730": [[50, "703"]], "48090403": [[28, "372"]], "101093684": [[13, "9002"]], "5690235": [[30, "3063"]], "93725551": [[17, "1651"]], "42271702": [[43, "1001"]], "54193846": [[16, "1651"]], "34509967": [[17, "9002"]], "4223067": [[1, "875"]], "129560312": [[8, "3512"]], "138445505": [[17, "1845"]], "59262907": [[50, "1356"]], "112651427": [[30, "1479"]], "17792348": [[26, "2285"]], "55644350": [[27, "36"]], "62522200": [[45, "2425"]], "192673589": [[41, "2125"]], "46357841": [[19, "2459"]], "24415263": [[25, "19"]], "236044861": [[41, "2285"]], "6146816": [[4, "2"]], "2531907": [[2, "3891"]], "57125336": [[39, "1252"]], "11991729": [[49, "3063"]], "2143161": [[3, "1479"]], "2199533": [[6, "1845"]], "57692794": [[11, "9001"]], "1842490": [[26, "703"]], "603021": [[50, "875"]], "2713728": [[33, "2425"]], "46161881": [[49, "1479"]], "238574819": [[43, "2425"]], "22910606": [[21, "1975"]], "143757785": [[42, "9002"]], "56562834": [[1, "3512"]], "48820244": [[29, "2459"]], "7875107": [[5, "9002"]], "10816435": [[12, "9001"]], "67808274": [[41, "1252"]], "8287725": [[11, "3063"]], "58764775": [[24, "1001"]], "84125994": [[20, "1001"]], "150749945": [[8, "3191"]], "129205769": [[33, "9002"]], "9586085": [[42, "9003"]], "43429576": [[11, "1114"]], "17620349": [[1, "2824"]], "15171700": [[10, "230"]], "3753502": [[6, "36"]], "21471370": [[48, "1975"]], "11338085": [[22, "2498"]], "116876247": [[4, "2125"]], "17480189": [[19, "1252"]], "192014097": [[13, "2425"]], "9792122": [[42, "1001"]], "145605708": [[47, "2459"]], "641197": [[19, "9001"]], "81391338": [[10, "496"]], "690786": [[7, "1114"]], "81254480": [[37, "3191"]], "188901050": [[48, "1479"]], "14105410": [[20, "3063"]], "39138746": [[45, "9001"]], "8734494": [[48, "9003"]], "178845838": [[28, "2"]], "144315235": [[32, "857"]], "64056579": [[45, "1356"]], "9975508": [[1, "9001"]], "9782569": [[20, "1252"]], "98942712": [[17, "3191"]], "5779442": [[6, "9003"]], "794043": [[9, "875"]], "97068193": [[29, "9002"]], "204524138": [[6, "3891"]], "11440987": [[30, "1651"]], "203221687": [[28, "2721"]], "16027881": [[33, "496"]], "130642221": [[20, "496"]], "81422647": [[18, "2425"]], "102691644": [[41, "2498"]], "94142933": [[5, "2285"]], "9030615": [[16, "2"]], "37719431": [[34, "1252"]], "149592120": [[37, "857"]], "68322443": [[37, "2425"]], "2859915": [[13, "2125"]], "192664601": [[13, "36"]], "12696901": [[2, "1845"]], "157742473": [[22, "3191"]], "2887408": [[44, "2498"]], "24097087": [[41, "1001"]], "171516705": [[13, "703"]], "6687685": [[12, "703"]], "8131166": [[49, "372"]], "2136256": [[5, "19"]], "71547661": [[23, "9002"]], "54966548": [[4, "2285"]], "16465448": [[18, "2"]], "30173827": [[21, "2721"]], "17843041": [[25, "2425"]], "2886689": [[15, "857"]], "612243": [[30, "1114"]], "16213225": [[23, "875"]], "107036150": [[12, "1114"]], "2660056": [[32, "2"]], "8932273": [[43, "36"]], "119856585": [[3, "3512"]], "17407689": [[26, "3063"]], "53132268": [[17, "19"]], "19712034": [[34, "3063"]], "91651323": [[13, "2285"]], "150514472": [[10, "1114"]], "92626683": [[11, "2721"]], "46206836": [[48, "1114"]], "72328191": [[11, "2"]], "46147663": [[23, "1001"]], "9753445": [[4, "1114"]], "57823690": [[5, "1114"]], "14341478": [[3, "3063"]], "99936858": [[9, "2824"]], "4392328": [[1, "1845"]], "14058633": [[37, "2498"]], "3845760": [[16, "857"]], "21391212": [[5, "2425"]], "163898678": [[21, "1845"]], "11122052": [[50, "1001"]], "147233730": [[17, "2285"]], "52604201": [[35, "2824"]], "8765061": [[28, "857"]], "39917424": [[45, "703"]], "6782750": [[2, "2"]], "193853289": [[38, "230"]], "95631566": [[7, "2285"]], "71715579": [[19, "2425"]], "38712949": [[41, "875"]], "50494244": [[1, "2498"]], "82748322": [[7, "3191"]], "46705350": [[31, "2824"]], "154558323": [[39, "9002"]], "68604088": [[36, "230"]], "2186784": [[47, "1651"]], "481109": [[25, "1001"]], "9545147": [[22, "230"]], "54833088": [[19, "1651"]], "14761865": [[5, "3063"]], "63910366": [[28, "1001"]], "10336089": [[46, "703"]], "17119050": [[21, "2"]], "15937987": [[31, "36"]], "9845172": [[46, "9003"]], "36910754": [[22, "857"]], "68094806": [[27, "1651"]], "46138963": [[33, "2721"]], "3791330": [[42, "19"]], "36509233": [[45, "36"]], "70534787": [[37, "2459"]], "159935337": [[20, "1356"]], "65697758": [[14, "703"]], "66167552": [[15, "36"]], "37650107": [[27, "1356"]], "53193024": [[16, "1479"]], "237859085": [[26, "2721"]], "21516086": [[28, "2824"]], "482618": [[19, "1001"]], "192796379": [[50, "9002"]], "124064230": [[39, "2125"]], "58649699": [[46, "1975"]], "11323105": [[40, "1479"]], "133707208": [[48, "2824"]], "49154103": [[34, "2285"]], "52876402": [[47, "1479"]], "2242146": [[17, "496"]], "7539035": [[21, "1252"]], "176336269": [[27, "703"]], "9280807": [[41, "9001"]], "44456889": [[20, "3191"]], "12728456": [[40, "9001"]], "17822759": [[26, "230"]], "45555702": [[20, "230"]], "117311969": [[42, "1651"]], "170997573": [[29, "230"]], "90727410": [[13, "2"]], "47534783": [[8, "9002"]], "35080515": [[33, "9003"]], "138291781": [[44, "2425"]], "6085672": [[38, "1845"]], "51519474": [[50, "1845"]], "11298266": [[1, "3063"]], "191815899": [[25, "1975"]], "107638050": [[7, "2721"]], "60446409": [[23, "496"]], "63872122": [[48, "875"]], "107452512": [[40, "2459"]], "59956663": [[19, "2824"]], "68738047": [[44, "36"]], "146890948": [[23, "703"]], "57466230": [[27, "875"]], "122840480": [[34, "1975"]], "40787086": [[8, "2"]], "39044845": [[24, "36"]], "2484106": [[22, "496"]], "3904043": [[2, "1252"]], "37473819": [[9, "9001"]], "55906910": [[42, "1356"]], "205592679": [[9, "3063"]], "137057068": [[43, "9002"]], "40495936": [[33, "1845"]], "47990641": [[35, "2125"]], "97047333": [[42, "3191"]], "132442884": [[23, "1975"]], "4753056": [[19, "1975"]], "64725155": [[4, "19"]], "179915201": [[16, "1001"]], "46987387": [[35, "1975"]], "2748895": [[48, "2"]], "22306806": [[28, "3063"]], "41816267": [[5, "1252"]], "165345212": [[22, "2721"]], "6329181": [[24, "19"]], "144168816": [[21, "9001"]], "54660342": [[13, "3191"]], "16461350": [[15, "9001"]], "24255405": [[22, "9002"]], "102385300": [[49, "2498"]], "4799123": [[39, "19"]], "2175026": [[14, "1479"]], "12083530": [[19, "9002"]], "63295241": [[8, "2824"]], "20139905": [[18, "2459"]], "19263563": [[2, "857"]], "54493966": [[33, "2459"]], "10155947": [[15, "1651"]], "56007813": [[18, "19"]], "17316407": [[6, "875"]], "55834376": [[12, "3191"]], "8958270": [[5, "496"]], "6634441": [[4, "703"]], "99689868": [[17, "9003"]], "828680": [[15, "1001"]], "120541571": [[1, "1356"]], "44271058": [[11, "9003"]], "234303879": [[20, "2498"]], "2781518": [[13, "1001"]], "68941581": [[28, "3191"]], "4222426": [[7, "2425"]], "17586471": [[15, "372"]], "99083947": [[12, "2285"]], "21215766": [[21, "372"]], "48883709": [[2, "3913"]], "20730690": [[20, "9001"]], "60564387": [[45, "1845"]], "2860030": [[27, "1479"]], "5545764": [[50, "1479"]], "6272336": [[9, "372"]], "38963944": [[25, "230"]], "109434277": [[12, "1252"]], "9489303": [[39, "1001"]], "21348897": [[25, "36"]], "10033950": [[48, "2125"]], "4456304": [[7, "9001"]], "120392844": [[24, "496"]], "47971395": [[24, "372"]], "177181396": [[44, "1975"]], "12252580": [[14, "857"]], "2345093": [[41, "19"]], "127353872": [[13, "1651"]], "236635371": [[13, "2459"]], "196584796": [[7, "3512"]], "43668047": [[27, "2721"]], "57613048": [[39, "1975"]], "4930940": [[12, "496"]], "107871960": [[21, "9003"]], "5188450": [[44, "703"]], "2162773": [[16, "2125"]], "37299990": [[9, "2498"]], "56254390": [[14, "3512"]], "101940123": [[45, "9003"]], "262960": [[3, "2498"]], "920140": [[3, "1651"]], "38850012": [[8, "1356"]], "59344959": [[9, "857"]], "52721796": [[28, "19"]], "36198584": [[50, "19"]], "101674570": [[22, "2459"]], "110994377": [[9, "1114"]], "69706117": [[30, "9003"]], "60709977": [[30, "2498"]], "3932511": [[47, "19"]], "159241252": [[36, "1114"]], "10656599": [[32, "36"]], "10318052": [[37, "1001"]], "14976591": [[30, "857"]], "10760839": [[7, "496"]], "72870816": [[16, "2425"]]}, "3": {"68374185": [[12, "1356"]], "57311015": [[16, "36"]], "34594720": [[3, "2824"]], "55556017": [[16, "2459"]], "33250624": [[4, "2125"]], "31062440": [[11, "1845"]], "71725819": [[12, "2125"]], "52781029": [[4, "-1"], [17, "2125"]], "72011032": [[18, "1975"]], "25860203": [[5, "496"]], "69471187": [[16, "230"]], "70998926": [[2, "3063"]], "21747783": [[11, "9003"]], "52604656": [[5, "1975"]], "73124846": [[8, "875"]], "54624089": [[9, "1845"]], "65500502": [[9, "-1"]], "57716719": [[12, "3063"]], "71503901": [[10, "1001"]], "75602999": [[19, "2824"]], "37611199": [[5, "3391"]], "35409962": [[14, "2459"]], "74281245": [[8, "1252"]], "23887839": [[7, "3391"]], "65915875": [[4, "2824"]], "27504396": [[13, "1114"]], "34807276": [[10, "1845"]], "69228113": [[7, "1114"]], "22857118": [[2, "230"]], "60083415": [[18, "19"]], "31677020": [[20, "2498"]], "21398897": [[18, "36"]], "51703080": [[9, "9003"]], "59424663": [[10, "9001"]], "21288650": [[2, "1001"]], "68256113": [[5, "-1"], [17, "1252"]], "21501919": [[3, "2"]], "63477550": [[14, "1114"]], "69095753": [[9, "496"]], "75594684": [[12, "2824"]], "60820319": [[15, "36"]], "56655804": [[14, "1651"]], "20305152": [[4, "-2"]], "57301965": [[16, "19"]], "32912998": [[10, "36"]], "52362288": [[7, "1001"]], "72758785": [[17, "703"]], "24867103": [[5, "875"]], "71665518": [[6, "19"]], "58942958": [[7, "1252"]], "66994966": [[5, "2824"]], "74575461": [[10, "2824"]], "33839445": [[12, "1114"]], "71158865": [[2, "496"]], "32164273": [[11, "-1"], [13, "703"]], "50417974": [[3, "36"]], "64234735": [[16, "3063"]], "73521248": [[7, "496"]], "72347193": [[14, "9001"]], "72939444": [[8, "9001"]], "73117623": [[7, "2125"]], "71948215": [[16, "2125"]], "24170462": [[17, "625"]], "23141706": [[12, "3391"]], "23646514": [[4, "857"]], "33676156": [[3, "1479"]], "32471901": [[10, "703"]], "35209850": [[8, "2"]], "73960727": [[3, "9003"]], "68491550": [[1, "1356"]], "35269373": [[13, "-1"], [6, "1975"]], "35109279": [[16, "1114"]], "71785767": [[18, "1651"]], "26427088": [[12, "19"]], "55013551": [[19, "1356"]], "31125485": [[10, "1651"]], "65711554": [[10, "1356"]], "56122356": [[18, "857"]], "59659822": [[13, "2498"]], "26544749": [[3, "1845"]], "74581107": [[17, "857"]], "60761923": [[9, "9001"]], "56250407": [[8, "3391"]], "75141066": [[8, "2824"]], "72931023": [[12, "2"]], "51377059": [[12, "9003"]], "58661148": [[10, "857"]], "31387061": [[11, "1479"]], "27778895": [[2, "1651"]], "55444303": [[17, "-1"]], "35687738": [[8, "3063"]], "28292437": [[5, "2125"]], "57961492": [[18, "9003"]], "24730193": [[1, "3063"]], "58413022": [[14, "19"]], "75444204": [[20, "1651"]], "24659315": [[19, "496"]], "72152912": [[10, "230"]], "71747900": [[9, "2824"]], "25533323": [[1, "2459"]], "74958078": [[17, "230"]], "74554160": [[15, "9003"]], "57011589": [[1, "625"]], "59408370": [[19, "1001"]], "32085126": [[20, "2"]], "61030453": [[20, "230"]], "33270318": [[3, "1356"]], "33873382": [[20, "36"]], "53153605": [[11, "2498"]], "26092455": [[13, "625"]], "25546953": [[1, "1479"]], "54329744": [[16, "1845"]], "71410329": [[11, "230"]], "73307295": [[2, "857"]], "29562449": [[15, "3063"]], "74174848": [[7, "9001"]], "23491699": [[6, "875"]], "25335037": [[19, "1114"]], "27176114": [[6, "2"]], "73188698": [[12, "1479"]], "22298536": [[18, "496"]], "22351026": [[18, "-1"]], "59971546": [[18, "2824"]], "75354926": [[19, "3063"]], "30115973": [[14, "2824"]], "24122036": [[4, "9001"]], "53715997": [[7, "2498"]], "25378256": [[16, "-1"], [14, "3391"]], "36563305": [[16, "857"]], "35402134": [[14, "875"]], "71492513": [[2, "875"]], "73091591": [[19, "625"]], "22470031": [[4, "496"]], "66984696": [[1, "496"]], "34198394": [[8, "703"]], "51162536": [[5, "1651"]], "36189447": [[17, "1651"]], "23442682": [[15, "875"]], "31971887": [[3, "2459"]], "23801931": [[19, "3391"]], "65577744": [[7, "9003"]], "23659625": [[20, "857"]], "72047080": [[2, "19"]], "75425635": [[12, "36"]], "31599427": [[6, "2125"]], "23444924": [[5, "1252"]], "25678539": [[9, "1975"]], "31168234": [[15, "9001"]], "64812546": [[15, "625"]], "52145239": [[9, "1479"]], "23418557": [[4, "2498"]], "22018719": [[16, "2"]], "30566233": [[11, "2824"]], "61545687": [[17, "1479"]], "24583106": [[12, "857"]], "74802533": [[11, "1975"]], "53942754": [[4, "1252"]], "65442839": [[6, "3063"]], "21520467": [[13, "19"]], "23106212": [[12, "703"]], "56039509": [[14, "2498"]], "73464271": [[6, "1845"]], "70619832": [[8, "1651"]], "59747901": [[20, "1252"]], "23321417": [[17, "2824"]], "28816142": [[17, "1001"]], "21366326": [[11, "2"]], "58999497": [[4, "1651"]], "23614441": [[15, "496"]], "69726238": [[12, "1975"]], "28468610": [[11, "703"]], "35802724": [[16, "1651"]], "20016399": [[15, "-1"]], "58149615": [[3, "875"]], "51238000": [[6, "857"]], "35379433": [[10, "2125"]], "30642629": [[11, "1252"]], "62030294": [[12, "9001"]], "73724132": [[18, "625"]], "67027956": [[15, "1651"]], "65471025": [[4, "19"]], "67223232": [[18, "1114"]], "51969285": [[5, "230"]], "25336605": [[1, "230"]], "35713135": [[10, "1114"]], "71285234": [[5, "1479"]], "53153635": [[18, "1356"]], "58186185": [[8, "625"]], "61803735": [[4, "1356"]], "24160314": [[8, "9003"]], "51946389": [[3, "2125"]], "50155584": [[4, "1975"]], "72861648": [[2, "1479"]], "67154149": [[2, "1356"]], "73527935": [[11, "1356"]], "30229709": [[2, "2125"]], "24258782": [[9, "2498"]], "50095677": [[12, "875"]], "51754548": [[4, "3063"]], "24920679": [[6, "3391"]], "22676271": [[18, "2498"]], "26700420": [[2, "9001"]], "23337339": [[10, "1252"]], "22688440": [[14, "625"]], "36317381": [[13, "2459"]], "59504317": [[18, "2125"]], "62310884": [[20, "19"]], "65717402": [[19, "857"]], "59248635": [[16, "625"]], "56384852": [[16, "9001"]], "28583198": [[9, "703"]], "51796904": [[7, "625"]], "56716720": [[1, "2125"]], "63484411": [[17, "1975"]], "32877519": [[19, "9003"]], "64013908": [[18, "3063"]], "32512255": [[19, "2459"]], "36997078": [[5, "1356"]], "67722599": [[20, "1114"]], "73519949": [[12, "2459"]], "22673539": [[9, "2125"]], "23038652": [[13, "9003"]], "60521139": [[7, "1975"]], "58575895": [[11, "1001"]], "23727361": [[13, "2125"]], "22315601": [[19, "703"]], "58599448": [[17, "9003"]], "35430248": [[4, "2"]], "31050442": [[12, "496"]], "32478423": [[13, "496"]], "27429045": [[1, "9000"]], "54338104": [[18, "2459"]], "32046379": [[20, "9003"]], "62204136": [[18, "1479"]], "31951021": [[10, "1479"]], "29354776": [[10, "1975"]], "37074119": [[15, "1114"]], "30316237": [[19, "2125"]], "30543384": [[9, "3391"]], "26308390": [[6, "2498"]], "29556552": [[14, "1356"]], "69689119": [[6, "1252"]], "37358352": [[10, "2459"]], "68551662": [[9, "625"]], "63996658": [[19, "2498"]], "50453463": [[5, "9003"]], "72961533": [[17, "1845"]], "69536396": [[20, "3063"]], "21467064": [[17, "3391"]], "69960333": [[13, "2"]], "21415809": [[20, "1001"]], "56370269": [[3, "9001"]], "75185923": [[18, "1001"]], "51984223": [[15, "1356"]], "70121157": [[11, "36"]], "24676110": [[2, "-2"], [2, "1975"]], "28242578": [[1, "-1"]], "23012127": [[5, "9001"]], "59892010": [[7, "19"]], "30327088": [[5, "2"]], "31386817": [[16, "2498"]], "37359856": [[7, "1651"]], "24714201": [[15, "2"]], "27912894": [[3, "230"]], "54752476": [[9, "2"]], "54595445": [[18, "1845"]], "21434575": [[2, "2824"]], "25774976": [[4, "1114"]], "35756155": [[17, "1114"]], "20975684": [[14, "1252"]], "75112238": [[11, "1651"]], "21314561": [[14, "2"]], "53534829": [[2, "2459"]], "50802289": [[10, "3063"]], "65454845": [[6, "703"]], "53946380": [[6, "2824"]], "24119221": [[13, "857"]], "26867986": [[6, "2459"]], "68837466": [[6, "625"]], "36800548": [[3, "1114"]], "32663536": [[7, "36"]], "38026395": [[18, "230"]], "60194368": [[19, "-1"]], "23308343": [[7, "1845"]], "72709296": [[6, "1479"]], "74303953": [[13, "9001"]], "24305478": [[20, "2125"]], "36802569": [[18, "3391"]], "36451932": [[5, "-2"]], "50736493": [[3, "625"]], "53237361": [[15, "2824"]], "36079043": [[3, "19"]], "54922679": [[8, "1114"]], "68727579": [[16, "1356"]], "27518100": [[14, "1975"]], "73555897": [[19, "9001"]], "68664768": [[1, "1114"]], "52468922": [[14, "703"]], "60376475": [[8, "230"]], "33133206": [[9, "3063"]], "61874635": [[1, "36"]], "35273429": [[8, "2125"]], "69784532": [[6, "496"]], "33042890": [[16, "1479"]], "67195812": [[4, "230"]], "37621465": [[5, "3063"]], "55974140": [[6, "1356"]], "53856611": [[15, "1001"]], "59493569": [[14, "36"]], "65174788": [[2, "-1"], [16, "496"]], "21456449": [[15, "2125"]], "73345320": [[14, "496"]], "26641146": [[6, "-1"]], "72988557": [[8, "1001"]], "75129897": [[19, "1845"]], "26987936": [[12, "1252"]], "34538075": [[2, "1252"]], "31867254": [[1, "875"]], "74205613": [[5, "1001"]], "21413621": [[3, "1252"]], "23447597": [[8, "-1"]], "72800376": [[19, "19"]], "62169353": [[15, "1845"]], "73535950": [[9, "1356"]], "29171680": [[7, "230"]], "31354120": [[8, "496"]], "71163788": [[19, "1252"]], "75599755": [[20, "9001"]], "22932865": [[3, "3391"]], "26702598": [[15, "3391"]], "50858264": [[5, "1845"]], "31758484": [[18, "1252"]], "73793566": [[2, "9000"]], "22250183": [[15, "230"]], "59285548": [[13, "1651"]], "70186202": [[15, "19"]], "58202724": [[17, "36"]], "71459657": [[8, "857"]], "64592488": [[6, "9003"]], "35588771": [[4, "2459"]], "27370300": [[5, "19"]], "24655724": [[6, "-2"], [15, "1975"]], "55172207": [[12, "-1"]], "58751097": [[14, "1845"]], "51174007": [[7, "1356"]], "27385920": [[20, "-1"]], "71699602": [[13, "1845"]], "68972357": [[4, "9003"]], "67447118": [[13, "1001"]], "33442626": [[7, "857"]], "71947648": [[15, "1252"]], "30894311": [[15, "703"]], "30561994": [[6, "1114"]], "68335678": [[14, "230"]], "75019822": [[19, "36"]], "33169193": [[20, "2459"]], "55755983": [[10, "625"]], "23571572": [[1, "19"]], "23725470": [[11, "3063"]], "29659862": [[14, "857"]], "22676417": [[12, "1001"]], "51213930": [[2, "1114"]], "72780102": [[4, "36"]], "71330091": [[13, "2824"]], "65187291": [[5, "857"]], "75038486": [[3, "2498"]], "24087808": [[2, "703"]], "58036381": [[5, "1114"]], "51747924": [[12, "625"]], "68151281": [[11, "857"]], "30597155": [[6, "230"]], "70907673": [[4, "875"]], "23730705": [[13, "3391"]], "23718962": [[14, "-1"], [3, "-2"]], "69141171": [[1, "9001"]], "30280267": [[2, "2498"]], "52686564": [[7, "2"]], "58075256": [[7, "703"]], "30186292": [[11, "2459"]], "23971060": [[15, "2498"]], "50744663": [[15, "2459"]], "75021034": [[4, "9000"]], "52791160": [[18, "2"]], "75335033": [[16, "875"]], "23392053": [[3, "1651"]], "54465758": [[16, "1001"]], "32300723": [[9, "857"]], "21503883": [[1, "3391"]], "29668198": [[9, "230"]], "35194022": [[10, "9003"]], "26730595": [[3, "3063"]], "26932520": [[17, "2459"]], "52731692": [[11, "9001"]], "73211488": [[10, "3391"]], "37962650": [[3, "1001"]], "55414534": [[5, "2498"]], "23538405": [[15, "1479"]], "50982261": [[16, "1252"]], "52558387": [[13, "875"]], "73142423": [[13, "1479"]], "30942999": [[1, "857"]], "74993632": [[16, "3391"]], "55785711": [[1, "703"]], "23599482": [[8, "1356"]], "71315204": [[12, "2498"]], "53534299": [[19, "2"]], "29383123": [[20, "1479"]], "61068944": [[8, "19"]], "22151882": [[16, "2824"]], "29668867": [[6, "1001"]], "35342880": [[5, "36"]], "56407552": [[8, "2459"]], "36980100": [[8, "1845"]], "66635120": [[11, "19"]], "60874412": [[4, "703"]], "34866667": [[18, "875"]], "67204312": [[17, "1356"]], "37422234": [[18, "703"]], "21346931": [[7, "1479"]], "28611030": [[4, "625"]], "68366290": [[19, "230"]], "51895519": [[17, "2498"]], "52382697": [[17, "875"]], "59119835": [[5, "625"]], "60910140": [[4, "1001"]], "37595625": [[6, "36"]], "35076613": [[11, "2125"]], "28782271": [[8, "2498"]], "37406875": [[13, "3063"]], "37592919": [[17, "2"]], "67850994": [[12, "1651"]], "55642672": [[12, "230"]], "59553802": [[11, "496"]], "25526236": [[1, "1651"]], "74660436": [[1, "2824"]], "37470835": [[16, "703"]], "37311325": [[7, "-1"]], "61794910": [[15, "857"]], "70210003": [[17, "3063"]], "24542557": [[13, "230"]], "73235996": [[2, "9003"]], "37073395": [[1, "-2"], [19, "1975"]], "70183879": [[19, "1651"]], "21801311": [[14, "1479"]], "35294703": [[7, "2824"]], "23929814": [[9, "1252"]], "73294397": [[4, "1845"]], "57015079": [[6, "9001"]], "32378690": [[7, "3063"]], "28049353": [[1, "9003"]], "27312862": [[10, "2498"]], "26534151": [[2, "3391"]], "74915185": [[5, "2459"]], "24158735": [[9, "875"]], "72750346": [[5, "703"]], "64241808": [[1, "2498"]], "23964295": [[8, "1479"]], "57145827": [[16, "9003"]], "72972877": [[8, "36"]], "35172684": [[10, "2"]], "75371659": [[10, "19"]], "37319349": [[10, "-1"]], "72498598": [[17, "19"]], "61749798": [[8, "1975"]], "73167355": [[1, "1975"]], "27239674": [[9, "36"]], "52887419": [[9, "1114"]], "69787291": [[1, "1001"]], "32081727": [[7, "2459"]], "74581585": [[3, "703"]], "59795464": [[9, "2459"]], "35095260": [[3, "-1"], [2, "1845"]], "75452492": [[7, "875"]], "65715354": [[13, "1975"]], "51883043": [[3, "857"]], "30971467": [[2, "36"]], "37512514": [[3, "496"]], "21876364": [[11, "625"]], "58741791": [[1, "1845"]], "23603037": [[14, "1001"]], "25707859": [[2, "625"]], "60861904": [[14, "3063"]], "32018115": [[9, "1651"]], "71514484": [[17, "9001"]], "29472368": [[12, "1845"]], "26106798": [[14, "2125"]], "23664847": [[17, "496"]], "54512292": [[9, "1001"]], "53525397": [[13, "1356"]], "57410018": [[1, "1252"]], "21344239": [[13, "36"]], "73619925": [[11, "875"]], "21437866": [[3, "9000"]], "72577657": [[4, "1479"]], "37567246": [[11, "3391"]], "58616540": [[11, "1114"]], "75041819": [[14, "9003"]], "75603168": [[18, "9001"]], "69252405": [[6, "1651"]], "59793540": [[3, "1975"]], "68115125": [[9, "19"]], "21491770": [[2, "2"]], "26979430": [[10, "875"]], "71307994": [[13, "1252"]], "74561363": [[10, "496"]], "33660105": [[4, "3391"]], "52619858": [[16, "1975"]], "53085677": [[19, "1479"]]}, "7": {}}';
       // echo $tops;
        $topslist = json_decode($tops,true);  //热榜的排行

        $hotinfo = array();
        foreach ($topslist[$platform] as $key =>$value){      // -1为热门  -2 为推荐  其他为省排行
            if(($key == $userid)){
                foreach ($value as $keys =>$values) {
                    if( count($values)>1) {
                        switch($values[1]){
                            case '-1':  array_push($hotinfo, [$values[$keys] => "-1"] ); break;
                            case '-2':  array_push($hotinfo, [$values[$keys] => "-2"] ); break;
                            default:
                                $livecity = $this->getcityid($values[1], $citymini);
                                array_push($hotinfo, [$values[$keys] => $livecity]); break;


                        }

                    }




//                        if ($values[$keys] == '-1') {
//
//                            array_push($hotinfo, [$values[$keys-1] => "-1"]);
//                        } else if ($values[$keys] == '-2') {
//
//                            array_push($hotinfo, [$values[$keys-1] => "-2"]);
//                        } else if(isset( $values[$keys+1])) {
//                            $city = $values[$keys+1];
//
//                            $livecity = $this->getcityid($platform, $city, $citymini);
//
//                            array_push($hotinfo, [$values[$keys] => $livecity]);
//                        }
                    }
                }
        }
        echo json_encode($hotinfo);

    }


    public function getcityid($citystr,$citymini){
           foreach ($citymini as $key =>$value){

               if((int)$citystr ==(int)$value){
                   return    $key;
               }
           }
        }


          public function t(){
              $connect = new Memcached;
              $connect->setOption(Memcached::OPT_COMPRESSION, false);
              $connect->setOption(Memcached::OPT_BINARY_PROTOCOL, true);
              $connect->addServer('60.205.105.239', 11211);
              $tops = $connect->get("Tops");
              echo $tops; exit;
              $result = DB::select("SELECT id,province,city FROM `city_mini`");
              $lenght = count($result);
              $citymini = array();
              for($i=0;$i<$lenght;$i++){
                  if(isset($result[0]->city)){
                      $citymini[$result[$i]->city] = (int)$result[$i]->id;
                  }
                  if(isset($result[0]->province)){
                      $citymini[$result[$i]->province] = (int)$result[$i]->id;
                  }
              }
            $userid = 30255178;
//              $userid=12055037;
        $platform = 3;
             $tops='{"1": {"12055037": [[9, "372"]], "52148095": [[16, "9003"]], "8857180": [[22, "372"]], "49931498": [[5, "1356"]], "57180366": [[17, "2425"]], "88545004": [[36, "9003"]], "44615885": [[6, "1252"]], "113294673": [[45, "875"]], "40181076": [[6, "3512"]], "59829192": [[25, "1975"]], "236613095": [[43, "2721"]], "112026891": [[43, "1975"]], "92626267": [[47, "2"]], "170588762": [[16, "2459"]], "68037356": [[24, "1651"]], "6120764": [[31, "19"]], "181287922": [[4, "3512"]], "49916849": [[26, "703"]], "4318640": [[5, "9001"]], "50680758": [[32, "1651"]], "55543656": [[26, "2125"]], "101638283": [[46, "1252"]], "103271002": [[44, "2125"]], "3764247": [[26, "2824"]], "62166905": [[12, "496"]], "9254512": [[7, "2"]], "15837334": [[20, "2"]], "176406511": [[3, "3191"]], "56029643": [[32, "857"]], "5423355": [[19, "1479"]], "13840991": [[28, "2425"]], "178454592": [[26, "1356"]], "131008452": [[8, "2824"]], "10203907": [[48, "9002"]], "61836571": [[34, "9001"]], "211875049": [[23, "2285"]], "6403814": [[34, "9002"]], "59025116": [[34, "3063"]], "59012663": [[47, "372"]], "58159197": [[45, "3191"]], "60326041": [[49, "1651"]], "55065306": [[44, "1479"]], "13971700": [[42, "9002"]], "41015145": [[42, "3191"]], "3113923": [[3, "703"]], "238682301": [[10, "3512"]], "3224151": [[18, "496"]], "14162379": [[29, "230"]], "69396223": [[35, "1001"]], "131379717": [[23, "1001"]], "9278394": [[14, "496"]], "49882696": [[41, "3063"]], "179710947": [[40, "1114"]], "6889873": [[6, "2"]], "43800411": [[31, "1356"]], "17167480": [[45, "1001"]], "23889641": [[48, "1252"]], "39090342": [[27, "1001"]], "115403704": [[3, "2425"]], "129202879": [[14, "3191"]], "68565456": [[8, "9001"]], "175559317": [[21, "2459"]], "11844863": [[44, "2"]], "37164683": [[19, "1001"]], "60767141": [[43, "2425"]], "138986843": [[22, "2459"]], "2906604": [[9, "1252"]], "118409148": [[38, "9001"]], "2385032": [[23, "9003"]], "237499065": [[17, "857"]], "191710178": [[39, "1252"]], "15298160": [[49, "2"]], "51673014": [[3, "1252"]], "10363304": [[26, "857"]], "115291362": [[21, "2824"]], "85720334": [[44, "9002"]], "7222582": [[8, "857"]], "69996559": [[12, "1845"]], "53193261": [[4, "9003"]], "44243208": [[46, "1479"]], "43279244": [[4, "2285"]], "56622007": [[4, "1114"]], "17297611": [[2, "372"]], "80517841": [[26, "2459"]], "8355111": [[7, "9001"]], "107818634": [[32, "2824"]], "120326357": [[48, "3063"]], "7630136": [[12, "2"]], "204185014": [[34, "1356"]], "11052851": [[49, "19"]], "6186174": [[40, "2824"]], "17955316": [[16, "372"]], "35285538": [[17, "9003"]], "159581014": [[16, "1114"]], "67597423": [[19, "2498"]], "7058278": [[50, "1651"]], "7575590": [[13, "9001"]], "72951205": [[39, "3191"]], "16716693": [[3, "1356"]], "178499210": [[13, "2721"]], "4230322": [[6, "9003"]], "36564651": [[45, "3063"]], "111642809": [[14, "9003"]], "113497114": [[49, "1114"]], "20192718": [[50, "2824"]], "63568640": [[11, "230"]], "286933": [[28, "1001"]], "2051045": [[4, "9001"]], "138460101": [[41, "2425"]], "82423699": [[31, "230"]], "80001908": [[32, "372"]], "114112642": [[9, "2459"]], "91324366": [[27, "1845"]], "10416132": [[44, "703"]], "47687000": [[43, "230"]], "119125631": [[4, "496"]], "23284987": [[18, "875"]], "54970835": [[42, "1651"]], "56280443": [[3, "2"]], "35302264": [[16, "2721"]], "135870490": [[10, "19"]], "41035506": [[49, "703"]], "8566124": [[22, "1651"]], "3677902": [[37, "496"]], "84928315": [[15, "3063"]], "97353284": [[13, "1975"]], "59908140": [[38, "1479"]], "176764959": [[25, "19"]], "7264132": [[4, "36"]], "212190473": [[29, "2721"]], "35952651": [[23, "372"]], "63946172": [[49, "230"]], "47500017": [[16, "1479"]], "116778736": [[33, "857"]], "140880690": [[17, "1001"]], "90792161": [[42, "3063"]], "2587739": [[1, "1845"]], "2186427": [[9, "1001"]], "228023215": [[46, "2721"]], "235893181": [[49, "36"]], "124528425": [[50, "19"]], "70362335": [[50, "1252"]], "14348232": [[35, "496"]], "91588084": [[39, "3063"]], "54133658": [[26, "19"]], "144264244": [[22, "1845"]], "2544761": [[1, "3512"]], "38173315": [[25, "3063"]], "11816182": [[12, "230"]], "56535197": [[46, "2459"]], "98951645": [[47, "3191"]], "80776000": [[3, "1975"]], "192487095": [[7, "1975"]], "8572086": [[4, "1252"]], "234322186": [[44, "2459"]], "53783580": [[37, "3191"]], "205292774": [[31, "372"]], "9710822": [[28, "1479"]], "113997282": [[44, "1114"]], "68168364": [[28, "1845"]], "12188638": [[49, "3191"]], "19304512": [[41, "9003"]], "70249209": [[46, "9003"]], "167035578": [[10, "3191"]], "117701794": [[21, "1975"]], "69715571": [[44, "2498"]], "226781453": [[3, "3512"]], "18103601": [[47, "1845"]], "106026454": [[26, "2285"]], "39088482": [[44, "3063"]], "131263763": [[25, "1001"]], "45950369": [[47, "230"]], "59609932": [[4, "19"]], "8518014": [[25, "875"]], "117087617": [[18, "1651"]], "52569807": [[39, "9002"]], "172098650": [[42, "2285"]], "226505940": [[10, "1114"]], "4373371": [[12, "36"]], "153987967": [[26, "1845"]], "225471767": [[49, "9002"]], "7328606": [[19, "2"]], "10399624": [[40, "19"]], "10067307": [[2, "3891"]], "46255182": [[9, "3512"]], "135755464": [[23, "2425"]], "46902935": [[27, "372"]], "59465566": [[12, "2425"]], "3222109": [[39, "9003"]], "12468292": [[48, "2498"]], "188605873": [[14, "9002"]], "54213484": [[1, "3891"]], "66808222": [[14, "2285"]], "82220021": [[45, "9002"]], "58403315": [[5, "1845"]], "40181492": [[7, "1114"]], "101325108": [[49, "2425"]], "4206613": [[14, "19"]], "178638616": [[38, "2"]], "21055107": [[12, "1252"]], "11006248": [[27, "3191"]], "66712315": [[27, "230"]], "87504734": [[49, "2498"]], "35516655": [[8, "1479"]], "1916018": [[1, "2721"]], "129786803": [[29, "2425"]], "34661323": [[14, "1651"]], "69811530": [[27, "9002"]], "12733457": [[11, "875"]], "37437301": [[4, "2425"]], "45028451": [[35, "1845"]], "67403200": [[15, "875"]], "34959814": [[9, "2721"]], "69650975": [[28, "2824"]], "106307619": [[29, "2459"]], "129922339": [[42, "2125"]], "37598068": [[6, "496"]], "17919827": [[6, "230"]], "152252243": [[33, "2459"]], "14111126": [[48, "19"]], "9782061": [[30, "372"]], "14050702": [[27, "2498"]], "7796998": [[10, "36"]], "80139340": [[24, "36"]], "37233892": [[15, "1001"]], "44181482": [[50, "372"]], "54975657": [[35, "230"]], "7510007": [[42, "9003"]], "2775237": [[45, "36"]], "114282367": [[33, "2425"]], "73958679": [[27, "9001"]], "75076676": [[47, "1479"]], "51587596": [[34, "230"]], "145881981": [[25, "1114"]], "1922167": [[3, "9001"]], "149227786": [[24, "2721"]], "110624753": [[36, "1252"]], "31547278": [[12, "372"]], "4956063": [[1, "703"]], "72806434": [[28, "1356"]], "39480161": [[48, "372"]], "70925798": [[22, "36"]], "50693592": [[40, "2498"]], "219080546": [[17, "372"]], "31743286": [[16, "2498"]], "11063267": [[25, "2824"]], "57566762": [[35, "2721"]], "12726125": [[15, "1479"]], "10027491": [[23, "875"]], "14254223": [[35, "1975"]], "231560727": [[37, "1356"]], "162985873": [[32, "9001"]], "15252153": [[16, "2125"]], "228016978": [[25, "857"]], "10693376": [[25, "496"], [33, "9003"]], "169863740": [[34, "2125"]], "134504652": [[6, "1479"]], "128100226": [[20, "2125"]], "9028691": [[31, "2824"]], "35752739": [[8, "2459"]], "182872486": [[50, "857"]], "25490481": [[33, "19"]], "10912028": [[32, "36"]], "155055002": [[4, "1651"]], "46469938": [[3, "857"]], "14687367": [[31, "1001"]], "156984614": [[27, "1356"]], "206475175": [[38, "2498"]], "82883181": [[31, "1114"]], "5837669": [[6, "857"]], "115576547": [[45, "1845"]], "226093848": [[25, "2125"]], "11217592": [[5, "496"]], "12793709": [[43, "857"]], "97627446": [[17, "19"]], "16040733": [[43, "1356"]], "146268007": [[29, "2824"]], "4466522": [[32, "1479"]], "8777798": [[34, "36"]], "80516023": [[2, "9002"]], "86957005": [[42, "2824"]], "147344075": [[40, "9001"]], "15238416": [[21, "372"]], "37435556": [[9, "3191"]], "234913659": [[40, "703"]], "55785712": [[36, "2125"]], "99820835": [[39, "1975"]], "67001860": [[6, "1114"]], "53441945": [[46, "9001"]], "56696443": [[50, "875"]], "98527892": [[25, "2285"]], "8478268": [[20, "9003"]], "3996718": [[11, "9003"]], "140130383": [[12, "1479"]], "8762096": [[30, "496"]], "105643344": [[40, "875"]], "15143920": [[33, "1651"]], "12930406": [[41, "1001"]], "16490144": [[4, "2824"]], "66185729": [[7, "1845"]], "155053112": [[7, "2425"]], "53682619": [[12, "2824"]], "175275582": [[43, "3191"]], "1791178": [[37, "2498"]], "45194202": [[31, "3191"]], "161753989": [[39, "1651"]], "182022947": [[45, "2498"]], "55022687": [[38, "2125"]], "5714648": [[16, "857"]], "5307423": [[2, "1651"]], "14789782": [[25, "372"]], "14767005": [[21, "2125"]], "5360447": [[29, "372"]], "66120247": [[47, "857"]], "14718726": [[47, "875"]], "54270771": [[48, "1845"]], "7150880": [[38, "1651"]], "70043230": [[19, "703"]], "55265870": [[5, "875"]], "6777402": [[30, "2"]], "191200106": [[8, "1114"]], "38721405": [[17, "3063"]], "43066701": [[39, "2498"]], "184930122": [[24, "3063"]], "203910928": [[39, "703"]], "38952690": [[5, "1001"]], "4870144": [[23, "2459"]], "3661679": [[2, "1114"]], "7883943": [[50, "703"]], "18160507": [[47, "2285"]], "31439358": [[2, "1001"]], "41058170": [[50, "1114"]], "54370470": [[16, "230"]], "238503964": [[17, "2125"]], "236105689": [[6, "1356"]], "5759210": [[47, "496"]], "3750696": [[3, "36"]], "146604521": [[32, "2285"]], "36180422": [[27, "3063"]], "141646397": [[34, "2285"]], "15738907": [[35, "1252"]], "177021454": [[20, "1975"]], "121679803": [[31, "2425"]], "64835392": [[31, "9003"]], "62474214": [[34, "2498"]], "88484616": [[31, "9001"]], "46383150": [[39, "36"]], "145297044": [[20, "1356"]], "55881533": [[21, "857"]], "9139263": [[19, "875"]], "49247470": [[25, "2459"]], "16856439": [[36, "230"]], "235146573": [[19, "2721"]], "10592203": [[20, "2425"]], "140297477": [[9, "1356"]], "19923293": [[22, "1975"]], "1028352": [[43, "1651"]], "18093968": [[17, "1845"]], "11460144": [[36, "1845"]], "142814514": [[40, "1651"]], "46440008": [[15, "857"]], "39154441": [[43, "2824"]], "82979022": [[24, "1114"]], "178112789": [[36, "2285"]], "104127788": [[35, "1114"]], "39109724": [[44, "19"]], "10359349": [[18, "3063"]], "60806655": [[32, "2425"]], "53897876": [[45, "2425"]], "92631938": [[30, "9001"]], "20819994": [[48, "9001"]], "119876897": [[16, "2285"]], "51330755": [[45, "1479"]], "9827756": [[3, "1845"]], "67942053": [[38, "9002"]], "6369148": [[7, "1479"]], "9926722": [[21, "1356"]], "11336672": [[20, "36"]], "3590038": [[21, "9003"]], "81401486": [[32, "1845"]], "2727133": [[8, "3063"]], "58935077": [[48, "703"]], "35269977": [[41, "2"]], "6733076": [[20, "857"]], "979395": [[21, "230"]], "2725814": [[19, "3063"]], "59819704": [[28, "3063"]], "5328843": [[37, "2"]], "4069103": [[12, "3063"]], "214980670": [[18, "2459"]], "70257711": [[38, "9003"]], "53504827": [[6, "2498"]], "238660292": [[36, "9001"]], "3635937": [[10, "9002"]], "51425962": [[33, "1479"]], "235019925": [[39, "1356"]], "21019314": [[19, "857"]], "203884726": [[25, "1651"]], "37524248": [[9, "19"]], "2214915": [[1, "1479"]], "225310849": [[31, "2498"]], "56656201": [[40, "1975"]], "199351563": [[4, "2459"]], "55575967": [[40, "2125"]], "38164652": [[31, "2"]], "9367131": [[43, "1845"]], "190822509": [[19, "3191"]], "65415617": [[17, "1651"]], "50690700": [[47, "9002"]], "7175451": [[13, "1001"]], "97806404": [[38, "857"]], "119878619": [[2, "875"]], "110247310": [[18, "1845"]], "103410382": [[48, "1975"]], "55628708": [[43, "2498"]], "85571926": [[20, "2459"]], "177324376": [[44, "2721"]], "144077070": [[29, "1651"]], "41350299": [[43, "372"]], "12250168": [[45, "2285"]], "107369662": [[16, "1356"]], "2512772": [[1, "2459"]], "4254795": [[34, "496"]], "46046083": [[6, "703"]], "93009425": [[22, "2824"]], "148930218": [[42, "857"]], "13059363": [[35, "3063"]], "16596159": [[46, "875"]], "42958387": [[20, "2498"]], "17863686": [[15, "1651"]], "354384": [[16, "1651"]], "72895185": [[41, "2459"]], "41438991": [[5, "3063"]], "19705650": [[11, "1651"]], "16652765": [[2, "1845"]], "3309488": [[27, "496"]], "4303453": [[14, "703"]], "119849704": [[1, "875"]], "236174264": [[36, "2425"]], "34493837": [[28, "703"]], "53993026": [[5, "2459"]], "11121022": [[21, "9001"]], "60804061": [[50, "1845"]], "72322692": [[30, "36"]], "53330790": [[10, "9001"]], "51134707": [[38, "372"]], "51405481": [[49, "2459"]], "52629694": [[10, "2498"]], "74584143": [[13, "1356"]], "63865787": [[23, "2125"]], "93651138": [[46, "36"]], "143913554": [[29, "1975"]], "9888013": [[11, "1252"]], "12900190": [[43, "9003"]], "13851292": [[49, "1479"]], "7064156": [[12, "9001"]], "49510956": [[29, "1001"]], "34998400": [[32, "2"]], "2955015": [[27, "1479"]], "2316542": [[35, "9002"]], "5170740": [[34, "372"]], "17445035": [[1, "3063"]], "15389593": [[13, "703"]], "49862170": [[25, "2721"]], "135156727": [[9, "496"]], "12410085": [[46, "2498"]], "104853970": [[5, "857"]], "52350254": [[30, "3191"]], "98373159": [[41, "2824"]], "125128016": [[17, "1975"]], "51707502": [[39, "875"]], "40024982": [[21, "36"]], "19166479": [[38, "2425"]], "236174687": [[36, "2721"]], "68383475": [[21, "1114"]], "3269162": [[44, "9001"]], "69752879": [[20, "1651"]], "2299064": [[22, "1479"]], "48868952": [[37, "1845"]], "6801944": [[12, "703"]], "218462265": [[35, "1651"]], "200424938": [[24, "1975"]], "38747398": [[7, "3191"]], "142860471": [[41, "2285"]], "57358266": [[50, "9003"]], "7148014": [[48, "2"]], "86613287": [[7, "703"]], "9524893": [[49, "9003"]], "64140770": [[7, "2459"]], "127784449": [[45, "1356"]], "10906149": [[2, "9003"]], "43476081": [[11, "372"]], "49263184": [[50, "1975"]], "53303112": [[14, "3512"]], "7311868": [[29, "19"]], "8369589": [[17, "2824"]], "236775095": [[46, "9002"]], "36003690": [[10, "2459"]], "36876289": [[15, "2125"]], "12207461": [[40, "1845"]], "145309986": [[30, "19"]], "100601219": [[29, "2498"]], "85815841": [[27, "9003"]], "9924159": [[3, "2459"]], "140785923": [[24, "496"]], "5381170": [[25, "1479"]], "56109272": [[43, "875"]], "8794160": [[16, "9001"]], "44523276": [[28, "2459"]], "26912132": [[5, "2824"]], "103321182": [[29, "875"]], "15033960": [[5, "372"]], "9850946": [[36, "3191"]], "88468667": [[3, "3891"]], "3116430": [[13, "2"]], "149273304": [[28, "1975"]], "16600470": [[47, "2125"]], "220340175": [[7, "9002"]], "4529321": [[16, "3191"]], "3258057": [[11, "3512"]], "45530664": [[50, "2125"]], "3543025": [[21, "1845"]], "65070564": [[37, "230"]], "51458485": [[40, "1252"]], "35416884": [[7, "1001"]], "7494366": [[37, "372"]], "60071461": [[48, "2125"]], "3398817": [[2, "857"]], "150006105": [[23, "36"]], "53765609": [[22, "2425"]], "2235762": [[10, "2"]], "59046750": [[25, "230"]], "112771785": [[37, "1651"]], "21313932": [[49, "3063"]], "9762355": [[11, "2425"]], "207792632": [[46, "1975"]], "152392266": [[50, "2459"]], "67171643": [[37, "875"]], "11649509": [[41, "19"]], "15537077": [[17, "496"]], "6519873": [[13, "496"]], "85273024": [[19, "2425"]], "9594343": [[21, "2498"]], "17971988": [[3, "2285"]], "49764310": [[15, "1975"]], "145630958": [[9, "2498"]], "191576880": [[39, "230"]], "140956033": [[40, "9002"]], "65042163": [[14, "857"]], "69518136": [[22, "2721"]], "23499073": [[45, "2721"]], "17993346": [[33, "2498"]], "168838896": [[15, "2721"]], "45452004": [[46, "19"]], "15232318": [[8, "703"]], "8090055": [[36, "372"]], "12176137": [[45, "9003"]], "54184016": [[46, "3191"]], "159497517": [[33, "1252"]], "4995273": [[3, "2824"]], "92408174": [[34, "2459"]], "3906380": [[40, "496"]], "8016989": [[40, "9003"]], "85502654": [[12, "1001"]], "116444572": [[1, "2425"]], "9426594": [[42, "372"]], "60741271": [[3, "2498"]], "101757146": [[15, "1252"]], "6791263": [[23, "2"]], "80439188": [[22, "875"]], "83691340": [[23, "230"]], "95193371": [[46, "1356"]], "11609118": [[24, "2498"]], "7797781": [[14, "9001"]], "34315805": [[49, "372"]], "5934916": [[11, "9002"]], "9799690": [[14, "2425"]], "12285886": [[3, "372"]], "11456348": [[4, "2"]], "46783894": [[36, "2824"]], "12878255": [[16, "2"]], "49943498": [[16, "1975"]], "169402712": [[24, "9003"]], "11481054": [[43, "1479"]], "63524905": [[13, "372"]], "54560776": [[18, "9002"]], "18069013": [[8, "230"]], "64228531": [[28, "9001"]], "5217905": [[11, "857"]], "56785265": [[29, "496"]], "54706506": [[26, "1651"]], "36057531": [[11, "1356"]], "55904057": [[42, "1975"]], "226484310": [[42, "2459"]], "9427428": [[26, "372"]], "223160150": [[36, "1356"]], "56099321": [[19, "9001"]], "153004841": [[23, "2498"]], "36112650": [[13, "857"]], "1661610": [[7, "36"]], "17244294": [[38, "1001"]], "58927186": [[23, "1845"]], "116396210": [[10, "1479"]], "7643064": [[10, "703"]], "400725862": [[46, "1845"]], "196508279": [[17, "1479"]], "48991748": [[13, "9003"]], "2850754": [[5, "2"]], "123579071": [[12, "1975"]], "15189483": [[21, "2425"]], "7071483": [[46, "857"]], "32730746": [[46, "372"]], "18713574": [[4, "3191"]], "229198137": [[12, "9002"]], "15951139": [[8, "1975"]], "56328642": [[33, "875"]], "33442435": [[18, "2425"]], "38638206": [[34, "1479"]], "56680356": [[3, "1001"]], "47842580": [[40, "2459"]], "212688639": [[5, "2125"]], "36685829": [[27, "857"]], "60615400": [[5, "1252"]], "124540966": [[10, "3891"]], "69559126": [[46, "2"]], "3867669": [[42, "875"]], "80164403": [[32, "703"]], "117547649": [[2, "3913"]], "25634903": [[9, "2285"]], "2421421": [[21, "19"]], "104905579": [[11, "2285"]], "195410153": [[33, "9001"]], "421742": [[9, "3891"]], "63337035": [[14, "2824"]], "3569797": [[40, "1479"]], "59400664": [[48, "1356"]], "19290039": [[10, "857"]], "131373462": [[30, "2425"]], "7173236": [[3, "1651"]], "59626871": [[19, "1356"]], "35524421": [[5, "3512"]], "112777890": [[3, "9002"]], "21794870": [[8, "2721"]], "21072156": [[34, "1975"]], "51765661": [[32, "2125"]], "56441806": [[48, "2459"]], "56310219": [[32, "1114"]], "17946912": [[26, "230"]], "30983564": [[50, "9001"]], "103716320": [[24, "1845"]], "38562994": [[27, "1651"]], "195440471": [[14, "875"]], "46863002": [[2, "2125"]], "44293913": [[47, "1975"]], "4662767": [[2, "9001"]], "29711972": [[31, "1651"]], "203257965": [[31, "2721"]], "14488889": [[28, "230"]], "5354341": [[31, "496"]], "23432675": [[32, "3063"]], "11630591": [[46, "1114"]], "147392237": [[8, "2285"]], "48939873": [[34, "703"]], "2843522": [[9, "230"]], "219295338": [[26, "2721"]], "7503009": [[39, "857"]], "50616103": [[13, "1845"]], "7924629": [[47, "2824"]], "47093355": [[9, "703"]], "5978458": [[1, "2125"]], "41058856": [[38, "3063"]], "57005905": [[1, "1114"]], "7874805": [[43, "496"]], "15296549": [[40, "230"]], "129853429": [[38, "2285"]], "37894870": [[15, "2498"]], "29771464": [[43, "2125"]], "4389409": [[47, "703"]], "7755523": [[1, "496"]], "51108026": [[12, "19"]], "3238481": [[4, "3063"]], "85163334": [[9, "1975"]], "146761421": [[25, "9002"]], "46204580": [[37, "1975"]], "171121328": [[28, "9002"]], "47373527": [[38, "2459"]], "18417006": [[31, "2285"]], "80194325": [[48, "875"]], "5567269": [[41, "372"]], "6402952": [[1, "1975"]], "10207607": [[43, "36"]], "149399530": [[36, "2459"]], "7684357": [[50, "496"]], "162615892": [[28, "857"]], "93151732": [[2, "1252"]], "154861498": [[17, "9001"]], "8138770": [[8, "2125"]], "19724411": [[44, "3191"]], "7611425": [[15, "9001"]], "16628185": [[10, "1001"]], "42213820": [[47, "1001"]], "56175708": [[20, "230"]], "72993217": [[41, "230"]], "68543292": [[33, "1114"]], "7614234": [[18, "1356"]], "60863861": [[6, "3191"]], "52600950": [[20, "9001"]], "3856469": [[8, "2"]], "138140632": [[17, "2721"]], "117066510": [[44, "1845"]], "80892163": [[24, "1479"]], "113269527": [[24, "3191"]], "3039514": [[30, "9002"]], "71685440": [[15, "36"]], "231304190": [[24, "2285"]], "131696721": [[3, "230"]], "6088525": [[3, "19"]], "84995545": [[38, "875"]], "1979560": [[32, "496"]], "11405704": [[30, "1651"]], "115695207": [[32, "3191"]], "15587288": [[4, "2498"]], "10506341": [[7, "3512"]], "41241158": [[24, "372"]], "2454806": [[47, "3063"]], "12758129": [[42, "2"]], "65837849": [[34, "2"]], "7992976": [[18, "230"]], "7602589": [[1, "3191"]], "10240205": [[5, "1975"]], "3554670": [[19, "496"]], "47086616": [[45, "372"]], "5587962": [[22, "9003"]], "5996866": [[35, "2824"]], "59387297": [[35, "36"]], "35625143": [[28, "36"]], "20140326": [[23, "1252"]], "13933336": [[19, "36"]], "22255143": [[36, "875"]], "34910974": [[39, "2"]], "18846177": [[38, "1356"]], "55003262": [[38, "1114"]], "55910986": [[6, "3063"]], "61682327": [[23, "1975"]], "6748972": [[26, "2"]], "2470599": [[15, "703"]], "20858811": [[42, "1001"]], "209509983": [[39, "1001"]], "2833259": [[6, "9001"]], "155432230": [[12, "2721"]], "176539665": [[3, "2721"]], "3227675": [[8, "496"]], "64486490": [[28, "1114"]], "55164738": [[12, "2285"]], "9991512": [[4, "2125"]], "40936299": [[13, "2459"]], "25567048": [[47, "19"]], "192004537": [[37, "9001"]], "101270659": [[42, "2721"]], "2991529": [[42, "230"]], "147165762": [[27, "2824"]], "72810205": [[30, "2459"]], "17356104": [[17, "1252"]], "5335112": [[6, "1001"]], "58264217": [[48, "230"]], "2052417": [[30, "1975"]], "39477825": [[27, "2"]], "94110621": [[37, "857"]], "88270711": [[33, "703"]], "29423004": [[6, "875"]], "98385303": [[16, "19"]], "199241634": [[26, "875"]], "49134303": [[18, "2285"]], "135704822": [[8, "3512"]], "2388597": [[8, "1001"]], "16747598": [[10, "1252"]], "62299889": [[42, "2498"]], "2287831": [[26, "2498"]], "2726530": [[24, "19"]], "58019694": [[15, "19"]], "927096": [[32, "1356"]], "31370266": [[27, "2425"]], "39481190": [[16, "2824"]], "11011053": [[37, "2285"]], "131234654": [[19, "1975"]], "11878901": [[48, "496"]], "67366626": [[27, "875"]], "104897609": [[37, "3063"]], "123902309": [[36, "1975"]], "51693893": [[17, "230"]], "4029256": [[1, "372"]], "46966038": [[38, "230"]], "60333205": [[33, "1001"]], "66900664": [[4, "2721"]], "2617087": [[49, "1356"]], "38402402": [[15, "2824"]], "8406831": [[32, "9002"]], "15949851": [[30, "3063"]], "98166310": [[39, "19"]], "5143276": [[43, "19"]], "166259239": [[40, "3191"]], "3332696": [[26, "496"]], "8378747": [[12, "9003"]], "66531715": [[16, "1252"]], "31308476": [[20, "3063"]], "10091416": [[28, "1651"]], "1269729": [[11, "3063"]], "17391413": [[7, "230"]], "129294538": [[8, "875"]], "27742673": [[42, "1252"]], "2289408": [[11, "2"]], "163328781": [[38, "2721"]], "39400757": [[36, "1479"]], "56586661": [[24, "2824"]], "4360290": [[13, "9002"]], "4178474": [[2, "19"]], "11873274": [[45, "2125"]], "80675163": [[35, "875"]], "67333161": [[44, "372"]], "55104789": [[6, "1845"]], "5576381": [[33, "372"]], "11562114": [[49, "2824"]], "54948399": [[35, "2459"]], "12096295": [[40, "2"]], "9750068": [[32, "9003"]], "58944318": [[20, "2824"]], "116847271": [[35, "3191"]], "7659038": [[8, "1845"]], "5034514": [[42, "9001"]], "22626133": [[36, "1001"]], "23323636": [[5, "2498"]], "3122339": [[16, "496"]], "57189694": [[29, "1479"]], "124662084": [[42, "1845"]], "3209374": [[1, "2"]], "85160922": [[36, "2498"]], "20140682": [[36, "1651"]], "10563355": [[4, "1356"]], "183885142": [[41, "1356"]], "8545397": [[27, "2285"]], "35439614": [[47, "1651"]], "12078393": [[6, "2459"]], "56998124": [[21, "1252"]], "21860074": [[1, "857"]], "55142979": [[4, "9002"]], "130461957": [[1, "1252"]], "15570850": [[35, "2498"]], "44189795": [[41, "1114"]], "56342044": [[50, "2285"]], "139172533": [[20, "3191"]], "135814854": [[21, "2285"]], "2421449": [[38, "703"]], "54531225": [[17, "875"]], "152642562": [[45, "1975"]], "217205964": [[34, "1651"]], "29765860": [[49, "1001"]], "11744473": [[11, "1001"]], "53981706": [[49, "875"]], "50270974": [[34, "2824"]], "47498809": [[30, "1001"]], "95302062": [[46, "230"]], "530302": [[1, "1651"]], "132659841": [[22, "703"]], "7057659": [[39, "9001"]], "92865389": [[48, "2824"]], "50911081": [[12, "1114"]], "86634384": [[28, "2498"]], "13858516": [[11, "2125"]], "36238179": [[19, "1651"]], "3412024": [[22, "2"]], "29381610": [[9, "2425"]], "6220758": [[19, "1114"]], "144001325": [[29, "1845"]], "157615817": [[20, "1845"]], "61773342": [[43, "9002"]], "15805762": [[41, "1651"]], "61010343": [[29, "36"]], "80930574": [[28, "2125"]], "61139016": [[7, "2498"]], "5054015": [[2, "230"]], "85155747": [[47, "2498"]], "39684343": [[18, "857"]], "9727262": [[15, "372"]], "46935561": [[23, "1356"]], "184913002": [[45, "1651"]], "3996228": [[9, "1845"]], "147098003": [[8, "2498"]], "54378021": [[5, "1479"]], "56037446": [[10, "2824"]], "63803252": [[42, "19"]], "182970486": [[9, "2125"]], "17652814": [[21, "1001"]], "135631858": [[26, "1975"]], "39293610": [[40, "1001"]], "5887496": [[26, "1252"]], "60724983": [[35, "1356"]], "23304273": [[37, "1479"]], "37079681": [[29, "857"]], "40492393": [[30, "1252"]], "65568501": [[2, "3512"]], "63370379": [[39, "2125"]], "11301743": [[14, "2"]], "17125697": [[25, "703"]], "7644426": [[13, "36"]], "127377313": [[30, "2824"]], "47137359": [[23, "2721"]], "68702023": [[46, "2285"]], "119608847": [[22, "1356"]], "8360492": [[13, "3512"]], "38600793": [[9, "857"]], "57462746": [[3, "875"]], "143406639": [[41, "2721"]], "10479584": [[30, "1356"]], "61015148": [[23, "9002"]], "120798767": [[42, "1114"]], "85857934": [[9, "2824"]], "238620176": [[37, "2425"]], "149292945": [[21, "9002"]], "117943327": [[44, "1651"]], "133999358": [[2, "2824"]], "2101869": [[3, "9003"]], "35398680": [[33, "496"]], "176308475": [[29, "9002"]], "18123423": [[42, "496"]], "1947191": [[35, "857"]], "238364582": [[25, "2498"]], "7067060": [[20, "9002"]], "138708313": [[11, "2498"]], "57578477": [[45, "2824"]], "68919335": [[37, "2824"]], "238359426": [[48, "2285"]], "11474425": [[27, "19"]], "56327549": [[33, "9002"]], "61805674": [[6, "2721"]], "17455976": [[40, "2721"]], "106936957": [[18, "1001"]], "57800718": [[33, "2285"]], "40988076": [[20, "2721"]], "34327932": [[25, "2"]], "216352943": [[47, "2721"]], "53562719": [[9, "1651"]], "5810283": [[50, "2"]], "39945674": [[48, "1114"]], "211545307": [[40, "3063"]], "25582556": [[30, "9003"]], "56568595": [[24, "2425"]], "6748372": [[13, "230"]], "54836433": [[1, "230"]], "55846424": [[14, "2721"]], "125510492": [[24, "1252"]], "118574866": [[1, "2285"]], "8939458": [[30, "1479"]], "120067263": [[45, "1114"]], "46628409": [[27, "703"]], "4424378": [[8, "1651"]], "10062387": [[16, "36"]], "66874115": [[41, "857"]], "5066230": [[12, "875"]], "80633655": [[42, "1479"]], "32597151": [[1, "1001"]], "236037964": [[35, "2285"]], "158394179": [[20, "372"]], "65429786": [[43, "1114"]], "7934004": [[12, "1356"]], "157282989": [[34, "1845"]], "138483460": [[22, "3063"]], "17205745": [[14, "2125"]], "81104553": [[24, "857"]], "58638972": [[37, "2459"]], "35667296": [[21, "875"]], "55883281": [[8, "1356"]], "142599512": [[18, "2824"]], "238050846": [[41, "2498"]], "44573082": [[44, "1001"]], "64059485": [[2, "1975"]], "35108623": [[28, "9003"]], "46528488": [[12, "2459"]], "57462359": [[17, "36"]], "181771275": [[6, "2285"]], "16904767": [[7, "1356"]], "5834963": [[20, "1252"]], "135609843": [[35, "2425"]], "7744981": [[27, "1975"]], "84382768": [[32, "19"]], "39379406": [[16, "875"]], "21349079": [[41, "875"]], "36866090": [[14, "2459"]], "85223395": [[46, "2125"]], "6956067": [[39, "1114"]], "237434110": [[37, "9002"]], "34451993": [[48, "1651"]], "135465878": [[49, "1252"]], "117564755": [[10, "875"]], "118943844": [[3, "1114"]], "29100091": [[47, "36"]], "149786639": [[8, "3191"]], "3065287": [[40, "372"]], "12966130": [[34, "9003"]], "2362334": [[1, "3913"]], "10549647": [[7, "2285"]], "56120109": [[46, "703"]], "139323043": [[18, "3191"]], "159321127": [[33, "2125"]], "67124538": [[4, "857"]], "35246073": [[14, "372"]], "14510186": [[7, "3063"]], "103440062": [[26, "9001"]], "238714681": [[30, "2285"]], "113668967": [[17, "2"]], "57134805": [[3, "3063"]], "20093123": [[1, "2824"]], "5671813": [[6, "19"]], "22292711": [[24, "875"]], "112501280": [[33, "3191"]], "52699979": [[29, "2"]], "161652691": [[19, "1252"]], "81679390": [[48, "857"]], "67400151": [[19, "9002"]], "8991029": [[24, "2125"]], "6857220": [[15, "3191"]], "40104370": [[40, "36"]], "61840439": [[50, "1356"]], "86663994": [[22, "19"]], "199480648": [[25, "2425"]], "6775726": [[32, "2721"]], "95920752": [[43, "2459"]], "85054686": [[40, "857"]], "34389161": [[30, "2125"]], "72373475": [[44, "1252"]], "143070345": [[34, "857"]], "44122909": [[18, "1479"]], "8759813": [[10, "3063"]], "2777585": [[25, "9001"]], "7771595": [[45, "2459"]], "34617080": [[15, "2425"]], "38681100": [[37, "19"]], "54004917": [[12, "857"]], "38231483": [[45, "703"]], "177912924": [[48, "1479"]], "86747305": [[27, "2125"]], "5894792": [[16, "9002"]], "237611868": [[18, "1252"]], "7587375": [[8, "36"]], "17260613": [[33, "2824"]], "40999818": [[2, "3063"]], "186359850": [[21, "1479"]], "106829587": [[37, "1001"]], "51453901": [[37, "2125"]], "58578043": [[14, "1114"]], "17091858": [[43, "1001"]], "5805451": [[47, "9001"]], "171928674": [[27, "1252"]], "11285677": [[15, "230"]], "37907214": [[1, "1356"]], "2396739": [[11, "2459"]], "8726141": [[10, "1651"]], "1455443": [[11, "703"]], "18684428": [[23, "703"]], "2701993": [[2, "703"]], "107579453": [[50, "9002"]], "68938226": [[33, "1975"]], "51717316": [[8, "372"]], "10414840": [[10, "496"]], "45545079": [[20, "2285"]], "12791016": [[6, "2125"]], "6174831": [[11, "496"]], "15599982": [[50, "1001"]], "73995674": [[30, "1845"]], "99006301": [[44, "2824"]], "7684045": [[6, "36"]], "88385774": [[2, "2721"]], "5157932": [[4, "230"]], "201819778": [[14, "1479"]], "2205316": [[39, "496"]], "16344659": [[15, "1114"]], "6892624": [[7, "2125"]], "25390040": [[7, "875"]], "195620553": [[22, "2498"]], "6707270": [[26, "1479"]], "23552991": [[18, "703"]], "57873100": [[29, "1356"]], "48728024": [[29, "2125"]], "14335174": [[7, "372"]], "226965031": [[48, "2721"]], "143397588": [[34, "1252"]], "112296071": [[40, "1356"]], "169336059": [[49, "1845"]], "9040288": [[7, "2721"]], "130260069": [[25, "1252"]], "7131763": [[32, "1001"]], "47008302": [[50, "1479"]], "7131761": [[28, "2"]], "128420991": [[13, "1252"]], "188143791": [[5, "3891"]], "10340802": [[14, "36"]], "13006074": [[35, "9003"]], "107070773": [[5, "3191"]], "62025174": [[19, "2459"]], "6535497": [[1, "36"]], "47283340": [[45, "19"]], "47554626": [[7, "1651"]], "6682903": [[39, "2285"]], "50398028": [[30, "2721"]], "5754759": [[11, "19"]], "2633089": [[18, "9003"]], "16096761": [[28, "3191"]], "158756179": [[25, "1356"]], "83815904": [[17, "3191"]], "62314231": [[5, "9002"]], "68702659": [[28, "372"]], "17168686": [[11, "9001"]], "148865823": [[33, "36"]], "6592957": [[15, "496"]], "17835515": [[12, "2498"]], "53652564": [[49, "857"]], "146301782": [[32, "1975"]], "7204440": [[46, "496"]], "39792050": [[50, "3191"]], "214659419": [[22, "1001"]], "14795916": [[16, "1845"]], "49912995": [[41, "9001"]], "659588": [[9, "1479"]], "66756667": [[22, "1114"]], "208783857": [[39, "2459"]], "41901203": [[41, "1845"]], "24207945": [[3, "1479"]], "49147522": [[20, "496"]], "46014284": [[44, "1975"]], "9757034": [[29, "9001"]], "13816281": [[11, "1975"]], "7824376": [[25, "1845"]], "199383417": [[38, "2824"]], "43334584": [[30, "703"]], "44895620": [[20, "1114"]], "5862544": [[37, "9003"]], "63243184": [[43, "2285"]], "3190519": [[45, "857"]], "170630879": [[28, "2721"]], "23298068": [[10, "2425"]], "58112049": [[24, "9002"]], "103496106": [[26, "3191"]], "7151982": [[20, "703"]], "125222600": [[45, "9001"]], "8313055": [[11, "36"]], "36468057": [[6, "1975"]], "206532744": [[32, "2498"]], "138859270": [[42, "36"]], "24259892": [[5, "2721"]], "99892277": [[2, "2425"]], "113272865": [[31, "1252"]], "12345764": [[40, "2425"]], "4568693": [[1, "9002"]], "8793196": [[15, "9002"]], "21496402": [[27, "36"]], "9261002": [[23, "9001"]], "208931151": [[28, "496"]], "237404525": [[33, "2721"]], "134689576": [[19, "230"]], "142184051": [[4, "703"]], "88336040": [[32, "2459"]], "7810952": [[29, "1252"]], "5881720": [[47, "9003"]], "55800867": [[10, "2721"]], "37048315": [[25, "3191"]], "36993069": [[37, "703"]], "97496988": [[23, "2824"]], "2313145": [[38, "496"]], "11187990": [[11, "2824"]], "43971474": [[35, "2125"]], "4826513": [[24, "703"]], "35288924": [[30, "857"]], "128408093": [[44, "9003"]], "119452802": [[14, "2498"]], "42270389": [[9, "36"]], "238708557": [[27, "2721"]], "9463884": [[7, "19"]], "39296515": [[3, "2125"]], "53805396": [[2, "36"]], "4698603": [[6, "2425"]], "47386298": [[21, "703"]], "37438778": [[31, "1479"]], "115027644": [[23, "3191"]], "972532": [[18, "1975"]], "494067": [[2, "2"]], "4223067": [[4, "875"]], "129560312": [[15, "3512"]], "199358605": [[13, "1479"]], "16027881": [[36, "496"]], "20610922": [[22, "9001"]], "3675846": [[6, "372"]], "67751933": [[18, "372"]], "11000399": [[34, "2425"]], "2476203": [[18, "36"]], "52831488": [[12, "1651"]], "53245991": [[26, "1114"]], "37270517": [[43, "703"]], "3473201": [[17, "2285"]], "40138366": [[6, "1651"]], "66906740": [[43, "9001"]], "6001500": [[20, "1001"]], "34572137": [[11, "1114"]], "13006282": [[9, "9001"]], "3578865": [[6, "3891"]], "238574819": [[50, "2425"]], "47044542": [[24, "1001"]], "3155724": [[24, "2"]], "90977052": [[45, "1252"]], "11271994": [[23, "3063"]], "138826251": [[5, "9003"]], "40706252": [[6, "9002"]], "61505877": [[34, "19"]], "6815282": [[45, "2"]], "3753502": [[25, "36"]], "4619659": [[39, "2425"]], "144151653": [[44, "2285"]], "20802283": [[30, "875"]], "17056694": [[41, "1252"]], "16473323": [[23, "1651"]], "143267556": [[23, "1114"]], "43943553": [[9, "1114"]], "40681077": [[17, "2459"]], "73960795": [[29, "3191"]], "641197": [[18, "9001"]], "46585193": [[14, "1001"]], "2251066": [[2, "2459"]], "567572": [[5, "36"]], "176784621": [[13, "1114"]], "25325007": [[49, "2285"]], "50665452": [[29, "3063"]], "4354383": [[49, "9001"]], "192060708": [[37, "1252"]], "14588582": [[13, "2425"]], "9975508": [[1, "9001"]], "51290703": [[19, "2285"]], "147308806": [[17, "1356"]], "187773251": [[5, "1114"]], "46781092": [[7, "2824"]], "64952588": [[30, "2498"]], "112466271": [[46, "2425"]], "130702859": [[44, "857"]], "9878649": [[19, "1845"]], "19337049": [[31, "875"]], "9803846": [[14, "230"]], "9288944": [[34, "1114"]], "52332445": [[2, "496"]], "14451721": [[5, "703"]], "319198": [[4, "3891"]], "9030615": [[15, "2"]], "18370054": [[46, "1651"]], "20902551": [[13, "3191"]], "74588354": [[35, "1479"]], "178388988": [[12, "3512"]], "3762457": [[5, "19"]], "102497955": [[39, "2824"]], "45788764": [[32, "1252"]], "230502586": [[40, "2285"]], "49013728": [[38, "1845"]], "56551609": [[33, "1845"]], "5360161": [[21, "2"]], "9607116": [[50, "2498"]], "16045779": [[5, "2285"]], "11653341": [[9, "9003"]], "51969443": [[30, "1114"]], "5021268": [[18, "2125"]], "72981174": [[7, "857"]], "8483339": [[2, "3191"]], "88268814": [[41, "3191"]], "167399274": [[8, "1252"]], "20137647": [[33, "2"]], "139951550": [[38, "1252"]], "51220139": [[47, "1356"]], "2845739": [[18, "2"]], "25143764": [[41, "36"]], "143813001": [[8, "3891"]], "11782176": [[37, "2721"]], "54765177": [[4, "372"]], "109824213": [[2, "2498"]], "43546155": [[43, "3063"]], "145574993": [[47, "1114"]], "13966771": [[46, "1001"]], "58214891": [[50, "3063"]], "151115610": [[14, "1252"]], "41879620": [[24, "230"]], "171981965": [[11, "3191"]], "191852309": [[39, "2721"]], "48206630": [[12, "3191"]], "66093155": [[18, "2721"]], "63107151": [[22, "496"]], "64221800": [[46, "2824"]], "72403601": [[41, "1479"]], "3329077": [[27, "1114"]], "176067738": [[9, "9002"]], "6118163": [[35, "9001"]], "6133429": [[31, "2459"]], "107149873": [[44, "36"]], "123603633": [[27, "2459"]], "82077450": [[21, "3063"]], "12272446": [[11, "1479"]], "37756928": [[28, "875"]], "125196082": [[48, "2425"]], "10284206": [[49, "496"]], "59210610": [[31, "857"]], "49717069": [[44, "496"]], "41287160": [[32, "230"]], "84285186": [[41, "496"]], "84806810": [[13, "3063"]], "52515252": [[45, "496"]], "209906359": [[39, "372"]], "132365008": [[11, "1845"]], "108894467": [[29, "1114"]], "164099260": [[28, "1252"]], "101755845": [[2, "1356"]], "10704376": [[48, "1001"]], "93744074": [[22, "1252"]], "45832563": [[21, "3191"]], "16402074": [[15, "1356"]], "15613854": [[46, "3063"]], "3731283": [[36, "703"]], "63363016": [[13, "2824"]], "54398723": [[34, "2721"]], "198974805": [[4, "1845"]], "51439402": [[45, "230"]], "12058005": [[41, "2125"]], "7630261": [[8, "2425"]], "52311557": [[35, "372"]], "4527800": [[23, "19"]], "51781610": [[35, "19"]], "11342023": [[20, "875"]], "48176512": [[22, "3191"]], "218396125": [[44, "230"]], "64476261": [[42, "1356"]], "44011603": [[36, "36"]], "16512230": [[9, "2"]], "73376928": [[41, "1975"]], "12073029": [[10, "230"]], "218947063": [[47, "2459"]], "12392733": [[15, "2285"]], "549068": [[7, "3891"]], "3104460": [[8, "19"]], "2253239": [[37, "36"]], "21516086": [[6, "2824"]], "45923086": [[42, "2425"]], "57375338": [[10, "2285"]], "143757785": [[22, "9002"]], "43834599": [[47, "1252"]], "12838905": [[17, "2498"]], "19234103": [[41, "9002"]], "98107265": [[33, "3063"]], "189955859": [[31, "9002"]], "7614494": [[13, "19"]], "14736846": [[31, "3063"]], "95967480": [[17, "9002"]], "36689492": [[22, "230"]], "80864214": [[13, "1651"]], "176336269": [[17, "703"]], "237741817": [[36, "9002"]], "11614027": [[39, "1845"]], "162048313": [[11, "2721"]], "47632667": [[48, "3191"]], "67902773": [[31, "36"]], "2472071": [[1, "9003"]], "61229352": [[29, "2285"]], "9145121": [[30, "230"]], "237197449": [[50, "2721"]], "861894": [[5, "2425"]], "192575104": [[16, "1001"]], "42420307": [[23, "857"]], "206059331": [[26, "9002"]], "3766638": [[20, "19"]], "9898390": [[31, "1845"]], "18095771": [[9, "875"]], "11866206": [[5, "230"]], "112518656": [[22, "2125"]], "46349732": [[10, "9003"]], "69567795": [[36, "2"]], "48001501": [[21, "496"]], "134132471": [[26, "36"]], "53225806": [[36, "3063"]], "80822289": [[26, "9003"]], "3530314": [[7, "496"]], "12432335": [[28, "2285"]], "7782648": [[25, "9003"]], "9586085": [[9, "3063"]], "7973054": [[32, "875"]], "9326515": [[31, "703"]], "46724443": [[14, "3063"]], "9777590": [[43, "2"]], "11017317": [[19, "19"]], "46763950": [[2, "1479"]], "90727410": [[35, "2"]], "65244898": [[13, "875"]], "47118701": [[34, "875"]], "157424216": [[47, "2425"]], "92791131": [[48, "9003"]], "58159272": [[34, "3191"]], "34629086": [[48, "36"]], "11633180": [[5, "1651"]], "4382736": [[1, "19"]], "117443215": [[10, "1975"]], "53925360": [[16, "2425"]], "115479195": [[36, "1114"]], "197574406": [[24, "9001"]], "119581540": [[1, "2498"]], "3417138": [[15, "9003"]], "16081389": [[49, "2721"]], "121321264": [[2, "2285"]], "46567452": [[37, "1114"]], "81803202": [[38, "3191"]], "237348020": [[7, "9003"]], "19860941": [[31, "1975"]], "55484449": [[18, "1114"]], "35427173": [[19, "372"]], "4845944": [[36, "19"]], "15678318": [[33, "230"]], "9325569": [[10, "372"]], "72898972": [[39, "1479"]], "139706053": [[18, "2498"]], "201648536": [[24, "2459"]], "81674185": [[15, "2459"]], "201681135": [[14, "1845"]], "55531309": [[13, "2285"]], "152849070": [[26, "2425"]], "120079042": [[31, "2125"]], "2263345": [[4, "1001"]], "69165622": [[23, "496"]], "10954028": [[21, "2721"]], "110175251": [[20, "1479"]], "47166521": [[19, "2125"]], "54580200": [[36, "857"]], "44444536": [[10, "1356"]], "7782338": [[7, "1252"]], "46383113": [[35, "703"]], "151781411": [[16, "3063"]], "42357095": [[22, "857"]], "67804353": [[17, "1114"]], "101992259": [[33, "1356"]], "9627580": [[50, "36"]], "49434539": [[21, "1651"]], "117950072": [[43, "1252"]], "9141694": [[50, "230"]], "81318575": [[15, "1845"]], "10066904": [[38, "19"]], "10089607": [[19, "9003"]], "49480172": [[13, "2125"]], "47701169": [[8, "9002"]], "97431920": [[14, "1356"]], "83977046": [[49, "1975"]], "9926474": [[4, "1479"]], "13845924": [[26, "3063"]], "2345093": [[18, "19"]], "84860853": [[44, "2425"]], "19935218": [[13, "2498"]], "208936342": [[29, "703"]], "54110236": [[49, "2125"]], "99259134": [[19, "2824"]], "2799046": [[10, "1845"]], "46669281": [[34, "1001"]], "52290434": [[41, "703"]], "54359996": [[42, "703"]], "63257785": [[26, "1001"]], "17210810": [[8, "9003"]], "66906335": [[22, "2285"]], "37215051": [[24, "1356"]], "4397228": [[3, "496"]], "139644159": [[38, "1975"]], "35581230": [[38, "36"]], "19248612": [[12, "2125"]], "19683438": [[28, "19"]], "103431126": [[44, "875"]], "134055097": [[23, "1479"]], "2954377": [[29, "9003"]], "2763212": [[4, "1975"]], "61698759": [[10, "2125"]], "2578737": [[16, "703"]], "55492583": [[44, "1356"]], "199662350": [[14, "1975"]]}, "3": {"74462145": [[11, "2125"]], "65250442": [[6, "9000"]], "68291511": [[4, "19"]], "34028683": [[14, "36"]], "59655461": [[3, "496"]], "56466626": [[11, "1845"]], "33250624": [[4, "2125"]], "69406005": [[5, "3063"]], "55217169": [[3, "9000"]], "34128364": [[12, "-1"], [10, "36"]], "66481536": [[7, "2459"]], "35781819": [[7, "3391"]], "59393337": [[13, "1479"]], "73479738": [[14, "1114"]], "69475977": [[7, "1845"]], "72276420": [[17, "230"]], "21336205": [[1, "1001"]], "25117555": [[6, "19"]], "25865397": [[18, "2824"]], "28877814": [[4, "2"]], "70661159": [[6, "2"]], "24314622": [[2, "496"]], "33565658": [[13, "1845"]], "23887839": [[20, "3391"]], "35648605": [[2, "-1"], [4, "230"]], "21866040": [[3, "2"]], "60376653": [[12, "703"]], "69749537": [[6, "625"]], "23248390": [[3, "1479"]], "35420926": [[20, "19"]], "53569743": [[19, "19"]], "29341653": [[11, "-1"]], "74652598": [[6, "3063"]], "21398897": [[13, "36"]], "34175856": [[9, "1356"]], "59085567": [[9, "230"]], "33772970": [[8, "2"]], "21793631": [[8, "1975"]], "23123536": [[13, "3391"]], "54343001": [[9, "1001"]], "57325962": [[6, "2824"]], "37636306": [[15, "1845"]], "28726185": [[2, "19"]], "37024980": [[14, "1479"]], "62450519": [[15, "-1"], [8, "496"]], "66854653": [[7, "625"]], "75596317": [[20, "1114"]], "25935908": [[3, "857"]], "60476009": [[11, "875"]], "25085952": [[19, "1651"]], "69268503": [[9, "2"]], "21479758": [[5, "496"]], "31037857": [[2, "2"]], "75121270": [[19, "1114"]], "72345009": [[19, "2459"]], "22480447": [[12, "1975"]], "53833323": [[19, "3063"]], "56116102": [[13, "1356"]], "21416596": [[20, "-1"], [8, "1479"]], "25617464": [[3, "2498"]], "35750853": [[4, "2459"]], "69271255": [[5, "1001"]], "31884465": [[15, "1356"]], "74281336": [[17, "1651"]], "67021619": [[5, "36"]], "53580156": [[11, "1651"]], "66496410": [[19, "703"]], "55240174": [[13, "1001"]], "21387251": [[12, "2824"]], "73160067": [[15, "703"]], "33773622": [[1, "3063"]], "27586038": [[11, "496"]], "50878870": [[5, "2459"]], "25381903": [[2, "-2"], [14, "2"]], "55370824": [[20, "1479"]], "23872895": [[2, "2498"]], "72114998": [[10, "1252"]], "34044245": [[13, "857"]], "56250407": [[14, "3391"]], "60130664": [[2, "1651"]], "21178096": [[15, "9003"]], "30844929": [[6, "1479"]], "57074671": [[17, "9001"]], "54993951": [[18, "1356"]], "62482245": [[14, "1252"]], "71883011": [[16, "230"]], "55838746": [[10, "1001"]], "35369090": [[18, "496"]], "74810974": [[14, "2459"]], "33112814": [[6, "3391"]], "67622661": [[11, "1001"]], "54261804": [[16, "1252"]], "24304435": [[1, "9000"]], "35968269": [[13, "2125"]], "54935073": [[11, "9003"]], "26406373": [[5, "-1"]], "33633972": [[5, "1114"]], "33929370": [[1, "703"]], "57011589": [[9, "625"]], "23795351": [[7, "-2"], [16, "1479"]], "51883845": [[8, "9000"]], "65683212": [[16, "3063"]], "35509480": [[7, "1479"]], "60506882": [[3, "9001"]], "23290951": [[8, "3391"]], "70212657": [[14, "2498"]], "34934627": [[6, "1114"]], "61980687": [[5, "1651"]], "23685757": [[9, "3391"]], "53340390": [[7, "1114"]], "34946670": [[9, "1114"]], "72557006": [[1, "2498"]], "23444100": [[11, "3391"]], "67507314": [[17, "2459"]], "28239565": [[9, "2824"]], "23188314": [[20, "1001"]], "26218570": [[1, "625"]], "35052122": [[3, "2125"]], "21154047": [[11, "2"]], "75460956": [[13, "230"]], "52410552": [[16, "1001"]], "54432065": [[4, "2498"]], "20922338": [[3, "703"]], "66181468": [[2, "1975"]], "59067050": [[5, "2125"]], "56726646": [[6, "9003"]], "37367949": [[16, "9003"]], "30245288": [[14, "9003"]], "52331716": [[10, "2"]], "65018495": [[2, "1252"]], "73725184": [[9, "2125"]], "36189447": [[14, "1651"]], "25965996": [[15, "2498"]], "58693095": [[10, "1114"]], "55618276": [[18, "1651"]], "25087088": [[15, "1479"]], "25979483": [[1, "2"]], "58381999": [[15, "2824"]], "56710307": [[18, "857"]], "26715862": [[5, "1975"]], "54729786": [[7, "2"]], "71922818": [[1, "1479"]], "31486995": [[17, "3391"]], "58325812": [[20, "625"]], "32490831": [[17, "19"]], "34203786": [[9, "1651"]], "31168234": [[14, "9001"]], "26246655": [[8, "230"]], "74971904": [[19, "36"]], "33091945": [[2, "1001"]], "35049828": [[2, "230"]], "22744655": [[17, "2824"]], "72447553": [[7, "9001"]], "32199371": [[19, "1845"]], "23887991": [[3, "1001"]], "56150901": [[11, "36"]], "67198302": [[18, "2459"]], "64789067": [[18, "1114"]], "73464271": [[2, "9003"]], "67059977": [[18, "625"]], "51445930": [[11, "857"]], "54111466": [[14, "1001"]], "32504141": [[10, "1651"]], "29061146": [[5, "3391"]], "36210720": [[10, "9001"]], "34532703": [[10, "1845"]], "20305152": [[9, "-2"]], "37077334": [[6, "-2"]], "56838276": [[12, "1479"]], "53605398": [[2, "9000"]], "57670156": [[20, "2824"]], "50930310": [[8, "2125"]], "56654289": [[16, "36"]], "26124630": [[4, "36"]], "70825430": [[5, "1356"]], "36703204": [[9, "9003"]], "71187663": [[13, "1252"]], "23288848": [[16, "496"]], "27041723": [[9, "2498"]], "53734291": [[16, "2824"]], "67154149": [[6, "1356"]], "30666142": [[18, "2125"]], "33359969": [[17, "2125"]], "29975101": [[16, "2125"]], "71295250": [[13, "703"]], "69731348": [[19, "1252"]], "51754548": [[11, "3063"]], "24920679": [[19, "3391"]], "31808911": [[12, "857"]], "23972892": [[11, "2459"]], "31364102": [[3, "19"]], "55506557": [[18, "-1"]], "35059210": [[6, "36"]], "71906847": [[19, "1479"]], "57487316": [[4, "496"]], "73642068": [[6, "2459"]], "61185575": [[9, "857"]], "31776165": [[19, "9001"]], "34814776": [[11, "19"]], "68353368": [[2, "2824"]], "35182849": [[8, "3063"]], "64279187": [[13, "2459"]], "71834840": [[3, "3063"]], "37435616": [[7, "2125"]], "72353305": [[7, "230"]], "28804430": [[11, "1252"]], "35450093": [[1, "496"]], "72816353": [[20, "2"]], "54151537": [[16, "625"]], "65173709": [[17, "1114"]], "67696470": [[1, "19"]], "24924730": [[18, "9001"]], "31744742": [[1, "2459"]], "35425851": [[1, "230"]], "56619167": [[17, "1356"]], "28319111": [[18, "2"]], "23784128": [[17, "-1"], [1, "-2"], [9, "1252"]], "50537338": [[12, "2498"]], "74359305": [[12, "1356"]], "51088132": [[18, "1975"]], "35311805": [[7, "1975"]], "66982009": [[20, "36"]], "31946687": [[14, "857"]], "74345144": [[15, "1252"]], "60777561": [[18, "2498"]], "50216137": [[8, "2498"]], "37074119": [[15, "1114"]], "28953832": [[5, "-2"], [9, "2459"]], "35079479": [[8, "625"]], "55227716": [[11, "1479"]], "34723399": [[10, "1975"]], "71933041": [[17, "9003"]], "25775578": [[15, "857"]], "26182767": [[1, "1252"]], "68743363": [[13, "1651"]], "57370088": [[13, "9001"]], "37711602": [[3, "1252"]], "72872109": [[4, "1651"]], "69623921": [[4, "9001"]], "57031487": [[15, "1651"]], "28147219": [[16, "857"]], "21440562": [[8, "9001"]], "26284277": [[2, "703"]], "24676110": [[3, "-2"], [9, "1975"]], "56080197": [[14, "1975"]], "59979233": [[3, "3391"]], "55537351": [[19, "2498"]], "52074423": [[7, "1252"]], "75595412": [[1, "1356"]], "37994486": [[7, "857"]], "69634255": [[5, "2498"]], "27223405": [[12, "875"]], "72718269": [[20, "1651"]], "35541069": [[13, "1975"]], "74983332": [[5, "9001"]], "55182965": [[6, "1001"]], "33218211": [[15, "3391"]], "64315696": [[12, "3391"]], "71212702": [[18, "3063"]], "21516208": [[5, "1845"]], "33332354": [[16, "2"]], "50026274": [[17, "1975"]], "53534829": [[15, "2459"]], "57902608": [[6, "1845"]], "59046284": [[13, "9003"]], "23931489": [[4, "1356"]], "58922780": [[14, "19"]], "53902748": [[16, "1356"]], "36301719": [[17, "1001"]], "36670001": [[3, "230"]], "37353531": [[15, "496"]], "23030386": [[7, "496"]], "51555462": [[4, "857"]], "74673919": [[7, "36"]], "52642245": [[16, "703"]], "30255178": [[1, "-1"], [12, "9003"]], "59551773": [[13, "-1"], [10, "9003"]], "64428659": [[19, "1975"]], "28211616": [[3, "1651"]], "55840642": [[1, "2824"]], "32935154": [[3, "1114"]], "75557524": [[9, "1479"]], "69803736": [[19, "496"]], "23547494": [[2, "3063"]], "64416996": [[10, "-1"], [6, "496"]], "35982867": [[7, "1356"]], "57897606": [[1, "36"]], "56147326": [[10, "1356"]], "57010880": [[13, "2498"]], "65636497": [[20, "2459"]], "73954361": [[20, "9001"]], "67195812": [[5, "230"]], "57052669": [[7, "2498"]], "30251208": [[8, "703"]], "29094019": [[4, "703"]], "37621465": [[12, "3063"]], "56163540": [[20, "496"]], "60555907": [[4, "1001"]], "50743557": [[10, "857"]], "34031460": [[14, "496"]], "60929242": [[19, "2824"]], "36980100": [[14, "1845"]], "23219332": [[9, "875"]], "51053942": [[5, "9003"]], "28192738": [[1, "9001"]], "21379784": [[5, "19"]], "71753078": [[15, "625"]], "21413621": [[12, "1252"]], "23584694": [[15, "36"]], "25186285": [[5, "2"]], "68156566": [[12, "36"]], "53942325": [[7, "19"]], "72021115": [[18, "1479"]], "35563018": [[6, "2498"]], "32247541": [[14, "875"]], "60460601": [[18, "9003"]], "65405163": [[9, "9001"]], "59157370": [[1, "857"]], "54495057": [[19, "857"]], "69720766": [[14, "1356"]], "34085709": [[2, "3391"]], "71894436": [[1, "9003"]], "75210897": [[16, "19"]], "68236941": [[16, "3391"]], "37515720": [[4, "-1"], [10, "1479"]], "52390379": [[18, "1001"]], "28865541": [[15, "2125"]], "70186202": [[13, "19"]], "66831907": [[8, "857"]], "73619925": [[8, "875"]], "31933377": [[10, "3063"]], "26528246": [[8, "1651"]], "74729762": [[10, "230"]], "70883427": [[5, "625"]], "52444013": [[20, "2498"]], "27929355": [[7, "2824"]], "32790693": [[13, "496"]], "75612425": [[15, "9001"]], "30226136": [[18, "3391"]], "67447118": [[7, "1001"]], "50905555": [[20, "1975"]], "37091842": [[11, "1356"]], "67008044": [[5, "703"]], "52376510": [[8, "9003"]], "35548541": [[8, "1845"]], "22751966": [[12, "19"]], "21465926": [[12, "625"]], "66586562": [[17, "703"]], "27968665": [[20, "875"]], "72140741": [[1, "1845"]], "60902310": [[14, "-1"]], "53494779": [[7, "3063"]], "27588077": [[17, "625"]], "74017505": [[19, "625"]], "36392348": [[8, "2824"]], "37971632": [[16, "875"]], "67126294": [[3, "2459"]], "63556175": [[4, "9003"]], "56148241": [[3, "625"]], "30459208": [[8, "2459"]], "58576466": [[16, "1651"]], "55110102": [[4, "3063"]], "57906225": [[9, "1845"]], "67128905": [[7, "9003"]], "26183869": [[15, "875"]], "65617941": [[10, "2125"]], "34345253": [[12, "2"]], "64518507": [[12, "9001"]], "34222952": [[6, "857"]], "58075256": [[6, "703"]], "58731554": [[14, "2824"]], "23548673": [[12, "496"]], "35710864": [[11, "1114"]], "68358147": [[1, "1651"]], "75055723": [[19, "1356"]], "21434575": [[5, "2824"]], "53188319": [[19, "2"]], "21503883": [[4, "3391"]], "71021678": [[6, "9001"]], "75597285": [[16, "2498"]], "28104071": [[2, "857"]], "58033912": [[4, "2824"]], "69822463": [[18, "36"]], "64845034": [[13, "1114"]], "29358558": [[9, "19"]], "34193292": [[6, "1651"]], "33413702": [[15, "230"]], "51938695": [[11, "230"]], "58571642": [[2, "1356"]], "62160878": [[11, "625"]], "34596431": [[8, "36"]], "75329482": [[12, "230"]], "50982261": [[5, "1252"]], "21796008": [[20, "1356"]], "29376102": [[7, "875"]], "74353510": [[14, "703"]], "33272988": [[9, "-1"], [3, "1975"]], "72979952": [[19, "1001"]], "69757501": [[2, "9001"]], "50400479": [[19, "875"]], "33982089": [[4, "1114"]], "67044377": [[10, "2824"]], "63656301": [[5, "9000"]], "35165995": [[6, "230"]], "70258416": [[13, "875"]], "22243083": [[3, "-1"], [4, "-2"]], "51990371": [[16, "2459"]], "70001101": [[2, "1114"]], "61068944": [[15, "19"]], "53207798": [[14, "230"]], "74733382": [[17, "1252"]], "23549938": [[10, "703"]], "63924730": [[18, "230"]], "66635120": [[8, "19"]], "55193355": [[12, "2459"]], "28221707": [[1, "3391"]], "24211912": [[12, "2125"]], "53650857": [[11, "1975"]], "74691276": [[5, "875"]], "59071837": [[2, "875"]], "31618492": [[12, "1845"]], "29917364": [[8, "1356"]], "69083949": [[4, "1252"]], "22737510": [[10, "625"]], "75439337": [[18, "19"]], "58431719": [[1, "1975"]], "73543043": [[17, "1479"]], "75243340": [[16, "9001"]], "35788943": [[7, "1651"]], "34351622": [[2, "1845"]], "24955050": [[10, "496"]], "30205806": [[4, "625"]], "61568290": [[6, "875"]], "55331168": [[18, "875"]], "67030282": [[18, "1252"]], "57175751": [[2, "625"]], "73311382": [[1, "2125"]], "72432835": [[2, "2459"]], "70155513": [[17, "36"]], "55718010": [[4, "1975"]], "67027270": [[11, "2498"]], "25089955": [[1, "1114"]], "75536415": [[14, "3063"]], "53678068": [[15, "1001"]], "73344357": [[17, "875"]], "56560662": [[3, "1356"]], "60792986": [[3, "875"]], "50852127": [[18, "1845"]], "55479592": [[11, "2824"]], "74114246": [[12, "1651"]], "36276592": [[3, "1845"]], "30873189": [[17, "2"]], "74597019": [[14, "2125"]], "30803367": [[7, "-1"], [17, "496"]], "35355521": [[2, "2125"]], "74080090": [[16, "1845"]], "74043762": [[15, "2"]], "25599001": [[8, "1001"]], "35172684": [[16, "-1"]], "51153663": [[10, "3391"]], "53776112": [[17, "3063"]], "23566534": [[4, "1479"]], "34825873": [[8, "-1"], [9, "3063"]], "55775928": [[15, "3063"]], "57914218": [[14, "625"]], "26073004": [[17, "857"]], "69787291": [[12, "1001"]], "31322739": [[4, "1845"]], "23813451": [[10, "2498"]], "68508292": [[10, "875"]], "36844089": [[2, "1479"]], "62170767": [[10, "19"]], "32423340": [[6, "-1"]], "20929532": [[3, "9003"]], "75452492": [[4, "875"]], "65715354": [[16, "1975"]], "51142805": [[5, "1479"]], "59405137": [[11, "9001"]], "53855498": [[13, "625"]], "30838764": [[3, "36"]], "53725240": [[1, "875"]], "31641291": [[4, "9000"]], "20191044": [[13, "2"]], "35221317": [[2, "36"]], "51535578": [[13, "3063"]], "21267965": [[19, "-1"], [9, "496"]], "72902127": [[20, "3063"]], "58231265": [[7, "9000"]], "66907854": [[6, "1252"]], "28255676": [[9, "36"]], "35598523": [[9, "703"]], "74298164": [[17, "1845"]], "27148571": [[6, "1975"]], "52721655": [[8, "1114"]], "30824579": [[10, "2459"]], "23035143": [[18, "703"]], "51987176": [[13, "2824"]], "35367314": [[3, "2824"]], "35704484": [[6, "2125"]], "34940631": [[12, "1114"]], "71307994": [[8, "1252"]], "29297069": [[8, "-2"], [11, "703"]], "74682973": [[16, "1114"]], "61749192": [[15, "1975"]], "56453979": [[7, "703"]], "68952274": [[17, "2498"]], "31002694": [[5, "857"]]}, "7": {}}';
//              print_r($tops);

              $topslist = json_decode($tops,true);  //热榜的排行

              $hotinfo = array();
              foreach ($topslist[$platform] as $key =>$value){      // -1为热门  -2 为推荐  其他为省排行
                  if(($key == $userid)){
                      foreach ($value as $keys =>$values) {
                          if( count($values)>1) {
                               switch($values[1]){
                              case '-1':  array_push($hotinfo, [$values[$keys] => "-1"] ); break;
                              case '-2':  array_push($hotinfo, [$values[$keys] => "-2"] ); break;
                              default:
                                  $livecity = $this->getcityid($values[1], $citymini);
                                  array_push($hotinfo, [$values[$keys] => $livecity]); break;


                          }

                                  }
                              }

                      }
              }
              echo json_encode($hotinfo);
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
