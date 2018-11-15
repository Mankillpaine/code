<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Common;
use DB;
class StarassistantController extends Controller
{
    public function __construct()
    {
        //检测该方法是否需要验证
        header("P3P: CP=CURa ADMa DEVa PSAo PSDo OUR BUS UNI PUR INT DEM STA PRE COM NAV OTC NOI DSP COR");

        header("Access-Control-Allow-Origin: *");




    }

    /*
     * 日榜
     */
        public function daylist(Request $request){
       $sort =  $request->sort;
       $platform   =    $request->platform;
        $hourse = date("H", time());
        if($hourse>=9) {
            $endtime = date("Y-m-d", strtotime("-1 day"));
        }else{
            $endtime = date("Y-m-d", strtotime("-2 day"));
        }
        if($sort =='income') {

            if ($platform != 'all') {
                    $result = DB::select("SELECT `platformname`, `platform`, `platformid`,`idate`,  `income`, `increase`,`increase_rmb`, `follower`, `increase_follower`,`indexnum`,  `nickname`, `rmb`, `ratename`, CASE `platform` when 6 THEN 'http://s.momocdn.com/w/u/img/2016/04/01/1459499443848-401_S.png' ELSE `avatar` END as avatar FROM `singleincome` where `idate`= '" . $endtime . "' and groups=" . $platform . " and platform !=11 limit 30 ");

            } else {
                $result = DB::select("SELECT `platformname`, `platform`, `platformid`,`idate`,  `income`, `increase`,`increase_rmb`, `follower`, `increase_follower`,`indexnum`,  `nickname`, `rmb`, `ratename`, CASE `platform` when 6 THEN 'http://s.momocdn.com/w/u/img/2016/04/01/1459499443848-401_S.png' ELSE `avatar` END as avatar FROM `singleincome` where `idate`= '" . $endtime . "' and groups= 0 and platform !=11  limit 30 ");

            }
        }else{
            if ($platform != 'all') {
                $result = DB::select("SELECT `platformname`, `platform`, `platformid`,`idate`,  `income`, `increase`,`increase_rmb`, `follower`, `increase_follower`,`indexnum`,  `nickname`,  CASE `platform` when 6 THEN 'http://s.momocdn.com/w/u/img/2016/04/01/1459499443848-401_S.png' ELSE `avatar` END as avatar FROM `singlefans` where `idate`= '" . $endtime . "' and groups=".$platform." and platform !=11 limit 30 ");

            }else{
                $result = DB::select("SELECT `platformname`, `platform`, `platformid`,`idate`,  `income`, `increase`,`increase_rmb`, `follower`, `increase_follower`,`indexnum`,  `nickname`,  CASE `platform` when 6 THEN 'http://s.momocdn.com/w/u/img/2016/04/01/1459499443848-401_S.png' ELSE `avatar` END as avatar FROM `singlefans` where `idate`= '" . $endtime . "' and groups= 0 and platform !=11 limit 30 ");

            }
        }

        $data['code']    = 200;
        $data['data']    = $result;
        $data['msg']    = "";
        return $data;

    }



    /*
     * 平台菜单
     */
    public function daylistmenu(){
        $result = DB::select("select * from platform where `status` = 1 ");
        $data['data']    = $result;
        $data['code']    = 200;
        $data['msg']    = "";
        return  $data;
    }



    /*
    * 总榜
    */
    public function rmball(Request $request){
        $sort =  $request->sort;
        $platform   =    $request->platform;
        $hourse = date("H", time());
        if($hourse>=9) {
            $endtime = date("Y-m-d", strtotime("-1 day"));
        }else{
            $endtime = date("Y-m-d", strtotime("-2 day"));
        }
        if($sort =='income') {

            if ($platform != 'all') {
                $result = DB::select("SELECT `platformname` ,`platform` ,`platformid` ,`idate` ,`income` ,`follower` ,`indexnum` ,`nickname` ,`rmb` ,`ratename` ,CASE `platform` when 6 THEN 'http://s.momocdn.com/w/u/img/2016/04/01/1459499443848-401_S.png' ELSE `avatar`   END as avatar FROM `rmball` where `idate`= '" . $endtime . "' and groups=" . $platform . " and platform !=11 limit 30 ");

            } else {
                $result = DB::select("SELECT `platformname` ,`platform` ,`platformid` ,`idate` ,`income` ,`follower` ,`indexnum` ,`nickname` ,`rmb` ,`ratename` ,CASE `platform` when 6 THEN 'http://s.momocdn.com/w/u/img/2016/04/01/1459499443848-401_S.png' ELSE `avatar`   END as avatar FROM `rmball` where `idate`= '" . $endtime . "' and groups= 0 and platform !=11 limit 30 ");

            }
        }else{
            if ($platform != 'all') {
                $result = DB::select("SELECT `platformname` ,`platform` ,`platformid` ,`idate` ,`income` ,`follower` ,`indexnum` ,`nickname` ,CASE `platform` when 6 THEN 'http://s.momocdn.com/w/u/img/2016/04/01/1459499443848-401_S.png' ELSE `avatar`   END as avatar FROM `followerall` where `idate`= '" . $endtime . "' and groups=".$platform." and platform !=11 limit 30 ");

            }else{
                $result = DB::select("SELECT `platformname` ,`platform` ,`platformid` ,`idate` ,`income` ,`follower` ,`indexnum` ,`nickname` ,CASE `platform` when 6 THEN 'http://s.momocdn.com/w/u/img/2016/04/01/1459499443848-401_S.png' ELSE `avatar`   END as avatar FROM `followerall` where `idate`= '" . $endtime . "' and groups= 0 and platform !=11  limit 30 ");

            }
        }
        $data['code']    = 200;
        $data['data']    = $result;
        $data['msg']    = "";
        return $data;
    }



