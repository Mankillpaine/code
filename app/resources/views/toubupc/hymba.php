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
    <title>头部 - 直播行业指数</title>
    <link rel="stylesheet" href="<?php echo HTTP_URL; ?>web/static/css/common.css">
    <link rel="stylesheet" href="<?php echo HTTP_URL; ?>web/static/css/industryindex.css">
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
                    <li class="list-item center sel rel">
                        <a class="link-wh-100" href="/industryrmb">直播行业指数</a>
                    </li>
                    <li class="list-item center rel">
                        <a class="link-wh-100" href="/terracermb">平台活跃指数</a>
                    </li>
                </ul>
                <div class="anchor-title big-title center">主播指数</div>
                <ul class="anchor-list">
                    <li class="list-item center rel">
                        <a class="link-wh-100" href="/rmball">娱乐主播综合指数</a>
                    </li>
                    <li class="list-item center rel">
                        <a class="link-wh-100" href="/dayhot">娱乐主播活跃指数</a>
                    </li>
                    <li class="list-item center rel">
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
                <!-- 图表 start -->
                <div class="table">
                    <div class="table-head clearfix">
                        <h2 class="fl">直播行业指数</h2>
                        <!-- 时间选择控件 start -->
                        <div class="ly-time fr">
                            <div class="start-time fl">
                                <p class="time-content center wh-100">2016-10-25</p>
                            </div>
                            <span class="label fl">至</span>
                            <div class="end-time fl">
                                <p class="time-content center wh-100">2016-10-25</p>
                            </div>
                            <span class="button btn-search sprite fl"></span>
                        </div>
                        <!-- 时间选择控件 end -->
                    </div>
                    <div class="table-tbody"></div>
                </div>
                <!-- 图表 end -->

                <!-- 说明 start -->
                <div class="table-label">
                    <p>“直播行业指数”是头部网基于覆盖多家主流直播平台的独家客观数据，每日发布[直播行业指数]及[直播平台活跃指数]。数据算法涵盖在线主播人数、直播观看量、直播间互动及礼物赠送量、直播平台网络关注度、直播平台活跃用户量等维度，通过科学的加权计算生成指数。</p>
                </div>
                <!-- 说明 end -->
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
<script src="<?php echo HTTP_URL; ?>web/static/js/industryindex.bundle.js"></script>
</body>
</html>