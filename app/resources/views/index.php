<html>
<meta charset="utf8">
<meta name="viewport" content="width=device-width initial-scale=1.0 maximum-scale=1.0 user-scalable=yes" />
<link rel="stylesheet" type="text/css" href="/lumen4/public/css/style.css">
<link rel="stylesheet" type="text/css" href="/lumen4/public/css/css.css">
<link href="/lumen4/public/css/tab.css" rel="stylesheet" type="text/css" >
<script type="text/javascript" src="/lumen4/public/js/jquery.min.js"></script>
<script type="text/javascript" src="/lumen4/public/js/check.js"></script>
<script type="text/javascript" src="/lumen4/public/js/screen.js"></script>
<head>
    <title>主播收入排行</title>
</head>
<div class="wapper" id="page">
    <!-- 代码部分begin -->
    <div class="bigone" style="position:relative;overflow:hidden">
        <div style="position:relative;overflow:hidden">
            <div class="titleone">
                <a href="/index/">全网排行</a>
                <a href="/index/platform/1" class="last">平台排行</a>
            </div>
            <div class="con">
                <div class="list1-title" >
                    <a href="index/platform/1">映客直播</a>
                    <!--                            <a href="javascript:;">熊猫TV</a>-->
                    <!--                            <a href="javascript:;">全民TV</a>-->
                    <a href="index/platform/3"  >花椒直播</a>
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
                                $platformid = $value->platformid;
                                $paltfor    =  $value->platform;
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
                                    <a href="detail?num=<?php echo $rr;  ?>" >
                                        <li>
                                            <div class="con_r">
                                                <div class="top">
                                                    <img src="/lumen4/public/images/top1.png">
                                                </div>
                                                <div class="thumb">
                                                    <img src="<?php if($value->avatar ==null){ echo "/lumen4/public/images/0.jpg"; } else {if(strpos($value->avatar,".cn")>0) echo $value->avatar;else if(strpos($value->avatar,".cn")==0 && $value->platform ==1 )  {echo "http://img.meelive.cn/".$value->avatar; }  else  echo $value->avatar;} ?>" />
                                                </div>
                                            </div>
                                            <div class="con_l">
                                                <div class="info_name">
                                                    <?php echo str_replace("?"," ",$value->nickname);?>
                                                </div>
                                                <div class="ico"></div>
                                                <div class="plat_name">
                                                    <?php
                                                    if($value->platform ==1) echo "映客";
                                                    if($value->platform  ==2) echo "一直播";
                                                    if($value->platform  ==3) echo "花椒直播";
                                                    if($value->platform  ==4) echo "熊猫TV";
                                                    if($value->platform  ==5) echo "全民TV";
                                                    ?>
                                                </div>
                                                <div class="p_income">昨日收入:<span><?php echo $value->increase_rmb ; ?> 元 </span>(<?php  if($value->platform  ==4) echo number_format($value->increase/1000000,2); else{ echo $value->increase;}?>
                                                    <?php
                                                    if($value->platform  ==1) echo "映票";
                                                    if($value->platform  ==2) echo "一直播";
                                                    if($value->platform  ==3) echo "花椒币";
                                                    if($value->platform  ==4) echo "身高";
                                                    if($value->platform  ==5) echo "战斗力";
                                                    ?>)
                                                </div>
                                            </div>
                                        </li>
                                    </a>
                                <?php } else if($key == 1) { ?>
                                    <a href="detail?num=<?php echo $rr;  ?>">
                                        <li>
                                            <div class="con_r">
                                                <div class="top">
                                                    <img src="/lumen4/public/images/top2.png">
                                                </div>
                                                <div class="thumb">

                                                    <img src="<?php if($value->avatar==null){ echo "/lumen4/public/images/0.jpg"; } else {if(strpos($value->avatar,".cn")>0) echo $value->avatar;else if(strpos($value->avatar,".cn")==0 && $value->platform  ==1 )  {echo "http://img.meelive.cn/".$value->avatar; }  else  echo $value->avatar;} ?>" />

                                                </div>
                                            </div>
                                            <div class="con_l">
                                                <div class="info_name">
                                                    <?php echo str_replace("?"," ",$value->nickname);?>
                                                </div>
                                                <div class="ico"></div>
                                                <div class="plat_name">
                                                    <?php
                                                    if($value->platform  ==1) echo "映客";
                                                    if($value->platform  ==2) echo "一直播";
                                                    if($value->platform  ==3) echo "花椒直播";
                                                    if($value->platform  ==4) echo "熊猫TV";
                                                    if($value->platform  ==5) echo "全民TV";
                                                    ?></div>
                                                <div class="p_income">昨日收入:<span><?php echo $value->increase_rmb ;?> 元 </span>(<?php  if($value->platform  ==4) echo number_format($value->increase/1000000,2); else{ echo $value->increase;}?> <?php
                                                    if($value->platform  ==1) echo "映票";
                                                    if($value->platform  ==2) echo "一直播";
                                                    if($value->platform  ==3) echo "花椒币";
                                                    if($value->platform  ==4) echo "米身高";
                                                    if($value->platform  ==5) echo "战斗力";
                                                    ?>)</div>
                                            </div>
                                        </li>
                                    </a>
                                <?php } if($key==2){ ?>
                                    <a href="detail?num=<?php echo $rr;  ?>">
                                        <li>
                                            <div class="con_r">
                                                <div class="top">
                                                    <img src="/lumen4/public/images/top3.png">
                                                </div>
                                                <div class="thumb">
                                                    <img src="<?php if($value->avatar==null){ echo "/lumen4/public/images/0.jpg"; } else {if(strpos($value->avatar,".cn")>0) echo $value->avatar;else if(strpos($value->avatar,".cn")==0 && $value->platform  ==1 )  {echo "http://img.meelive.cn/".$value->avatar; }  else  echo $value->avatar;} ?>" />
                                                </div>
                                            </div>
                                            <div class="con_l">
                                                <div class="info_name"><?php echo str_replace("?"," ",$value->nickname);?></div>
                                                <div class="ico"></div>
                                                <div class="plat_name">
                                                    <?php
                                                    if($value->platform  ==1) echo "映客";
                                                    if($value->platform  ==2) echo "一直播";
                                                    if($value->platform  ==3) echo "花椒直播";
                                                    if($value->platform  ==4) echo "熊猫TV";
                                                    if($value->platform  ==5) echo "全民TV";
                                                    ?>
                                                </div>
                                                <div class="p_income">昨日收入:<span><?php echo $value->increase_rmb ; ?> 元 </span>(<?php  if($value->platform  ==4) echo number_format($value->increase/1000000,2); else{ echo $value->increase;}?> <?php
                                                    if($value->platform  ==1) echo "映票";
                                                    if($value->platform  ==2) echo "一直播";
                                                    if($value->platform  ==3) echo "花椒币";
                                                    if($value->platform  ==4) echo "米身高";
                                                    if($value->platform  ==5) echo "战斗力";
                                                    ?>)</div>
                                            </div>
                                        </li>
                                    </a>
                                <?php }else if($key>2) { ?>
                                    <a href="detail?num=<?php echo $rr;  ?>">
                                        <li>
                                            <div class="con_r">
                                                <div class="top">
                                                    <span class="top_n"><?php echo $key+1 ?></span>
                                                </div>
                                                <div class="thumb">
                                                    <img src="<?php if($value->avatar==null){ echo "/lumen4/public/images/0.jpg"; } else {if(strpos($value->avatar,".cn")>0) echo $value->avatar;else if(strpos($value->avatar,".cn")==0 && $value->platform  ==1 )  {echo "http://img.meelive.cn/".$value->avatar; }  else  echo $value->avatar;} ?>" />
                                                </div>
                                            </div>
                                            <div class="con_l">
                                                <div class="info_name"><?php echo str_replace("?"," ",$value->nickname);?></div>
                                                <div class="ico"></div>
                                                <div class="plat_name">
                                                    <?php
                                                    if($value->platform  ==1) echo "映客";
                                                    if($value->platform  ==2) echo "一直播";
                                                    if($value->platform  ==3) echo "花椒直播";
                                                    if($value->platform  ==4) echo "熊猫TV";
                                                    if($value->platform  ==5) echo "全民TV";
                                                    ?>
                                                </div>
                                                <div class="p_income">昨日收入:<span><?php echo $value->increase_rmb ;?> 元 </span>(<?php  if($value->platform  ==4) echo number_format($value->increase/1000000,2); else{ echo $value->increase;}?>
                                                    <?php
                                                    if($value->platform  ==1) echo "映票";
                                                    if($value->platform  ==2) echo "一直播";
                                                    if($value->platform  ==3) echo "花椒币";
                                                    if($value->platform  ==4) echo "米身高";
                                                    if($value->platform  ==5) echo "战斗力";
                                                    ?>)
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
    <img src="/lumen4/public/images/footer.png" />
</div>
</div>



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

    function nav() {


    }
</script>
</body>
</html>


