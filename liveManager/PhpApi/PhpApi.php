<?php
namespace PhpApi\PhpApi;
use DB;
use Excel;
use Illuminate\Support\Facades\Common;
use Illuminate\Support\Facades\dbMongo;

class PhpApi{

    public static function error($code){
        // $error = new stdClass();
        $error['code'] = $code;
        return $error;
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->bindClasses();

    }

    /*
 * 权限检查
 */
    public function authorTity(){
        /*
                     *
                     * 创建数组  “访问路径”和 “权限验证”的对应关系
                     *   是否有用户是否有权限访问进行验证
          */

    }


    public function  bindClasses(){

        return "它调用我了";
    }
//    /*
//     * 操作
//     */
//    public function Handle($info){
//        if(empty($info['handle'])){
//            $this->Errorinfo('10001');
//        }
//        // var_dump($info);
//
//    }
    /*
     * 封装返回数据
     */
    public function Returndata($data){
        /*
        *
        *     假如有报错，返回 调用Common::getErrorMsg（错误代码）的返回结果
         * 没有报错，直接处理逻辑，返回数据
        */


        //10001 => 传递参数不对或者已经丢失
        //

//        $arr['data'] ="";
//        $arr['code']="";
//        $arr['msg'] ="";
//


        //   return $arr;
    }







    /*
     * 日收入排序主播列表
     */
    public static function user()
    {
        $hourse = date("H", time());
        if ($hourse >= 9) {
            $endtime = date("Y-m-d", strtotime("-1 day"));
        } else {
            $endtime = date("Y-m-d", strtotime("-2 day"));
        }
        $platsql = "SELECT * FROM `activeindex` where `idate`= '" . $endtime . "' and groups=0 ";

        if (1 == 1) {
            $result = DB::select($platsql);
        } else {
            $result = error(10000000);
        }
//       dd($result);
        return $result;
    }


    /*
     * 主播贡献榜
     * 分页完成
     */
    public static function pageStarincome($data){
        $currentTime  = $data-> startTime;
        $companyId = $data->companyId;
//        $companyId =8001;
//        $currentTime ='2016-12-02 15:25:13';
        $getDate =  date('Y-m-01',strtotime($currentTime));
        $endDate =  date('Y-m-t',strtotime($currentTime));
        $result =  DB::select("SELECT user.`platformid` ,user.`nickname`  ,user.`avatar` ,SUM(daily_user.`increase_rmb`)as monthrmb  FROM `user`  LEFT JOIN `daily_user`  on user.`platform` =daily_user.`platform` AND user.`platformid` =daily_user.`platformid` WHERE daily_user.`idate` BETWEEN '". $getDate ."' AND '". $endDate ."' where user.companyid =". $companyId ." GROUP BY user.`platform` ,user.`platformid` ");
        if (!$result) {
            $re = self::error(9901);
        }
        $sumNum = count($result);    //总条数
        if(isset($data->total)){
            $total =$data->total;
        }else{
            $total = 10;  //每页显示的条数
        }
        $pageNum = ceil($sumNum / $total);    //总页数
        if(isset($data->page)&&$data->page!=1){
            $page = ($data->page-1) *$total;
        }else{
            $page = 0;
        }
        $db = DB::select("SELECT user.`platformid` ,user.`nickname`  ,user.`avatar` ,SUM(daily_user.`increase_rmb`)as monthrmb  FROM `user`  LEFT JOIN `daily_user`  on user.`platform` =daily_user.`platform` AND user.`platformid` =daily_user.`platformid` WHERE daily_user.`idate` BETWEEN '". $getDate ."' AND '". $endDate ."' where user.companyid =". $companyId ." GROUP BY user.`platform` ,user.`platformid`   LIMIT ".$page .",".$total ." ");
        $tota = count($db);    //当前页显示条数
        $re['data'] = $db;   //数据
        $re['pageNum']= $pageNum; //总页数
        if(isset($data->page)&&$data->page!=1){
            $re['page']   = $data->page;//第几页
        }else{
            $re['page']  = 1;
        }
        $re['num']    = $tota;
        return $re;

    }

//    public function topOnline(){
//        $time =date("Y-m-d");
//        $starttime = $time . " 00:00:00 ";
//        $endtime   = $time . " 11:59:59";
//        $sql ="SELECT * FROM `live_log` WHERE `itime` BETWEEN '".$starttime."' AND '".$endtime."' GROUP BY `platform` ,`platformid` ORDER BY `online` DESC limit 100 ";
//        $result =  DB::select($sql);
//          //  err = 10004    code msg
//        //  返回错误结果
//        return $result;
//    }



    public function Excel(){
        $destinationPath = 'uploadFiles/Excel/';
        $filepath = $destinationPath."20161223074328268.xls";
        Excel::load($filepath, function($reader) {
            // $data = $reader->all();
            $tabl_name = date('YmdHis').mt_rand(100,999);
            $reader = $reader->getSheet(0);
            $data = $reader->toArray();

            $result = $this->intouser($tabl_name,$data);
            if($result){
                return 200;
            }
        });

    }

    /*************************************************         工会

    /*
     * 主播月收入
     */
    public static function companyIncome($data){
        $starTime  = $data-> startTime;
        $endTime   = $data->endTime;
        $companyId = $data->companyId;
        $result  =  DB::select("SELECT `idate`,`increase_rmb` FROM `daily_company` WHERE `companyid` =".$companyId." AND `idate` BETWEEN '". $starTime ."' and '". $endTime ."' ");
        if(!$result){
            $result = array();
        }

        return $result;
    }


    /*
     * 工会月收入
     */
    public static function companyrmb($data){
        $starTime  = $data-> startTime;
        $endTime   = $data->endTime;
        $companyId = $data->companyId;
        $result  =  DB::select("SELECT `idate`,`increase_company_rmb` FROM `daily_company` WHERE `companyid` =".$companyId." AND `idate` BETWEEN '". $starTime ."' and '". $endTime ."' ");
        if(!$result){
            $result = array();
        }

        return $result;
    }






    /*
     * 工会月粉丝趋势
     */
    public static function companyFollower($data){
        $starTime  = $data-> startTime;
        $endTime   = $data->endTime;
        $companyId = $data->companyId;
        $result  =  DB::select("SELECT `idate`,`increase_follower` FROM `daily_company` WHERE `companyid` =".$companyId." AND `idate` BETWEEN '". $starTime ."' and '". $endTime ."' ");
        if(!$result){
            $result =array();
        }
        return $result;

    }

    /************************************************** * 主播 */

    /*
     * 在线主播最高人数
     * 分页完成
     */
    public static function topOnline($data){
        $time = time();
        $currentTime = $data->startTime ;
        $companyId =$data->companyId;
        //   $companyId =8001;
        $currentDate = date("Y-m-d",$time);
        // $currentTime ='2016-12-28 15:25:13';
        $getDate =  date('Y-m-d',strtotime($currentTime));
        $starttime = $getDate . " 00:00:00";
        $endttime  = $getDate . " 23:59:59";


        //当前在线主播
        if($getDate ==$currentDate ) {
            $result = DB::select("SELECT user.`platform` ,user.`platformid` ,user.`nickname` ,user.`avatar` ,user.`remark`,live_history.`income` ,live_history.`workTime` ,live_history.`recommend` ,  live_history.`online` ,live_history.`starttime` ,`agent` .name as agentname,user_level.`name` as levelname ,`plat`.name as platname,live_history.`rmb`  FROM `user` LEFT JOIN `live_history`  on user.`platform`= live_history.`platform`    AND user.`platformid`= live_history.`platformid` LEFT JOIN `agent` on user.`agentid` =`agent` .id LEFT JOIN `user_level`  on user.`level` =user_level.`id`   LEFT JOIN `platform` as plat on plat.`id` =user.`platform`   WHERE live_history.`starttime` BETWEEN '" . $starttime . "' and '".$endttime  . "'  and user.companyid=". $companyId ."  AND `live_history` .endtime IS NULL  GROUP BY user.`platform`,  user.`platformid`  ORDER BY live_history.`online` DESC  ");
            // $result = DB::select( "SELECT user.`platform` ,user.`platformid` ,user.`nickname` ,user.`avatar` ,user.`remark`,live_history.`income` ,live_history.`workTime` ,live_history.`recommend` ,  live_history.`online` ,live_history.`starttime` ,`agent` .name as agentname,user_level.`name` as levelname ,`plat`.name as platname,live_history.`rmb`  FROM `user`  LEFT JOIN `live_history`  on user.`platform`= live_history.`platform`    AND user.`platformid`= history.`platformid` LEFT JOIN `agent` on user.`agentid` =`agent` .id LEFT JOIN `user_level` on user.`level` =user_level.`id`   LEFT JOIN `platform` as plat on plat.`id` =user.`platform`   WHERE live_history.`starttime` <= '" . $currentTime . "' and user.companyid=". $companyId ."  ORDER BY live_history.`online` DESC");
            if (!$result) {
                $re = self::error(9901);
            }
            $sumNum = count($result);    //总条数
            if(isset($data->total)){
                $total =$data->total;
            }else{
                $total = 10;  //每页显示的条数
            }
            $pageNum = ceil($sumNum / $total);    //总页数
            if(isset($data->page)&&$data->page!=1){
                $page = ($data->page-1) *$total;
            }else{
                $page = 0;
            }
            // $db = DB::select("SELECT user.`platform` ,user.`platformid` ,user.`nickname` ,user.`avatar` ,user.`remark`,live_history.`income` ,live_history.`workTime` ,live_history.`recommend` ,  live_history.`online` ,history.`starttime` ,`agent` .name as agentname,user_level.`name` as levelname ,`plat`.name as platname,live_history.`rmb`  FROM `user`  LEFT JOIN `live_history`  on user.`platform`= live_history.`platform`    AND user.`platformid`= live_history.`platformid` LEFT JOIN `agent` on user.`agentid` =`agent` .id LEFT JOIN `user_level` on user.`level` =user_level.`id`   LEFT JOIN `platform` as plat on plat.`id` =user.`platform`   WHERE live_history.`starttime` <= '" . $currentTime . "' and user.companyid=". $companyId ."  ORDER BY live_history.`online` DESC limit ".$page .",".$total ." ");
            //   echo "SELECT user.`platform` ,user.`platformid` ,user.`nickname` ,user.`avatar` ,user.`remark`,live_history.`income` ,live_history.`workTime` ,live_history.`recommend` ,  live_history.`online` ,history.`starttime` ,`agent` .name as agentname,user_level.`name` as levelname ,`plat`.name as platname,live_history.`rmb`  FROM `user`  LEFT JOIN `live_history`  on user.`platform`= live_history.`platform`    AND user.`platformid`= live_history.`platformid` LEFT JOIN `agent` on user.`agentid` =`agent` .id LEFT JOIN `user_level` on user.`level` =user_level.`id`   LEFT JOIN `platform` as plat on plat.`id` =user.`platform`   WHERE live_history.`starttime` <= '" . $currentTime . "' and user.companyid=". $companyId ."  ORDER BY live_history.`online` DESC limit ".$page .",".$total ." ";
            $db = DB::select("SELECT user.`platform` ,user.`platformid` ,user.`nickname` ,user.`avatar` ,user.`remark`,live_history.`income` ,live_history.`workTime` ,live_history.`recommend` ,  live_history.`online` ,live_history.`starttime` ,`agent` .name as agentname,user_level.`name` as levelname ,`plat`.name as platname,live_history.`rmb`  FROM `user` LEFT JOIN `live_history`  on user.`platform`= live_history.`platform`    AND user.`platformid`= live_history.`platformid` LEFT JOIN `agent` on user.`agentid` =`agent` .id LEFT JOIN `user_level`  on user.`level` =user_level.`id`   LEFT JOIN `platform` as plat on plat.`id` =user.`platform`   WHERE live_history.`starttime` BETWEEN '" . $starttime . "' and '".$endttime  . "' and user.companyid=". $companyId ."  AND `live_history` .endtime IS NULL  GROUP BY user.`platform`,  user.`platformid` ORDER BY live_history.`online` DESC limit ".$page .",".$total ." ");

            $tota = count($db);    //当前页显示条数
            $re['data'] = $db;   //数据
            $re['pageNum']= $pageNum; //总页数
            if(isset($data->page)&&$data->page!=1){
                $re['page']   = $data->page;//第几页
            }else{
                $re['page']  = 1;
            }
            $re['num']    = $tota;
        }else{
            $result =  DB::select("SELECT user.`platform` ,user.`platformid` ,user.`nickname` ,user.`avatar` ,user.`remark`,daily_user.`increase_income` ,daily_user.`workTime` ,daily_user.`recommend` ,  daily_user.`onlineMax` ,daily_user.`idate` ,`agent` .name as agentname,user_level.`name` as levelname ,`plat`.name as platname,daily_user.`increase_rmb`  FROM `user` LEFT JOIN `daily_user`  on user.`platform`= daily_user.`platform`    AND user.`platformid`= daily_user.`platformid` LEFT JOIN `agent` on user.`agentid` =`agent` .id LEFT JOIN `user_level`  on user.`level` =user_level.`id`   LEFT JOIN `platform` as plat on plat.`id` =user.`platform`   WHERE daily_user.`idate` = '" . $getDate . "'   and user.companyid=". $companyId ." GROUP BY user.`platform`,  user.`platformid`  ORDER BY daily_user.`workTime` DESC  ");

            if (!$result) {
                $re = self::error(9901);
            }
            $sumNum = count($result);    //总条数
            if(isset($data->total)){
                $total =$data->total;
            }else{
                $total = 10;  //每页显示的条数
            }
            $pageNum = ceil($sumNum / $total);    //总页数
            if(isset($data->page)&&$data->page!=1){
                $page = ($data->page-1) *$total;
            }else{
                $page = 0;
            }
            $db =  DB::select("SELECT user.`platform` ,user.`platformid` ,user.`nickname` ,user.`avatar` ,user.`remark`,daily_user.`increase_income` ,daily_user.`workTime` ,daily_user.`recommend` ,  daily_user.`onlineMax` ,daily_user.`idate` ,`agent` .name as agentname,user_level.`name` as levelname ,`plat`.name as platname,`plat`.ratename,daily_user.`increase_rmb`  FROM `user` LEFT JOIN `daily_user`  on user.`platform`= daily_user.`platform`    AND user.`platformid`= daily_user.`platformid` LEFT JOIN `agent` on user.`agentid` =`agent` .id LEFT JOIN `user_level`  on user.`level` =user_level.`id`   LEFT JOIN `platform` as plat on plat.`id` =user.`platform`   WHERE daily_user.`idate` = '" . $getDate . "'   and user.companyid=". $companyId ." GROUP BY user.`platform`,  user.`platformid`  ORDER BY daily_user.`workTime` DESC  limit ".$page .",".$total ." ");
            $tota = count($db);    //当前页显示条数
            $re['data'] = $db;   //数据
            $re['pageNum']= $pageNum; //总页数
            if(isset($data->page)&&$data->page!=1){
                $re['page']   = $data->page;//第几页
            }else{
                $re['page']  = 1;
            }
            $re['num']    = $tota;

        }
        return $re;
    }

    /*
     * 日收入最高的主播
     * 分页完成
     */
    public static function topIncome($data){
        $time = time();
        $currentTime = $data->startTime ;
        $companyId =$data->companyId;
        //    $companyId =8001;
        $currentDate = date("y-m-d",$time);
        //   $currentTime ='2016-12-28 15:25:13';
        $getDate =  date('Y-m-d',strtotime($currentTime));
        //当前在线主播
        if($getDate ==$currentDate ) {
            $result = DB::select("SELECT user.`platform` ,user.`platformid` ,user.`nickname` ,user.`avatar` ,user.`remark`,history.`income`  ,`agent` .name as agentname,user_level.`name` as levelname ,`plat`.name as platname,history.`rmb`,`plat`.ratename  FROM `user`  LEFT JOIN `live_history`  on user.`platform`= live_history.`platform`    AND user.`platformid`= live_history.`platformid` LEFT JOIN `agent` on user.`agentid` =`agent` .id LEFT JOIN `user_level`  on user.`level` =user_level.`id`   LEFT JOIN `platform` as plat on plat.`id` =user.`platform`   WHERE live_history.`starttime` <= '" . $currentTime . "' and user.companyid=". $companyId ."   GROUP BY user.`platform`,  user.`platformid` ORDER BY live_history.`rmb` DESC");
            if (!$result) {
                $re = self::error(9901);
            }
            $sumNum = count($result);    //总条数
            if(isset($data->total)){
                $total =$data->total;
            }else{
                $total = 10;  //每页显示的条数
            }
            $pageNum = ceil($sumNum / $total);    //总页数
            if(isset($data->page)&&$data->page!=1){
                $page = ($data->page-1) *$total;
            }else{
                $page = 0;
            }
            $db = DB::select("SELECT user.`platform` ,user.`platformid` ,user.`nickname` ,user.`avatar` ,user.`remark`,live_history.`income`  ,`agent` .name as agentname,user_level.`name` as levelname ,`plat`.name as platname,live_history.`rmb`,`plat`.ratename  FROM `user`  LEFT JOIN `live_history` on user.`platform`= live_history.`platform`    AND user.`platformid`= live_history.`platformid` LEFT JOIN `agent` on user.`agentid` =`agent` .id LEFT JOIN `user_level`  on user.`level` =user_level.`id`   LEFT JOIN `platform` as plat on plat.`id` =user.`platform`   WHERE live_history.`starttime` <= '" . $currentTime . "' and user.companyid=". $companyId ."   GROUP BY user.`platform`,  user.`platformid` ORDER BY live_history.`rmb` DESC  LIMIT ".$page .",".$total ." ");
            $tota = count($db);    //当前页显示条数
            $re['data'] = $db;   //数据
            $re['pageNum']= $pageNum; //总页数
            if(isset($data->page)&&$data->page!=1){
                $re['page']   = $data->page;//第几页
            }else{
                $re['page']  = 1;
            }
            $re['num']    = $tota;
        }else{
            $result = DB::select("SELECT user.`platform` ,user.`platformid` ,user.`nickname` ,user.`avatar` ,user.`income` ,user.`rmb` ,user.`remark`,daily_user.`increase_income`,daily_user.`increase_rmb`,daily_user.`recommend`,`agent` .name as agentname,user_level.`name` as levelname ,`plat`.name as platname,`plat`.ratename FROM `user`  LEFT JOIN `daily_user` on user.`platform`= daily_user.`platform` AND user.`platformid`= daily_user.`platformid` LEFT JOIN `agent` on user.`agentid`= `agent` .id  LEFT JOIN `user_level`  on user.`level`= user_level.`id` LEFT JOIN `platform` as plat on plat.`id`= user.`platform` WHERE daily_user. `idate`=  '". $getDate ."'  and user.companyid=". $companyId ."   GROUP BY user.`platform`,  user.`platformid`  ORDER BY daily_user.`increase_rmb` DESC");

            if (!$result) {
                $re = self::error(9901);
            }
            $sumNum = count($result);    //总条数
            if(isset($data->total)){
                $total =$data->total;
            }else{
                $total = 10;  //每页显示的条数
            }
            $pageNum = ceil($sumNum / $total);    //总页数
            if(isset($data->page)&&$data->page!=1){
                $page = ($data->page-1) *$total;
            }else{
                $page = 0;
            }

            $db = DB::select("SELECT user.`platform` ,user.`platformid` ,user.`nickname` ,user.`avatar` ,user.`income` ,user.`rmb` ,user.`remark`,daily_user.`increase_income`,daily_user.`increase_rmb`,daily_user.`recommend`,`agent` .name as agentname,user_level.`name` as levelname ,`plat`.name as platname,`plat`.ratename FROM `user` LEFT JOIN `daily_user`  on user.`platform`= daily_user.`platform` AND user.`platformid`= daily_user.`platformid` LEFT JOIN `agent` on user.`agentid`= `agent` .id  LEFT JOIN `user_level`  on user.`level`= user_level.`id` LEFT JOIN `platform` as plat on plat.`id`= user.`platform` WHERE daily_user. `idate`=  '". $getDate ."'  and user.companyid=". $companyId ."  GROUP BY user.`platform`,  user.`platformid`  ORDER BY daily_user.`increase_rmb` DESC limit ".$page .",".$total ."  ");
            $tota = count($db);    //当前页显示条数
            $re['data'] = $db;   //数据
            $re['pageNum']= $pageNum; //总页数
            if(isset($data->page)&&$data->page!=1){
                $re['page']   = $data->page;//第几页
            }else{
                $re['page']  = 1;
            }
            $re['num']    = $tota;

        }
        return $re;

    }

