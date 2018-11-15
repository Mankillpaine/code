<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2016/9/19
 * Time: 14:52
 */
//$mem = new Memcache();
$connect = new Memcached;
$connect->setOption(Memcached::OPT_COMPRESSION, false);
$connect->setOption(Memcached::OPT_BINARY_PROTOCOL, true);
$connect->addServer('60.205.105.239', 11211);
$connect->setSaslAuthData('f10618a5473d48f1', 'Toubu123');

$Memcache_date = 86400;
//return $is_send = false; //关闭定时任务
return $is_send = true;  //开启定时任务

?>