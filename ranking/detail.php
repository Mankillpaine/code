<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
	<meta name="viewport" content="width=device-width initial-scale=1.0 maximum-scale=1.0 user-scalable=yes" />
	<meta name="format-detection" content="telephone=no" />
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/css.css">
	<link href="css/tab.css" rel="stylesheet" type="text/css" >
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/check.js"></script>
	<script type="text/javascript" src="js/screen.js"></script>


</head>
<body>
<?php
               //打印出所有的 错误信息

$servername = "rm-2ze2211tvnc3k0c0fo.mysql.rds.aliyuncs.com";
$username = "front";
$password = "Toubu123";
$dbname = "star";

// 创建连接
$conn = new mysqli($servername, $username, $password, $dbname);
// 检测连接
if ($conn->connect_error) {
	die("连接失败: " . $conn->connect_error);
}
$rr = $_GET['num'];

$len = strlen($rr);
if($len >5){
	$fix  = substr($rr, 0, 3); // 取到ID前三位
	$plat = (int)substr($rr, 3, 2); //取到平台号
	$end_plat = substr($rr, 5, $len-5); //取到ID后五位

	$platformid = (int)($end_plat . $fix);
}
else{
	$plat = (int)substr($rr,-2);
	$platformid =  (int)substr($rr,0,$len-2);
}
	$sql = "SELECT * FROM `users` WHERE `platformid` = '".$platformid."'  AND `platform` =" .$plat ;

$result = $conn->query($sql);






$conn->close();
?>

<div class="wapper" id="page" style="background-color: #f8f8f8;">
	<?php
		if ($result->num_rows > 0) {
		// 输出每行数据
		while($row = $result->fetch_assoc()) {

	?>
	<div class="d_head">
		<div class="d_thumb">
			<img src="<?php if($row['avatar']==null){ echo "images/0.jpg"; } else {if(strpos($row['avatar'],".cn")>0) echo $row['avatar'];else if(strpos($row['avatar'],".cn")==0 && $row['platform'] ==1 )  {echo "http://img.meelive.cn/".$row['avatar']; }  else  echo $row['avatar'];} ?>">
		</div>
		<div class="nikename">
			<?php echo str_replace("?"," ",$row['nickname']);?>
		</div>
		<div class="plat_dname">
			<?php
			if($row['platform'] ==1) echo "映客";
			if($row['platform'] ==2) echo "一直播";
			if($row['platform'] ==3) echo "花椒直播";
			if($row['platform'] ==4) echo "熊猫TV";
			if($row['platform'] ==5) echo "全民TV";
			?>    ID:<?php echo $row['platformid']; ?>
		</div>
	</div>
	<div class="d_content">
		<div class="d-cont_head">
			<div class="fans_num">
				<span class="fans_n"><?php echo $row['follower']; ?></span>
				<span class="fans_name">粉丝</span>
			</div>
			<div class="line" style="float: left;  width: 1px;  height: 0.48rem;   background-color: #d8d8d8;  margin: 0.5rem 0rem;"></div>
			<div class="plat_ticket">
				<span class="ticket_n"><?php  if($row['platform'] ==4) echo number_format($row['income']/1000000,2); else{ echo $row['income'];}?></span>
				<span class="ticket_name">
					<?php
					if($row['platform'] ==1) echo "映票";
					if($row['platform'] ==2) echo "一直播";
					if($row['platform'] ==3) echo "花椒币";
					if($row['platform'] ==4) echo "身高";
					if($row['platform'] ==5) echo "战斗力";
					?></span>
			</div>
		</div>
	</div>
	<div class="d-cont_mid">

		<div class="d-dis-title">
			<div class="d_ico"><img src="images/information.png"></div>
			<div class="title-name">主播简介</div>
		</div>
		<div class="d-dis-cont">
		<?php if($row['veri_info']){ echo  "<div class='d_tag'>".$row['veri_info']." </div> ";}?>
			<div class="d_dis" ><?php if($row['intro']){echo $row['intro'];} if(!$row['intro'] && !$row['veri_info']){echo "这个主播暂时没有个人简介";} ?></div>
		</div>
		<div class="d-dis-info">
			<ul>
				<?php if($row['gender'] ==1 || $row['gender']==2){ ?>
				<li>
					<div class="d_ico">
						<img src="images/sex.png" />
					</div>
					<div class="dis-info-n">
						性别
					</div>
					<div class="dis-info-r">
						<?php if($row['gender']==1) {echo "男";} else if($row['gender'] ==2){ echo "女";} ?>
					</div>
				</li>
				<?php } ?>
				<?php if($row['birthday']){ ?>
				<li>
					<div class="d_ico">
						<img src="images/birthday.png" />
					</div>
					<div class="dis-info-n">
						生日
					</div>
					<div class="dis-info-r">
						<?php echo $row['birthday']; ?>
					</div>
				</li>
				 <?php } ?>
			<?php if($row['cityname']){ ?>
				<li>
					<div class="d_ico">
						<img src="images/location.png" />
					</div>
					<div class="dis-info-n">
						城市
					</div>
					<div class="dis-info-r">
						<?php echo $row['cityname'];  ?>
					</div>
				</li>
			<?php } ?>
			<?php if($row['hometownname']) {?>
				<li>
					<div class="d_ico">
						<img src="images/home.png" />
					</div>
					<div class="dis-info-n">
						家乡
					</div>
					<div class="dis-info-r">
						<?php echo $row['hometownname']; ?>
					</div>
				</li>
			  <?php } ?>

			</ul>
		</div>
	</div>

	<div class="bottom">
		<div class="content-star">
			<a href="content.php?num=<?php echo $rr ?>">联系主播</a>
		</div>
	</div>
	<?php
		}
		}
	?>
</div>

<!-- web end -->
<script type="text/javascript">

	window.onresize = function () {
		// 计算响应式比例
		var number = document.documentElement.clientWidth / 750 * 625;

		if(number < 625) document.getElementsByTagName('html')[0].style.fontSize = number +'%';
		number = null;
	}




</script>


<div style="display:none;">
<script language="javascript" type="text/javascript" src="http://js.users.51.la/18934637.js"></script>
<noscript><a href="http://www.51.la/?18934637" target="_blank"><img alt="&#x6211;&#x8981;&#x5566;&#x514D;&#x8D39;&#x7EDF;&#x8BA1;" src="http://img.users.51.la/18934637.asp" style="border:none" /></a></noscript>
</div>

</body>
</html>