    /*
     * 日增粉粉丝榜
     * 分页完成
     */

    public static function   topFans($data){
//        $time = time();
        $currentTime = $data->startTime ;
        $companyId =$data->companyId;
//            $companyId =8001;
//        $currentDate = date("y-m-d",$time);
//           $currentTime ='2016-12-28 15:25:13';
        $getDate =  date('Y-m-d',strtotime($currentTime));
        //当前在线主播

        $result = DB::select("SELECT user.`nickname`,user.`remark`,user.`platformid`,user.avatar,daily_user.`increase_follower` ,user.`follower` ,plat.`name` as platname ,`agent` .name as agentname,user_level.`name` as levename FROM `user`   LEFT JOIN `daily_user`  on user.`platform`= daily_user.`platform`AND  user.`platformid`= daily_user.`platformid`   LEFT JOIN `agent` on user.`agentid`= `agent` .id     LEFT JOIN `user_level`  on user.`level`= user_level.`id`    LEFT JOIN `platform` as plat on plat.`id`= user.`platform`  WHERE  user.companyid= ". $companyId ." AND daily_user.`idate` = '". $getDate ."'  GROUP BY user.`platform`,  user.`platformid`  ORDER BY daily_user.`increase_follower` DESC");
        if (!$result) {
            $result = self::error(9901);
        }
        $sumNum = count($result);    //总条数
        if(isset($data->total)){
            $total =$data->total;
        }else{
            $total = 10;  //每页显示的条数
        }
        $pageNum = ceil($sumNum / $total);    //总页数
        if(isset($data->page)&&$data->page!=1){
            $page = ($data->page-1) *$total;
        }else{
            $page = 0;
        }
        $da = DB::select("SELECT user.`platform`, user.`nickname`,user.`remark`,user.`platformid`,user.avatar,daily_user.`increase_follower` ,user.`follower` ,plat.`name` as platname ,`agent` .name as agentname,user_level.`name` as levename FROM user   LEFT JOIN `daily_user` on user.`platform`= daily_user.`platform`AND  user.`platformid`= daily_user.`platformid`   LEFT JOIN `agent` on user.`agentid`= `agent` .id     LEFT JOIN `user_level` on user.`level`= user_level.`id`    LEFT JOIN `platform` as plat on plat.`id`= user.`platform`  WHERE  user.companyid= ". $companyId ." AND daily_user.`idate` = '". $getDate ."'  GROUP BY user.`platform`,  user.`platformid`  ORDER BY daily_user.`increase_follower` DESC  LIMIT ".$page .",".$total ." ");
        $tota = count($da);    //当前页显示条数
        $re['data'] = $da;   //数据
        $re['pageNum']= $pageNum; //总页数
        if(isset($data->page)&&$data->page!=1){
            $re['page']   = $data->page;//第几页
        }else{
            $re['page']  = 1;
        }
        $re['num']    = $tota;

        return $re;
    }
    /*
     * 在线时长最高排行
     * 分页完成
     */
    public static function TopLivetime($data){
        $currentTime = $data->startTime ;
        $companyId =$data->companyId;
//        $companyId =8001;
//        $currentTime ='2016-12-02 15:25:13';
        $getDate =  date('Y-m-d',strtotime($currentTime));
        $sql ="SELECT user.`nickname` ,user.`remark`, user.`platformid` ,user.`avatar`,daily_user.`workTime`,plat.`name` as platname ,plat.`color`, agent.`name` as agentname ,user_level.name  FROM `user`  LEFT JOIN `daily_user` on user.`platform` =daily_user.`platform` AND user.`platformid` =daily_user.`platformid` LEFT JOIN `agent` on user.`agentid`= `agent` .id     LEFT JOIN `user_level`  on user.`level`= user_level.`id`    LEFT JOIN `platform` as plat on plat.`id`= user.`platform`  WHERE daily_user.`idate` ='". $getDate ."' AND user.`companyid` =". $companyId ."  GROUP BY user.`platform`,  user.`platformid` ";

        $result =DB::select($sql);
        $sumNum = count($result);    //总条数
        if(isset($data->total)){
            $total =$data->total;
        }else{
            $total = 10;  //每页显示的条数
        }
        $pageNum = ceil($sumNum / $total);    //总页数
        #echo $sumNum; echo $total; echo $pageNum; die;
        if(isset($data->page)&&$data->page!=1){
            $page = ($data->page-1) *$total;
        }else{
            $page = 0;
        }
        $da = DB::select("SELECT user.`nickname` ,user.platform,user.`remark`, user.`platformid` ,user.`avatar`,daily_user.`workTime`,plat.`name` as platname , agent.`name` as agentname ,user_level.name as levename  FROM `user`  LEFT JOIN `daily_user` on user.`platform` =daily_user.`platform` AND user.`platformid` =daily_user.`platformid` LEFT JOIN `agent` on user.`agentid`= `agent` .id     LEFT JOIN `user_level`  on user.`level`= user_level.`id`    LEFT JOIN `platform` as plat on plat.`id`= user.`platform`   WHERE daily_user.`idate` ='". $getDate ."' AND user.`companyid` =". $companyId ." GROUP BY user.`platform`,  user.`platformid`  order by daily_user.`workTime` desc   LIMIT ".$page .",".$total ." ");
     // echo   "SELECT user.`nickname` ,user.platform,user.`remark`, user.`platformid` ,user.`avatar`,daily_user.`workTime`,plat.`name` as platname , agent.`name` as agentname ,user_level.name as levename  FROM `user`  LEFT JOIN `daily_user` on user.`platform` =daily_user.`platform` AND user.`platformid` =daily_user.`platformid` LEFT JOIN `agent` on user.`agentid`= `agent` .id     LEFT JOIN `user_level`  on user.`level`= user_level.`id`    LEFT JOIN `platform` as plat on plat.`id`= user.`platform`   WHERE daily_user.`idate` ='". $getDate ."' AND user.`companyid` =". $companyId ." GROUP BY user.`platform`,  user.`platformid`  order by daily_user.`workTime` desc   LIMIT ".$page .",".$total ." ";

        $tota = count($da);    //当前页显示条数
        $re['data'] = $da;   //数据
        $re['pageNum']= $pageNum; //总页数
        if(isset($data->page)&&$data->page!=1){
            $re['page']   = $data->page;//第几页
        }else{
            $re['page']  = 1;
        }
        $re['num']    = $tota;

        return $re;
        //return $result;
    }

    /*************************************************************************  小组             ******************************************/
    /*
     * 小组贡献榜   /***************************************************达标百分比没有完成
     * 分页完成
     * 任务未完成率  没有写
     */
    public static function groupIncome($data){
//        $companyId =8001;
//        $currentTime ='2016-12-02 15:25:13';
        $currentTime = $data->startTime ;
        $companyId =$data->companyId;
        $getDate =  date('Y-m-01',strtotime($currentTime));
        $endDate =  date('Y-m-t',strtotime($currentTime));

        $sql = "SELECT  count(rmb>`month_income` ) /num*100 as percent,    agentname as name ,  num,rmb  FROM (SELECT SUM(daily_user.`increase_rmb`) AS rmb, user_level.`month_income` ,  agent.`name` as agentname ,   total.num  FROM `user`  LEFT JOIN `agent` on user.`agentid`= agent.`id` LEFT JOIN `daily_user` on user.`platform`= daily_user.`platform`  AND user.`platformid`= daily_user.`platformid`  LEFT JOIN(SELECT COUNT(`user`.`platformid`) as num, `user` .`platform`, `user` .`platformid`  FROM `user`   LEFT JOIN `agent` on `user` .`agentid`= `agent` .id GROUP BY user.`platform`, user.`platformid`, `agent` .id) AS total on total.platform= user.`platform` and total.platformid= user.`platformid` left join user_level on user.agentid= user_level.id WHERE user.`companyid`= ". $companyId . "   AND daily_user.`idate` BETWEEN '"  . $getDate . "'   AND '" . $endDate  . "' GROUP BY user.`agentid` ) as b ";
   $result =DB::select($sql);
        $sumNum = count($result);    //总条数
        if(isset($data->total)){
            $total =$data->total;
        }else{
            $total = 10;  //每页显示的条数
        }
        $pageNum = ceil($sumNum / $total);    //总页数
        if(isset($data->page)&&$data->page!=1){
            $page =($data->page-1) *$total;
        }else{
            $page = 0;
        }
        $da = DB::select("SELECT  count(rmb>`month_income` ) /num*100 as percent,    agentname as name ,  num,rmb  FROM (SELECT SUM(daily_user.`increase_rmb`) AS rmb, user_level.`month_income` ,  agent.`name` as agentname ,   total.num  FROM `user`  LEFT JOIN `agent` on user.`agentid`= agent.`id` LEFT JOIN `daily_user` on user.`platform`= daily_user.`platform`  AND user.`platformid`= daily_user.`platformid`  LEFT JOIN(SELECT COUNT(`user`.`platformid`) as num,`user` .`platform`, `user` .`platformid` FROM `user`   LEFT JOIN `agent` on `user` .`agentid`= `agent` .id WHERE user.`companyid` =". $companyId  ." GROUP BY  `agent` .id) AS total on total.platform= user.`platform` and total.platformid= user.`platformid` left join user_level on user.agentid= user_level.id WHERE user.`companyid`= ". $companyId . "   AND daily_user.`idate` BETWEEN '"  . $getDate . "'   AND '" . $endDate  . "' GROUP BY user.`agentid` ) as b  LIMIT  ".$page .",".$total ."");
        // echo  "SELECT  count(rmb>`month_income` ) /num*100 as percent,    agentname as name ,  num,rmb  FROM (SELECT SUM(daily_user.`increase_rmb`) AS rmb, user_level.`month_income` ,  agent.`name` as agentname ,   total.num  FROM `user`  LEFT JOIN `agent` on user.`agentid`= agent.`id` LEFT JOIN `daily_user` on user.`platform`= daily_user.`platform`  AND user.`platformid`= daily_user.`platformid`  LEFT JOIN(SELECT COUNT(`user`.`platformid`) as num FROM `user`   LEFT JOIN `agent` on `user` .`agentid`= `agent` .id WHERE user.`companyid` =". $companyId  ." GROUP BY  `agent` .id) AS total on total.platform= user.`platform` and total.platformid= user.`platformid` left join user_level on user.agentid= user_level.id WHERE user.`companyid`= ". $companyId . "   AND daily_user.`idate` BETWEEN '"  . $getDate . "'   AND '" . $endDate  . "' GROUP BY user.`agentid` ) as b  LIMIT  ".$page .",".$total ."";

        $tota = count($da);    //当前页显示条数
        $re['data'] = $da;   //数据
        $re['pageNum']= $pageNum; //总页数
        if(isset($data->page)&&$data->page!=1){
            $re['page']   = $data->page;//第几页
        }else{
            $re['page']  = 1;
        }
        $re['num']    = $tota;

        return $re;

    }

    /*
  * 月增粉明細
     * 分页完成
  */
    public static function pageFollower($data){
//        $companyId =8001;
//        $currentTime ='2016-12-02 15:25:13';
        $currentTime = $data->startTime ;
        $companyId =$data->companyId;
        $getDate =  date('Y-m-01',strtotime($currentTime));
        $endDate =  date('Y-m-t',strtotime($currentTime));
        $sql =  "SELECT SUM(daily_company.`increase_follower`)as follower  ,company.`companyname` ,daily_company.`idate`  FROM `daily_company` LEFT JOIN `company`  on daily_company.`companyid` =company.`companyid` WHERE company.`companyid` =". $companyId ." and daily_company.`idate` BETWEEN '". $getDate ."' and '". $endDate  ."'  GROUP BY daily_company.`idate` ";
        $result =DB::select($sql);
        $sumNum = count($result);    //总条数
        if(isset($data->total)){
            $total =$data->total;
        }else{
            $total = 10;  //每页显示的条数
        }
        $pageNum = ceil($sumNum / $total);    //总页数
        if(isset($data->page)&&$data->page!=1){
            $page = ($data->page-1) *$total;
        }else{
            $page = 0;
        }
        $da = DB::select("SELECT SUM(daily_company.`increase_follower`)as follower  ,company.`companyname` ,daily_company.`idate`  FROM `daily_company` LEFT JOIN `company`  on daily_company.`companyid` =company.`companyid` WHERE company.`companyid` =". $companyId ." and daily_company.`idate` BETWEEN '". $getDate ."' and '". $endDate  ."'  GROUP BY daily_company.`idate` LIMIT ".$page .",".$total ." ");

        $tota = count($da);    //当前页显示条数
        $re['data'] = $da;   //数据
        $re['pageNum']= $pageNum; //总页数
        if(isset($data->page)&&$data->page!=1){
            $re['page']   = $data->page;//第几页
        }else{
            $re['page']  = 1;
        }
        $re['num']    = $tota;

        return $re;

    }

    /*
     *   平台增粉榜
     * 分页完成
     */
    public static function pagePlatfollower($data){
        $companyId      = $data->companyId;
        $currentTime    = $data-> startTime;
//        $companyId =8001;
//        $currentTime ='2016-12-02 15:25:13';
        $getDate =  date('Y-m-01',strtotime($currentTime));
        $endDate =  date('Y-m-t',strtotime($currentTime));
        // $sql ="SELECT SUM(incomelog.`increase_follower`)as increase_follower ,user.`platform` ,palt.name   FROM `user`  LEFT JOIN  `daily_user` as incomelog on user.`platform` =incomelog.`platform` LEFT JOIN platform as palt on user.`platform` = palt.id  WHERE incomelog.`idate` BETWEEN '".$getDate ."' AND '".$endDate ."' AND user.companyid =".$companyId ." GROUP BY incomelog.`platform` ";
        $sql   = "SELECT SUM(daily_user.`increase_follower`)as increase_follower ,user.`platform` ,palt.name FROM  user LEFT JOIN `daily_user` on user.`platform` =daily_user.`platform` LEFT JOIN platform as palt on user.`platform` = palt.id WHERE daily_user.`idate` BETWEEN '".$getDate ."' AND '".$endDate ."' AND user.companyid = ".$companyId ." GROUP BY daily_user.`platform`" ;
        //  echo $sql;
        $result =DB::select($sql);
        $sumNum = count($result);    //总条数
        if(isset($data->total)){
            $total =$data->total;
        }else{
            $total = 10;  //每页显示的条数
        }
        $pageNum = ceil($sumNum / $total);    //总页数
        if(isset($data->page)&&$data->page!=1){
            $page = $data->page * $total;
        }else{
            $page = 0;
        }
        $da1   = "SELECT CASE palt.id when 1 then '/public/img/1.png' when 2 then '/public/img/2.png' when 3 then '/public/img/3.png' when 4 then '/public/img/4.png' when 5 then '/public/img/5.png' when 6 then '/public/img/6.png' when 7 then '/public/img/7.png' when 8 then '/public/img/8.png' when 9 then '/public/img/9.png' when 10 then '/public/img/10.png' when 11 then '/public/img/11.png' END as platurl,palt.color, SUM(daily_user.`increase_follower`)as increase_follower ,user.`platform` ,palt.name FROM `user` LEFT JOIN `daily_user`  on user.`platform` =daily_user.`platform`  AND user.`platformid` =`daily_user` .`platformid`   LEFT JOIN platform as palt on user.`platform` = palt.id WHERE daily_user.`idate` BETWEEN '".$getDate ."' AND '".$endDate ."'  AND user.companyid =   ".$companyId ." GROUP BY daily_user.`platform` LIMIT  ".$page .",".$total ." ";
      // echo $da1;
        $da =DB::select($da1);
        $tota = count($da);    //当前页显示条数
        $re['data'] = $da;   //数据
        $re['pageNum']= $pageNum; //总页数
        if(isset($data->page)&&$data->page!=1){
            $re['page']   = $data->page;//第几页
        }else{
            $re['page']  = 1;
        }
        $re['num']    = $tota;

        return $re;

    }

