<?php

namespace App\Http\Controllers;
use PhpApi\PhpApi\PhpApi;
use Illuminate\Support\Facades\dbMongo;
use DB;

class ExampleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
        $api = new  PhpApi();
        return   $api->bindClasses();

    }

    //
    public function UseFaces(){
       $api = new  PhpApi();
       echo $api->bindClasses();
     // echo  $api->bindClasses();
    }


    /*
     * 一直播指数的合作测试页
     */
    public function toubuIndex()
    {

        $plat = $_GET["plat"];

        if ($plat == "1") {
            $platform = "1";
            $list = "326538716,40110736,46401077,344608612,309476605,56892176,520520,278372959,342287589,13006282,84823189,322070549,2527180,101493255";
        }elseif ($plat == "3") {
            $platform = "3";
            $list = "98712422,21212404,96877665,71913653,52359706,75363497,98876263,27233501,72086676,33121400,94416877,37928477,98767287,95496578,54738663,31933676,35311805,93932307,24389623,37928477,21491770,31933676,31933676,22907396,34335810,30544992,29146334,93932307,25481320,93932307,98813573,32052145,25979483,34926562,34526668,54738663,37928477,37928477,20486654,29161814,22907396,21207947,36690885,98324124,20173593,22907396,31819759,29042398,23625617,73061438";
        }elseif ($plat == "4") {
            $platform = "4";
            $list = "5947128,3014510,40372214,5290260,34923282,3010906,6531174,3010086,25419686,6531348,25415922,3100772,31100752,35529618,3817420,31035590,51912002,32501654,54843042,24632622,3010000,22529656,33056912,3010056,31368684,62770770,45922784,21879556,29405456,22961968,25850740,3015694,32374166,30912188,32624550,33955900,24872350,3208234,26102440,24536458,3009988,26619712,3009998,3252620,36835910,31212064,31831164,3162116,3010054,30228850";
        }elseif ($plat == "5") {
            $platform = "5";
            $list = "44397,9418129,2333,666,29189,5964230,15,911,1039622,3919534,2821027,333,8832533,29105,3446603,42416,313,17773256,1939881,674228,35743,10519449,1688553,7049122,4242823,47,2064317,1206067,3043295,326745,2942116,620637,4025818,2813894,2252160,7376362,3783489,2869580,2910931,4078550,464,7777,2639525,9749860,2820986,1875231,8553412,3424101,4469284,330717";
        }elseif ($plat == "6") {
            $platform = "6";
            $list = "320786452,437224229,345348180";
        }elseif ($plat == "7") {
            $platform = "7";
            $list = "39369208,1988249,28747059,89577782,42888018,55497258,27415809,35660584,26678335,61050767,42171186,67485200,46139181,80231575,8750909,92377214,110718861,56545184,42976867,26195576,110369339,43272103,58525264,121937707,40535794,33822654,108961739,1570166,38122734,54459537";
        }elseif ($plat == "8") {
            $platform = "8";
            $list = "16906461,11886026,1073823454,22451324,22223513,1082903051,22223513,22451324,1007171655,32940687,1488395944,54779648,1041227068,32315477,1238064,1077386863,1238064,1082642980,1083154347,1027265417,1083809085,47467873,34949348,1007871821,38994104,68891754,22451324,1458782130,1041412656,1083154347,1027265417,11886026,1455450190,11886026,61508056,1016624,32044570,56537299,1046436259,54779648,1083809085,38489095,11886026,1456367050,1015222,35748422,1082642980,1016624,20090999,22042313";
        }elseif ($plat == "9") {
            $platform = "9";
            $list = "793926305,775334427,747773325,906627146,801340896,365835205,795368653,821807533,992306823,763958303,915567338,926363813,356771982,798955476,341779697,722961086,785632148,809574320,718370723";
        }elseif ($plat == "10") {
            $platform = "10";
            $list = "19344409,96777662,4757314,5270773,34222876,19,64334674,1080600,55912480,91996087,295321,92681050,8766782,184165,44116782,45862251,2954707,17562136,12986804,2517434,50755628,268560,2286501,12733289,79905,8930628,27113213,1001726,236231,391270,92470968,22684671,8697252,78246000,624144,87971736,60415251,20994953,36058082,16717,8826613,72902130,5954380,29162881,9468763,94076577,5842120,185416,1974429,15014125";
        }elseif ($plat == "11") {
            $platform = "11";
            $list = "160855,172256,134804,150554,166925,166674,140441,170274,147869,104051,139209,164784,174740,176186,125122,174731,120886,153214,174738,175737,176183,116643,175060,171597,174303,163169,165156,168110,112729,167527,168841,169174,171656,169817,112150,175487,167411";
        }


        $sql = "select temp.*,users.nickname from (
    select * from (select platform,platformid,sum(increase_rmb) as rmb,sum(`increase_follower`) as fo
  from income_log
 where `platform`= " . $platform . "
   and `platformid` in(".$list.")
   and idate BETWEEN '2017-01-01'
   and '2017-01-31' group by platform,`platformid`) as a left join
(select platform as platformx,platformid as platformidx,liveid,avg(`online`) as onlineavg,max(`online`) as onlinemax,count(*) as countx
  from live_log
 where `platform`= " . $platform . "
   and `platformid` in(".$list.")
   and itime BETWEEN '2017-01-01 00:00:00'
   and '2017-01-31 23:59:59'
group by platformid order by onlineavg desc) as b on a.platform=b.platformx and a.platformid=b.platformidx order by onlinemax desc) temp left join users on temp.platform=users.`platform`  and temp.platformid=users.platformid ;";


        //echo $sql;

        $result = DB::connection("mysql_star") -> select($sql);

        $maxOnline = 0;
        $maxIncome = 0;
        $maxFollower = 0;
        $maxAvgOnline = 0;

        //先得到最大值
        foreach ($result as $one){
            if($one -> onlinemax > $maxOnline){$maxOnline = $one -> onlinemax; }
            if($one -> onlineavg > $maxAvgOnline){$maxAvgOnline = $one -> onlineavg; }

            if($one -> fo < 1){$one -> fo = 1;}
            if($one -> rmb < 1){$one -> rmb = 1;}

            if($one -> fo > $maxFollower){$maxFollower = $one -> fo; }
            if($one -> rmb > $maxIncome){$maxIncome = $one -> rmb; }
        }

        //echo "<br />最大收入:" . $maxIncome;
        //echo "<br />最大增粉:" . $maxFollower;
        //echo "<br />最大在线:" . $maxOnline;
        //echo "<br />最大平均在线:" . $maxAvgOnline;

        //print_r($result);

        //return;

        //计算每个主播的指数
        echo "<table>";
        echo "<tr>";
        echo "
            <td>平台</td>
            <td>主播id</td>
            <td>主播昵称</td>
            <td>最高在线分数</td>
            <td>平均在线分数</td>
            <td>增粉分数</td>
            <td>收入分数</td>
            <td>总分</td>

            <td>最高在线</td>
            <td>平均在线</td>
            <td>月收入</td>
            <td>月增粉</td>
            ";
        echo "</tr>";

        foreach ($result as $one){

            echo "<tr>";

            echo "<td>" . $one -> platform . "</td>";
            echo "<td>" . $one -> platformid . "</td>";
            echo "<td>" . $one -> nickname . "</td>";

            $scoreOnline = 35;
            $scoreOnline = $scoreOnline * 0.7 + ($one -> onlinemax / $maxOnline) * $scoreOnline * 0.3 ;

            echo "<td>" . $scoreOnline . "</td>";

            $scoreAvgOnline = 35;
            $scoreAvgOnline = $scoreAvgOnline * 0.7 + ($one -> onlineavg / $maxAvgOnline) * $scoreAvgOnline * 0.3 ;

            echo "<td>" . $scoreAvgOnline . "</td>";

            $scoreFollower = 20;
            $scoreFollower = $scoreFollower * 0.7 + ($one -> fo / $maxFollower) * $scoreFollower * 0.3 ;

            echo "<td>" . $scoreFollower . "</td>";

            $scoreIncome = 10;
            $scoreIncome = $scoreIncome * 0.7 + ($one -> rmb / $maxIncome) * $scoreIncome * 0.3 ;

            echo "<td>" . $scoreIncome . "</td>";


            $scoreAll = $scoreOnline + $scoreFollower + $scoreIncome + $scoreAvgOnline;

            echo "<td>" . $scoreAll . "</td>";


            echo "<td>" . $one -> onlinemax . "</td>";
            echo "<td>" . $one -> onlineavg . "</td>";
            echo "<td>" . $one -> rmb . "</td>";
            echo "<td>" . $one -> fo . "</td>";


            echo "<tr>";

        }

        echo "</table>";


    }


    /*
     * Api 测试
     */
    public function Apitest(){


        $data = PhpApi::monthStarate();
        var_dump($data);
        
        //authors =>'主播列表'
//        if(isset($_GET['handle'])){
//            $arr['handle']  =   $_GET['handle'];
//        }else{
//            $arr['handle']='';
//        }
//        $api = new  PhpApi();
//      $result  =   $api->Returndata($arr);
//        return $result;

    }


    /*
 * 主播24小时直播记录
 */
    public function MongoLiveLog(){
       // echo phpinfo();

        $mongo = new dbMongo();

        $option =  [
            'limit' => 1 ,
            'projection' => []
        ];

        $result = $mongo -> query("liveManager.liveLog_201701" , ["_id" => "222_1_20170117"] , $option);

        if(count($result)  == 1) {
            echo json_encode($result[0]->history);
        }

        return;

    }





    /*
     * Demo
     * 日收入排序
     */
    public function apiWord(){
         return view('api');
    }

}
