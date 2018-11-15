<?php
require 'rs.php';
$bucket = 'lamatao';

$micro = microtime()*1000000;
$key = time().$micro;

Qiniu_SetKeys($QINIU_ACCESS_KEY, $QINIU_SECRET_KEY);
$putPolicy = new Qiniu_RS_PutPolicy($bucket);
$putPolicy -> Scope = $bucket;
$putPolicy -> deadline = strtotime(date('Y-m-d 00:00:00',strtotime('+1 day')));
$putPolicy -> null;
$putPolicy -> FsizeLimit = 2000000;
$putPolicy -> ReturnBody = null;
$upToken = $putPolicy->Token(null);

//header("Content-Type: text/html; charset=utf-8");
//$upToken = "i17fgC0icQ4umJzJhOqBN7ylN9HtUM4E5gsaneXC:0_OwTQWHttLA7Wht6M2UbLs8pGo=:eyJzY29wZSI6ImxhbWF0YW8iLCJkZWFkbGluZSI6MTQxOTc3MDUxNCwiZnNpemVMaW1pdCI6MjAwMDAwMH0=";

echo $upToken;

function URLSafeBase64Encode($originalStr)
{
    $find = array("+","/");
    $replace = array("-", "_");
    return str_replace($find, $replace, base64_encode($originalStr));
}


//$action = URLSafeBase64Encode($bucket.":".$key);

//$viewkey = $key;

?>