    /*
     * 小組增粉榜
     * 分页完成
     */
    public static function groupFollower($data){
        $companyId  = $data->companyId;

        $currentTime = $data->startTime;
//        $companyId =8001;
//        $currentTime ='2016-12-02 15:25:13';
        $getDate =  date('Y-m-01',strtotime($currentTime));
        $endDate =  date('Y-m-t',strtotime($currentTime));
        $sql = "SELECT SUM(daily_user.`increase_follower`) as follower, agent.`name`,sumstar.groupstar FROM  agent LEFT JOIN `user`  on agent.`id`= user.`agentid` LEFT JOIN `daily_user`  on user.`platform`= daily_user.`platform`  AND user.`platformid`= daily_user.`platformid`  LEFT JOIN  company on agent.`companyid`= company.`companyid` LEFT JOIN(SELECT COUNT(user_plan.`platformid`) as groupstar ,user.`agentid` FROM `user`  LEFT JOIN   `user_plan` on user_plan.`platform`= user.`platform` AND user_plan.`platformid`= user.`platformid` GROUP BY user.`agentid`) as sumstar on sumstar.agentid =user.`agentid`  WHERE company.`companyid`= '" . $companyId  . "' and daily_user.`idate` BETWEEN  '". $getDate . "' AND  '" . $endDate . "' GROUP BY agent.`name`";
        $result =DB::select($sql);
        $sumNum = count($result);    //总条数
        if(isset($data->total)){
            $total =$data->total;
        }else{
            $total = 10;  //每页显示的条数
        }
        $pageNum = ceil($sumNum / $total);    //总页数
        if(isset($data->page)&&$data->page!=1){
            $page = $data->page * $total ;
        }else{
            $page = 0;
        }
        $da1 = "SELECT SUM(daily_user.`increase_follower`) as follower, agent.`name`,sumstar.groupstar FROM  agent LEFT JOIN `user`  on agent.`id`= user.`agentid` LEFT JOIN `daily_user`  on user.`platform`= daily_user.`platform` AND user.`platformid`= daily_user.`platformid` LEFT JOIN  company on agent.`companyid`= company.`companyid` LEFT JOIN(SELECT COUNT(user_plan.`platformid`) as groupstar ,user.`agentid` FROM `user`  LEFT JOIN  `user_plan` on user_plan.`platform`= user.`platform` AND user_plan.`platformid`= user.`platformid` WHERE `user_plan` .`idate` =  '". $getDate . "' GROUP BY user.`agentid`) as sumstar on sumstar.agentid =user.`agentid`  WHERE company.`companyid`= '" . $companyId  . "' and daily_user.`idate` BETWEEN  '". $getDate . "' AND  '" . $endDate . "' GROUP BY agent.`name`  LIMIT ".$page .",".$total ."  ";

        $da =DB::select($da1);
        $tota = count($da);    //当前页显示条数
        $re['data'] = $da;   //数据
        $re['pageNum']= $pageNum; //总页数
        if(isset($data->page)&&$data->page!=1){
            $re['page']   = $data->page;//第几页
        }else{
            $re['page']  = 1;
        }
        $re['num']    = $tota;

        return $re;

    }




    /*
     * 月粉丝排行
     * 分页完成
     */
    public static function monthStarfans($data){
        //   $companyid  = 8001;
        // $currentTime = '2016-12-01';
        $companyId =$data->companyId;
//        $companyid  = $data->companyId;
        $currentTime = $data->startTime;
        $getDate =  date('Y-m-01',strtotime($currentTime));
        $getMonth =  date('Y-m',strtotime($currentTime));
        $endDate =  date('Y-m-t',strtotime($currentTime));
        //当前在线主播
        // $sql =  "SELECT user.`nickname`,user.`remark`,user.`platformid`,user.avatar,sum(incomelog.`increase_follower`) as increase_follower ,user.`follower` ,plat.`name` as platname ,`agent` .name as agentname,leve.`name` as levename FROM `user`    LEFT JOIN `daily_user` as incomelog on user.`platform`= incomelog.`platform`AND  user.`platformid`= incomelog.`platformid`   LEFT JOIN `agent` on user.`agentid`= `agent` .id     LEFT JOIN `user_level` as leve on user.`level`= leve.`id`    LEFT JOIN `platform` as plat on plat.`id`= user.`platform`  WHERE  user.companyid= ". $companyId ." AND incomelog.`idate` BETWEEN '". $getDate ."' and '". $endDate ."'  ORDER BY incomelog.`increase_follower` DESC ";
        $sql = "SELECT user.`nickname`,user.`remark`,user.`platformid`,user.avatar,sum(daily_user.`increase_follower`) as increase_follower ,user.`follower` ,plat.`name` as platname ,`agent` .name as agentname,user_level.`name` as levename FROM  user LEFT JOIN `daily_user`  on user.`platform`= daily_user.`platform`AND user.`platformid`= daily_user.`platformid` LEFT JOIN `agent` on user.`agentid`= `agent` .id LEFT JOIN `user_level` on user.`level`= user_level.`id` LEFT JOIN `platform` as plat on plat.`id`= user.`platform` WHERE user.companyid= ". $companyId ." AND daily_user.`idate` BETWEEN '". $getDate ."' and  '". $endDate ."' GROUP BY user.`platform` ,user.`platformid`   ORDER BY daily_user.`increase_follower` DESC";
        //  echo $sql;
        $result = DB::select($sql );
        if (!$result) {
            $result = self::error(9901);
        }
        $sumNum = count($result);    //总条数
        if(isset($data->total)){
            $total =$data->total;
        }else{
            $total = 10;  //每页显示的条数
        }
        $pageNum = ceil($sumNum / $total);    //总页数
        if(isset($data->page)&&$data->page!=1){
            $page = ($data->page-1) *$total;
        }else{
            $page = 0;
        }
        $sql1 = "SELECT user.`nickname`,user.`remark`,user.`platformid`,user.`platform`, user.avatar,sum(daily_user.`increase_follower`) as increase_follower ,user.`follower` ,plat.`name` as platname ,`agent` .name as agentname,user_level.`name` as levename FROM  user LEFT JOIN `daily_user`  on user.`platform`= daily_user.`platform`AND user.`platformid`= daily_user.`platformid` LEFT JOIN `agent` on user.`agentid`= `agent` .id LEFT JOIN `user_level` on user.`level`= user_level.`id` LEFT JOIN `platform` as plat on plat.`id`= user.`platform` WHERE user.companyid= ". $companyId ." AND daily_user.`idate` BETWEEN '". $getDate ."' and  '". $endDate ."' GROUP BY user.`platform` ,user.`platformid`   ORDER BY `increase_follower` DESC   LIMIT ".$page .",".$total ." ";
       //echo $sql1;
       $da = DB::select( $sql1);
        $tota = count($da);    //当前页显示条数
        $re['data'] = $da;   //数据
        $re['pageNum']= $pageNum; //总页数
        if(isset($data->page)&&$data->page!=1){
            $re['page']   = $data->page;//第几页
        }else{
            $re['page']  = 1;
        }
        $re['num']    = $tota;

        return $re;

    }






    /*                                                                j
     * 主播管理
     */
    public static function filter($data){
        $currentTime = $data->startTime;
        $companyId =$data->companyId;
        $getDate =  date('Y-m-01',strtotime($currentTime));
        $getMonth =  date('Y-m',strtotime($currentTime));
        $endDate =  date('Y-m-t',strtotime($currentTime));
        //    $wheresql ="SELECT SUM(incomelog.`workTime`) as monthworktime,user.`avatar`,user.`remark`,user.`nickname`, leve.`name` as levename, user.`platform`,  user.`platformid`, user.`income`,  user.`rmb`,plat.`name`  as platname,plat.ratename,  user.`indexnum`,agent.`name`  FROM `user`  LEFT JOIN `daily_user` as incomelog on user.`platform`= incomelog.`platform`   AND user.`platformid`= incomelog.`platformid`   LEFT JOIN `user_level` as leve on user.`level`= leve.`id`   LEFT JOIN `agent` as agent on agent.`id`= user.`agentid` LEFT JOIN `platform` as plat on plat.`id` =user.`platform`   WHERE incomelog.`idate` BETWEEN '". $getDate . "'  AND '". $endDate . "'  AND incomelog.`reachStandard`= 1 AND user.`companyid` =". $companyId ." ";
        //$wheresql ="SELECT SUM(daily_user.`workTime`) as monthworktime,user.`avatar`,user.`remark`,user.`nickname`, user_level.`name` as levename, user.`platform`, user.`platformid`, user.`income`, user.`rmb`,plat.`name` as platname,plat.ratename, user.`indexnum`,agent.`name` FROM `user` LEFT JOIN `daily_user` on user.`platform`= daily_user.`platform` AND user.`platformid`= daily_user.`platformid` LEFT JOIN `user_level` as user_level on user.`level`= user_level.`id` LEFT JOIN `agent` on agent.`id`= user.`agentid` LEFT JOIN `platform` as plat on plat.`id` =user.`platform` WHERE daily_user.`idate` BETWEEN  '". $getDate . "' AND  '". $endDate . "'  AND user.`companyid` =". $companyId ."";
        $wheresql = "SELECT  n.monthworktime,user.`avatar`,user.`remark`,user.`nickname`, user_level.`name` as levelname, user.`platform`, user.`platformid`, user.`income`, user.`rmb`,plat.`name` as platname,plat.ratename, user.`indexnum`,agent.`name` as agentname FROM `user` left join ( SELECT SUM(daily_user.`workTime`) as monthworktime, user.`platform`, user.`platformid` FROM `user` LEFT JOIN `daily_user` on user.`platform`= daily_user.`platform`   AND user.`platformid`= daily_user.`platformid` WHERE daily_user.`idate` BETWEEN  '". $getDate . "' AND  '". $endDate . "'  AND user.`companyid` =". $companyId ." GROUP BY user.`platform`, user.`platformid`) as n  on user.`platform`= n.platform   AND user.`platformid`= n.platformid  LEFT JOIN `user_level` as user_level on user.`level`= user_level.`id`  LEFT JOIN `agent` on agent.`id`= user.`agentid`  LEFT JOIN `platform` as plat on plat.`id`= user.`platform`  WHERE user.`companyid`= ".$companyId ."  ";
        if(isset($data->platform)){
            $wheresql .= " and  user.platform = ".$data->platform;
        }
        if(isset($data->province)){
            $wheresql .= " and  user.city in (".$data->province.")";
        }
        if(isset($data->level)){
            $wheresql .= " and  user.level = ".$data->level;
        }
        if(isset($data->agent)){
            $wheresql .= " and  user.agentid = ".$data->agent;
        }
        if(isset($data->gender)){
            $wheresql .= " and  user.gender = ".$data->gender;
        }
       // $wheresql .="  GROUP BY user.`platform`, user.`platformid`  " ;
      //  echo $wheresql;
        $results = DB::select($wheresql);
        $sumNum = count($results);    //总条数
        if(isset($data->total)){
            $total =$data->total;
        }else{
            $total = 10;  //每页显示的条数
        }
        $pageNum = ceil($sumNum / $total);    //总页数
        if(isset($data->page)&&$data->page!=1){
            $page = ($data->page-1) *$total;
        }else{
            $page = 0;
        }
        $sql1 = $wheresql." limit ".$page ." ,". $total ." ";
       // echo $sql1;
        $da =DB::select($sql1);

        $tota = count($da);    //当前页显示条数
        $re['star'] = $da;   //数据
        $re['pageNum']= $pageNum; //总页数
        if(isset($data->page)&&$data->page!=1){
            $re['page']   = $data->page;//第几页
        }else{
            $re['page']  = 1;
        }
        $re['num']    = $tota;
        return $re;
        // dd($data);
    }

    /*
     * 主播菜单
     */
    public static function menu($data){
        $companyId = $data->companyId;
        $platform = DB::select("SELECT `id`,`name` FROM `platform` ");
        $province = DB::select("SELECT `id`,`province` FROM `city_mini` WHERE `parent` =0 AND `id` !=1 ");
        $agent    = DB::select( "SELECT `id`,`name`,`companyid` FROM `agent` WHERE `companyid` =".$companyId ."");
        $level    = DB::select("SELECT id,`name`  FROM `user_level` WHERE `companyid` =".$companyId ."");
        $gender   =array('1','0');
        $re['platform'] = $platform;
        $re['province'] = $province;
        $re['agent']    = $agent;
        $re['gender']   = $gender;
        $re['level']    = $level;
        return $re;
    }


    /*
     * 主播详情直播状态
     */
    public   static function starLiveState($data){

        $platform       =  $data->platform;
        $platformid     =   $data->platformid;
//          $platform    = 11;
//          $platformid  =  2478212391;
        $sql ="SELECT `title`,`starttime`,`recommend`,`online` FROM `live_history` WHERE `platform` =". $platform ." AND `platformid` = ". $platformid ." AND `endtime` IS NULL ";

        $result =DB::select($sql);

        if($result){
            //  $re['data'] = $result;

            return $result;
        }

        return null;
    }


    /*
     * 直播地址
     */
    public static function liveUrl($data){

        $platform       =  $data->platform;
        $platformid     =   $data->platformid;
        if ($platform == 1) {    //映客
            $url = "http://service.inke.com/api/live/now_publish?imsi=&uid=&proto=5&idfa=CC528020-8D86-4291-927E-FA712C636768&lc=0000000000000026&cc=TG0001&imei=&sid=20G45xJ7rO0qv38i1si1mxjsrj7svmbvypG23QXrfOEYLvGnmi0Mi3&cv=IK3.1.00_Iphone&devi=8c7b856e2895f4548c3c4083a3c6e1093e19109d&conn=Wifi&ua=iPhone&idfv=E2367328-B69B-4C6D-B12B-9CF7B49207E5&osversion=ios_9.300000&id=" . $platformid . "&multiaddr=1";
            $re = Common::http_get($url);
            $liveinfo = json_decode($re);
            if (isset($liveinfo->live)) {

                $re = $liveinfo->live->share_addr;
                return $re;
            }
        } else if ($platform == 7) {      //一直播
            //http://www.yizhibo.com/l/ FAp1lDeZaCpZDnp9 .html
            $liveinfo = Xxtea::getLiveInfo($platformid);     //直播间名字，图片，直播地址，
            if ($liveinfo != "") {

                $re = "http://www.yizhibo.com/l/" . $liveinfo->scid . ".html";
                return $re;
            }
        } else if ($platform == 3) {//花椒  /
            $rand = rand(100000000, 9999999999);
            $time = time();
            $line = "deviceid=3ccc323a0a7828d54b54af7d7d4a8475netspeed=0network=Wi-Fiplatform=iosrand=" . $rand . "time=" . $time . "userid=52611531version=3.8.0eac63e66d8c4a6f0303f00bc76d0217c";
            $guid = MD5($line);
            $url = "http://live.huajiao.com/feed/getUserFeeds?deviceid=3ccc323a0a7828d54b54af7d7d4a8475&netspeed=0&network=Wi-Fi&platform=ios&rand=" . $rand . "&time=" . $time . "&userid=52611531&version=3.8.0&guid=" . $guid . "&model=iPhone6,1&channel=Apple&clientip=&dui=3ccc323a0a7828d54b54af7d7d4a8475&num=40&privacy=Y&uid=" . $platformid;
            $gxs = Common::http_get($url);

            $info = json_decode($gxs);
            if ($info->data->feeds) {
                if ($info->data->feeds[0]->type == '1') {

                    $re = "http://www.huajiao.com/l/" . $info->data->feeds[0]->feed->relateid;
                    return $re;
                }
            }

        } else if ($platform == 5) {    //全民
            $endtime = date("YmdHis", time());
            $url = "http://www.quanmin.tv/json/rooms/" . $platformid . "/info4.json?_t=" . $endtime;
            $gxs = Common::http_get($url);
            $info = json_decode($gxs);
            if ($info->play_status) {

                $re = "http://www.quanmin.tv/v/" . $info->uid;
                return $re;
            }
        } else if($platform == 9) {   //来疯
            //获取主播详细信息
            $time = number_format(microtime(true), 3, '', '');
            $url = "http://v.laifeng.com/card?userId=" . $platformid . "&_=" . $time;
            $gxs = Common::http_get($url);
            $info = json_decode($gxs);
            $roomId = $info->response->data->roomId;
            $live = "http://v.laifeng.com/" . $roomId;
            $liveinfo = Common::http_get($live);
            $isShowing = common::getStr($liveinfo, "isShowing:", ",");
            if ($isShowing != 'false') {
                //   echo 111;
                $roomId = $info->response->data->roomId;

                $re = "http://v.laifeng.com/" . $roomId;
                return $re;
            }

        }else if($platform == 4){ //熊猫直播
            $time = number_format(microtime(true), 3, '', '');
            $liveid =DB::select("SELECT `liveid` FROM `users` WHERE `platform` =4 AND  `platformid` =".$platformid." ");
            //http://www.panda.tv/api_room_v2?roomid=10007&pub_key=&__plat=pc_web&_=1478850784540
            $url ='http://www.panda.tv/api_room_v2?roomid='.$liveid[0]->lastliveid.'&pub_key=&__plat=pc_web&_='.$time;
            $gxs = Common::http_get($url);
            $info = json_decode($gxs);
            if($info->data->roominfo->status==2){
                $roomId = $liveid[0]->lastliveid;

                $re = "http://www.panda.tv/" . $roomId;
                return $re;
            }

        }else if($platform == 6){ //哈尼直播
            $url ='https://web.immomo.com/webmomo/api/scene/profile/infosv2';
            $stid = "stid=".$platformid;
            $cookie ='MMID=9c10215538d589409240a33f965f07f0; MMSSID=3496f70e63e6344d20598150ba1054eb; Hm_lvt_96a25bfd79bc4377847ba1e9d5dfbe8a=1478849182; Hm_lpvt_96a25bfd79bc4377847ba1e9d5dfbe8a=1478849182; __v3_c_sesslist_10052=ek7hxnsmkb_d7g; __v3_c_pv_10052=1; __v3_c_session_10052=1478849181305915; __v3_c_today_10052=1; __v3_c_review_10052=0; __v3_c_last_10052=1478849181305; __v3_c_visitor=1478162299762468; __v3_c_session_at_10052=1478849181901; s_id=040b95821bdf6d22fc0c4bc71afa2b53; cId=84918400873391; Hm_lvt_c391e69b0f7798b6e990aecbd611a3d4=1478849184; Hm_lpvt_c391e69b0f7798b6e990aecbd611a3d4=1478849184';
            $gxs = Common::_http_post($url,$stid,$cookie);
            $info = json_decode($gxs);
            if($info->data->live){

                $re = "https://web.immomo.com/live/" . $platformid;
                return $re;
            }
        }else if($platform ==10){
            $liveid =DB::select("SELECT `liveid` FROM `users` WHERE `platform` =10 AND  `platformid` =".$platformid." ");
            $url    = "http://open.douyucdn.cn/api/RoomApi/room/".$liveid[0]->lastliveid;
            $gxs = Common::http_get($url);
            $info = json_decode($gxs);
            if($info->data->room_status=='1'){
                $roomId = $liveid[0]->lastliveid;

                $re = "https://www.douyu.com/" . $roomId;
                return $re;
            }

            //   var_dump($info);
        }else if($platform == 2){

            $liveid =DB::select("SELECT `liveid` FROM `live_history` WHERE `platform` =2 AND  `platformid` =".$platformid ." ");

            if($liveid[0]->lastliveid) {
                $url = "http://www.myhug.cn/u/profile?yUId=".$liveid[0]->lastliveid."&subUrlType=hls&apiVersion=4.0.7&appVersion=4.0.7&app=wx_baobao&appName=wap_wx&sig=2b06c09ad1adc190f66c2f2e9dd9048d1";
                $gxs = Common::http_get($url);
                $info = json_decode($gxs);
                if($info->user->userZhibo->zId){
                    $roomId = $liveid[0]->lastliveid;

                    $re = "http://www.myhug.cn/wap/z/entry.html?yUId=".$roomId."&from=singlemessage&isappinstalled=1";
                    return $re;
                }
            }
        }else if($platform==8){
            $liveid =DB::select("SELECT `liveid` FROM `live_history` WHERE `platform` =8 AND  `platformid` =".$platformid ." ");
            $url    = "http://www.meipai.com/live/".$liveid[0]->lastliveid;
            $gxs = Common::http_get($url);
            $rule = '/\isStop:.*/';  ;//正则表达式
            preg_match($rule,$gxs,$result);
            $arre = substr($result[0], 0, -1);
            $var=explode(":",$arre);
            $var[1] = trim($var[1]);
            if($var[1] =='false'){
                $roomId = $liveid[0]->lastliveid;

                $re = "http://www.meipai.com/live/".$roomId;
                return $re;
            }
        }else if($platform ==11) {
            $livedata["app_key"] = "ugc_ios";
            $livedata["device_id"] = "E226CDA4-9215-403F-9E01-E6FBF75FF50A";
            $livedata["netstat"] = "wifi";
            $livedata["platform"] = "2_22_232";
            $livedata["ua"] = "iPhone6,1__9.3.1";
            $livedata["version"] = "2.0.1";
            $livedata["time"] = (string)time();
            $livedata["user_id"] = (string)$platformid;
            ksort($livedata);
            $stringToBeSigned = "";
            foreach ($livedata as $k => $v) {
                if ("@" != substr($v, 0, 1)) {
                    $stringToBeSigned .= "$k" . "$v";
                }
            }
            $livedata['sign'] = sha1($stringToBeSigned . "Imd$%u#J22TM%xljf^u^");
            $url = "https://m2-glider-xiu.pps.tv/v1/ugc/get_user_info.json";

            $gxs = Common::http_post($url, $livedata);
            $gxs = json_decode($gxs);

            if ($gxs->data) {
                $re = "http://x.pps.tv/room/" . $gxs->data->basic->room_id;
                return $re;
            }
        }
        return null;
    }


























