<?php
header('Content-Type:text/html;charset=utf-8');

if(isset($_GET["error"])){
	
	$error = $_GET["error"];
	
	$upload_ret = base64_decode($_GET["upload_ret"]);

	echo "<script>alert('图片上传失败:".$error." - " . $upload_ret . "');</script>";
	
	//echo $error;
		
}else{
	
	$ret = $_GET["upload_ret"];
	
	if($ret!=""){
		$ret = base64_decode($ret);
	}
	
	//echo $ret;
	
	$ret = json_decode($ret);
	
	//print_r($ret);
	
	$img = "http://qimg.dangma.la/".$ret->key;
	
	$func = $ret -> func;
    
    echo "<script>var func = '".$func."'; var img = '".$img."'; var run = func + '\(\"' + img + '/middle\"\)'; parent.eval(run);</script>";
	
	
}

$go = $_SERVER["HTTP_REFERER"];

//echo '<a href='.$go.'>重新上传</a>';

echo '<script>location.href="'.$go.'";</script>';

?>