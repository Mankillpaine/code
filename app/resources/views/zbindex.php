<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, target-densitydpi=device-dpi" />
    <title>主播小秘书 - 聪明的主播都在用 - 头部出品</title>
    <link rel="stylesheet" type="text/css" href="<?php echo HTTP_URL; ?>boostrap/css/bootstrap-theme.css">
    <link rel="stylesheet" type="text/css" href="<?php echo HTTP_URL; ?>boostrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="<?php echo HTTP_URL; ?>css/wecss.css">
    <script type="text/javascript" src="<?php echo HTTP_URL; ?>js/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo HTTP_URL; ?>boostrap/js/bootstrap.js"></script>
    <script type="text/javascript" src="<?php echo HTTP_URL; ?>js/screen.js"></script>

</head>
<body>
<div class="warpper">
    <div class="header" style="padding-top: 0.48rem;">
        <div class="thumb center-block" >
            <img src="<?php if ($result[0]->avatar) { echo $result[0]->avatar; }else{ echo HTTP_URL."images/touxiang.png"; } ?>" class="img-circle">
        </div>
        <div class="platinfo center-block">
            <div class="text-content">
                <div class="paltuser">
                    <?php  if($result[0]->nickname) { echo $result[0]->nickname; } else { echo "主播小秘书";  } ; ?>
                </div>
                <span class="icon"></span>
                <div class="platname">
                   <?php
                   if($result[0]->platform==1){ echo "映客直播";}
                  else if($result[0]->platform==6){ echo "哈你直播";}
                  else if($result[0]->platform==5){ echo "全民TV";}
                  else if($result[0]->platform==4){ echo "熊猫TV";}
                  else if($result[0]->platform==3){ echo "花椒直播";}
                  else if($result[0]->platform==7){ echo "一直播";}
                    else{echo "暂无平台"; }
                   ?>
                </div>
            </div>
        </div>
    </div>




    <div class="content">
        <ul>
            <li>
                <a href="/app/zhubo">
                    <div class="nav_ico">
                        <img src="<?php echo HTTP_URL; ?>images/partner.png" />
                    </div>
                    <span>直播伴侣</span>
                </a>

                <a href="/app/srph">
                    <div class="nav_ico">
                        <img src="<?php echo HTTP_URL; ?>images/income.png" />
                    </div>
                    <span>收入统计</span>
                </a>
                <a href="/app/zbfans">
                    <div class="nav_ico">
                        <img src="<?php echo HTTP_URL; ?>images/fans.png" />
                    </div>
                    <span>粉丝统计</span>
                </a>

            </li>

            <li>
<!--                <a href="">-->
<!--                    <div class="nav_ico">-->
<!--                        <img src="--><?php //echo HTTP_URL; ?><!--images/offer.png" />-->
<!--                    </div>-->
<!--                    <span>粉丝贡献榜</span>-->
<!--                </a>-->

                <a href="/app/income/platform/1">
                    <div class="nav_ico">
                        <img src="<?php echo HTTP_URL; ?>images/list.png" />
                    </div>
                    <span>主播排行榜</span>
                </a>
<!--                <a href="###">-->
<!--                    <div class="nav_ico">-->
<!--                        <img src="--><?php //echo HTTP_URL; ?><!--images/rich.png" />-->
<!--                    </div>-->
<!--                    <span>土豪排行榜</span>-->
<!--                </a>-->

            </li>
        </ul>

<!--        <ul>-->
<!---->
<!--            <li>-->
<!--                <a href="###">-->
<!--                    <div class="nav_ico">-->
<!--                        <img src="--><?php //echo HTTP_URL; ?><!--images/marketing.png" />-->
<!--                    </div>-->
<!--                    <span>营销接单</span>-->
<!--                </a>-->
<!---->
<!--                <a href="###">-->
<!--                    <div class="nav_ico">-->
<!--                        <img src="--><?php //echo HTTP_URL; ?><!--images/link.png" />-->
<!--                    </div>-->
<!--                    <span>连麦/互推</span>-->
<!--                </a>-->
<!---->
<!--            </li>-->
<!--        </ul>-->

<?php if($state > 0){ ?>
        <ul>

            <li>
                <a href="/app/info">
                    <div class="nav_ico">
                        <img src="<?php echo HTTP_URL; ?>images/seting.png" />
                    </div>
                    <span>编辑资料</span>
                </a>
            </li>

            <li>
                <a href="/app/logout">
                    <div class="nav_ico">
                        <img src="<?php echo HTTP_URL; ?>images/logout.png" />
                    </div>
                    <span>退出登录</span>
                </a>
            </li>
        </ul>
<?php } ?>
        
        
        
    </div>
</div>
<script type="text/javascript">

    // 计算响应式比例
    var number = document.documentElement.clientWidth / 750 * 625;

    if(number < 625){
        document.getElementsByTagName('html')[0].style.fontSize = number +'%';
    }    else {
        document.getElementsByTagName('html')[0].style.fontSize = '625%';
    }

    //        console.log(document.getElementsByTagName('html')[0].style.fontSize = '100px');

    number = null;
</script>

<?php require_once("common/footer.php"); ?>


</body>
</html>