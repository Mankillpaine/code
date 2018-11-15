<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
require 'rs.php';
$bucket = 'lamatao';
$func = $_GET["func"];

$micro = microtime()*1000000;
$key = "itoubu_" . time().$micro;

if(isset($_GET["avatar"])){
	$key = "avatar_" . $_GET["avatar"];
}

Qiniu_SetKeys($QINIU_ACCESS_KEY, $QINIU_SECRET_KEY);
$putPolicy = new Qiniu_RS_PutPolicy($bucket);
$putPolicy -> Scope = $bucket;
$putPolicy -> ReturnUrl = "http://".$_SERVER['HTTP_HOST']."/qiniu_upload/return.php";
$putPolicy -> FsizeLimit = 2000000;
//echo  "http://".$_SERVER['HTTP_HOST']."/qiniu/return.php";
//$putPolicy -> ReturnBody = "name=$(fname)&hash=$(etag)&location=$(x:location)&=$(x:prise)";
$putPolicy -> ReturnBody = '{"func":"'.$func.'","key":$(x:viewkey),"width":$(imageInfo.width),"height":$(imageInfo.height),"size":$(fsize)}';
$upToken = $putPolicy->Token(null);


function URLSafeBase64Encode($originalStr)
{
    $find = array("+","/");
    $replace = array("-", "_");
    return str_replace($find, $replace, base64_encode($originalStr));
}


$action = URLSafeBase64Encode($bucket.":".$key);

$viewkey = $key;

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>

<body style=" margin:0px;">

<form method="post" id="form1" name="form1" action="http://up.qiniu.com/" enctype="multipart/form-data">
  <input name="key" type="hidden" value="<?php echo $key; ?>">
  <input name="x:viewkey" type="hidden" value="<?php echo $viewkey; ?>">
  <input name="token" type="hidden" value="<?php echo $upToken; ?>">
  本地上传图片:
  <input name="file" type="file" id="up_btn" onchange="document.form1.submit();"/>
</form>



</body>
</html>