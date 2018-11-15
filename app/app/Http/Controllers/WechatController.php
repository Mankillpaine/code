<?php

namespace App\Http\Controllers;
use DB;
use Cache;
use Memcached;
//use Pozpom\MemcachedCloud\MemcachedCloudConnector;

use Illuminate\Http\Request;
class WechatController extends Controller
{
    /**
     * 微信方法
     *
     * @return void
     */
    public function __construct()
    {

        //
    }

//    public function men(){
//         
//    }
       /*
        * 全网收入排行
        */
    public function income(){
        $id = 0;
        $hourse = date("H",time());
            if($hourse>=9) {
                $result = DB::select( "SELECT a.*,users.`nickname`,users.`avatar`  from (select income_log.*  from `income_log` where `idate` = date_sub(curdate(),interval 1 day) and  platform in(1,3,7) order by `increase_rmb`  desc limit 100) as a inner join users on  `a`.`platform` =`users`.`platform`  and `a`.`platformid` =users.`platformid` ORDER BY `a`.`increase_rmb` DESC");
            }else{
                $result = DB::select("SELECT a.*,users.`nickname`,users.`avatar`  from (select income_log.*  from `income_log` where `idate` = date_sub(curdate(),interval 2 day) and  platform in(1,3,7) order by `increase_rmb`  desc limit 100) as a inner join users on  `a`.`platform` =`users`.`platform`  and `a`.`platformid` =users.`platformid` ORDER BY `a`.`increase_rmb` DESC");

            }
        $this->mencache();
        return view('income', ['result' => $result])->with('id',$id);
    }

    public function post(Request $request){
        $id = $request->all();
        $name =  $request->input('name');
        $password = $request->input('password');
        $result   = DB::insert("insert into users (`username`,`password`) values ('.$name.','.$password.')");
        if($result){
            return Redirect::to('users/login')->with('message', '欢迎注册，好好玩耍!');
        }else{
            return Redirect::to('users/register')->with('message', '请您正确填写下列数据')->withErrors()->withInput();
        }
    }
     /*
      *平台排行
      */
    public function getFoname(Request $request,$id){
        $platform = $id;
        $hourse = date("H",time());

        if($hourse>=9) {
            $result = DB::select("SELECT a.*,users.`nickname`,users.`avatar`  from (select income_log.*  from `income_log` where `idate` = date_sub(curdate(),interval 1 day)  and `platform` = ". $platform. " order by `increase_rmb`   desc limit 100) as a inner join users on  `a`.`platform` =`users`.`platform`  and `a`.`platformid` =users.`platformid` ORDER BY `a`.`increase_rmb` DESC");
        }else{
            $result = DB::select("SELECT a.*,users.`nickname`,users.`avatar`  from (select income_log.*  from `income_log` where `idate` = date_sub(curdate(),interval 2 day)  and `platform` = ". $platform . "  order by `increase_rmb`   desc limit 100) as a inner join users on  `a`.`platform` =`users`.`platform`  and `a`.`platformid` =users.`platformid` ORDER BY `a`.`increase_rmb` DESC");

        }

        return view('income', ['result' => $result])->with('id',$id);

    }

   public function Searchdetail(Request $request,$num){

       $len = strlen($num);
       if($len >5){
           $fix  = substr($num, 0, 3); // 取到ID前三位
           $plat = (int)substr($num, 3, 2); //取到平台号
           $end_plat = substr($num, 5, $len-5); //取到ID后五位

           $platformid = (int)($end_plat . $fix);
       }
       else{
           $plat = (int)substr($num,-2);
           $platformid =  (int)substr($num,0,$len-2);
       }
       $result = DB::select("SELECT * FROM `users` WHERE `platformid` = '".$platformid."'  AND `platform` =" .$plat );
       return view('detail', ['result' => $result])->with('rr',$num);


   }

    public function Attention(Request $request,$num) {

        return view('attention')->with('rr',$num);
    }
    public function AttentionPost(Request $request){
        $method = $request->method();
        $id = 0;
        if ($request->isMethod('post')) {
            $company =   $request->input('company');
            $product =  $request->input('product');
            $keyword =  $request->input('keyword');
            $username=  $request->input('username');
            $mobile  =  $request->input('mobile');
            $rr      =  $request->input('starid');
            $len = strlen($rr);
            if($len >5){
                $plat = (int)substr($rr, 3, 2);
                $fix  = substr($rr, 0, 3); // 取到ID前三位
                $end_plat = substr($rr, 5, $len-5); //取到ID后五位
                $platformid = (int)($end_plat . $fix);

            }
            else{
                $plat = (int)substr($rr,-2);
                $platformid = (int)substr($rr,0,$len-2);
            }
           $result  = DB::insert("INSERT INTO contact (company, product, keyword,username,mobile,platform,platformid) VALUE ('".$company."','".$product."','".$keyword."','".$username."','".$mobile."','".$plat."','".$platformid."')");
           // echo $result;die;
           //   if($result){
           //       return view('income', ['result' => $result])->with('id',$id);
           //   }
            return "<script>alert('提交成功，我们会尽快与您联系！');history.go(-2);</script>";
        }
    }

