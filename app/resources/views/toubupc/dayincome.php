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
    <title>头部 - 单日主播收入榜</title>
    <link rel="stylesheet" href="<?php echo HTTP_URL; ?>web/static/css/common.css">
    <link rel="stylesheet" href="<?php echo HTTP_URL; ?>web/static/css/onedayanchorincome.css">
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
    
    <!-- 内容部分 start -->
    <div class="anchorcomindex-main">
        <div class="ly-1210 clearfix">
            <!-- 左边导航块 start -->
            <nav class="anchorcomindex-main-left fl">
                <div class="industry-title big-title center">行业指数</div>
                <ul class="industry-list">
                    <li class="list-item center rel">
                        <a class="link-wh-100" href="/industryrmb">直播行业指数</a>
                    </li>
                    <li class="list-item center rel">
                        <a class="link-wh-100" href="/terracermb">平台活跃指数</a>
                    </li>
                </ul>
                <div class="anchor-title big-title center">主播指数</div>
                <ul class="anchor-list">
                    <li class="list-item center  rel">
                        <a class="link-wh-100" href="/rmball">娱乐主播综合指数</a>
                    </li>
                    <li class="list-item center rel">
                        <a class="link-wh-100" href="/dayhot">娱乐主播活跃指数</a>
                    </li>
                    <li class="list-item center sel rel">
                        <a class="link-wh-100" href="/allincome">单日主播收入榜</a>
                    </li>
                    <li class="list-item center rel">
                        <a class="link-wh-100" href="/dayfans">单日主播粉丝榜</a>
                    </li>
                </ul>
            </nav>
            <!-- 左边导航块 end -->

            <!-- 右边内容块 start -->
            <div class="anchorcomindex-main-right fr">
                <div class="table">
                    <div class="table-head clearfix rel">
                        <h2 class="fl" style="font-size:20px;height:auto;line-height:28px; margin-bottom:0px;">单日主播收入榜 TOP100</h2>
                        <time class="fl" style="margin-bottom:10px;"><?php $hourse = date("H", time());
                            if($hourse>=9) {   echo date("Y-m-d", strtotime("-1 day")); }else{  echo date("Y-m-d", strtotime("-2 day")); } ?></time>
                        <!-- 平台导航 start -->
                        <ul class="list-nav fl hidden">
                            <li class="list-item fl"><a class="link-wh-100 <?php  if(!isset($_GET['plat'])) { echo 'sel'; }   ?> " href="/allincome">全平台</a></li>
                            <?php foreach ($plat as $key => $value){   ?>
                                <li class="list-item fl"><a class="link-wh-100 <?php  if(isset($_GET['plat'])) {  if($_GET['plat'] ==$value->id){ echo 'sel'; }  } ?>" href="/allincome?plat=<?php echo $value->id;    ?>" ><?php  echo $value->name;  ?></a></li>
                            <?php  } ?>
                        </ul>
                        <!-- 平台导航 end -->
                        <span class="button btn-other hide fr">
                            其他
                            <span class="ico ico-triangle"></span>
                        </span>
                        <div class="search clearfix abs" style="width:250px;">
                            <form action="/searchStar" method="get" style="margin:0px;" id="indexSearch">
                            	<input class="fl" type="text" name="keyword" placeholder="请输入主播ID、昵称进行搜索" style="width:200px;">
                            </form>
                            <span class="button btn-search sprite fl" onClick="document.getElementById('indexSearch').submit();">
                                <span class="ico ico-search"></span>
                            </span>
                        </div>
                    </div>
                    <div class="table-thead">
                        <div class="table-tr clearfix">
                            <div class="table-th fl">排行<span class="ico sprite rel">
                                <div class="ly-alert hide abs">
                                    <p>“单日主播收入榜”是根据主播单日收入增长值来排名。</p>
                                </div>
                                <div class="decorate hide sprite abs"></div>
                            </span></div>
                            <div class="table-th fl">账号</div>
                            <div class="table-th fl">平台</div>
                            <div class="table-th fl">收入</div>
                            <div class="table-th fl">折合人民币</div>
                            <div class="table-th fl">更多</div>
                        </div>
                    </div>
                    <div class="table-tbody">
                        <!-- 循环表格 start -->
                        <?php  foreach ($result as $key => $value){ ?>

                        <a class="table-tr db hidden clearfix" href="/zbdetail?id=<?php  echo $value->platform;  ?>&platformid=<?php echo $value->platformid;  ?>">
                            <div class="table-td fl">
                                <span class="user-sort db"><?php echo $key+1; ?></span>
                            </div>
                            <div class="table-td fl">
                                <figure class="clearfix">
                                    <img class="fl" src="<?php if($value->avatar ==null){ echo HTTP_URL."images/0.jpg"; } else {if(strpos($value->avatar,"http")===true) echo $value->avatar;else if(strpos($value->avatar,"http")===false && $value->platform ==1 &&$value->platform !=6 )  {echo "http://img.meelive.cn/".$value->avatar; }else if($value->platform==6){  echo "http://s.momocdn.com/w/u/img/2016/04/01/1459499443848-401_S.png";  }  else  echo $value->avatar;} ?>" alt="<?php echo $value->nickname; ?>">
                                    <figcaption class="fl">
                                        <span class="user-name hidden fl"><?php echo $value->nickname; ?></span>
                                        <span class="user-id hidden fl">ID:<?php echo $value->platformid; ?></span>
                                    </figcaption>
                                </figure>
                            </div>
                            <div class="table-td fl">
                                <span class="user-terrace db"><?php
                                    if($value->platform ==1) {echo "映客"; }
                                    else if($value->platform ==2) {echo "抱抱"; }
                                    else if($value->platform ==3) {echo "花椒直播"; }
                                    else if($value->platform ==4) {echo "熊猫TV"; }
                                    else if($value->platform ==5) {echo "全民TV"; }
                                    else if($value->platform ==6) {echo "陌陌直播"; }
                                    else if($value->platform ==7) {echo "一直播"; }
                                    else if($value->platform ==8) {echo "美拍"; }
                                    else if($value->platform ==9) {echo "来疯直播"; }
                                    else if($value->platform ==10) {echo "斗鱼TV"; }
                                    ?></span>
                            </div>
                            <div class="table-td fl">
                                <span class="user-income hidden center fl">+
                                    <?php
                                    if($value->platform ==1) {echo  $value->increase."映票"; }
                                    else if($value->platform ==2) {echo  $value->increase."礼券"; }
                                    else if($value->platform ==3) {echo  $value->increase."花椒币"; }
                                    else if($value->platform ==4) {echo  round($value->increase/1000000, 2). "M 身高"; }
                                    else if($value->platform ==5) {echo   round($value->increase/100, 2)."战斗力"; }
                                    else if($value->platform ==6) {echo  $value->increase. "星光值"; }
                                    else if($value->platform ==7) {echo  $value->increase."金币"; }
                                    else if($value->platform ==8) {echo  $value->increase. "美拍豆"; }
                                    else if($value->platform ==9) {echo $value->increase."星豆"; }
                                    else if($value->platform ==10) {echo round($value->increase/100)."KG"; }


                                    ?>
                                </span>
                                <span class="user-total hidden center fl" style="font-size:14px;"><?php
                                    if($value->platform ==1) {echo  $value->income."映票"; }
                                    else if($value->platform ==2) {echo  $value->income."礼券"; }
                                    else if($value->platform ==3) {echo  $value->income."花椒币"; }
                                    else if($value->platform ==4) {echo  round($value->income/1000000, 2). "M 身高"; }
                                    else if($value->platform ==5) {echo   round($value->income/100, 2)."战斗力"; }
                                    else if($value->platform ==6) {echo  $value->income. "星光值"; }
                                    else if($value->platform ==7) {echo  $value->income."金币"; }
                                    else if($value->platform ==8) {echo  $value->income. "美拍豆"; }
                                    else if($value->platform ==9) {echo $value->income."星豆"; }
                                    else if($value->platform ==10) {echo round($value->income/100)."KG"; }

                                    ?></span>
                            </div>
                            <div class="table-td fl">
                                <span class="user-income hidden center fl">+<?php echo $value->increase_rmb; ?></span>
                                <span class="user-total hidden center fl" style="font-size:14px;">总:<?php echo $value->rmb; ?></span>
                            </div>
                            <div class="table-td fl">
                                <span class="button btn-more fl">主播详情</span>
                            </div>
                        </a>
                        <?php } ?>

                        <!-- 循环表格 end -->
                    </div>
                </div>
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

<script src="<?php echo HTTP_URL; ?>web/static/js/common.bundle.js"></script>
<script src="<?php echo HTTP_URL; ?>web/static/js/onedayanchorincome.bundle.js"></script>
</body>
</html>