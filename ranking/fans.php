<html>
<meta charset="utf8">
<meta name="viewport" content="width=device-width initial-scale=1.0 maximum-scale=1.0 user-scalable=yes" />
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" type="text/css" href="css/css.css">
<link href="css/tab.css" rel="stylesheet" type="text/css" >
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/check.js"></script>
<script type="text/javascript" src="js/screen.js"></script>


<?php
$hourse = date("H",time());
   $platform = (int)$_GET['platform'];

if($platform){
    if($hourse>=9) {
        $sql = "SELECT a.*,users.`nickname`,users.`avatar`  from (select income_log.*  from `income_log` where `idate` = CURRENT_DATE()  and `platform` = ". $platform. " order by `increase_follower`   desc limit 100) as a inner join users on  `a`.`platform` =`users`.`platform`  and `a`.`platformid` =users.`platformid` ORDER BY `a`.`increase_follower` DESC";
    }else{
        $sql = "SELECT a.*,users.`nickname`,users.`avatar`  from (select income_log.*  from `income_log` where `idate` = CURRENT_DATE()-1  and `platform` = ". $platform . "  order by `increase_follower`   desc limit 100) as a inner join users on  `a`.`platform` =`users`.`platform`  and `a`.`platformid` =users.`platformid` ORDER BY `a`.`increase_follower` DESC";

    }
}else{
    if($hourse>=9) {
        $sql = "SELECT a.*,users.`nickname`,users.`avatar`  from (select income_log.*  from `income_log` where platform in(1,3) and `idate` = CURRENT_DATE() order by `increase_follower`  desc limit 100) as a inner join users on  `a`.`platform` =`users`.`platform`  and `a`.`platformid` =users.`platformid` ORDER BY `a`.`increase_follower` DESC";
    }else{
        $sql = "SELECT a.*,users.`nickname`,users.`avatar`  from (select income_log.*  from `income_log` where  platform in(1,3) and `idate` = CURRENT_DATE()-1 order by `increase_follower`  desc limit 100) as a inner join users on  `a`.`platform` =`users`.`platform`  and `a`.`platformid` =users.`platformid` ORDER BY `a`.`increase_follower` DESC";


    }
}

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

    $result = $conn->query($sql);


?>
<head>
    <title>粉丝增长排行</title>
