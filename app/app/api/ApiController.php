<?php
namespace App\api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Common;
use DB;

class ApiController {
        /*
         * 工会api
         */
          public function    getStarsFromGuild(){
              $id       =   $_GET['id'];
              $date     =   $_GET["date"];
              $data = array();
              $data['commond'] = "getStarsFromGuild";
              $data['data']    = array();
              $data['code']    = 0;
              $data['msg']     =  "";

              if((time()-(1*24*60*60))-strtotime($date)>7*24*3600 || (time()-(1*24*60*60))-strtotime($date)<0){
                   $data['code'] = "2001";
                   $data['msg']  = "时间范围超限";
                  return $data;
              }
              $result      =    DB::select("SELECT a.`nickname` , b.`platform` ,b.`platformid` ,b.`income` ,b.`increase` ,b.`increase_rmb` ,b.`follower` ,b.`increase_follower` ,b.`work`  FROM `tool_users` as a INNER JOIN `income_log` as b on a.`platform` =b.`platform` and a.`platformid` =b.`platformid`   WHERE a.`companyid` =".$id." AND b.`idate` ='".$date."' ORDER BY `income` DESC ");
             if($result){
                 $data['data']    = $result;
                 return json_encode($data);
             }else{
                 return json_encode($data);
             }
          }



    /*
     * 工会api
     */
    public function    getDailyData(){
//        $id       =   $_GET['id'];
        $platform     =   $_GET["platform"];
        $data = array();
        $hourse = date("H", time());
        if($hourse>=9) {
            $date = strtotime("-1 day");
        }else{
            $date =  date('Y-m-d',strtotime(time()));
        }
        $data['commond'] = "getDailyData";
        $data['data']    = array();
        $data['code']    = 0;
        $data['msg']     =  "";

//        if((time()-(1*24*60*60))-strtotime($date)>7*24*3600 || (time()-(1*24*60*60))-strtotime($date)<0){
//            $data['code'] = "2001";
//            $data['msg']  = "时间范围超限";
//            return $data;
//        }
        $plat = DB::select("SELECT `status` FROM `platform` WHERE `id` =".$platform ."");
        if(isset($plat[0]->status)&&$plat){
            $result      =    DB::select(" SELECT a.idate,a.idate_last, CASE a.`platform` when 1 THEN '映客' when 2 THEN '抱抱' WHEN 3 THEN '花椒' WHEN 4 THEN '熊猫'  WHEN 5 THEN '全民'   WHEN 6 THEN '陌陌'   WHEN 7 THEN '一直播'   WHEN 8 THEN '美拍'   WHEN 9 THEN '来疯'   WHEN 10 THEN '斗鱼'   WHEN 11 THEN '奇秀' END as platname,       a.`platform`,a.`platformid`,a.income,b.rmb,a.increase,a.`increase_rmb`,a.`follower`,a.`increase_follower`,a.`work`,b.`nickname`,b.gender,b.`birthday`,b.`cityname`,b.`avatar`,b.intro,b.`lastliveid` FROM `incomelog_lastday` a  inner join users b on a.`platform`= ". $platform  ."   and a.`platform`= b.`platform`  and a.`platformid`= b.`platformid`   order by a.`increase_rmb` desc limit 5000  ");
       
        }else{
            $result = null;
        }
     
        if($result){
            $data['data']    = $result;
            return json_encode($data);
        }else{
            return json_encode($data);
        }
    }