    /*
 * 平台指数
 */
    public function platmba(){

            $starttime = date("Y-m-d", mktime(0, 0, 0, date("m"), date("d") - 30, date("Y")));
            $endtime = date("Y-m-d", strtotime("-1 day"));

        $platsql = "SELECT `index`,`platform`,`idate` FROM `rank_log` WHERE `platform` =0 AND idate BETWEEN '" . $starttime . "' and '" . $endtime . "' limit 30 ";

        $platmba = DB::select($platsql);
        $data['code']    = 200;
        $data['data']    = $platmba;
        $data['msg']    = "";
        return $data;


    }


    /*
        * 平台活跃指数
    */
    public function plathymba(){
        $starttime = date("Y-m-d", mktime(0, 0, 0, date("m"), date("d") - 30, date("Y")));
        $endtime = date("Y-m-d", strtotime("-1 day"));
        $platsql = "SELECT log.`index`,log.`idate`,plat.`name`,plat.`color`  FROM `rank_log` as log LEFT JOIN `platform` as plat on plat.`id` =log.`platform`   WHERE plat.status=1 AND log.idate BETWEEN '" . $starttime . "' and '" . $endtime . "' ";
        $platmba = DB::select($platsql);
        $plat = DB::select("select `name`,`color` from platform where status =1");
        $_time = range(strtotime($starttime), strtotime($endtime), 24*60*60);
        $_time = array_map(create_function('$v', 'return date("Y-m-d", $v);'), $_time);
        $n=0;
        for ($j=0; $j<count($plat);$j++) {
            for ($i=0; $i<count($_time);$i++) {
                $datearr[$n]['idate'] =$_time[$i];
                $datearr[$n]['name']  =$plat[$j]->name;
                $datearr[$n]['color'] = $plat[$j]->color;
                $datearr[$n]['index']  =null;
                $n++;
            }
        }
        for ($j=0; $j<count($datearr);$j++) {
            for ($i = 0; $i < count($platmba); $i++) {
                if ($datearr[$j]['idate'] == $platmba[$i]->idate) {
                    if ($datearr[$j]['name'] == $platmba[$i]->name) {
                        // $datearr[$j]['color'] = $platmba[$i]->color;
                        $datearr[$j]['index'] = $platmba[$i]->index;
                    }
                }
            }
        }
        $data['code']    = 200;
        $data['data']    = $datearr;
        $data['msg']    = "";
        return $data;


    }

