<!DOCTYPE html>
<html lang="ch-zh">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="renderer" content="webkit">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no,email=no">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <title>头部 - 主播详情</title>
    <link rel="stylesheet" href="<?php echo HTTP_URL; ?>web/static/css/common.css">
    <link rel="stylesheet" href="<?php echo HTTP_URL; ?>web/static/css/anchordet.css">
</head>
<body>
    <!--公共头部 start-->
    <header class="public-header">
        <nav class="ly-1210 clearfix">
            <h1 class="logo fl"><a class="inlie wh-100" href="/"></a></h1>
            <ul class="nav fl">
                <li class="fl db"><a href="/">首页</a></li>
                <li class="fl db select"><a href="/industryrmb">指数</a></li>
                <li class="fl db"><a href="/observe">观察</a></li>
                <li class="fl db"><a href="/server">服务</a></li>
            </ul>
            <div class="search fr">
                <div class="ly-sel rel fl">
                    <span class="button btn-sel"></span>
                    <span class="ico abs"></span>
                    <ul class="sel-list public-header-sprite clearfix abs"></ul>
                </div>
                <form action="/searchStar" method="get" style="margin:0px;" id="headSearch" onSubmit="return doSearch();">
                <input class="fl" type="text" id="keyword" name="keyword" placeholder="">
                </form>
                <span class="button btn-search public-header-sprite fr" onClick="return doSearch();"></span>
            
            </div>
        </nav>
    </header>
    <script>
        function doSearch(){
            
            if(document.getElementById("keyword").value == ""){
                alert('请输入主播ID、昵称或资讯搜索词');
                return false;
            }
            
            var searchType = document.getElementsByClassName("btn-sel")[0].innerHTML;
            if(searchType == "主播"){
                document.getElementById("headSearch").action="/searchStar";
            }else if(searchType == "资讯"){
                document.getElementById("headSearch").action="/searchArticle";  
            }
            
            document.getElementById('headSearch').submit();
            
            return true;
        }
    </script>
    <!--公共头部 end-->