    /*
     * 工会api
     */
    public function    getSumData(){
//        $id       =   $_GET['id'];
        $platform     =   $_GET["platform"];
        $data = array();
        $hourse = date("H", time());
        if($hourse>=9) {
            $date = strtotime("-1 day");
        }else{
            $date =  date('Y-m-d',strtotime(time()));
        }
        $data['commond'] = "getSumData";
        $data['data']    = array();
        $data['code']    = 0;
        $data['msg']     =  "";
        $plat = DB::select("SELECT `status` FROM `platform` WHERE `id` =".$platform ."");
        if(isset($plat[0]->status)&&$plat){
           // $result      =    DB::select(" SELECT a.idate,a.idate_last, CASE a.`platform` when 1 THEN '映客' when 2 THEN '抱抱' WHEN 3 THEN '花椒' WHEN 4 THEN '熊猫'  WHEN 5 THEN '全民'   WHEN 6 THEN '陌陌'   WHEN 7 THEN '一直播'   WHEN 8 THEN '美拍'   WHEN 9 THEN '来疯'   WHEN 10 THEN '斗鱼'   WHEN 11 THEN '奇秀' END as platname,       a.`platform`,a.`platformid`,a.income,b.rmb,a.increase,a.`increase_rmb`,a.`follower`,a.`increase_follower`,a.`work`,b.`nickname`,b.gender,b.`birthday`,b.`cityname`,b.`avatar`,b.intro,b.`lastliveid` FROM `incomelog_lastday` a  inner join users b on a.`platform`= ". $platform  ."   and a.`platform`= b.`platform`  and a.`platformid`= b.`platformid`   order by a.`increase_rmb` desc limit 500  ");
            $result      =    DB::select("SELECT `platform`,`platformid` ,`rmb`,  CASE `platform` when 1 THEN '映客' when 2 THEN '抱抱' WHEN 3 THEN '花椒' WHEN 4 THEN '熊猫'  WHEN 5 THEN '全民'   WHEN 6 THEN '陌陌'   WHEN 7 THEN '一直播'   WHEN 8 THEN '美拍'   WHEN 9 THEN '来疯'   WHEN 10 THEN '斗鱼'   WHEN 11 THEN '奇秀' END as platname FROM `users` WHERE `platform` = ". $platform  ." ORDER BY rmb DESC LIMIT 20000");
            //  echo  " SELECT a.idate, CASE a.`platform` when 1 THEN '映客' when 2 THEN '抱抱' WHEN 3 THEN '花椒' WHEN 4 THEN '熊猫'  WHEN 5 THEN '全民'   WHEN 6 THEN '陌陌'   WHEN 7 THEN '一直播'   WHEN 8 THEN '美拍'   WHEN 9 THEN '来疯'   WHEN 10 THEN '斗鱼'   WHEN 11 THEN '奇秀' END as platname,       a.`platform`,a.`platformid`,a.income,a.increase,a.`increase_rmb`,a.`follower`,a.`increase_follower`,a.`work`,b.`nickname`,b.gender,b.`birthday`,b.`cityname`,b.`avatar`,b.intro,b.`lastliveid` FROM `incomelog_lastday` a  inner join users b on a.`platform`= ". $platform  ."   and a.`platform`= b.`platform`  and a.`platformid`= b.`platformid`   order by a.`increase_rmb` desc limit 500  ";

        }else{
            $result = null;
        }
        //  $result      =    DB::select(" SELECT a.idate,a.`platform`,a.`platformid`,a.income,a.increase,a.`increase_rmb`,a.`follower`,a.`increase_follower`,a.`work`,b.`nickname`,b.gender,b.`birthday`,b.`cityname`,b.`avatar`,b.intro  FROM `incomelog_lastday` a  inner join users b on a.`platform`= ". $platform  ."   and a.`platform`= b.`platform`  and a.`platformid`= b.`platformid` order by a.`increase_rmb` desc limit 500  ");
        if($result){
            $data['data']    = $result;
            return json_encode($data);
        }else{
            return json_encode($data);
        }
    }




    /*
     * 工会api
     */
    public function    getPlatformData(){

//        $data = array();
//        $data['commond'] = "getPlatformData";
//        $data['data']    = array();
//        $data['code']    = 0;
//        $data['msg']     =  "";
        $result      =    DB::select("SELECT `platform` ,sum,`idate`,CASE `platform` when 1 THEN '映客' when 2 THEN '抱抱' WHEN 3 THEN '花椒' WHEN 4 THEN '熊猫'  WHEN 5 THEN '全民'   WHEN 6 THEN '陌陌'   WHEN 7 THEN '一直播'   WHEN 8 THEN '美拍'   WHEN 9 THEN '来疯'   WHEN 10 THEN '斗鱼'   WHEN 11 THEN '奇秀' END as platname   FROM users_count GROUP BY `idate`,`platform`  ");

        echo "<table border='1'><tr><th>平台名</th><th>收入</th><th>时间</th></tr>";
        foreach ($result as $key =>$value){
             echo "<tr/><td>".$value->platname."</td><td>".$value->sum."</td><td>".$value->idate."</td><tr/>";
        }
       // var_dump($result);
        echo "</table>";
//        if($result){
//            $data['data']    = $result;
//            return json_encode($data);
//        }else{
//            return json_encode($data);
//        }
    }





}