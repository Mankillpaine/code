<?php
header('Content-Type:text/html;charset=utf-8');



if(isset($_GET["error"])){
	
	$error = $_GET["error"];
	
	echo "<script>parent.UM.getEditor('myEditor').getWidgetCallback('image')('http://qimg.dangma.la/','Error');alert('图片不能超过2M哦');</script>";
	
	echo $error;
		
}else{

	$ret = $_GET["upload_ret"];
	
	if($ret!=""){
		$ret = base64_decode($ret);
	}
	
	echo $ret;
	
	$ret = json_decode($ret);
	
	
	$width = $ret->width;
	$height = $ret->height;
	
	//存库备用
	$db = new Model("upload_pics");
	
	$new["pickey"] = $ret->key;
	$new["size"] = $ret->size;
	$new["width"] = $ret->width;
	$new["height"] = $ret->height;
	$new["uid"] = $_COOKIE["uid"];
	
	$db -> add($new);
	
	
	if($width > 500){
		$height = (500/$width) * $height;	
		$width = 500;
	}
	
	//print_r($ret);
	
	//echo "<img src='http://qimg.dangma.la/".$ret."' />";
	
	echo "<script>parent.UM.getEditor('myEditor').getWidgetCallback('image')('http://qimg.dangma.la/".$ret->key."/show?".$width."-".$height."','SUCCESS')</script>";
	
	//echo $ret;
	
	
}


?>