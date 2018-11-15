<!DOCTYPE html>
<html lang="zh-CN" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $userinfo->nickname;?>的直播成就</title>
    <link rel="stylesheet" type="text/css" href="<?php echo HTTP_URL; ?>boostrap/css/bootstrap-theme.css">
    <link rel="stylesheet" type="text/css" href="<?php echo HTTP_URL; ?>boostrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="<?php echo HTTP_URL; ?>css/share.css">
    <script type="text/javascript" src="<?php echo HTTP_URL; ?>js/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo HTTP_URL; ?>boostrap/js/bootstrap.js"></script>
    <script type="text/javascript" src="<?php echo HTTP_URL; ?>js/screen.js"></script>
    <script type="text/javascript" src="<?php echo HTTP_URL; ?>js/Chart.js"></script>
    <script type="text/javascript" src="<?php echo HTTP_URL; ?>js/birthday.js"></script>
</head>
<body>
<div  class="warpper" id="aa">
    <div class="share1">
        <div class="share_top">
            <div class="thumbs">
                <img src="<?php if($userinfo->plat=='映客' && strpos($userinfo->avatar,".cn")==0 )  {echo "http://img.meelive.cn/".$userinfo->avatar; }else{ echo $userinfo->avatar;}?>">
            </div>
            <div class="palt_info">
                <span class="plat_user"><?php echo $userinfo->nickname;?></span>
                <span class="inco"></span>
                <span class="plat_name"><?php echo $userinfo->plat;?></span>
            </div>
            <div class="date">
                <span class="date_t"><?php echo $userinfo->itime;?>开播  时长<?php echo floor($userinfo->duration / 60) + 1;?>分钟</span>
            </div>
        </div>
        <div class="share_date">
            <div class="data_char">
                <span class="char_name char">超过了今天</span>
                <div class="char_s">
                    <span class="char_data"><?php echo $userinfo->percent;?></span>
                    <span class="char_data_r">%</span>
                </div>
                <span class="charr_name">的主播</span>
            </div>
            <div class="data_t">
                <span class="data_f"><?php echo substr($userinfo->follower,0,1);?></span>
                <span class="data_n"><?php echo substr($userinfo->follower,1,strlen($userinfo->follower)-1);?></span>
                <span class="data_c">粉丝增长</span>
            </div>
            <div class="data_m">
                <span class="data_f"><?php echo substr($userinfo->gold,0,1);?></span>
                <span class="data_n"><?php echo substr($userinfo->gold,1,strlen($userinfo->gold)-1);?></span>
                <span class="data_c">金币增长</span>
            </div>
            <div class="data_b">
                <span class="data_f"><?php echo substr($userinfo->online,0,1);?></span>
                <span class="data_n"><?php echo substr($userinfo->online,1,strlen($userinfo->online)-1);?></span>
                <span class="data_c">最高在线</span>
            </div>
        </div>
        <div class="clear">	</div>
        <?php
        	$top = json_decode($userinfo->income_top);
		?>
        <div class="income_top">
            <div class="income-t"></div>
            <ul>

<?php
$i=0;
foreach($top as $t){
	if($i>5){break;}
?>
                <li>    <span class="income_number"><?php echo $i+1; ?></span>
						<span class="top_thumb">

                            <img src="<?php echo  $t->face; ?>">

						</span>
						<span class="top_nic">

							<?php echo $t->nic; ?>
						</span>
                    <span class="ds_data">本场打赏<?php echo $t->gold; ?></span>
                </li>
<?php
$i++;
}
?>
            </ul>
            <div class="income_b"> </div>
        </div>
        <div class="clear">	</div>
        
        <?php if($isMe==1){?>
        
        	<div class="share_bottom">
            <div class="sharebtn">
                <div class="sharebtn_top">
                    分享一下，晒晒我的直播成就~
                </div>
                <div class="sharebtn_ico">
                    <ul>
                        <li><a href="###"> <img src="<?php echo HTTP_URL; ?>images/pengyouquan.png"> </a></li>
                        <li><a href="###"> <img src="<?php echo HTTP_URL; ?>images/wechat.png"> </a></li>
                    </ul>
                </div>
            </div>
        </div>

            
            
        <?php }else{?>
		
        <div class="share_bottom">
            <div class="share_dis">
                <img src="<?php echo HTTP_URL; ?>images/ktzb.png" style="cursor:pointer;" onClick="location.href='http://mp.weixin.qq.com/s?__biz=MzI0NjQzNDA2OA==&tempkey=hIK8WlfbKdXcs3g5mI8GjG3XkJaWO1GLZKjbdoT7qBNgOvJtczx%2BAZI33DE0eSMWnSsXsOvmu5%2BpzcrRXUETqqSueMgyE5P2FRq6KwYitKFt8ujRxy3nDZ0r%2FR0Llb5QtWgv00ztnYQcxcsWFVJMeQ%3D%3D&#rd';">
            </div>
            <div class="share_tb">
                <img src="<?php echo HTTP_URL; ?>images/tb.png" alt="">
            </div>
        </div>

		<?php }?>
    </div>

    <div class="tc" style="display: none;">
        <div class="tip">
            <span><img src="<?php echo HTTP_URL; ?>images/129.png"></span>
            <span class="cl_this">点击这里，分享给您的好友或朋友圈</span>
        </div>
    </div>


</div>
<script type="text/javascript">

    window.onload =function () {
        // 计算响应式比例
        var number = document.documentElement.clientWidth / 750 * 625;

        if(number < 625){
            document.getElementsByTagName('html')[0].style.fontSize = number +'%';
        }    else {
            document.getElementsByTagName('html')[0].style.fontSize = '625%';
        }

        number = null;
    } ;
    $(".sharebtn_ico").click(function () {

        $('.tc').css("display","block");
    });
</script>
<?php require_once("common/footer.php"); ?>


</body>
</html>