    /*
     *直播歷史
     * 分页完成
     */
    public static function livehistry($data)
    {
//        $platform = 1;
//        $platformid = 4517136;
        $platform       =  $data->platform;
        $platformid     =   $data->platformid;
        $results = DB::select("SELECT `live_history`.`title`,`live_history`.`workTime`,`live_history`.`onlineMax`,`live_history`.`cover`,`live_history`.`starttime` FROM `user`   LEFT JOIN `live_history`  on user.`platform`= live_history.`platform`  AND user.`platformid` = live_history.`platformid`   WHERE live_history.`endtime` IS not NULL AND user.`platform` =" . $platform . " AND user.`platformid` =" . $platformid . " ");
        $sumNum = count($results);    //总条数
        if(isset($data->total)){
            $total =$data->total;
        }else{
            $total = 10;  //每页显示的条数
        }
        $pageNum = ceil($sumNum / $total);    //总页数
        if(isset($data->page)&&$data->page!=1){
            $page = ($data->page-1) *$total;
        }else{
            $page = 0;
        }
        $sql1 ="SELECT `live_history`.`title`,`live_history`.`workTime`,`live_history`.`onlineMax`,`live_history`.`cover`,`live_history`.`starttime`,user.remark,user.nickname FROM `user`   LEFT JOIN `live_history` as live_history on user.`platform`= live_history.`platform`  AND user.`platformid` = live_history.`platformid`   WHERE live_history.`endtime` IS not NULL AND user.`platform` =". $platform  ." AND user.`platformid` =". $platformid ." limit ".$page ." ,". $total ." ";
        $da =DB::select($sql1);

        $tota = count($da);    //当前页显示条数
        $re['data'] = $da;   //数据
        $re['pageNum']= $pageNum; //总页数
        if(isset($data->page)&&$data->page!=1){
            $re['page']   = $data->page;//第几页
        }else{
            $re['page']  = 1;
        }
        $re['num']    = $tota;

        return $re;

    }




    /************************************************** 平台贡献榜 ***/
    /*
     * 平台收入排行榜
     * 平台图标链接没有完成
     * 分页完成
     */
    public static function pagePlatincome($data){
//        $companyId =8001;
//        $currentTime ='2016-12-02 15:25:13';
        $companyId  = $data->companyId;
        $currentTime = $data->startTime;
        $getDate =  date('Y-m-01',strtotime($currentTime));
        $endDate =  date('Y-m-t',strtotime($currentTime));
        $sql =  "SELECT SUM(incomelog.`increase_rmb`) AS rmb,  plat.`name` FROM `user`  LEFT JOIN `agent` as agent on user.`agentid`= agent.`id` LEFT JOIN `daily_user` as incomelog on user.`platform`= incomelog.`platform` LEFT JOIN `platform` as plat on plat.`id` =user.`platform`  AND user.`platformid`= incomelog.`platformid` WHERE user.`companyid`= ". $companyId ." AND incomelog.`idate` BETWEEN '". $getDate ."'  AND '". $endDate ."' GROUP BY user.`platform`";
//        $result =DB::select($sql);
        $result =DB::select($sql);
        $sumNum = count($result);    //总条数
        if(isset($data->total)){
            $total =$data->total;
        }else{
            $total = 10;  //每页显示的条数
        }
        $pageNum = ceil($sumNum / $total);    //总页数
        if(isset($data->page)&&$data->page!=1){
            $page = ($data->page-1) *$total;
        }else{
            $page = 0;
        }
        $sql1 =  "SELECT SUM(incomelog.`increase_rmb`) AS rmb,plat.`color`,CASE  plat.`id` when 1 then  '/public/img/1.png' when 2 then  '/public/img/2.png' when 3 then  '/public/img/3.png' when 4 then  '/public/img/4.png' when 5 then  '/public/img/5.png' when 6 then  '/public/img/6.png' when 7 then  '/public/img/7.png' when 8 then  '/public/img/8.png' when 9 then  '/public/img/9.png' when 10 then  '/public/img/10.png' when 11 then  '/public/img/11.png' END  as platurl, plat.`name` FROM `user`  LEFT JOIN `agent` as agent on user.`agentid`= agent.`id` LEFT JOIN `daily_user` as incomelog on user.`platform`= incomelog.`platform` AND user.platformid = incomelog.platformid LEFT JOIN `platform` as plat on plat.`id` =user.`platform`  AND user.`platformid`= incomelog.`platformid` WHERE user.`companyid`= ". $companyId ." AND incomelog.`idate` BETWEEN '". $getDate ."'  AND '". $endDate ."' GROUP BY user.`platform` limit ".$page ." ,". $total ."   ";

        $da =DB::select($sql1);

        $tota = count($da);    //当前页显示条数
        $re['data'] = $da;   //数据
        $re['pageNum']= $pageNum; //总页数
        if(isset($data->page)&&$data->page!=1){
            $re['page']   = $data->page;//第几页
        }else{
            $re['page']  = 1;
        }
        $re['num']    = $tota;

        return $re;

    }

    /*
     * 搜索接口
     */

    public static function search($data){
        $keysword =$data->keysword;

        $currentTime = $data->startTime;
        $companyId  = $data->companyId;
        $getDate =  date('Y-m-01',strtotime($currentTime));
        $endDate =  date('Y-m-t',strtotime($currentTime));
        $where ="SELECT SUM(incomelog.`workTime`) as monthworktime,user.`avatar`,user.`remark`,user.`nickname`, leve.`name` as levelname, user.`platform`,  user.`platformid`, user.`income`,user.signon_date,  user.`rmb`,plat.`name`  as platname,plat.ratename,  user.`indexnum`,agent.`name` as agentname,user.`agentid` as agentid,user.level  FROM `user`  LEFT JOIN `daily_user` as incomelog on user.`platform`= incomelog.`platform`   AND user.`platformid`= incomelog.`platformid`   LEFT JOIN `user_level` as leve on user.`level`= leve.`id`   LEFT JOIN `agent` as agent on agent.`id`= user.`agentid` LEFT JOIN `platform` as plat on plat.`id` =user.`platform`   WHERE incomelog.`idate` BETWEEN '". $getDate ."'  AND '" . $endDate  . "'  AND incomelog.`reachStandard`= 1 AND user.`companyid` =". $companyId  ." and user.`cancel_date`='0000-00-00'  ";

        if(is_numeric($keysword) && sizeof($keysword)>2 ){
            $where .= " and  user.platformid = ".$data->keysword;

        }else {
            $where .= " and  user.nickname  LIKE '%".$data->keysword ."%'";

        }
        $where.= "  and user.companyid = ".$data->companyId;

        $results = DB::select($where);
        $sumNum = count($results);    //总条数
        if(isset($data->total)){
            $total =$data->total;
        }else{
            $total = 10;  //每页显示的条数
        }
        $pageNum = ceil($sumNum / $total);    //总页数
        if(isset($data->page)&&$data->page!=1){
            $page = ($data->page-1) *$total;
        }else{
            $page = 0;
        }
        $where .= " LIMIT ".$page .",".$total ;   // echo $sql1;
//        $sql1 = "select agent, platform, platformid, days, count(`platformid`) as icount,(count(`platformid`)/days) as percent,  case when count(reachStandard)>= days then 1 else null end as reachStandard from( select a.`platform`, a.`platformid`, a.`agent`, a.`days`, b.`idate`, b.reachStandard  from `user_plan` a left join `daily_user` b on a.`platform`= b.`platform`  and a.`platformid`= b.`platformid`  and a.idate like '".$getMonth."%'  and b.`idate` BETWEEN '".$getDate ."'   and '". $endDate  . "' where a.`companyid`= ".$companyId ."  and b.reachStandard= 1) c  group by agent, `platform`, `platformid`  ORDER BY percent DESC  LIMIT ".$page .",".$total ." ";

        $da =DB::select($where);
        $tota = count($da);    //当前页显示条数
        if($da[0]->platform){
        $re['data'] = $da; }else{
            $re['data'] =null;
        }  //数据
        $re['pageNum']= $pageNum; //总页数
        if(isset($data->page)&&$data->page!=1){
            $re['page']   = $data->page;//第几页
        }else{
            $re['page']  = 1;
        }
        $re['num']    = $tota;

        return $re;

    }


    /*
     * 主播详情
     *
     */
    public static function starDetail($data){
        $companyId  = $data->companyId;
        $platform   =   $data->platform;
        $platformid =   $data->platformid;
        $currentTime = $data->startTime;
        $getDate =  date('Y-m-01',strtotime($currentTime));
        $endDate =  date('Y-m-t',strtotime($currentTime));
        $sql =  "SELECT  user.day_work, CASE  plat.`id` when 1 then  '/public/img/1.png' when 2 then  '/public/img/2.png' when 3 then  '/public/img/3.png' when 4 then  '/public/img/4.png' when 5 then  '/public/img/5.png' when 6 then  '/public/img/6.png' when 7 then  '/public/img/7.png' when 8 then  '/public/img/8.png' when 9 then  '/public/img/9.png' when 10 then  '/public/img/10.png'  when 11 then  '/public/img/11.png' END as platurl,user.`platform` ,user.remark,plat.name as platname,user.`platformid` ,user.`nickname` ,user.provincename,user.`indexnum` ,user.`avatar` ,agent.`name` as agentname ,leve.`name`as levelname ,user.`income` ,user.`rmb` ,plat.`ratename`,user.`follower` FROM `user`  LEFT JOIN `platform` as plat on user.`platform`= plat.`id` LEFT JOIN `user_level` as leve on leve.`id`= user.`level` LEFT JOIN `agent` as agent on agent.`id` =user.`agentid`  WHERE user.`platform`= ".$platform ." AND user.`platformid`= " . $platformid  . " ";
        $detail  = DB::select($sql);
        $sumsql =  "SELECT sum(`workTime`)as workTime  FROM `daily_user` WHERE `platform` =".$platform ." AND `platformid` = ".$platformid ." AND `idate` BETWEEN '". $getDate . "' AND '".$endDate . "'";
        $worktime  = DB::select($sumsql);
        if($detail){
            $re['star'] = $detail;
        }else{
            $re['star'] = null;
        }
        if($worktime){
            $re['worktime'] = $worktime;
        }else{
            $re['worktime'] =null;
        }
        return $re;
    }


    /*
     * 将excel表加载到数据库
     */
    public function intouser($table_name,$arr_field)
    {

        $va = $arr_field;
        $value_str="";
        foreach($va as $key => $value){
            if($key!=0){
                foreach ( $value as $key => $val ) {
                    $value_str .= "'$val',";

                }
                $news = rtrim($value_str, ",");
                $result = DB::insert("insert into user values ($news)");
            }
            $value_str="";
        }
        if($result){
            return  true;
        }
        return false;
    }

    /************************************************************************ 日考勤表    *********************************************/





    /*
  * 月未达标主播
  * 分页完成
  */
    public static function monthStarunrate($data){
        //   $companyid  = 8001;
        // $currentTime = '2016-12-01';
        $companyId  = $data->companyId;
        $currentTime = $data->startTime;
        $getDate =  date('Y-m-01',strtotime($currentTime));
        $getMonth =  date('Y-m',strtotime($currentTime));
        $endDate =  date('Y-m-t',strtotime($currentTime));
        $sql ="SELECT  `platform` ,nickname,`avatar` ,`platformid`,COUNT(b.ratedays)as ratedays,COUNT(`platformid`) as days,levelname, agentname,sum(increase_rmb)as increase_rmb,(increase_rmb/month_income)*100 as percent  FROM (SELECT   user.`platform`,  user.`nickname`, user.`platformid`,user.`avatar` , `daily_user`.`increase_rmb`,  case `daily_user`.`reachStandard` WHEN 1 THEN 1 else  null END as ratedays, `user_level`.`name` as levelname , user_level.`month_income`, `agent`.`name` as agentname  FROM daily_user LEFT JOIN `user` on `user`.`platform`= `daily_user`.`platform`  AND `user`.`platformid`= `daily_user`.`platformid`  LEFT JOIN `user_plan` on `user`.`platform`= `user_plan`.`platform`   AND `user`.`platformid`= `user_plan`.`platformid`  LEFT JOIN `platform` on `daily_user` .`platform`= `platform`.id  LEFT JOIN `user_level` on `user_level`.`id`= `user`.`level`  LEFT JOIN `agent` on `agent` .id= user.`agentid` WHERE `user`.`companyid`= ".$companyId ."    AND `user_plan`.`idate`= '" . $getDate  . "'   AND `daily_user`.`idate` BETWEEN '" . $getDate  .  "'  AND '" . $endDate . "') as b  GROUP BY  `platform` ,`platformid` ORDER BY increase_rmb DESC";
          //  "select agent,  remark,  platform, platformid, platname, days, nickname, agentname, worktime,   avatar,    ratedays,  count(`platformid`) as icount, levelname, ((days-ratedays) /days)*100 as percent,  0 as reachStandard  from(select a.`platform`, a.`platformid`, COUNT(b.`platformid`) as ratedays,   plat.name as platname, a.`agent`, a.`days`, b.`idate`, b.reachStandard, user.`nickname`, user.remark, user.`avatar`, agent.`name` as agentname, sum(b.`workTime`) as worktime, leve.`name` as levelname  from `user_plan` a  left join `daily_user` b on a.`platform`= b.`platform`  and a.`platformid`= b.`platformid`   and a.idate like '". $getMonth ."%'    and b.`idate` BETWEEN  '".$getDate ."'   and '" . $endDate . "' LEFT JOIN `agent` as agent on agent.`id`= a.`agent`  LEFT JOIN `user`  on user.`platform`= a.platform   AND user.`platformid`= a.platformid  LEFT JOIN `user_level` as leve on leve.`id`= user.`level`  LEFT JOIN platform as plat on user.`platform`= plat.id where a.`companyid`= ".$companyId ."   and b.reachStandard!= 1 GROUP BY a.`platform`, a.`platformid`) c group by agent, `platform`,   `platformid` ORDER BY percent DESC";

        $results = DB::select($sql);
        $sumNum = count($results);    //总条数
        if(isset($data->total)){
            $total =$data->total;
        }else{
            $total = 10;  //每页显示的条数
        }
        $pageNum = ceil($sumNum / $total);    //总页数
        if(isset($data->page)&&$data->page!=1){
            $page = ($data->page-1) *$total;
        }else{
            $page = 0;
        }
        $sql1 ="SELECT platname, `platform`,nickname,`avatar` ,`platformid`,COUNT(b.ratedays)as ratedays,COUNT(`platformid`) as days,levelname, agentname,sum(increase_rmb)as increase_rmb,(increase_rmb/month_income)*100 as percent,sum(workTime)as worktime  FROM (SELECT   user.`platform`,  user.`nickname`, user.`platformid`,user.`avatar` , `daily_user`.workTime , `daily_user`.`increase_rmb`,`platform`.name as platname,  case `daily_user`.`reachStandard` WHEN 1 THEN 1 else  null END as ratedays, `user_level`.`name` as levelname , user_level.`month_income`, `agent`.`name` as agentname  FROM daily_user LEFT JOIN `user` on `user`.`platform`= `daily_user`.`platform`  AND `user`.`platformid`= `daily_user`.`platformid`  LEFT JOIN `user_plan` on `user`.`platform`= `user_plan`.`platform`   AND `user`.`platformid`= `user_plan`.`platformid`  LEFT JOIN `platform` on `daily_user` .`platform`= `platform`.id  LEFT JOIN `user_level` on `user_level`.`id`= `user`.`level`  LEFT JOIN `agent` on `agent` .id= user.`agentid` WHERE `user`.`companyid`= ".$companyId ."    AND `user_plan`.`idate`= '" . $getDate  . "'   AND `daily_user`.`idate` BETWEEN '" . $getDate  .  "'  AND '" . $endDate . "') as b  GROUP BY  `platform` ,`platformid` ORDER BY increase_rmb DESC LIMIT ".$page .",".$total ."";
     //  echo $sql1;
     //   $sql1 =    "select agent,  remark,  platform, platformid, platname, days, nickname, agentname, worktime,   avatar,    ratedays,  count(`platformid`) as icount, levelname, ((days-ratedays) /days)*100 as percent,  0 as reachStandard  from(select a.`platform`, a.`platformid`, COUNT(b.`platformid`) as ratedays, plat.name as platname, a.`agent`, a.`days`, b.`idate`, b.reachStandard, user.`nickname`, user.remark, user.`avatar`, agent.`name` as agentname, sum(b.`workTime`) as worktime, leve.`name` as levelname  from `user_plan` a  left join `daily_user` b on a.`platform`= b.`platform`  and a.`platformid`= b.`platformid`   and a.idate like'". $getMonth ."%'    and b.`idate` BETWEEN  '".$getDate ."'   and  '" . $endDate . "'  LEFT JOIN `agent` as agent on agent.`id`= a.`agent`  LEFT JOIN `user`  on user.`platform`= a.platform   AND user.`platformid`= a.platformid  LEFT JOIN `user_level` as leve on leve.`id`= user.`level`  LEFT JOIN platform as plat on user.`platform`= plat.id where a.`companyid`=  ".$companyId ."  and b.reachStandard!= 1 GROUP BY a.`platform`, a.`platformid`) c group by agent, `platform`,   `platformid` ORDER BY percent DESC  LIMIT ".$page .",".$total ." ";
        $da =DB::select($sql1);

        $tota = count($da);    //当前页显示条数
        $re['data'] = $da;   //数据
        $re['pageNum']= $pageNum; //总页数
        if(isset($data->page)&&$data->page!=1){
            $re['page']   = $data->page;//第几页
        }else{
            $re['page']  = 1;
        }
        $re['num']    = $tota;

        return $re;

    }