    /*
        * 多级菜单
        */
    public function searchStar(Request $request){


        $plat ="";
        $orderby =1; //排序
        // $limit = $_GET['limit'];
        $args = array();

        if(isset($_POST["platform"]) != false && $_POST["platform"] !=''){
            $plat .= " and u.platform=".$_POST['platform'];
            $args["platform"] = $_POST['platform'];
        }else{
            $args["platform"] = "";
        }


        if(isset($_POST["gender"]) != false && $_POST["gender"] !=''){
            $plat .= " and u.gender=" . $_POST['gender'];
            $args["gender"] = $_POST['gender'];
        }else{
            $args["gender"] = "";
        }


        if(isset($_POST["city"]) != false && $_POST["city"] !=''){
            $plat .= " and u.city =  ".$_POST['city']."  ";                     //$_GET['city'];
            $args["city"] = $_POST['city'];
        }else{
            $args["city"] = "";
        }


        if(isset($_POST["follower"]) != false && $_POST["follower"] !='' && strpos($_POST["follower"],"-") > -1){

            $arr = explode("-",$_POST["follower"]);
            $plat .= " and u.follower between ".$arr[0]*10000 ." and " .$arr[1]*10000 ." ";

            $args["follower"] = $_POST['follower'];
        }else{
            $args["follower"] = "";
        }


        if(isset($_POST["income"]) != false && $_POST["income"] !='' && strpos($_POST["income"],"-") > -1){

            $arr = explode("-",$_POST["income"]);
            $plat .= " and u.rmb between ".$arr[0]*10000 ." and " .$arr[1]*10000 ." ";

            $args["income"] = $_POST['income'];
        }else{
            $args["income"] = "";
        }



        if(isset($_POST["keyword"]) != false && $_POST["keyword"] !=''){
            if(is_numeric($_POST["keyword"])){
                $plat .= " and u.`platformid` = ". $_POST["keyword"] ."";
            }else{
                $plat .= " and x.`nickname`  LIKE '". $_POST["keyword"] ."%'";
            }
            // $sql ="SELECT users.`nickname`,users.platform,users.`follower`,users.`cityname`  FROM `users` LEFT JOIN `platform` on users.`platform` = `platform`.id LEFT JOIN `city_mini` on users.`city` =`city_mini` .id   WHERE users.`nickname`  LIKE '%".$content ."%'  ORDER BY users.rmb desc limit 300; ";
            $args["keyword"] = $_POST['keyword'];
        }else{
            $args["keyword"] = "";
        }


        if(isset($_POST["orderby"]) != false && $_POST["orderby"] !=''){
            $plat .=" order by u.".$_POST["orderby"]." desc";
            $args["orderby"] = $_POST['orderby'];
        }else{
            $plat .=" order by u.indexnum desc";
            $args["orderby"] = "indexnum";
        }

//        if(isset($_POST["limit"]) != false && $_POST["limit"] !=''){
//            $sql = "select u.*,'' as name,platform.name as platname,platform.ratename from users as u inner join users x on u.platformid=x.platformid and u.platform=x.platform left join `platform` on platform.id = u.platform where 1" . $plat . " limit ".$_POST["limit"]." ,30";
//            $search_results = DB::select($sql);
//            return $search_results;
//        }
        $sql = "select CASE platform.id when 1 then '/liveManager/public/img/1.png' when 2 then '/liveManager/public/img/2.png' when 3 then '/liveManager/public/img/3.png' when 4 then '/liveManager/public/img/4.png' when 5 then '/liveManager/public/img/5.png' when 6 then '/liveManager/public/img/6.png' when 7 then '/liveManager/public/img/7.png' when 8 then '/liveManager/public/img/8.png' when 9 then '/public/img/9.png' when 10 then '/public/img/10.png' when 11 then '/liveManager/public/img/11.png' END as platurl,u.nickname,u.income, u.`platform`, u.`platformid`, u.`follower`, u.`rmb`, CASE u.`platform` when 6 THEN 'http://s.momocdn.com/w/u/img/2016/04/01/1459499443848-401_S.png' ELSE u.`avatar` END as avatar, platform.name as platname, platform.ratename from users as u inner join users x on u.platformid=x.platformid and u.platform=x.platform left join `platform` on platform.id = u.platform  where 1" . $plat . " limit 30";

        $search_results = DB::select($sql);

        $data['code']    = 200;
        $data['data']    = $search_results;
        $data['msg']    = "";
        return $data;

    }

    /*
     *城市菜单
     */
     public function city(Request $request){
         $cityid     = $request->cityid;
         $city         = DB::select("select id,city from city_mini where parent = ". $cityid  ."  ");
         $data['code']    = 200;
         $data['data']    = $city;
         $data['msg']    = "";
         return $data;

     }
    /*
 *省份菜单
 */
    public function province(){
        $province     = DB::select("select id,province from city_mini where parent=0 and id>1");
        $data['code']    = 200;
        $data['data']    = $province;
        $data['msg']    = "";
        return $data;

    }

   /*
    *  主播详情页
    */
    public function stardetail(Request $request){
        $platform   =    $request->platform;
        $platformid =    $request->platformid;
        $result  = DB::select("select users.platform,users.follower,users.income,users.intro,users.weibo,users.indexnum,users.platformid,users.veri_info,users.gender,users.nickname,users.birthday,users.hometownname,users.cityname,`platform`.`name` as platname ,`platform`.`ratename`, CASE `platform`.id when 6 THEN 'http://s.momocdn.com/w/u/img/2016/04/01/1459499443848-401_S.png' ELSE `avatar`   END as avatar  from users LEFT JOIN `platform` on users.`platform` =`platform`.`id` where platform = ".$platform. " and platformid = ".$platformid."");
        $data['code']    = 200;
        $data['data']    = $result;
        $data['msg']    = "";
        return $data;
    }