    public function incomelist() {

//        $result = DB::select("select case a.platform when 1 then '映客' when 3 then '花椒' when 7 then '一直播' end as 平台,a.platformid,users.nickname,a.金币收入,a.人民币收入,format((a.income/(a.income-`金币收入`) - 1) * 100,2) as 周增幅,a.income,users.`intro` ,users.`veri_info` from (SELECT sum(`increase`) as `金币收入`,SUM(`increase_rmb`) as `人民币收入`,max(income) as income,`platform` ,`platformid` FROM `income_log` where `idate` >= '2016-08-01' and idate <= '2016-08-07' and platform in (1,3,7) group by `platform` ,`platformid` order by 人民币收入 desc limit 500) as a left join users on a.platform=users.`platform` and a.platformid=users.`platformid`" );
         $result = DB::select("select 平台,platformid,nickname,金币收入,人民币收入,人民币收入_上周,周增幅,收入增长速度,income as 总金币,intro,veri_info from (SELECT sum(`income_log`.`increase`) as `金币收入_上周`, SUM(`income_log`.`increase_rmb`) as `人民币收入_上周`, max(`income_log`.income) as income_上周,user_t.* ,(user_t.人民币收入-SUM(`income_log`.`increase_rmb`) )/SUM(`income_log`.`increase_rmb`) *100 as 收入增长速度 FROM `income_log` inner join user_t on user_t.`platform` = income_log.`platform`  and user_t.platformid=income_log.`platformid`  and `income_log`.`idate`>= '2016-07-25'  and `income_log`.idate<= '2016-07-31' group by `income_log`.`platform`, `income_log`.`platformid`) as temp order by 人民币收入 desc;");
        return view('list', ['result' => $result]);

    }
    public function fanslist(){
        $result = DB::select("select * from user_fans order by 粉丝增加 desc");
        return view('fanslist', ['result' => $result]);
    }


    /*
 * 全网收入排行
 */
    public function fans(){
        $id = 0;
        $hourse = date("H",time());
        if($hourse>=9) {
            $result = DB::select( "SELECT a.*,users.`nickname`,users.`avatar`  from (select income_log.*  from `income_log` where platform in(1,3,7) and `idate` = date_sub(curdate(),interval 1 day) order by `increase_follower`  desc limit 100) as a inner join users on  `a`.`platform` =`users`.`platform`  and `a`.`platformid` =users.`platformid` ORDER BY `a`.`increase_follower` DESC");

        }else{
            $result = DB::select("SELECT a.*,users.`nickname`,users.`avatar`  from (select income_log.*  from `income_log` where  platform in(1,3,7) and `idate` = date_sub(curdate(),interval 2 day) order by `increase_follower`  desc limit 100) as a inner join users on  `a`.`platform` =`users`.`platform`  and `a`.`platformid` =users.`platformid` ORDER BY `a`.`increase_follower` DESC");

        }

        return view('fans', ['result' => $result])->with('id',$id);
    }


        /*
        *粉丝排行
        */
    public function getFans(Request $request,$id){
        $platform = $id;
        $hourse = date("H",time());

        if($hourse>=9) {
            $result = DB::select("SELECT a.*,users.`nickname`,users.`avatar`  from (select income_log.*  from `income_log` where `idate` = date_sub(curdate(),interval 1 day)  and `platform` = ". $platform. " order by `increase_follower`   desc limit 100) as a inner join users on  `a`.`platform` =`users`.`platform`  and `a`.`platformid` =users.`platformid` ORDER BY `a`.`increase_follower` DESC");
        }else{
            $result = DB::select("SELECT a.*,users.`nickname`,users.`avatar`  from (select income_log.*  from `income_log` where `idate` = date_sub(curdate(),interval 2 day)  and `platform` = ". $platform . "  order by `increase_follower`   desc limit 100) as a inner join users on  `a`.`platform` =`users`.`platform`  and `a`.`platformid` =users.`platformid` ORDER BY `a`.`increase_follower` DESC");

        }

        return view('fans', ['result' => $result])->with('id',$id);

    }



    public function mencache(){
        $connect = new Memcached;
        $connect->setOption(Memcached::OPT_COMPRESSION, false);
        $connect->setOption(Memcached::OPT_BINARY_PROTOCOL, true);
        $connect->addServer('60.205.105.239', 11211);
        $connect->setSaslAuthData('f10618a5473d48f1', 'Toubu123');
//        $connect->set("hello", "world");
//        echo 'hello: ',$connect->get("hello");
        $connect->quit();
    }





    public function bd(){
        $connect = new Memcached;
        $connect->setOption(Memcached::OPT_COMPRESSION, false);
        $connect->setOption(Memcached::OPT_BINARY_PROTOCOL, true);
        $connect->addServer('60.205.105.239', 11211);
        $GLOBALS["Tops"] = $connect->get("Tops");

//        $GLOBALS["top_1"] =    $connect->get("top_1");   //映客热门列表
//        $GLOBALS["top_3"] =    $connect->get("top_3");       //花椒
//        $GLOBALS["top_7"] =    $connect->get("top_7");  //一直播

        $result = DB::select("SELECT * FROM `city_mini` WHERE `parent` =0 ");
        $toplist = array();
        foreach ($result as $key => $value){
            $toplist["top_1_".$value->id.""] =  $connect->get("top_1_".$value->id ."");
            $toplist["top_3_".$value->id.""] =  $connect->get("top_3_".$value->id ."");
        }
        //花椒推荐列表
        $hotlist = $connect->get("top_3_post");



    }

}