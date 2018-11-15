<?php

//var_dump($GLOBALS["xxx"]);
//$GLOBALS["xxx"] = "sdfsadfasdf";
//global $xxx;

var_dump($_GLOBAL["xxx"]);

var_dump($GLOBALS);

$_GLOBAL["xxx"] = "sdfdsfsd";

var_dump($GLOBALS);

echo $xxx;

function getMillisecond() {
list($t1, $t2) = explode(' ', microtime());
return (float)sprintf('%.0f',(floatval($t1)+floatval($t2))*1000);
}

$t1 = getMillisecond();
echo "<br />".$t1;

$arr = array();
for($i=0;$i<2000;$i++){
    $arr[$i] = rand(10000,90000);
}

$t2 = getMillisecond();
echo "<br />".$t2;
//echo $t2-$t1;

for($ii=0;$ii<100;$ii++){
    $x = rand(1,2000);
    $temp = $arr[$ii];
}

$t3 = getMillisecond();
echo "<br />".$t3;

echo "<br />";
echo $t3-$t2;

?>