    /*
   * 月达标主播
   * 分页完成
   */
    public static function monthStarate($data){
        //   $companyid  = 8001;
        // $currentTime = '2016-12-01';
        $companyId  = $data->companyId;
        $currentTime = $data->startTime;
        $getDate =  date('Y-m-01',strtotime($currentTime));
      //  $getMonth =  date('Y-m',strtotime($currentTime));
        $endDate =  date('Y-m-t',strtotime($currentTime));
        $getDays =  date('d',strtotime($currentTime));
        $sql ="SELECT user.`platform`,user.`nickname` , user.`platformid`, SUM(`daily_user`.`increase_rmb`) as `increase_rmb`,user_level.`month_income` ,(increase_rmb/user_level.`month_income`)*100 as percent,`agent`.`name`   FROM `user`  LEFT JOIN `daily_user` on `user`.`platform`= `daily_user`.`platform`   AND `user`.`platformid`= `daily_user`.`platformid`  LEFT JOIN `user_plan` on `user`.`platform`= `user_plan`.`platform`  AND `user`.`platformid`= `user_plan`.`platformid`  LEFT JOIN `platform` on `daily_user` .`platform`= `platform`.id LEFT JOIN `user_level` on `user_level`.`id` = `user`.`level`  LEFT JOIN `agent` on `agent` .id = user.`agentid`  WHERE `user`.`companyid`= '".$companyId ."'    AND `user_plan`.`idate`= '". $getDate . "'   AND `daily_user`.`idate` BETWEEN '". $getDate . "'  AND '".$endDate . "' GROUP BY user.`platform`,  user.`platformid` ORDER BY `increase_rmb` DESC   ";
      //   echo $sql;
       // $sql =  "select agent,   remark,  platform, platformid,platname ,   days, nickname,  agentname,  worktime,  avatar,   ratedays,   count(`platformid`) as icount,  levelname,  (ratedays /days) as percent,  case when ratedays>= days then 1 else null end as reachStandard  from( select a.`platform`, a.`platformid`, COUNT(b.`reachStandard`)as ratedays,plat.name as platname,  a.`agent`, a.`days`, b.`idate`, b.reachStandard, user.`nickname`,user.remark, user.`avatar`, agent.`name` as agentname, sum(b.`workTime`) as worktime, leve.`name` as levelname  from `user_plan` a  left join `daily_user` b on a.`platform`= b.`platform`   and a.`platformid`= b.`platformid`  and a.idate = '". $getDate . "'   and b.`idate` BETWEEN '".$getDate . "'   and '". $endDate  .  "' LEFT JOIN `agent` as agent on agent.`id`= a.`agent` LEFT JOIN `user`  on user.`platform`= a.platform  AND user.`platformid`= a.platformid  LEFT JOIN `user_level` as leve on leve.`id`= user.`level` LEFT JOIN platform as plat on user.platform =plat.id where a.`companyid`= ". $companyId ."  and b.reachStandard= 1 GROUP BY a.`platform` ,a.`platformid` ) c group by agent, `platform`, `platformid` ORDER BY percent DESC";
           $results = DB::select($sql);
        $sumNum = count($results);    //总条数
        if(isset($data->total)){
            $total =$data->total;
        }else{
            $total = 10;  //每页显示的条数
        }
        $pageNum = ceil($sumNum / $total);    //总页数
        if(isset($data->page)&&$data->page!=1){
            $page = ($data->page-1) *$total;
        }else{
            $page = 0;
        }
        $sql1 ="SELECT user.`platform`,user.`nickname` ,`platform` .name as platname,user_level.name as levelname , user.avatar, user.`platformid`, SUM(`daily_user`.`increase_rmb`) as `increase_rmb`,user_level.`month_income` ,(increase_rmb/user_level.`month_income`)*100 as percent,`agent`.`name`   FROM `user`  LEFT JOIN `daily_user` on `user`.`platform`= `daily_user`.`platform`   AND `user`.`platformid`= `daily_user`.`platformid`  LEFT JOIN `user_plan` on `user`.`platform`= `user_plan`.`platform`  AND `user`.`platformid`= `user_plan`.`platformid`  LEFT JOIN `platform` on `daily_user` .`platform`= `platform`.id LEFT JOIN `user_level` on `user_level`.`id` = `user`.`level`  LEFT JOIN `agent` on `agent` .id = user.`agentid`  WHERE `user`.`companyid`= '". $companyId ."'    AND `user_plan`.`idate`= '". $getDate . "'   AND `daily_user`.`idate` BETWEEN '". $getDate . " '  AND '".$endDate . "' GROUP BY user.`platform`,  user.`platformid` ORDER BY `increase_rmb` DESC  LIMIT ".$page .",".$total ." ";
         // echo $sql1;
//        $sql1 =  "select agent,   remark,  platform, platformid,platname ,   days, nickname,  agentname,  worktime,  avatar,   ratedays, increase_rmb,  count(`platformid`) as icount,  levelname,  (ratedays /days) as percent,  case when ratedays>= days then 1 else null end as reachStandard  from( select a.`platform`, a.`platformid`, COUNT(b.`reachStandard`)as ratedays,sum(b.increase_rmb) as  increase_rmb,  plat.name as platname,  a.`agent`, a.`days`, b.`idate`, b.reachStandard, user.`nickname`,user.remark, user.`avatar`, agent.`name` as agentname, sum(b.`workTime`) as worktime, user_level.`name` as levelname  from `user_plan` a  left join `daily_user` b on a.`platform`= b.`platform`   and a.`platformid`= b.`platformid`  and a.idate = '". $getDate . "'   and b.`idate` BETWEEN '".$getDate  . "'   and '".$endDate . "' LEFT JOIN `agent` as agent on agent.`id`= a.`agent` LEFT JOIN `user`  on user.`platform`= a.platform  AND user.`platformid`= a.platformid  LEFT JOIN `user_level` on user_level.`id`= user.`level` LEFT JOIN platform as plat on user.platform =plat.id where a.`companyid`= ". $companyId ."  and b.reachStandard= 1 GROUP BY a.`platform` ,a.`platformid` ) c group by agent, `platform`, `platformid` ORDER BY percent DESC  LIMIT ".$page .",".$total ."  ";
      // echo $sql1;
     //   $sql ="SELECT user.`platform`,user.`nickname` , user.`platformid`, SUM(`daily_user`.`increase_rmb`) as `increase_rmb`,user_level.`month_income` ,(increase_rmb/user_level.`month_income`) as percent,`agent`.`name`   FROM `user`  LEFT JOIN `daily_user` on `user`.`platform`= `daily_user`.`platform`   AND `user`.`platformid`= `daily_user`.`platformid`  LEFT JOIN `user_plan` on `user`.`platform`= `user_plan`.`platform`  AND `user`.`platformid`= `user_plan`.`platformid`  LEFT JOIN `platform` on `daily_user` .`platform`= `platform`.id LEFT JOIN `user_level` on `user_level`.`id` = `user`.`level`  LEFT JOIN `agent` on `agent` .id = user.`agentid`  WHERE `user`.`companyid`= 8001    AND `user_plan`.`idate`= ''". $getDate . "' '  AND `daily_user`.`idate` BETWEEN ''". $getDate . "' '  AND ''".$endDate . "'' GROUP BY user.`platform`,  user.`platformid` ORDER BY `increase_rmb` DESC  LIMIT ".$page .",".$total ." ";
        // $sql1 =  "select agent, platform,  platformid,  days, nickname,  agentname,worktime,avatar,   count(`platformid`) as icount,levelname,  (count(`platformid`) /days) as percent,  case when count(reachStandard)>= days then 1 else null end as reachStandard  from( select a.`platform`, a.`platformid`, a.`agent`, a.`days`, b.`idate`, b.reachStandard, user.`nickname`,user.`avatar`, agent.`name` as agentname, sum(b.`workTime`) as worktime,leve.`name`  as levelname  from `user_plan` a  left join `daily_user` b on a.`platform`= b.`platform`  and a.`platformid`= b.`platformid`  and a.idate like '2016-12%'  and b.`idate` BETWEEN '". $getDate . "'   and '". $endDate  . "'  LEFT JOIN `agent` as agent on agent.`id`= a.`agent` LEFT JOIN `user`  on user.`platform`= a.platform      AND user.`platformid`= a.platformid LEFT JOIN `user_level` as leve on leve.`id` =user.`level`      where a.`companyid`= ". $companyId ."  and b.reachStandard= 1) c group by agent, `platform`, `platformid` ORDER BY percent DESC LIMIT ".$page .",".$total ."  ";
        $da =DB::select($sql1);

        $tota = count($da);    //当前页显示条数
        $re['data'] = $da;   //数据
        $re['pageNum']= $pageNum; //总页数
        if(isset($data->page)&&$data->page!=1){
            $re['page']   = $data->page;//第几页
        }else{
            $re['page']  = 1;
        }
        $re['num']    = $tota;

        return $re;

    }

    /*
 * 月考勤主播
 * 分页完成
 */
    public static function monthWork($data){
        //   $companyid  = 8001;
        // $currentTime = '2016-12-01';
        $companyId  = $data->companyId;
        $currentTime = $data->startTime;
        $getDate =  date('Y-m-01',strtotime($currentTime));
        $getMonth =  date('Y-m',strtotime($currentTime));
        $endDate =  date('Y-m-t',strtotime($currentTime));
//        $sql =  "select agent, platform,  platformid,  days, nickname,  agentname,worktime,avatar,   count(`platformid`) as icount,levelname,  (count(`platformid`) /days) as percent,  case when count(reachStandard)>= days then 1 else null end as reachStandard  from( select a.`platform`, a.`platformid`, a.`agent`, a.`days`, b.`idate`, b.reachStandard, user.`nickname`,user.`avatar`, agent.`name` as agentname, sum(b.`workTime`) as worktime,leve.`name`  as levelname  from `user_plan` a  left join `daily_user` b on a.`platform`= b.`platform`  and a.`platformid`= b.`platformid`  and a.idate like '2016-12%'  and b.`idate` BETWEEN '2016-12-01'   and '2016-12-31'  LEFT JOIN `agent` as agent on agent.`id`= a.`agent` LEFT JOIN `user`  on user.`platform`= a.platform      AND user.`platformid`= a.platformid LEFT JOIN `user_level` as leve on leve.`id` =user.`level`      where a.`companyid`= 8001  and b.reachStandard= 1) c group by agent, `platform`, `platformid` ORDER BY percent DESC  ";
        //  $sql ="select agent,count(days),count(reachStandard) as irate,count(reachStandard)/count(days)*100 as percent,COUNT(days)-COUNT(`reachStandard`) as unrate from (select agent,  platform, platformid, days, count(`platformid`) as icount, case when count(reachStandard) >= days then 1 else null end as reachStandard  from(select a.`platform`, a.`platformid`, a.`agent`, a.`days`, b.`idate`, b.reachStandard  from `user_plan` a left join `daily_user` b on a.`platform`= b.`platform`  and a.`platformid`= b.`platformid` and b.reachStandard=1 and a.idate like '2016-12%'  and b.`idate` = '". $getDate  . "' where a.`companyid` = ". $companyId  .") c group by agent,`platform`,`platformid`) as temp group by agent   ";
     //   $sql ="select agent,count(days),count(reachStandard) as irate,count(reachStandard)/count(days)*100 as percent,COUNT(days)-COUNT(`reachStandard`) as unrate from (select agent,  platform, platformid, days, count(`platformid`) as icount, case when count(reachStandard) >= days then 1 else null end as reachStandard  from(select a.`platform`, a.`platformid`, a.`agent`, a.`days`, b.`idate`, b.reachStandard  from `user_plan` a left join `daily_user` b on a.`platform`= b.`platform`  and a.`platformid`= b.`platformid` and b.reachStandard=1 and a.idate like '".$getMonth . "%'  and b.`idate` BETWEEN '" .$getDate . "' and '".$endDate  .  "'  where a.`companyid` = ". $companyId  .") c group by agent,`platform`,`platformid`) as temp group by agent";
       $sql ="select agent,agentname, count(isReach) as reachUser,count(*) as allUser,count(isReach)/count(*)*100 as percent from(select case when reachCount>= days then 1 else null end as isReach, b.*,a.agent,`agent` .`name` as agentname  from `user_plan` a left join(select platform, platformid, sum(reachStandard) as reachCount  from `daily_user` where `companyid`= ".$companyId ."   and `idate` BETWEEN  '" .$getDate . "'   and  '" .$endDate . "' GROUP BY `platform`, `platformid`) b on a.`platform`= b.`platform`  and a.`platformid`= b.`platformid`  LEFT JOIN `agent` on `agent`  .`id` =a.`agent`  where a.`idate`=  '" .$getDate . "' AND  `agent`.`companyid` = ". $companyId ." ) as temp group by agent";
        // echo $sql;
        $results = DB::select($sql);
        $sumNum = count($results);    //总条数
        if(isset($data->total)){
            $total =$data->total;
        }else{
            $total = 10;  //每页显示的条数
        }
        $pageNum = ceil($sumNum / $total);    //总页数
        if(isset($data->page)&&$data->page!=1){
            $page = ($data->page-1) *$total;
        }else{
            $page = 0;
        }
        $sql1 ="select agent,agentname, count(isReach) as reachUser,count(*) as allUser,count(isReach)/count(*)*100 as percent from(select case when reachCount>= days then 1 else null end as isReach, b.*,a.agent,`agent` .`name` as agentname  from `user_plan` a left join(select platform, platformid, sum(reachStandard) as reachCount  from `daily_user` where `companyid`= ".$companyId ."   and `idate` BETWEEN  '" .$getDate . "'   and  '" .$endDate . "' GROUP BY `platform`, `platformid`) b on a.`platform`= b.`platform`  and a.`platformid`= b.`platformid`  LEFT JOIN `agent` on `agent`  .`id` =a.`agent`  where a.`idate`=  '" .$getDate . "' AND  `agent`.`companyid` = ". $companyId ." ) as temp group by agent LIMIT ".$page .",".$total ." ";
         //echo $sql1;
        //  $sql1 ="select  agent.`name` ,agent,count(days) as iratedays ,icount,count(reachStandard) as irate,count(reachStandard)/count(days)*100 as percent,COUNT(days)-COUNT(`reachStandard`) as unrate from (select agent,  platform, platformid, days, count(`platformid`) as icount, case when count(reachStandard) >= days then 1 else null end as reachStandard  from(select a.`platform`, a.`platformid`, a.`agent`, a.`days`, b.`idate`, b.reachStandard  from `user_plan` a left join `daily_user` b on a.`platform`= b.`platform`  and a.`platformid`= b.`platformid` and b.reachStandard=1 and a.idate like '".$getMonth . "%'  and b.`idate` BETWEEN '".$getDate . "' and '".$endDate . "'  where a.`companyid` = ". $companyId  .") c group by agent,`platform`,`platformid`) as temp LEFT JOIN `agent`  as agent on agent.`id` =agent  group by agent  LIMIT ".$page .",".$total ." ";
        // $sql1 =  "select agent, platform,  platformid,  days, nickname,  agentname,worktime,avatar,   count(`platformid`) as icount,levelname,  (count(`platformid`) /days) as percent,  case when count(reachStandard)>= days then 1 else null end as reachStandard  from( select a.`platform`, a.`platformid`, a.`agent`, a.`days`, b.`idate`, b.reachStandard, user.`nickname`,user.`avatar`, agent.`name` as agentname, sum(b.`workTime`) as worktime,leve.`name`  as levelname  from `user_plan` a  left join `daily_user` b on a.`platform`= b.`platform`  and a.`platformid`= b.`platformid`  and a.idate like '2016-12%'  and b.`idate` BETWEEN '2016-12-01'   and '2016-12-31'  LEFT JOIN `agent` as agent on agent.`id`= a.`agent` LEFT JOIN `user`  on user.`platform`= a.platform      AND user.`platformid`= a.platformid LEFT JOIN `user_level` as leve on leve.`id` =user.`level`      where a.`companyid`= 8001  and b.reachStandard= 1) c group by agent, `platform`, `platformid` ORDER BY percent DESC LIMIT ".$page .",".$total ."  ";
        $da =DB::select($sql1);

        $tota = count($da);    //当前页显示条数
        $re['data'] = $da;   //数据
        $re['pageNum']= $pageNum; //总页数
        if(isset($data->page)&&$data->page!=1){
            $re['page']   = $data->page;//第几页
        }else{
            $re['page']  = 1;
        }
        $re['num']    = $tota;

        return $re;

    }

