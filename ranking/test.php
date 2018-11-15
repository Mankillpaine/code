<html>
<meta charset="utf-8">
<?php
       $connect = new Memcached;
        $connect->setOption(Memcached::OPT_COMPRESSION, false);
        $connect->setOption(Memcached::OPT_BINARY_PROTOCOL, true);
        $connect->addServer('60.205.105.239', 11211);
        $connect->setSaslAuthData('f10618a5473d48f1', 'Toubu123');
        $connect->set("hello", "world");
        echo 'hello: ',$connect->get("hello");
        $connect->quit();
?>
</html>
