<?php
global $top_1;
global $top_7;
global $top_3;
global $hotlist;
global $toplist1;
global $toplist3;

ignore_user_abort(); //关掉浏览器，PHP脚本也可以继续执行.
set_time_limit(0); // 通过set_time_limit(0)可以让程序无限制的执行下去
$interval = 15; // 每隔*秒运行
$temp_key = 0;
do {
    $time = time();
    require 'mencahe.php';
    $mem = new Memcached;
    $mem->setOption(Memcached::OPT_COMPRESSION, false);
    $mem->setOption(Memcached::OPT_BINARY_PROTOCOL, true);
    $mem->addServer('60.205.105.239', 11211);

    if ($is_send) {
        $get_time = $mem->get('tem_data');
        var_dump($get_time);
    } else {
        $get_time = $time + 86400;
        exit();
    }
    if ($get_time == $time) {
        $mem->quit();
        exit();
    } else if ($get_time > $time - $interval) {
        $mem->quit();
    } else if ($temp_key == 0) {
        $temp_key = 1;
        $mem->set('tem_data', $time);
        $mem->quit();
        sleep(mt_rand(1, 3));
        $temp_key = 0;
    }else{
        $mem->quit();
        exit();
    }
    echo 11111111;die;
    $top_1 =    $mem->get("top_1");   //映客热门列表
    $top_3 =    $mem->get("top_3");       //花椒
    $top_7 =    $mem->get("top_7");  //一直播
    //花椒推荐列表
    $hotlist = $mem->get("top_3_post");

    echo 11111111;
    $result = DB::select("SELECT * FROM `city_mini` WHERE `parent` =0 ");
     var_dump($result);
    $con = mysql_connect("rm-2ze2211tvnc3k0c0fo.mysql.rds.aliyuncs.com","spider","Toubu123");
    if (!$con) {echo "我没连上";}
    mysql_select_db("star", $con);
    $sql = "SELECT * FROM `city_mini` WHERE `parent` =0" ;
    $res  = mysql_query($sql);
    var_dump($res);

    die;
    foreach ($result as $key => $value){
        $toplist1[$value->id] =  $connect->get("top_1_".$value->id ."");
        $toplist3[$value->id] =  $connect->get("top_3_".$value->id ."");
    }
    //这里是你要执行的代码
    sleep($interval); // 等待*秒钟
} while (true);

?>