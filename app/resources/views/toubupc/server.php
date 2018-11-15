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
    <title>头部 - 服务</title>
    <link rel="stylesheet" href="<?php echo HTTP_URL; ?>web/static/css/common.css">
    <link rel="stylesheet" href="<?php echo HTTP_URL; ?>web/static/css/serv.css">
</head>
<body>
    <!--公共头部 start-->
    <header class="public-header">
        <nav class="ly-1210 clearfix">
            <h1 class="logo fl"><a class="inlie wh-100" href="/"></a></h1>
            <ul class="nav fl">
                <li class="fl db"><a href="/">首页</a></li>
                <li class="fl db"><a href="/industryrmb">指数</a></li>
                <li class="fl db"><a href="/observe">观察</a></li>
                <li class="fl db select"><a href="/server">服务</a></li>
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

    <!--页面主体 start-->
    <section class="index-main">
        <div class="ly-1210 rel">
            <div class="ly-left fl clearfix">
                <div class="list list1 clearfix fl">
                    <em class="center db fl">直播伴侣</em>
                    <p class="fl">实时统计直播间在线人数、粉丝增长、金币增长、打赏记录等，让主播轻松掌控直播效果。</p>
                </div>
                <div class="list list2 clearfix fl">
                    <em class="center db fl">收入统计</em>
                    <p class="fl">自动记录每日打赏收入历史，帮助主播分析收入变动情况。</p>
                </div>
                <div class="list list3 clearfix fl">
                    <em class="center db fl">粉丝统计</em>
                    <p class="fl">自动记录每日粉丝增长历史，帮助主播了解粉丝爆增时段。</p>
                </div>
                <figure class="fl">
                    <img src="<?php echo HTTP_URL; ?>web/static/images/serv-erweima.png" alt="关注公众号“头部”立即体验主播小秘书">
                    <figcaption class="center">关注公众号“头部”立即体验主播小秘书</figcaption>
                </figure>
            </div>
            <div class="ly-right fl rel">
                <!--轮播器 start-->
                <div class="carousel abs">
                    <div class="carousel-main hidden rel wh-100">
                        <ul class="img-list abs">
                            <li class="fl">
                                <a class="link-wh-100" href="#">
                                    <img class="link-wh-100" src="<?php echo HTTP_URL; ?>web/static/images/serv-carousel-01.jpg" alt="直播市场还火爆吗？1">
                                </a>
                            </li>
                            <li class="fl">
                                <a class="link-wh-100" href="#">
                                    <img class="link-wh-100" src="<?php echo HTTP_URL; ?>web/static/images/serv-carousel-02.jpg" alt="直播市场还火爆吗？2">
                                </a>
                            </li>
                            <li class="fl">
                                <a class="link-wh-100" href="#">
                                    <img class="link-wh-100" src="<?php echo HTTP_URL; ?>web/static/images/serv-carousel-03.jpg" alt="直播市场还火爆吗？3">
                                </a>
                            </li>
                        </ul>
                        <ul class="arc-list abs center"></ul>
                    </div>
                </div>
                <!--轮播器 end-->
            </div>
        </div>
    </section>
    <!--页面主体 end-->

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
    <script src="<?php echo HTTP_URL; ?>web/static/js/serv.bundle.js"></script>
</body>
</html>