<?php if(!$result) {echo "暂无此主播的信息"; }else{ ?>
<!-- 内容部分 start -->
<div class="anchordet-main">
    <div class="ly-1210 clearfix">
        <!-- 左边内容块 start -->
        <div class="anchordet-main-left fl">
            <!-- 用户信息 start -->
            <div class="user-info-wk sprite clearfix">
                <figure class="fl">
                    <img class="fl" src="<?php  if($result[0]->avatar ==null){ echo HTTP_URL."images/0.jpg"; } else {if(strpos($result[0]->avatar,"http")===true) echo $result[0]->avatar;else if(strpos($result[0]->avatar,"http")===false && $result[0]->platform ==1 &&$result[0]->platform !=6 )  {echo "http://img.meelive.cn/".$result[0]->avatar; }else if($result[0]->platform==6){  echo "http://s.momocdn.com/w/u/img/2016/04/01/1459499443848-401_S.png";  }  else  echo $result[0]->avatar;} ?>" alt="<?php echo $result[0]->nickname; ?>">
                    <figcaption class="info-name center">
                        <span class="nickname db text-over-hidden" title="<?php echo $result[0]->nickname;  ?>"><?php echo $result[0]->nickname;  ?></span>
                        <div class="info-id-wk center fl nowrap hidden">
                            <img class="inlie" src="<?php
                            echo HTTP_URL."web/static/images/".$result[0]->platform.".png";

                            ?>" alt="<?php
                            if($result[0]->platform ==1) {echo "映客"; }
                            else if($result[0]->platform ==2) {echo "抱抱"; }
                            else if($result[0]->platform ==3) {echo "花椒直播"; }
                            else if($result[0]->platform ==4) {echo "熊猫TV"; }
                            else if($result[0]->platform ==5) {echo "全民TV"; }
                            else if($result[0]->platform ==6) {echo "陌陌直播"; }
                            else if($result[0]->platform ==7) {echo "一直播"; }
                            else if($result[0]->platform ==8) {echo "美拍"; }
                            else if($result[0]->platform ==9) {echo "来疯直播"; }
                            else if($result[0]->platform ==10) {echo "斗鱼TV"; }

                            ?>">
                            <span class="info-id inlie" title="<?php echo $result[0]->platformid;  ?>"><?php echo $result[0]->platformid;  ?></span>
                        </div>
                    </figcaption>
                </figure>
                <div class="user-info fl">
                    <div class="user-table-wk">
                        <div class="uset-table-nk">
                            <p class="item clearfix user-fist">
                                    <span class="user-sex fl">
                                        <span class="ico sprite ico-sex fl"></span>
                                        <span class="label-cont fl">性别:<?php if($result[0]->gender==1){echo "男";}else if($result[0]->gender ==0){echo "女";}else {echo "保密";}  ?></span>
                                    </span>
                                    <span class="user-age fl">
                                        <span class="ico sprite ico-age fl"></span>
                                        <span class="label-cont fl">生日:<?php echo $result[0]->birthday; ?></span>
                                    </span>
                                <span class="user-area fl">
                                    <span class="ico sprite ico-area fl"></span>
                                    <span class="label-cont fl">城市:<?php echo $result[0]->cityname; ?></span>
                                    </span>
                            </p>
                            <?php if(!empty($result[0]->veri_info)){ ?>
                            <p class="item user-authent clearfix hidden">
                                <span class="ico sprite ico-authent fl"></span>
                                <span class="label-cont fl">认证:<?php echo $result[0]->veri_info; ?></span>
                            </p>
                            <?php  } ?>
                            <p class="item user-autograph clearfix hidden">
                                <span class="ico sprite ico-autograph fl"></span>
                                <span class="label-cont fl">签名:<?php echo $result[0]->intro; ?></span>
                            </p>
                        </div>
                    </div>
                </div>
                <ul class="data-list">
                    <li class="fl">
                        <em class="db center text-over-hidden" title="<?php  echo $result[0]->indexnum; ?>"><?php  echo $result[0]->indexnum; ?></em>
                        <span class="label center db">综合指数</span>
                    </li>
                    <li class="fl">
                        <em class="db center text-over-hidden" title="<?php   echo $hostnum; ?>"><?php   echo $hostnum; ?></em>
                        <span class="label center db">热度指数</span>
                    </li>
                    <li class="fl">
                        <em class="db center text-over-hidden" title="<?php echo $result[0]->income; ?>"><?php
                            if($result[0]->platform ==1) {echo  $result[0]->income; }
                            else if($result[0]->platform ==2) {echo  $result[0]->income; }
                            else if($result[0]->platform ==3) {echo  $result[0]->income; }
                            else if($result[0]->platform ==4) {echo  round($result[0]->income/1000000, 2); }
                            else if($result[0]->platform ==5) {echo   round($result[0]->income/100, 2); }
                            else if($result[0]->platform ==6) {echo  $result[0]->income; }
                            else if($result[0]->platform ==7) {echo  $result[0]->income; }
                            else if($result[0]->platform ==8) {echo  $result[0]->income; }
                            else if($result[0]->platform ==9) {echo $result[0]->income; }
                            else if($result[0]->platform ==10) {echo round($result[0]->income/100); }
                            ?></em>
                        <span class="label center db"><?php
                            if($result[0]->platform ==1) {echo  "映票"; }
                            else if($result[0]->platform ==2) {echo  "礼券"; }
                            else if($result[0]->platform ==3) {echo  "花椒币"; }
                            else if($result[0]->platform ==4) {echo  "M 身高"; }
                            else if($result[0]->platform ==5) {echo   "战斗力"; }
                            else if($result[0]->platform ==6) {echo   "星光值"; }
                            else if($result[0]->platform ==7) {echo  "金币"; }
                            else if($result[0]->platform ==8) {echo  "美拍豆"; }
                            else if($result[0]->platform ==9) {echo "星豆"; }
                            else if($result[0]->platform ==10) {echo "KG"; }

                            ?></span>
                    </li>
                    <li class="fl">
                        <em class="db center text-over-hidden" title="<?php echo $result[0]->follower; ?>"><?php echo $result[0]->follower; ?></em>
                        <span class="label center db">粉丝</span>
                    </li>
                </ul>
            </div>
            <!-- 用户信息 end -->

            <!-- 数据分析表 start -->
            <div class="table">
                <ul class="table-head">
                    <li class="fl rel sel">日收入记录</li>
                    <li class="fl rel">日增粉记录</li>
                    <!-- <li class="fl rel">日在线记录</li> -->
                </ul>
                <div class="table-tbody"></div>
            </div>
            <!-- 数据分析表 end -->
        </div>
        <!-- 左边内容块 end -->

        <!-- 右边内容块 start -->
        <div class="anchordet-main-right fr">
            <?php if($liveid){ ?>
            <?php     if(!empty($liveid['cover'])){    ?>
            <!-- 主播有直播图片 start -->
            <a class="user-info img-get-true rel" target="_blank" href="<?php  echo $liveid['url']; ?>">
                <figure class="rel">
                    <img src="<?php  echo $liveid['cover']; ?>" alt="<?php  echo $liveid['title']; ?>">
                    <figcaption class="abs clearfix">
                        <span class="user-name text-over-hidden fl" title="<?php  echo $liveid['title']; ?>"><?php  echo $liveid['title']; ?></span>
                        <span class="user-watchpeople text-over-hidden fr right">去看TA &gt;</span>
                    </figcaption>
                </figure>
                <div class="user-head abs">
                    <p class="center abs">正在直播</p>
                </div>
            </a>
            <!-- 主播有直播图片 end -->
            <?php }else{ ?>
            <!-- 主播有无图片 start -->
            <a class="user-info img-get-false rel" target="_blank" href="<?php  echo $liveid['url']; ?>">
                <figure class="rel">
                    <img class="fl" src="<?php echo HTTP_URL; ?>web/static/images/rest-in.png" alt="<?php echo $result[0]->nickname; ?>">
                    <figcaption class="abs clearfix">
                        <span class="user-name text-over-hidden fl" title="<?php  echo $liveid['title']; ?>"><?php  echo $liveid['title']; ?></span>
                        <span class="user-watchpeople text-over-hidden fr right">去看TA &gt;</span>
                    </figcaption>
                </figure>
                <div class="user-head abs">
                    <p class="center abs">正在直播</p>
                </div>
            </a>
            <!-- 主播无直播图片 end -->
           <?php }}else{ ?>
            <!-- 主播不在线 start -->
            <a class="user-info img-get-false-not rel" href="javascript:;">
                <!-- <figure class="rel"> -->
                    <!-- <img class="fl" src="<?php if($result[0]->avatar ==null){ echo HTTP_URL."images/0.jpg"; } else {if(strpos($result[0]->avatar,"http")===false) echo $result[0]->avatar;else if(strpos($result[0]->avatar,"http")===true && $result[0]->platform ==1 &&$result[0]->platform !=6 )  {echo "http://img.meelive.cn/".$result[0]->avatar; }else if($result[0]->platform==6){  echo "http://s.momocdn.com/w/u/img/2016/04/01/1459499443848-401_S.png";  }  else  echo $result[0]->avatar;} ?>" alt="<?php echo $result[0]->nickname; ?>"> -->
                    <!-- <img class="fl" src="<?php echo HTTP_URL; ?>web/static/images/rest-in.png"> -->
                <!-- </figure> -->
                <!-- <div class="user-head abs"> -->
                    <!-- <p class="center abs">不在直播中</p> -->
                <!-- </div> -->
            </a>
            <?php } ?>
            <!-- 主播不在线 end -->
            <a class="button btn-contact sprite" target="_blank"  href="<?php echo ROOT_URL;  ?>/attention/num/<?php echo $ranknum;  ?>">联系主播</a>
        </div>
        <!-- 右边内容块 end -->
    </div>
</div>
<!-- 内容部分 end -->

    <!--公共底部 start-->
    <footer class="public-footer">
        <div class="ly-1210">
            <div class="ly-left fl clearfix">
                <a class="logo public-footer-sprite db th fl" href="/">底部logo</a>
                <b class="db fl">商务合作</b>
                <ul class="fl">
                    <li class="public-footer-sprite">陈莹</li>
                    <li class="public-footer-sprite">keering</li>
                    <li class="public-footer-sprite">chenying@itoubu.com</li>
                    <li class="public-footer-sprite">湘ICP备16010588号-1</li>
                </ul>
            </div>
            <figure class="ly-right fl clearfix">
                <img class="fl" src="<?php echo HTTP_URL; ?>web/static/images/public-footer-erweima.jpg" alt="扫描关注头部微信公众平台">
                <figcaption class="fl center hidden">扫码关注微信公众平台</figcaption>
            </figure>
            <div class="none-block hide">
                <script language="javascript" type="text/javascript" src="http://js.users.51.la/18934637.js"></script>
                <noscript>< a href=" " target="_blank">< img alt="&#x6211;&#x8981;&#x5566;&#x514D;&#x8D39;&#x7EDF;&#x8BA1;" src="http://img.users.51.la/18934637.asp" style="border:none" /></ a></noscript>
            </div>
        </div>
    </footer>
    <!--公共底部 end-->
<?php } ?>
<script src="<?php echo HTTP_URL; ?>web/static/js/common.bundle.js"></script>
<script src="<?php echo HTTP_URL; ?>web/static/js/anchordet.bundle.js"></script>
</body>
</html>