</head>
<body>
<div class="wapper" id="page">
    <!-- 代码部分begin -->
    <div class="bigone" style="position:relative;overflow:hidden">
        <div style="position:relative;overflow:hidden">
            <div class="titleone">
                <a href="fans.php"<?php if(!$_GET['platform']) {echo "style='color:#51a5fe;font-size:0.32rem;border-bottom:2px solid #51a5fe;'";} ?>>全网排行</a>
                <a href="fans.php?platform=1" <?php if($_GET['platform']){echo "style='color:#51a5fe;font-size:0.32rem;border-bottom:2px solid #51a5fe; '";}   ?>  class="last">平台排行</a>
            </div>
            <div class="con">
                <div class="list1-title" <?php if($_GET['platform']){echo "style='display:block; '";}   ?>>
                    <a href="fans.php?platform=1" <?php if($_GET['platform']==1){echo "style='color:#51a5fe;font-weight:bold; '";}   ?>>映客直播</a>
                    <!--                            <a href="javascript:;">熊猫TV</a>-->
                    <!--                            <a href="javascript:;">全民TV</a>-->
                    <a href="fans.php?platform=3" <?php if($_GET['platform']==3){echo "style='color:#51a5fe;font-weight:bold; '";}   ?> >花椒直播</a>
                </div>
                <div class="date_line">
                    <hr size="1px" style="width:24%; float:left; border:0;height: 1px; background-color: #f3f3f3; " />
                    <div class="date_word" >
                        <span>昨日榜单 • <?php  echo date('Y.m.d',strtotime('yesterday')); ?></span>
                    </div>
                    <hr size="1px"style="width:24%; float:left; border:0;height: 1px; background-color: #f3f3f3; "/>
                </div>
                <div class="listone list1">

                    <div class="list1-con">
                        <ul>
                 <?php

                    foreach ($result as $key => $value) {
                        $platformid = $value['platformid'];
                        $paltfor    =  $value['platform'];;
                        $leng = strlen($platformid); //字符串长度
                        if($leng>3){
                            $num = substr($platformid,strlen($platformid)-3,3); //后三位字符
                            if(strlen($paltfor)==1){
                                $paltfor = '0'.$paltfor; //平台前面加0
                            }
                            $men = substr($platformid,0,$leng-3); //ID后三位之前的字符
                            $rr =  $num . $paltfor.$men;
                        }
                        else{
                            $num = $platformid.$paltfor;
                        }

                        if($key==0){

                 ?>
              <a href="detail.php?num=<?php echo $rr;  ?>" >
                <li>
                    <div class="con_r">
                        <div class="top">
                            <img src="images/top1.png">
                        </div>
                        <div class="thumb">
                            <img src="<?php if($value['avatar']==null){ echo "images/0.jpg"; } else {if(strpos($value['avatar'],".cn")>0) echo $value['avatar'];else if(strpos($value['avatar'],".cn")==0 && $value['platform'] ==1 )  {echo "http://img.meelive.cn/".$value['avatar']; }  else  echo $value['avatar'];} ?>" />
                        </div>
                    </div>
                    <div class="con_l">
                        <div class="info_name">
                             <?php echo str_replace("?"," ",$value['nickname']);?>
                        </div>
                        <div class="ico"></div>
                        <div class="plat_name">
                            <?php
                                if($value['platform'] ==1) echo "映客";
                                if($value['platform'] ==2) echo "一直播";
                                if($value['platform'] ==3) echo "花椒直播";
                                if($value['platform'] ==4) echo "熊猫TV";
                                if($value['platform'] ==5) echo "全民TV";
                            ?>
                        </div>
                        <div class="p_income">日新增粉丝:<span><?php echo $value['increase_follower']; ?> 人 </span>
                        </div>
                    </div>
                </li>
              </a>
                  <?php } else if($key == 1) { ?>
                            <a href="detail.php?num=<?php echo $rr;  ?>">
                            <li>
                                <div class="con_r">
                                    <div class="top">
                                        <img src="images/top2.png">
                                    </div>
                                    <div class="thumb">

                                        <img src="<?php if($value['avatar']==null){ echo "images/0.jpg"; } else {if(strpos($value['avatar'],".cn")>0) echo $value['avatar'];else if(strpos($value['avatar'],".cn")==0 && $value['platform'] ==1 )  {echo "http://img.meelive.cn/".$value['avatar']; }  else  echo $value['avatar'];} ?>" />

                                    </div>
                                </div>
                                <div class="con_l">
                                    <div class="info_name">
                                        <?php echo str_replace("?"," ",$value['nickname']);?>
                                    </div>
                                    <div class="ico"></div>
                                    <div class="plat_name">
                                        <?php
                                        if($value['platform'] ==1) echo "映客";
                                        if($value['platform'] ==2) echo "一直播";
                                        if($value['platform'] ==3) echo "花椒直播";
                                        if($value['platform'] ==4) echo "熊猫TV";
                                        if($value['platform'] ==5) echo "全民TV";
                                        ?></div>
                                    <div class="p_income">日新增粉丝:<span><?php echo $value['increase_follower'];?> 人 </span></div>
                                </div>
                            </li>
                                </a>
                            <?php } if($key==2){ ?>
                            <a href="detail.php?num=<?php echo $rr;  ?>">
                            <li>
                                <div class="con_r">
                                    <div class="top">
                                        <img src="images/top3.png">
                                    </div>
                                    <div class="thumb">
                                        <img src="<?php if($value['avatar']==null){ echo "images/0.jpg"; } else {if(strpos($value['avatar'],".cn")>0) echo $value['avatar'];else if(strpos($value['avatar'],".cn")==0 && $value['platform'] ==1 )  {echo "http://img.meelive.cn/".$value['avatar']; }  else  echo $value['avatar'];} ?>" />
                                    </div>
                                </div>
                                <div class="con_l">
                                    <div class="info_name"><?php echo str_replace("?"," ",$value['nickname']);?></div>
                                    <div class="ico"></div>
                                    <div class="plat_name">
                                        <?php
                                        if($value['platform'] ==1) echo "映客";
                                        if($value['platform'] ==2) echo "一直播";
                                        if($value['platform'] ==3) echo "花椒直播";
                                        if($value['platform'] ==4) echo "熊猫TV";
                                        if($value['platform'] ==5) echo "全民TV";
                                        ?>
                                    </div>
                                    <div class="p_income">日新增粉丝:<span><?php echo $value['increase_follower']; ?> 人 </span></div>
                                </div>
                            </li>
                            </a>
                            <?php }else if($key>2) { ?>
                            <a href="detail.php?num=<?php echo $rr;  ?>">
                            <li>
                                <div class="con_r">
                                    <div class="top">
                                        <span class="top_n"><?php echo $key+1 ?></span>
                                    </div>
                                    <div class="thumb">
                                        <img src="<?php if($value['avatar']==null){ echo "images/0.jpg"; } else {if(strpos($value['avatar'],".cn")>0) echo $value['avatar'];else if(strpos($value['avatar'],".cn")==0 && $value['platform'] ==1 )  {echo "http://img.meelive.cn/".$value['avatar']; }  else  echo $value['avatar'];} ?>" />
                                    </div>
                                </div>
                                <div class="con_l">
                                    <div class="info_name"><?php echo str_replace("?"," ",$value['nickname']);?></div>
                                    <div class="ico"></div>
                                    <div class="plat_name">
                                        <?php
                                        if($value['platform'] ==1) echo "映客";
                                        if($value['platform'] ==2) echo "一直播";
                                        if($value['platform'] ==3) echo "花椒直播";
                                        if($value['platform'] ==4) echo "熊猫TV";
                                        if($value['platform'] ==5) echo "全民TV";
                                        ?>
                                    </div>
                                    <div class="p_income">日新增粉丝:<span><?php echo $value['increase_follower'];?> 人 </span>
                                    </div>
                                </div>
                            </li>
                            </a>
                           <?php }} ?>
                        </ul>
                    </div>
                </div>

                </div>


            </div>
        </div>
    </div>
    <div class="footer">
        <img src="images/footer.png" />
    </div>
</div>

<?php  $conn->close();   ?>
<!-- web end -->
<script type="text/javascript">

    window.onresize = function () {
        // 计算响应式比例
        var number = document.documentElement.clientWidth / 750 * 625;

        if(number < 625) document.getElementsByTagName('html')[0].style.fontSize = number +'%';
        number = null;
    }

    function tabmenu(){
        $(".tab_selec").toggleClass("view")
    }

    function ontab() {
//           alert('fdafdsafdsas');
        $(".list1-title"). css('display','block');
    }


</script>

<div style="display:none;">
<script language="javascript" type="text/javascript" src="http://js.users.51.la/18934637.js"></script>
<noscript><a href="http://www.51.la/?18934637" target="_blank"><img alt="&#x6211;&#x8981;&#x5566;&#x514D;&#x8D39;&#x7EDF;&#x8BA1;" src="http://img.users.51.la/18934637.asp" style="border:none" /></a></noscript>
</div>

</body>
</html>
