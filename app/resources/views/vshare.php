<!DOCTYPE html>
<html lang="zh-CN" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>分享页</title>
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
                <img src="<?php echo HTTP_URL; ?>images/timg.jpg">
            </div>
            <div class="palt_info">
                <span class="plat_user">我有七根胡子</span>
                <span class="inco"></span>
                <span class="plat_name">映客直播</span>
            </div>
            <div class="date">
                <span class="date_t">2016.09.02 14:00 开播  时长40分钟</span>
            </div>
        </div>
        <div class="share_date">
            <div class="data_char">
                <span class="char_name char">超过了今天</span>
                <div class="char_s">
                    <span class="char_data">85.4</span>
                    <span class="char_data_r">%</span>
                </div>
                <span class="charr_name">的主播</span>
            </div>
            <div class="data_t">
                <span class="data_f">3</span>
                <span class="data_n">00</span>
                <span class="data_c">粉丝增长</span>
            </div>
            <div class="data_m">
                <span class="data_f">5</span>
                <span class="data_n">423</span>
                <span class="data_c">金币增长</span>
            </div>
            <div class="data_b">
                <span class="data_f">5</span>
                <span class="data_n">423</span>
                <span class="data_c">最高在线</span>
            </div>
        </div>
        <div class="clear">	</div>
        <div class="income_top5">
            <ul>
                <li style="margin-top:0;">
						<span class="top_thumb">
							<img src="<?php echo HTTP_URL; ?>images/timg.jpg">
						</span>
						<span class="top_nic" style="margin-top:0.18rem;">
							我有七根胡子
						</span>
                    <span class="ds_data">本场打赏20000</span>
                </li>

                <li>
						<span class="top_thumb">
							<img src="<?php echo HTTP_URL; ?>images/timg.jpg">
						</span>
						<span class="top_nic" style="margin-top:0.18rem;">
							我有七根胡子
						</span>
                    <span class="ds_data">本场打赏20000</span>
                </li>

                <li>
						<span class="top_thumb" style="margin-top:0.04rem;">
							<img src="<?php echo HTTP_URL; ?>images/timg.jpg">
						</span>
						<span class="top_nic" style="margin-top:0.18rem;">
							我有七根胡子
						</span>
                    <span class="ds_data">本场打赏20000</span>
                </li>

                <li>
						<span class="top_thumb" style="margin-top:0.08rem;">
							<img src="<?php echo HTTP_URL; ?>images/timg.jpg">
						</span>
						<span class="top_nic" style="margin-top:0.2rem;">
							我有七根胡子
						</span>
                    <span class="ds_data">本场打赏20000</span>
                </li>

                <li>
						<span class="top_thumb" style="margin-top:0.25rem;">
							<img src="<?php echo HTTP_URL; ?>images/timg.jpg">
						</span>
						<span class="top_nic" style="margin-top:0.4rem;">
							我有七根胡子
						</span>
                    <span class="ds_data">本场打赏20000</span>
                </li>
            </ul>

        </div>
        <div class="clear">	</div>
        <div class="share_bottom">
            <div class="sharebtn">
                <div class="sharebtn_top">
                    分享一下，晒晒我的直播成就~
                </div>
                <div class="sharebtn_ico">
                    <ul>
                        <li><a href="###"> <img src="<?php echo HTTP_URL; ?>images/pengyouquan.png"> </a></li>
                        <li><a href="###"> <img src="<?php echo HTTP_URL; ?>images/wechat.png"> </a></li>
                        <li><a href="###"> <img src="<?php echo HTTP_URL; ?>images/weibo.png"> </a></li>
                        <li><a href="###"> <img src="<?php echo HTTP_URL; ?>images/qzone.png"> </a></li>
                    </ul>
                </div>
            </div>
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

</script>
</body>
</html>