    /*
     *主播收入统计
     */
    public function zbincome(Request $request)
    {

        //正常状态
        $platformid = $request->platformid;
        $platform   = $request->platform;
        $hourse = date("H", time());
        if($hourse>=9) {
            $startime = strtotime("-30 day");
            $endtimes = strtotime("-1 day");
            $start      =  date("Y-m-d",strtotime("-14 day"));
            $endtime      =  date("Y-m-d",strtotime("-1 day"));
        }else{
            $startime = strtotime("-31 day");
            $endtimes = strtotime("-2 day");
            $start      =  date("Y-m-d",strtotime("-15 day"));
            $endtime      =  date("Y-m-d",strtotime("-2 day"));
        }
        $i=0;
        while($startime <= $endtimes){
            $datearr[$i]['idate'] = date('Y-m-d',$startime);//得到dataarr的日期数组。
            $datearr[$i]['increase_rmb'] = 0;
            $datearr[$i]['increase'] = 0;
            $datearr[$i]['income'] = 0;
            $startime=$startime + 3600*24;
            $i++;
        }
        // var_dump($datearr);

        if($hourse>=9) {
            $result = DB::select("SELECT `increase` ,`income`,`increase_rmb`,`idate`  FROM income_log where `platform` = '" . $platform . "' and `platformid` = " . $platformid . " and idate BETWEEN   '". $start."' and '".$endtime."'  order by idate asc  ");
        }else{
            $result = DB::select("SELECT `increase` ,`income`,`increase_rmb`,`idate`  FROM income_log where `platform` = '" . $platform . "' and `platformid` = " . $platformid . " and idate BETWEEN   '". $start."' and '".$endtime."'  order by idate asc  ");
        }
        for($i=0; $i<count($result); $i++){
            for($j=0; $j<count($datearr);$j++){
                if($result[$i]->idate ==$datearr[$j]['idate']){
                    $datearr[$j]['increase_rmb'] = $result[$i]->increase_rmb;
                    $datearr[$j]['increase'] = $result[$i]->increase;
                    $datearr[$j]['income'] = $result[$i]->income;
                }
            }
        }
        $data['code']    = 200;
        $data['data']    = $datearr;
        $data['msg']    = "";
        return $data;


    }
    /*
 * 主播粉丝统计
 */

    public function zbfan(Request $request){

        //正常状态
        $platformid = $request-> platformid;
        $platform   = $request-> platform;
        $hourse = date("H", time());
        if($hourse>=9) {
            $start      =  date("Y-m-d",strtotime("-30 day"));
            $endtime      =  date("Y-m-d",strtotime("-1 day"));
            $startime = strtotime("-30 day");
            $endtimes = strtotime("-1 day");
        }else{
            $start      =  date("Y-m-d",strtotime("-31 day"));
            $endtime      =  date("Y-m-d",strtotime("-2 day"));
            $startime = strtotime("-31 day");
            $endtimes = strtotime("-2 day");
        }
        $i=0;
        while($startime <= $endtimes){
            $datearr[$i]['idate'] = date('Y-m-d',$startime);//得到dataarr的日期数组。
            $datearr[$i]['increase_follower'] = 0;
            $datearr[$i]['follower'] = 0;
            $startime=$startime + 3600*24;
            $i++;
        }
        if($hourse>=9) {
            $result = DB::select("SELECT `increase_follower` ,`follower`,`idate`  FROM income_log where `platform` = '" . $platform . "' and `platformid` = " . $platformid . " and idate BETWEEN '". $start."' and '".$endtime."' order by idate asc");
        }else{
            $result = DB::select("SELECT `increase_follower` ,`follower`,`idate`  FROM income_log where `platform` = '" . $platform . "' and `platformid` = " . $platformid . " and idate BETWEEN   '". $start."' and '".$endtime."' order by idate asc");
        }

        for($i=0; $i<count($result); $i++){
            for($j=0; $j<count($datearr);$j++){
                if($result[$i]->idate ==$datearr[$j]['idate']){
                    $datearr[$j]['increase_follower'] = $result[$i]->increase_follower;
                    $datearr[$j]['follower'] = $result[$i]->follower;
                }
            }
        }

        $data['code']    = 200;
        $data['data']    = $datearr;
        $data['msg']    = "";
        return $data;

    }

}
?>