    /*
     * 月考勤明细
     */
    public static function monthDetail($data){
        //        $companyId =8001;
//        $currentTime ='2016-12-02 15:25:13';
        $companyId  = $data->companyId;
        $currentTime = $data->startTime;
        $getDate =  date('Y-m-01',strtotime($currentTime));
        $endDate =  date('Y-m-t',strtotime($currentTime));
        $sql = " SELECT * FROM `daily_company` WHERE companyid= ".$companyId ." AND idate BETWEEN '". $getDate  . "' and '".  $endDate . "' " ;
//        $result =DB::select($sql);
        $result =DB::select($sql);
        $sumNum = count($result);    //总条数
        if(isset($data->total)){
            $total =$data->total;
        }else{
            $total = 10;  //每页显示的条数
        }
        $pageNum = ceil($sumNum / $total);    //总页数
        if(isset($data->page)&&$data->page!=1){
            $page = ($data->page-1) *$total;
        }else{
            $page = 0;
        }
        $sql1 = " SELECT * FROM `daily_company` WHERE companyid=".$companyId ." AND idate BETWEEN '". $getDate  . "' and '".  $endDate . "'  limit ".$page ." ,". $total ."  " ;
       $da =DB::select($sql1);

        $tota = count($da);    //当前页显示条数
        $re['data'] = $da;   //数据
        $re['pageNum']= $pageNum; //总页数
        if(isset($data->page)&&$data->page!=1){
            $re['page']   = $data->page;//第几页
        }else{
            $re['page']  = 1;
        }
        $re['num']    = $tota;

        return $re;





    }




    /*
     * 日达标主播
     */
    public static function Starrate($data){
//        $companyId =8001;
//        $currentTime ='2016-12-02 15:25:13';
        $companyId  = $data->companyId;
        $currentTime = $data->startTime;
        $getDate =  date('Y-m-d',strtotime($currentTime));
        $endDate =  date('Y-m-t',strtotime($currentTime));
        $sql = "SELECT user.`platform` ,user.`platformid` ,user.`nickname` ,user.`avatar` ,daily_user.`workTime` ,user.`income` ,user.`rmb` ,daily_user.`follower` ,user_level.`name` ,agent.`name`,plat.`name`,daily_user.`reachStandard`  FROM `user` LEFT JOIN `daily_user` on user.`platform`= daily_user.`platform`  AND user.`platformid`= daily_user.`platformid` LEFT JOIN `agent`  on agent.`id`= user.`agentid` LEFT JOIN `user_level` on user_level.`id`= user.`level`  LEFT JOIN `platform` as plat on plat.`id`= user.`platform` WHERE daily_user.`idate` = '" . $getDate  . "' AND daily_user.`reachStandard`=1 and user.companyid=".$companyId ." GROUP BY user.`platform` ,user.`platformid`  ORDER BY daily_user.`workTime` DESC  ";
//        $result =DB::select($sql);
        $result =DB::select($sql);
        $sumNum = count($result);    //总条数
        if(isset($data->total)){
            $total =$data->total;
        }else{
            $total = 10;  //每页显示的条数
        }
        $pageNum = ceil($sumNum / $total);    //总页数
        if(isset($data->page)&&$data->page!=1){
            $page = ($data->page-1) *$total;
        }else{
            $page = 0;
        }
        $sql1 = "SELECT user.`platform`,user.`remark`, user.`platformid` ,user.`nickname` ,user.`avatar` ,daily_user.`workTime`, daily_user.`increase_income`, daily_user.`increase_rmb`, daily_user.`increase_follower`,  user_level.`name` as levelname , agent.`name` as agentname ,plat.ratename, plat.`name` as platname ,daily_user.`reachStandard`  FROM `user`   LEFT JOIN `daily_user`  on user.`platform`= daily_user.`platform`  AND user.`platformid`= daily_user.`platformid` LEFT JOIN `agent` on agent.`id`= user.`agentid` LEFT JOIN `user_level` on user_level.`id`= user.`level`  LEFT JOIN `platform` as plat on plat.`id`= user.`platform` WHERE daily_user.`idate` = '" . $getDate  . "' AND daily_user.`reachStandard`=1 and user.companyid=".$companyId ."  GROUP BY user.`platform` ,user.`platformid`  ORDER BY daily_user.`workTime` DESC limit ".$page ." ,". $total ."   ";
        $da =DB::select($sql1);

        $tota = count($da);    //当前页显示条数
        $re['data'] = $da;   //数据
        $re['pageNum']= $pageNum; //总页数
        if(isset($data->page)&&$data->page!=1){
            $re['page']   = $data->page;//第几页
        }else{
            $re['page']  = 1;
        }
        $re['num']    = $tota;

        return $re;

    }

    /*
     * 日未达标主播
     */
    public static function unrateStar($data){
//        $companyId =8001;
//        $currentTime ='2016-12-02 15:25:13';
        $companyId  = $data->companyId;
        $currentTime = $data->startTime;
        $getDate =  date('Y-m-d',strtotime($currentTime));
        $endDate =  date('Y-m-t',strtotime($currentTime));
       // $sql ="SELECT user.`platform` ,user.`platformid` , user.`nickname` ,user.`avatar` ,daily_user.`workTime` ,user.`income` ,user.`rmb` ,daily_user.`follower` ,user_level.`name` as levelname ,agent.`name` as agentname ,plat.`name` as platname,daily_user.`reachStandard`,plat.`ratename`   FROM `user`   LEFT JOIN `daily_user` on user.`platform`= daily_user.`platform`  AND user.`platformid`= daily_user.`platformid` LEFT JOIN `agent` on agent.`id`= user.`agentid` LEFT JOIN `user_level`  on user_level.`id`= user.`level`  LEFT JOIN `platform` as plat on plat.`id`= user.`platform`  AND daily_user.`idate` = '" . $getDate . "'  WHERE   daily_user.`reachStandard`!=1 and user.companyid =".$companyId ."  GROUP BY user.`platform` ,user.`platformid`  ORDER BY daily_user.`workTime` DESC ";
        $sql = "SELECT * FROM (SELECT user.`platform`, user.`platformid`,   user.remark,  user.`nickname`,  user.`avatar`,  dayuser.`workTime`,   user.`income`,   user.`rmb`,   dayuser.`follower`,   user_level.`name` as levelname,  agent.`name` as agentname,  plat.`name` as platname,  dayuser.`reachStandard`, plat.`ratename` FROM `user`  LEFT JOIN (SELECT * FROM `daily_user` WHERE `idate`= '" . $getDate . "' ) as dayuser on `user`.`platform`= dayuser.platform  AND `user`.`platformid`= dayuser.platformid  LEFT JOIN `agent` on agent.`id`= user.`agentid`  LEFT JOIN `user_level` on user_level.`id`= user.`level` LEFT JOIN `platform` as plat on plat.`id`= user.`platform` WHERE `user` .`companyid` = ".$companyId ." ) as b WHERE b.reachStandard IS NULL or b.reachStandard !=1 order by b.workTime desc";
        $result =DB::select($sql);
        $sumNum = count($result);    //总条数
        if(isset($data->total)){
            $total =$data->total;
        }else{
            $total = 10;  //每页显示的条数
        }
        $pageNum = ceil($sumNum / $total);    //总页数
        if(isset($data->page)&&$data->page!=1){
            $page = ($data->page-1) *$total;
        }else{
            $page = 0;
        }
        $sql1 = "SELECT * FROM (SELECT user.`platform`, user.`platformid`,   user.remark,  user.`nickname`,  user.`avatar`,  dayuser.`workTime`,   dayuser.`increase_income`, dayuser.`increase_rmb`, dayuser.`increase_follower`,   user_level.`name` as levelname,  agent.`name` as agentname,  plat.`name` as platname,  dayuser.`reachStandard`, plat.`ratename` FROM `user`  LEFT JOIN (SELECT * FROM `daily_user` WHERE `idate`= '" . $getDate . "' ) as dayuser on `user`.`platform`= dayuser.platform  AND `user`.`platformid`= dayuser.platformid  LEFT JOIN `agent` on agent.`id`= user.`agentid`  LEFT JOIN `user_level` on user_level.`id`= user.`level` LEFT JOIN `platform` as plat on plat.`id`= user.`platform` WHERE `user` .`companyid` = ".$companyId ." ) as b WHERE b.reachStandard IS NULL or b.reachStandard !=1  order by b.workTime desc limit ".$page ." ,". $total ."  ";
       // echo $sql1;
      //  $sql1 =  "SELECT user.`platform` ,user.`platformid` ,user.remark,user.`nickname` ,user.`avatar` ,daily_user.`workTime` ,user.`income` ,user.`rmb` ,daily_user.`follower` ,user_level.`name` as levelname ,agent.`name` as agentname,plat.`name` as platname ,daily_user.`reachStandard`,plat.`ratename`    FROM `user`  LEFT JOIN `daily_user`  on user.`platform`= daily_user.`platform`  AND user.`platformid`= daily_user.`platformid` LEFT JOIN `agent` on agent.`id`= user.`agentid` LEFT JOIN `user_level`  on user_level.`id`= user.`level`  LEFT JOIN `platform` as plat on plat.`id`= daily_user.`platform`  WHERE daily_user.`reachStandard`!=1 and user.companyid =". $companyId  ." AND daily_user.`idate` = '" . $getDate . "'   GROUP BY user.`platform` ,user.`platformid`  ORDER BY daily_user.`workTime` DESC  limit ".$page ." ,". $total ."   ";

        $da =DB::select($sql1);

        $tota = count($da);    //当前页显示条数
        $re['data'] = $da;   //数据
        $re['pageNum']= $pageNum; //总页数
        if(isset($data->page)&&$data->page!=1){
            $re['page']   = $data->page;//第几页
        }else{
            $re['page']  = 1;
        }
        $re['num']    = $tota;

        return $re;

    }

    /*
   * 日小组考勤
   */
    public static function gourps($data){
//        $companyId =8001;
//        $currentTime ='2016-12-02 15:25:13';
        $companyId  = $data->companyId;
        $currentTime = $data->startTime;
        $getDate =  date('Y-m-d',strtotime($currentTime));
        $monthDate =  date('Y-m',strtotime($currentTime));
        $endDate =  date('Y-m-t',strtotime($currentTime));
        $sql ="select agent,count(days) as iratedays ,count(reachStandard) as irate,count(reachStandard)/count(days)*100 as percent,COUNT(days)-COUNT(`reachStandard`) as unrate from (select agent,  platform, platformid, days, count(`platformid`) as icount, reachStandard  from(select a.`platform`, a.`platformid`, a.`agentid` as agent , a.`days`, b.`idate`, b.reachStandard  from `user` a left join `daily_user` b on a.`platform`= b.`platform`  and a.`platformid`= b.`platformid` and b.reachStandard=1 and  b.`idate` = '". $getDate  . "' where a.`companyid` = ". $companyId  .") c group by agent,`platform`,`platformid`) as temp  group by agent";

        $result =DB::select($sql);
        $sumNum = count($result);    //总条数
        if(isset($data->total)){
            $total =$data->total;
        }else{
            $total = 10;  //每页显示的条数
        }
        $pageNum = ceil($sumNum / $total);    //总页数
        if(isset($data->page)&&$data->page!=1){
            $page = ($data->page-1) *$total;
        }else{
            $page = 0;
        }
        //  $sql1 ="select agent,count(days),count(reachStandard) as irate,count(reachStandard)/count(days)*100 as percent,COUNT(days)-COUNT(`reachStandard`) as unrate from (select agent,  platform, platformid, days, count(`platformid`) as icount, case when count(reachStandard) >= days then 1 else null end as reachStandard  from(select a.`platform`, a.`platformid`, a.`agent`, a.`days`, b.`idate`, b.reachStandard  from `user_plan` a left join `daily_user` b on a.`platform`= b.`platform`  and a.`platformid`= b.`platformid` and b.reachStandard=1 and a.idate like '2016-12%'  and b.`idate` = '". $getDate  . "' where a.`companyid` = ". $companyId  .") c group by agent,`platform`,`platformid`) as temp group by agent  limit ".$page ." ,". $total ." ";
     //   $sql1 =  "select agent, temp.icount,   count(days) as iratedays ,  count(reachStandard) as irate,  count(reachStandard) /count(days) *100 as percent,   COUNT(days) -COUNT(`reachStandard`) as unrate,agent.`name` as agentname  from( select agent, platform, platformid, days, count(`platformid`) as icount, case when count(reachStandard)>= days then 1 else null end as reachStandard from( select a.`platform`, a.`platformid`, a.`agent`, a.`days`, b.`idate`, b.reachStandard from `user_plan` a  left join `daily_user` b on a.`platform`= b.`platform` and a.`platformid`= b.`platformid` and b.reachStandard= 1  and a.idate like '".$monthDate ."%' and b.`idate`= '". $getDate  . "' where a.`companyid`= ".$companyId .") c group by agent, `platform`, `platformid`) as temp LEFT JOIN `agent`  on temp.agent = agent.`id` group by agent limit ".$page ." ,". $total ."";
        $sql1 =  "select agent, count(temp.icount) as icount,   count(days) as iratedays ,  count(reachStandard) as irate,  count(reachStandard) /count(days) *100 as percent,   COUNT(days) -COUNT(`reachStandard`) as unrate,agent.`name` as agentname  from( select agent, platform, platformid, days, count(`platformid`) as icount,  reachStandard from( select a.`platform`, a.`platformid`, a.`agentid` as agent, a.`days`, b.`idate`, b.reachStandard from `user` a  left join `daily_user` b on a.`platform`= b.`platform` and a.`platformid`= b.`platformid` and b.reachStandard= 1  and b.`idate`= '". $getDate  . "' where a.`companyid`= ".$companyId .") c group by agent, `platform`, `platformid`) as temp LEFT JOIN `agent`  on temp.agent = agent.`id` where agent.companyid =". $companyId ." group by agent limit ".$page ." ,". $total ."";

       # echo $sql1;
        $da =DB::select($sql1);

        $tota = count($da);    //当前页显示条数
        $re['data'] = $da;   //数据
        $re['pageNum']= $pageNum; //总页数
        if(isset($data->page)&&$data->page!=1){
            $re['page']   = $data->page;//第几页
        }else{
            $re['page']  = 1;
        }
        $re['num']    = $tota;

        return $re;

    }


    /*************************************************************************************单数 *****************************************/
    /*
     * 今日总览
     */
    public static function pageIndex($data){
        //当前在播
        $companyid      = $data->companyId;
        $currentTime    = $data->startTime;
//        $companyid = 8001;
//        $currentTime ='2016-12-28 15:25:13';
        $getDate =  date('Y-m-d',strtotime($currentTime));
        $startTime =    $getDate . " 00:00:00";
        $endTime   =    $getDate.   " 23:59:59";
        $liveStar =  DB::select("SELECT COUNT(*) as nowLive  FROM `user`  INNER JOIN  `live_history`  on user.`platform` =live_history.`platform`  AND user.`platformid` = live_history.`platformid`  WHERE live_history.`endtime` IS NULL AND user.`cancel_date`= '0000-00-00'  AND user.`companyid`= ". $companyid ." ") ;

        if(!$liveStar[0]->nowLive){
            $data1['liveStar'] =  0;
        }else{
            $data1['liveStar'] = $liveStar[0]->nowLive;
        }
        //日累计上播
        $sumStar = DB::select(" SELECT COUNT(*) as sumLive  FROM `user`   LEFT JOIN `daily_user`  on user.`platform` = daily_user.`platform` AND  user.`platformid` =daily_user.`platformid`  WHERE daily_user.`idate` = '".$getDate ."'  and user.`cancel_date`= '0000-00-00'  AND  user.`companyid`= ". $companyid ."  ");

        if(!$sumStar[0]->sumLive){
            $data1['sumLive'] = 0;
        }else{
            $data1['sumLive'] = $sumStar[0]->sumLive;
        }
        //当日收入
   $sumRmb  =  DB::select("SELECT SUM(daily_user.`increase_rmb`)  as sumRmb  FROM `user`  LEFT JOIN `daily_user` on user.`platform`= daily_user.`platform`  AND user.`platformid`= daily_user.`platformid` WHERE daily_user.`idate` = '" . $getDate . "'  AND user.`companyid`= ". $companyid ." and user.`cancel_date`= '0000-00-00'  ");
        if(!$sumRmb[0]->sumRmb){
            $data1['sumRmb']  =   0;
        }else{
            $data1['sumRmb'] = $sumRmb[0]->sumRmb;
        }
        //当日增粉
        $sumFollower =  DB::select("SELECT SUM(daily_user.`increase_follower`)  as sumFollower  FROM `user`  LEFT JOIN `daily_user` on user.`platform`= daily_user.`platform`  AND user.`platformid`= daily_user.`platformid` WHERE daily_user.`idate` = '" . $getDate . "'  AND user.`companyid`= ". $companyid ." and user.`cancel_date`= '0000-00-00' ");

       if(!$sumFollower[0]->sumFollower){
            $data1['sumFollower'] =   0;
        }else{
            $data1['sumFollower'] = $sumFollower[0]->sumFollower;
        }
        //工会当日收入
        $sumCompanyrmb =  DB::select("SELECT SUM(daily_user.`increase_company_rmb`)  as sumCompanyrmb  FROM `user`  LEFT JOIN `daily_user` on user.`platform`= daily_user.`platform`  AND user.`platformid`= daily_user.`platformid` WHERE daily_user.`idate` = '" . $getDate . "'  AND user.`companyid`= ". $companyid ." and user.`cancel_date`= '0000-00-00' ");

        if(!$sumCompanyrmb[0]->sumCompanyrmb){
            $data1['sumCompanyrmb'] =   0;
        }else{
            $data1['sumCompanyrmb'] = $sumCompanyrmb[0]->sumCompanyrmb;
        }





        /*
         * 平台数据分布
         */
        //活跃主播
        $platStar = DB::select("SELECT COUNT(*) as sumLive,user.platform,plat.name,plat.`color`  FROM `user`   LEFT JOIN `daily_user`  on user.`platform` = daily_user.`platform` AND  user.`platformid` =daily_user.`platformid` LEFT JOIN platform as plat on plat.id = user.platform   WHERE daily_user.`idate`    = '".$getDate ."'       AND user.`companyid`= ".$companyid ." GROUP BY daily_user.`platform` ");
        if($platStar){
            $data1['platStar'] = $platStar;
        }else{
            $data1['platStar'] = array();
        }
        //日收入分布
        $platIncome  =  DB::select("SELECT SUM(daily_user.`increase_rmb`) as sumRmb,user.platform,plat.name,plat.`color`  FROM `user`   LEFT JOIN `daily_user` on user.`platform` = daily_user.`platform` AND  user.`platformid` =daily_user.`platformid` LEFT JOIN platform as plat on plat.id = user.platform   WHERE daily_user.`idate`  = '".$getDate ."'    AND user.`companyid`= ". $companyid ."  GROUP BY daily_user.`platform`");
        if($platIncome){
            $data1['platIncome'] = $platIncome;
        }else{
            $data1['platIncome'] = array();
        }
        //日增粉分布
        $platFollower  =  DB::select("SELECT SUM(daily_user.`increase_follower`) as sumfollower,user.platform,plat.name ,plat.`color` FROM `user`   LEFT JOIN `daily_user` on user.`platform` = daily_user.`platform` AND  user.`platformid` =daily_user.`platformid` LEFT JOIN platform as plat on plat.id = user.platform   WHERE daily_user.`idate`  = '".$getDate ."'    AND user.`companyid`= ".$companyid ."  GROUP BY daily_user.`platform`");
        if($platFollower){
            $data1['platFollower'] = $platFollower;
        }else{
            $data1['platFollower'] = array();
        }
        return $data1;

    }

