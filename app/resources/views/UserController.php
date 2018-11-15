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
                    return view('zhibo')->with('id', $id)->with('userid', $userid)->with('num_followers', $num_followers)->with('platformid',$this->platform);

                }
            }else if($this->platform ==7){

              $fanslist     =   Xxtea::getMembers($userid);       //获取粉丝列表
              $liveid =  Xxtea::getLiveId($userid);
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
		$online = $_POST["maxnum"];
		
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
				'itime' => $_POST["start_t"] , 
				'percent' => $percent , 
				'duration' => $_POST["duration"] , 
				'follower' => $_POST["follower"] , 
				'gold' => $_POST["gold"],
				'income_top' => $_POST["income_top"],
				'giftlog' => $_POST["giftlog"],
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

        $userid =  $this -> platformid;
         $platform =  $this -> platform;
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
        //$tops = '{"1":{"125693": [[  8,"2"], [11, "-1"]], "144893": [[50,  "2425"]]}}';

        $topslist = json_decode($tops,true);  //热榜的排行

        $hotinfo = array();
        foreach ($topslist[$platform] as $key =>$value){      // -1为热门  -2 为推荐  其他为省排行
            if(($key == $userid)){
                foreach ($value as $keys =>$values) {
                        if ($values[$keys] == '-1') {

                            array_push($hotinfo, [$values[$keys-1] => "-1"]);
                        } else if ($values[$keys] == '-2') {

                            array_push($hotinfo, [$values[$keys-1] => "-2"]);
                        } else if(isset( $values[$keys+1])) {
                            $city = $values[$keys+1];

                            $livecity = $this->getcityid($platform, $city, $citymini);

                            array_push($hotinfo, [$values[$keys] => $livecity]);
                        }
                    }
                }else{
                return 0;
            }
        }
        return json_encode($hotinfo);

    }


    public function getcityid($platform,$citystr,$citymini){
           foreach ($citymini as $key =>$value){
               if((int)$citystr ==(int)$value){
                   return    $key;
               }
           }
        }


          public function t(){
              return view("bd");
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
