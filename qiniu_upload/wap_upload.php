<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
require 'rs.php';
$bucket = 'lamatao';
$func = $_GET["func"];

$micro = microtime()*1000000;

if(isset($_GET["key"]) && $_GET["key"] != ""){
	$key = $_GET["key"];
}else{
	$key = time().$micro;
}

Qiniu_SetKeys($QINIU_ACCESS_KEY, $QINIU_SECRET_KEY);
$putPolicy = new Qiniu_RS_PutPolicy($bucket);
$putPolicy -> Scope = $bucket;
$putPolicy -> ReturnUrl = "http://".$_SERVER['HTTP_HOST']."/qiniu/admin_return.php";
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

<body style="margin:0px;">

<form method="post" id="form1" name="form1" action="http://up.qiniu.com/" enctype="multipart/form-data" style="display:none;">
  <input name="key" type="hidden" value="<?php echo $key; ?>">
  <input name="x:viewkey" type="hidden" value="<?php echo $viewkey; ?>">
  <input name="token" type="hidden" value="<?php echo $upToken; ?>">
  本地上传图片:
  <input name="file" type="file" accept="image/*" id="upfile" onclick="var run='callWebView();';parent.eval(run);" onchange="var run='showLoading();';parent.eval(run);document.form1.submit();"/>
</form>

<a href="javascript:void;" onclick="openUpload();" style="width:100px; line-height:32px; border:1px #e86f5e solid; color:#e86f5e; display:block; text-align:center; text-decoration:none;-webkit-border-radius:6px;">+ 添加图片</a>

<script>
function openUpload(){
	document.getElementById('upfile').click();
}
</script>

</body>
</html>