    /*
     * 收入分析单数
     */
    public static function pageIncome($data){
        /*
         * 本月收入  /累计收入
         */
        $companyid   = $data->companyId;
        $currentTime =  $data ->startTime;
        $startTime =    date('Y-m-01',strtotime($currentTime)) . " 00:00:00";
        $endTime   =    date('Y-m-t',strtotime($currentTime)).   " 23:59:59";
        $monthRmb   = DB::select("SELECT SUM(`increase_rmb`) as increase_rmb   FROM `daily_company` WHERE `companyid` =" .$companyid ." AND `idate` BETWEEN '". $startTime ."' AND '". $endTime  ."'");

        $rmb        = DB::select("SELECT `rmb`    FROM `company` WHERE `companyid` =".$companyid ."");
        if(!$monthRmb){
            $re['monthRmb'] = 0;
        }else{
            $re['monthRmb'] = $monthRmb;
        }

        if(!$rmb){
            $re['rmb'] = 0;
        }else{
            $re['rmb'] = $rmb;
        }
        return $re;

    }

    /*
     * 增粉分析单数
     */
    public static function pageFollowers($data){
        /*
         * 本月增粉  /累计增粉
         */
        $companyid   = $data->companyId;
        $currentTime =  $data ->startTime;
//        $companyid = 8001;
//        $currentTime ='2016-12-28 15:25:13';
//        $getDate =  date('Y-m-d',strtotime($currentTime));
        $startTime =    date('Y-m-01',strtotime($currentTime)) . " 00:00:00";
        $endTime   =    date('Y-m-t',strtotime($currentTime)).   " 23:59:59";
//        $startTime =    $getDate . " 00:00:00";
//        $endTime   =    $getDate.   " 23:59:59";
        $monthFollower   = DB::select("SELECT SUM(`increase_follower`) as increase_follower  FROM `daily_company` WHERE `companyid` =" .$companyid ." AND `idate` BETWEEN '". $startTime ."' AND '". $endTime  ."'");
        $follower        = DB::select("SELECT `follower`    FROM `company` WHERE `companyid` =".$companyid ."");
//      dd($monthFollower);
        if(!$monthFollower){
            $re['monthFollower'] = 0;
        }else{
            $re['monthFollower'] = $monthFollower[0]->increase_follower;
        }

        if(!$follower){
            $re['follower'] = 0;
        }else{
            $re['follower'] = $follower[0]->follower;
        }
        return $re;

    }

    /*
     * 日考勤单数
     */
    public static function pageWork($data){

        // $companyid  =8001;


//        $workNum   = 999;
        $companyid   = $data->companyId;
        $currentTime =  $data ->startTime;
//        $companyid = 8001;
//        $currentTime ='2016-12-28 15:25:13';
        $getDate =  date('Y-m-d',strtotime($currentTime));
        $workNum = DB::select("SELECT COUNT(`platformid`) as workNum  FROM `user` WHERE `companyid` =". $companyid  ."  and user.`cancel_date`='0000-00-00' ");
        $rateNum =DB::select("SELECT COUNT(user.`platformid`) as rateNum   FROM `user`   LEFT JOIN `daily_user` on user.`platform`= daily_user.`platform`  AND user.`platformid`= daily_user.`platformid` WHERE daily_user.`idate` = '". $getDate ."'   AND daily_user.`reachStandard`= 1   AND user.`companyid`= ".$companyid ." and user.`cancel_date`='0000-00-00'  GROUP BY user.`companyid` ");
        if($workNum){
            $re['workNum'] =  $workNum[0] ->workNum;
        }else{
            $re['workNum'] =0;
        }
        if($rateNum){
            $re['rateNum'] =  $rateNum[0] ->rateNum;
        }else{
            $re['rateNum'] =  0;
        }
        if($re['rateNum'] ==0 || $re['workNum'] ==0){
            $re['percent'] = 0;
        }else{
            $re['percent'] = $re['rateNum']/$re['workNum']*100;
        }

        return $re;
    }

    /*
     * 主播管理单数
     * 平均在线人数 未完成
     */
    public static function starManager($data){
        //   $currentTime =  $data ->startTime;
//        $companyid = 8001;
//        $currentTime ='2016-12-28 15:25:13';
        $currentTime = $data->startTime;
        $getDate =  date('Y-m-01',strtotime($currentTime));
        $monthDate =  date('Y-m',strtotime($currentTime));
        $endDate =  date('Y-m-t',strtotime($currentTime));
        $companyid   = $data->companyId;
        $gender =  DB::select("SELECT COUNT(`platformid`)as count,`gender`    FROM `user` WHERE `companyid` =".$companyid ." and user.`cancel_date`='0000-00-00' GROUP BY `gender` ");
        $platform =DB::select("SELECT COUNT(user.`platformid`)as count,user.`platform`,plat.name ,plat.color   FROM `user`  LEFT JOIN `platform` as plat on plat.id=user.`platform`  WHERE user.`companyid` = ".$companyid ." and user.`cancel_date`='0000-00-00'  GROUP BY user.`platform` ");
        $province = DB::select("SELECT COUNT(`platformid`)as count,provincename,province   FROM `user` WHERE `companyid` =".$companyid ." and user.`cancel_date`='0000-00-00'  GROUP BY province");
        $starNum  = DB::select("SELECT COUNT(*) as starnum  FROM `user` WHERE `companyid` =".$companyid ." and user.`cancel_date`='0000-00-00' ");
        $avarage    = DB::select("SELECT avg(todayOnlineNum) as avarage  FROM `daily_company` WHERE `companyid` =".$companyid ." AND `idate` BETWEEN '". $getDate . "' AND '". $endDate . "'");
        if($gender){
            $re['gender'] = $gender;
        }else{

            $re['gender'] =array();
        }
        if($platform){
            $re['platform'] = $platform;
        }else{
            $re['platform'] =  array();
        }
        if($province){
            $re['province'] = $province;
        }else{
            $re['province'] =array();
        }

        if($starNum){
            $re['starNum'] = $starNum[0] ->starnum;     //主播总数
        }else{
            $re['starNum'] =array();
        }

        if($avarage){
            $re['avarage'] = $avarage[0] ->avarage;     //平均在线人数
        }else{
            $re['avarage'] =array();
        }

        // $re['starnum']   =90;/
        //   $re['avarage']   =98;//平均在线人数
        return $re;






    }

    /*
     * 月考勤单数
     */
    public static function pagemonthWork($data){
        $companyid   = $data->companyId;
        //  $currentTime =  $data ->startTime;
//        $companyid = 8001;
//        $currentTime ='2016-12-28 15:25:13';
        $currentTime = $data->startTime;
        $getDate =  date('Y-m-01',strtotime($currentTime));
        $monthDate =  date('Y-m',strtotime($currentTime));
        $endDate =  date('Y-m-t',strtotime($currentTime));
        $currentDate =  date('Y-m-d',strtotime($currentTime));
        $sql = "SELECT SUM(`achieveNum`)/SUM(`attendStar`)*100 as monthrate  FROM `daily_company` WHERE companyid=".$companyid ." AND `idate` BETWEEN '".$getDate ."' AND '". $endDate . "' ";

        $result =  DB::select($sql);
        if($result &&isset($result[0]->monthrate)){
            $re['monthrate'] = $result[0]->monthrate;
        }else{
            $re['monthrate'] = 0;
        }
        $sql1 ="select activeUser  FROM `company` WHERE companyid=".$companyid ." ";

        $attendStar =  DB::select($sql1);
        if($result&&isset($attendStar[0]->activeUser)){
            $re['person'] = $attendStar[0]->activeUser;
        }else{
            $re['person'] =0;
        }
//        $re['monthrate'] =33;
//        $re['person']    = 88;
        return $re;
    }

    /*
     *直播记录
     */
    public static function livehistrys($data){
        $platform   =   $data->platform;
        $platformid =   $data->platformid;
        $currentTime = $data->startTime;
        $getDate1 =  date('Y-m-01',strtotime($currentTime));
        $endDate1 =  date('Y-m-t',strtotime($currentTime));
        $getDate =  strtotime(date('Y-m-01 00:00:00',strtotime($currentTime)));
        $endDate =  strtotime(date('Y-m-t 23:59:59',strtotime($currentTime)));
        $i=0;
        while($getDate <= $endDate){
            $datearr[$i]['idate'] = date('Y-m-d',$getDate);//得到dataarr的日期数组。
            $datearr[$i]['increase_rmb'] = 0;
            $datearr[$i]['increase_follower'] = 0;
            $datearr[$i]['onlineMax'] = 0;
            $datearr[$i]['recommend'] = 0;
            $datearr[$i]['workTime']=0;
            $getDate=$getDate + 3600*24;
            $i++;
        }

        $sql =  "select * from daily_user where `platform` =".$platform ." AND `platformid` = ".$platformid ." AND `idate` BETWEEN '". $getDate1 . "' AND '".$endDate1 . "'";

        $result = DB::select($sql);
        //dd($result);
        for($i=0; $i<count($result); $i++){
            for($j=0; $j<count($datearr);$j++){
                if($result[$i]->idate == $datearr[$j]['idate']){
                    $datearr[$j]['increase_rmb'] = $result[$i]->increase_rmb;
                    $datearr[$j]['increase_follower'] = $result[$i]->increase_follower;
                    $datearr[$j]['onlineMax'] = $result[$i]->onlineMax;
                    $datearr[$j]['recommend'] = $result[$i]->recommend;
                    $datearr[$j]['workTime']=$result[$i]->workTime;

                }
            }
        }

        return $datearr;


    }




    /*
     * 主播24小时直播记录
     */

    public static function MongoLiveLog($data){
    //日期 用户id 平台号 时间
        $platform   =   $data->platform;
        $platformid =   $data->platformid;
        $currentTime = $data->startTime;
        $getDate =  date('Ymd',strtotime($currentTime));
        $monthDate =  date('Ym',strtotime($currentTime));
        $endDate =  date('Y-m-t',strtotime($currentTime));
        $mongo = new dbMongo();
        $query =  "liveManager.liveLog_".$monthDate;
        $id    =   $platformid."_". $platform ."_".$getDate;

        $option =  [
            'limit' => 1 ,
            'projection' => []
        ];

        $result = $mongo -> query($query , ["_id" => $id] , $option);

        if(count($result)  == 1) {
            return json_encode($result[0]->history);
        }

        return;

    }


    /*
   * 添加经纪人
   */

    public static function addAgent($data){
        $getDate =  date('y-m-d',time());
        $agentname  = $data->agentname;
        $companyId  = $data->companyId;
        $result = DB::insert("insert `agent`(`name`,`companyid`,`date`) values('".$agentname ."',".$companyId.",'".$getDate."')");
        if($result){
            return   $result;
        }
    }

    /*
     * 经纪人旗下主播
     */
    public static function allStar($data){
        $companyId  = $data->companyId;
        $agentid    = $data->agentid;
        $sql = "SELECT  user.`nickname` ,user.`remark` ,user.`platform`,user.`platformid` ,`platform`.`name` as platname,`user_level`.`name` as levelname,`agent`.`name` as agentname    FROM `user` LEFT JOIN `platform` on user.`platform` =`platform`.`id` LEFT JOIN `user_level` on user.`level` =`user_level`.`id` LEFT JOIN `agent` on `agent`.`id` =user.`agentid`  WHERE user.`companyid` =".$companyId ."  and user.agentid =".$agentid ." and user.`cancel_date`='0000-00-00' " ;

        $result =DB::select($sql);
        $sumNum = count($result);    //总条数
        if(isset($data->total)){
            $total =$data->total;
        }else{
            $total = 10;  //每页显示的条数
        }
        $pageNum = ceil($sumNum / $total);    //总页数
        if(isset($data->page)&&$data->page!=1){
            $page = ($data->page-1) *$total;
        }else{
            $page = 0;
        }
             $sql1 = "SELECT  user.`nickname` ,user.`remark` ,user.`platformid` ,user.`platform` ,`platform`.`name` as platname,`user_level`.`name` as levelname,`agent`.`name` as agentname    FROM `user` LEFT JOIN `platform` on user.`platform` =`platform`.`id` LEFT JOIN `user_level` on user.`level` =`user_level`.`id` LEFT JOIN `agent` on `agent`.`id` =user.`agentid`  WHERE user.`companyid` =".$companyId ."  and  user.agentid =".$agentid ." and user.`cancel_date`='0000-00-00'  limit ".$page ." ,". $total ."" ;

        $da =DB::select($sql1);

        $tota = count($da);    //当前页显示条数
        $re['data'] = $da;   //数据
        $re['pageNum']= $pageNum; //总页数
        if(isset($data->page)&&$data->page!=1){
            $re['page']   = $data->page;//第几页
        }else{
            $re['page']  = 1;
        }
        $re['num']    = $tota;

        return $re;

    }

    /*
     * 所有经纪人
     */
    public static function allAgent($data){
        $companyId  = $data->companyId;
        $sql ="SELECT b.sumstar,`agent`.`name` as agentname,`agent`.`date`,`agent`.`id`    FROM  `agent` LEFT JOIN ( SELECT COUNT(`platformid`) as sumstar,`agentid`  FROM `user` WHERE `companyid` =".$companyId ." GROUP BY `agentid`) b on b.agentid=`agent` .id WHERE  `agent`.`companyid` =".$companyId ." ";

        $result =DB::select($sql);
        $sumNum = count($result);    //总条数
        if(isset($data->total)){
            $total =$data->total;
        }else{
            $total = 10;  //每页显示的条数
        }
        $pageNum = ceil($sumNum / $total);    //总页数
        if(isset($data->page)&&$data->page!=1){
            $page = ($data->page-1) *$total;
        }else{
            $page = 0;
        }
        $sql1 =  "SELECT b.sumstar,`agent`.`name` as agentname,`agent`.`date` ,`agent`.`id`   FROM  `agent` LEFT JOIN ( SELECT COUNT(`platformid`) as sumstar,`agentid`  FROM `user` WHERE `companyid` =".$companyId ." GROUP BY `agentid`) b on b.agentid=`agent` .id WHERE  `agent`.`companyid` =".$companyId ."  limit ".$page ." ,". $total ." ";
        $da =DB::select($sql1);

        $tota = count($da);    //当前页显示条数
        $re['data'] = $da;   //数据
        $re['pageNum']= $pageNum; //总页数
        if(isset($data->page)&&$data->page!=1){
            $re['page']   = $data->page;//第几页
        }else{
            $re['page']  = 1;
        }
        $re['num']    = $tota;

        return $re;




    }
    /*
     * 修改经纪人名称
     */
    public static function updateAgent($data)
    {
          $agentname    =   $data->agentname;
          $agentid      =   $data->agentid;

          $result       =    DB::update("update `agent` set `name`='". $agentname ."' where `id`=".$agentid." ");
          if($result){
              return true;
          }
    }

    /*
     * 删除经纪人
     */
    public static function   deleteAgent($data){
        $agentid    =   $data->agentid;
        $companyId  = $data->companyId;
        $num        =   DB::select("SELECT COUNT(`platformid`) as num FROM `user` WHERE `agentid` =". $agentid ." AND `companyid` =". $companyId ."");
        if($num[0]->num >=1){
            return $num;
        }else{
            $result =   DB::delete("delete from `agent` where `id`=".$agentid ." and `companyid`=". $companyId ." ");
            if($result){
                return true;
            }
        }
    }

    /*
     * 所有主播
     */
    public static function allStars($data){
        $companyId  = $data->companyId;
        $sql =  "SELECT  user.`nickname` ,user.`remark` ,user.signon_date,user.level,user.agentid, user.`platformid` ,`platform`.`name` as platname,`user_level`.`name` as levelname,`agent`.`name` as agentname    FROM `user` LEFT JOIN `platform` on user.`platform` =`platform`.`id` LEFT JOIN `user_level` on user.`level` =`user_level`.`id` LEFT JOIN `agent` on `agent`.`id` =user.`agentid`  WHERE user.`companyid` =".$companyId ." AND user.`cancel_date`='0000-00-00' and user.`agentid` !=0 " ;
        $result =DB::select($sql);
        $sumNum = count($result);    //总条数
        if(isset($data->total)){
            $total =$data->total;
        }else{
            $total = 10;  //每页显示的条数
        }
        $pageNum = ceil($sumNum / $total);    //总页数
        if(isset($data->page)&&$data->page!=1){
            $page = ($data->page-1) *$total;
        }else{
            $page = 0;
        }
        $sql1 =  "SELECT  user.`nickname` ,user.`remark` ,user.signon_date,user.level,user.agentid,user.`platformid` ,user.`platform` ,`platform`.`name` as platname,`user_level`.`name` as levelname,`agent`.`name` as agentname    FROM `user` LEFT JOIN `platform` on user.`platform` =`platform`.`id` LEFT JOIN `user_level` on user.`level` =`user_level`.`id` LEFT JOIN `agent` on `agent`.`id` =user.`agentid`  WHERE user.`companyid` =".$companyId ." AND user.`cancel_date`='0000-00-00' and user.`agentid` !=0 limit ".$page ." ,". $total ." " ;

        $da =DB::select($sql1);

        $tota = count($da);    //当前页显示条数
        $re['data'] = $da;   //数据
        $re['pageNum']= $pageNum; //总页数
        if(isset($data->page)&&$data->page!=1){
            $re['page']   = $data->page;//第几页
        }else{
            $re['page']  = 1;
        }
        $re['num']    = $tota;

        return $re;
    }

  /*
   * 解约主播                                                                                                                                                              ,
   */
    public static function breakStar($data){
//         $companyid     =   $data->companyId;
         $platform      =   $data->platform;
         $platformid    =   $data->platformid;
         $getDate =  date('y-m-d',time());
        $result = DB::update("update `user` set `cancel_date`='". $getDate ."' where `platform`=". $platform ." and `platformid`=".$platformid ."");
        if($result){
            return true;
        }

    }
    /*
  * 解约经纪人
  */
    public static function breakAgent($data){
//         $companyid     =   $data->companyId;
        $platform      =   $data->platform;
        $platformid    =   $data->platformid;
        $result = DB::update("update `user` set `agentid`='null' where `platform`=". $platform ." and `platformid`=".$platformid ."");
        if($result){
            return true;
        }

    }




    /*
     * 主播信息编辑
     */
    public static function editStar($data){
        $platform      =   $data->platform;
        $platformid    =   $data->platformid;
        $remark        =   $data->remark;
        $agentid       =   $data->agentid;
        $levelid       =   $data->levelid;
        $result =   DB::update("update `user` set `remark`='". $remark  ."',level=". $levelid .",agentid=".$agentid ." where `platform`=". $platform ." and `platformid`='". $platformid ."'");
        if($result){
            return true;
        }
    }

    /*
     * 所有等级(无分页)
     */
    public static function allLevel($data){
        $companyId  = $data->companyId;
        $result = DB::select("SELECT * FROM `user_level` WHERE `companyid` =". $companyId ."");
        if($result){
            return $result;
        }
    }


    /*
   *  所有等级(分页)
   */
    public static function allLevelpage($data){
        $companyid       =   $data->companyId;
        $sql = "SELECT * FROM `user_level` WHERE `companyid` =". $companyid ."";

        $result =DB::select($sql);
        $sumNum = count($result);    //总条数
        if(isset($data->total)){
            $total =$data->total;
        }else{
            $total = 10;  //每页显示的条数
        }
        $pageNum = ceil($sumNum / $total);    //总页数
        if(isset($data->page)&&$data->page!=1){
            $page = ($data->page-1) *$total;
        }else{
            $page = 0;
        }
        $sql1 =  "SELECT * FROM `user_level` WHERE `companyid` =". $companyid ."  limit ".$page ." ,". $total ." ";

        # echo $sql1;
        $da =DB::select($sql1);

        $tota = count($da);    //当前页显示条数
        $re['data'] = $da;   //数据
        $re['pageNum']= $pageNum; //总页数
        if(isset($data->page)&&$data->page!=1){
            $re['page']   = $data->page;//第几页
        }else{
            $re['page']  = 1;
        }
        $re['num']    = $tota;

        return $re;



    }


    /*
     * 级别详细信息
     */
    public static function detailLevel($data){
        $companyid       =   $data->companyId;
        $leveid          =   $data->leveid;

        $result =   DB::select("SELECT * FROM `user_level` WHERE `companyid` =".$companyid ." AND `id` =". $leveid ."");
        if($result){
            return $result;
        }
    }
    /*
     * 级别编辑
     */
    public static function  editLevel($data){
        $companyid       =   $data->companyId;
        $leveid          =   $data->leveid;
        $monthincome     =   $data->monthincome;
        $daywork         =   $data->daywork;
        $monthwork        =   $data->monthwork;
        $dayincome       =   $data->dayincome;
        $result =  DB::update("update `user_level` set `month_income`=".$monthincome .",day_work=".$daywork .",month_work=". $monthwork .",day_income=".$dayincome ."  where `id`=". $leveid ." and `companyid`=".$companyid ."");
        if($result){
            return true;
        }
    }


    /*
 * 删除级别
 */
    public static function   deleteLevel($data){
        $levelid    =   $data->levelid;
        $companyId  = $data->companyId;
        $num        =   DB::select("SELECT COUNT(`platformid`) as num FROM `user` WHERE `level` =". $levelid ." AND `companyid` =". $companyId ."");
        if($num[0]->num >=1){
            return $num;
        }else{
            $result =   DB::delete("delete from `user_level` where `id`=".$levelid ." and `companyid`=". $companyId ." ");
            if($result){
                return true;
            }
        }
    }

    /*
     *  没有经纪人的主播
     */
    public static function noneAgent($data){
        $companyid       =   $data->companyId;
        $sql = "SELECT * FROM `user` WHERE `agentid` =0 AND `companyid` =".$companyid ."";

        $result =DB::select($sql);
        $sumNum = count($result);    //总条数
        if(isset($data->total)){
            $total =$data->total;
        }else{
            $total = 10;  //每页显示的条数
        }
        $pageNum = ceil($sumNum / $total);    //总页数
        if(isset($data->page)&&$data->page!=1){
            $page = ($data->page-1) *$total;
        }else{
            $page = 0;
        }
        $sql1 =  "SELECT user.*,  `platform`.`name` as platname,   `user_level`.`name` as levelname,   `agent`.`name` as agentname FROM `user`   LEFT JOIN `platform` on user.`platform`= `platform`.`id`  LEFT JOIN `user_level` on user.`level`= `user_level`.`id`  LEFT JOIN `agent` on `agent`.`id`= user.`agentid`  WHERE user.`agentid` =0 AND user.`companyid` =".$companyid ."  limit ".$page ." ,". $total ." ";

        # echo $sql1;
        $da =DB::select($sql1);

        $tota = count($da);    //当前页显示条数
        $re['data'] = $da;   //数据
        $re['pageNum']= $pageNum; //总页数
        if(isset($data->page)&&$data->page!=1){
            $re['page']   = $data->page;//第几页
        }else{
            $re['page']  = 1;
        }
        $re['num']    = $tota;

        return $re;



    }

    /*
     * 查找经纪人
     */
    public static function searchAgent($data){
        $companyid       =   $data->companyId;
        $keyword         =   $data->keyword;
        $agentid       =   $data->agentid;
        $sql = "SELECT * FROM `user` WHERE `companyid` =".$companyid ."  and agentid=".$agentid ."  AND `nickname` LIKE '%".$keyword ."%'";

        $result =DB::select($sql);
        $sumNum = count($result);    //总条数
        if(isset($data->total)){
            $total =$data->total;
        }else{
            $total = 10;  //每页显示的条数
        }
        $pageNum = ceil($sumNum / $total);    //总页数
        if(isset($data->page)&&$data->page!=1){
            $page = ($data->page-1) *$total;
        }else{
            $page = 0;
        }
        $sql1 =  "SELECT  user.`nickname` ,user.`remark` ,user.`platformid` ,`platform`.`name` as platname,`user_level`.`name` as levelname,`agent`.`name` as agentname   FROM `user`  LEFT JOIN `platform` on user.`platform` =`platform`.`id` LEFT JOIN `user_level` on user.`level` =`user_level`.`id` LEFT JOIN `agent` on `agent`.`id` =user.`agentid`  WHERE user.`companyid` =".$companyid ."  and user.agentid=".$agentid ."  AND user.`nickname` LIKE '%".$keyword ."%'  limit ".$page ." ,". $total ." ";

        # echo $sql1;
        $da =DB::select($sql1);
        $tota = count($da);    //当前页显示条数
        $re['data'] = $da;   //数据
        $re['pageNum']= $pageNum; //总页数
        if(isset($data->page)&&$data->page!=1){
            $re['page']   = $data->page;//第几页
        }else{
            $re['page']  = 1;
        }
        $re['num']    = $tota;

        return $re;

    }




    /*
   * 解约的所有主播
   */
    public static function noneStars($data){
        $companyId  = $data->companyId;
        $sql =  "SELECT  user.`nickname` ,user.`remark` ,user.`platformid` ,`platform`.`name` as platname,`user_level`.`name` as levelname,`agent`.`name` as agentname    FROM `user` LEFT JOIN `platform` on user.`platform` =`platform`.`id` LEFT JOIN `user_level` on user.`level` =`user_level`.`id` LEFT JOIN `agent` on `agent`.`id` =user.`agentid`  WHERE user.`companyid` =".$companyId ." AND user.`cancel_date`!='0000-00-00'" ;
        $result =DB::select($sql);
        $sumNum = count($result);    //总条数
        if(isset($data->total)){
            $total =$data->total;
        }else{
            $total = 10;  //每页显示的条数
        }
        $pageNum = ceil($sumNum / $total);    //总页数
        if(isset($data->page)&&$data->page!=1){
            $page = ($data->page-1) *$total;
        }else{
            $page = 0;
        }
        $sql1 =  "SELECT  user.`nickname` ,user.`remark` ,user.`platformid` ,`platform`.`name` as platname,`user_level`.`name` as levelname,`agent`.`name` as agentname, user.cancel_date,platform.id as platform   FROM `user` LEFT JOIN `platform` on user.`platform` =`platform`.`id` LEFT JOIN `user_level` on user.`level` =`user_level`.`id` LEFT JOIN `agent` on `agent`.`id` =user.`agentid`  WHERE user.`companyid` =".$companyId ." AND user.`cancel_date` !='0000-00-00'  limit ".$page ." ,". $total ." " ;

        # echo $sql1;
        $da =DB::select($sql1);

        $tota = count($da);    //当前页显示条数
        $re['data'] = $da;   //数据
        $re['pageNum']= $pageNum; //总页数
        if(isset($data->page)&&$data->page!=1){
            $re['page']   = $data->page;//第几页
        }else{
            $re['page']  = 1;
        }
        $re['num']    = $tota;

        return $re;
    }





    /*
     * 解约主播搜索接口
     */

    public static function searchBreak($data){
        $keysword   =   $data->keysword;
        $companyId  =   $data->companyId;
        $where ="SELECT SUM(incomelog.`workTime`) as monthworktime,user.`avatar`,user.`remark`,user.`nickname`, leve.`name` as levelname, user.`platform`,  user.`platformid`, user.`income`,  user.`rmb`,plat.`name`  as platname,plat.ratename,  user.`indexnum`,agent.`name`  FROM `user`  LEFT JOIN `daily_user` as incomelog on user.`platform`= incomelog.`platform`   AND user.`platformid`= incomelog.`platformid`   LEFT JOIN `user_level` as leve on user.`level`= leve.`id`   LEFT JOIN `agent` as agent on agent.`id`= user.`agentid` LEFT JOIN `platform` as plat on plat.`id` =user.`platform`   WHERE  user.`companyid` =". $companyId  ." and user.`cancel_date` !='0000-00-00'  ";

        if(is_numeric($keysword) && sizeof($keysword)>2 ){
            $where .= " and  user.platformid = ".$data->keysword;

        }else {
            $where .= " and  user.nickname  LIKE '%".$data->keysword ."%'";

        }
        $where.= "  and user.companyid = ".$data->companyId;
        $results = DB::select($where);
        $sumNum = count($results);    //总条数
        if(isset($data->total)){
            $total   =    $data->total;
        }else{
            $total = 10;  //每页显示的条数
        }
        $pageNum = ceil($sumNum / $total);    //总页数
        if(isset($data->page)&&$data->page!=1){
            $page = ($data->page-1) *$total;
        }else{
            $page = 0;
        }
        $where .= " LIMIT ".$page .",".$total ;   // echo $sql1;
        //echo $where;
//        $sql1 = "select agent, platform, platformid, days, count(`platformid`) as icount,(count(`platformid`)/days) as percent,  case when count(reachStandard)>= days then 1 else null end as reachStandard from( select a.`platform`, a.`platformid`, a.`agent`, a.`days`, b.`idate`, b.reachStandard  from `user_plan` a left join `daily_user` b on a.`platform`= b.`platform`  and a.`platformid`= b.`platformid`  and a.idate like '".$getMonth."%'  and b.`idate` BETWEEN '".$getDate ."'   and '". $endDate  . "' where a.`companyid`= ".$companyId ."  and b.reachStandard= 1) c  group by agent, `platform`, `platformid`  ORDER BY percent DESC  LIMIT ".$page .",".$total ." ";

        $da =DB::select($where);
        $tota = count($da);    //当前页显示条数
        if($da[0]->platform){
            $re['data'] = $da; }else{
            $re['data'] =null;
        }  //数据
        $re['pageNum']= $pageNum; //总页数
        if(isset($data->page)&&$data->page!=1){
            $re['page']   = $data->page;//第几页
        }else{
            $re['page']  = 1;
        }
        $re['num']    = $tota;

        return $re;

    }

    /*
  * 搜索没有经纪人的主播
  */

    public static function searchBreakagent($data){
        $keysword =$data->keysword;
        $companyId  = $data->companyId;
        $where ="SELECT SUM(incomelog.`workTime`) as monthworktime,user.`avatar`,user.`remark`,user.`nickname`, leve.`name` as levelname, user.`platform`,  user.`platformid`, user.`income`,  user.`rmb`,plat.`name`  as platname,plat.ratename,  user.`indexnum`,agent.`name` as agentname  FROM `user`  LEFT JOIN `daily_user` as incomelog on user.`platform`= incomelog.`platform`   AND user.`platformid`= incomelog.`platformid`   LEFT JOIN `user_level` as leve on user.`level`= leve.`id`   LEFT JOIN `agent` as agent on agent.`id`= user.`agentid` LEFT JOIN `platform` as plat on plat.`id` =user.`platform`   WHERE incomelog.`reachStandard`= 1 AND user.`companyid` =". $companyId  ." and user.`cancel_date` !='0000-00-00' and user.`agentid`=0  ";

        if(is_numeric($keysword) && sizeof($keysword)>2 ){
            $where .= " and  user.platformid = ".$data->keysword;

        }else {
            $where .= " and  user.nickname  LIKE '%".$data->keysword ."%'";

        }
        $where.= "  and user.companyid = ".$data->companyId;
        $results = DB::select($where);
        $sumNum = count($results);    //总条数
        if(isset($data->total)){
            $total =$data->total;
        }else{
            $total = 10;  //每页显示的条数
        }
        $pageNum = ceil($sumNum / $total);    //总页数
        if(isset($data->page)&&$data->page!=1){
            $page = ($data->page-1) *$total;
        }else{
            $page = 0;
        }
        $where .= " LIMIT ".$page .",".$total ;   // echo $sql1;
//        $sql1 = "select agent, platform, platformid, days, count(`platformid`) as icount,(count(`platformid`)/days) as percent,  case when count(reachStandard)>= days then 1 else null end as reachStandard from( select a.`platform`, a.`platformid`, a.`agent`, a.`days`, b.`idate`, b.reachStandard  from `user_plan` a left join `daily_user` b on a.`platform`= b.`platform`  and a.`platformid`= b.`platformid`  and a.idate like '".$getMonth."%'  and b.`idate` BETWEEN '".$getDate ."'   and '". $endDate  . "' where a.`companyid`= ".$companyId ."  and b.reachStandard= 1) c  group by agent, `platform`, `platformid`  ORDER BY percent DESC  LIMIT ".$page .",".$total ." ";

        $da =DB::select($where);
        $tota = count($da);    //当前页显示条数
        if($da[0]->platform){
            $re['data'] = $da; }else{
            $re['data'] =null;
        }  //数据
        $re['pageNum']= $pageNum; //总页数
        if(isset($data->page)&&$data->page!=1){
            $re['page']   = $data->page;//第几页
        }else{
            $re['page']  = 1;
        }
        $re['num']    = $tota;

        return $re;

    }

    /*
     * 添加主播
     */
    public static function addStar($data){
        $companyid  =   $data->companyId;
        $nickname   =   $data->nickname;
        $remark     =   $data->remark;
        $platform   =   $data->platform;
        $platformid =   $data->platformid;
        $signon_date=   $data->signon_date;
        $agentid    =   $data->agentid;
        $level      =   $data->level;
        $person_rate=   $data->person_rate;
        $company_rate=  $data->company_rate;
        $day_work    =  $data->day_work;
        $days        =  $data->days;
        $result =   DB::insert("insert into `user` (`platform`,`platformid`,`companyid`,`agentid`,`nickname`,`signon_date`,`level`,`person_rate`,`company_rate`,`remark`,`day_work`,`days`) values(". $platform .",". $platformid .",". $companyid  .",". $agentid .",'". $nickname ."','".$signon_date ."',". $level  .",".$person_rate .",".$company_rate .",'".$remark ."',". $day_work  .",".  $days   .")");
//      echo "insert into `user` (`platform`,`platformid`,`companyid`,`agentid`,`nickname`,`signon_date`,`level`,`person_rate`,`company_rate`,`remark`，`day_work`,`days`) values(". $platform .",". $platformid .",". $companyid  .",". $agentid .",'". $nickname ."','".$signon_date ."',". $level  .",".$person_rate .",".$company_rate .",'".$remark ."',". $day_work  .",".  $days   .")";
//       dd();
        if($result){
            return true;
        }else{
            return false;
        }
    }


    /*
     * 所有的平台
     */
    public static function allPlatform($data){
           // $companyId = $data->companyId;
            $platform = DB::select("SELECT `id`,`name` FROM `platform` WHERE status =1");
            if($platform){
                return $platform;
            }else{
                return null;
            }
    }

   /*
    * 添加级别
    */
    public static function addLevel($data){
        $name           =   $data->name;
        $day_income     =   $data->day_income;
        $month_income   =   $data->month_income;
        $month_work     =   $data->moth_work;
        $day_work     =   $data->day_work;

        $companyid      =   $data->companyId;
        $result =   DB::insert("insert into `user_level` (`name`,`day_income`,`month_income`,`day_work`,`month_work`,`companyid`) values('". $name ."',".$day_income .",". $month_income  .",".$day_work .",". $month_work  .",". $companyid  .")");
        if($result){
            return true;
        }
    }

}
