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
    <title>头部 - 文章详情</title>
    <link rel="stylesheet" href="<?php echo HTTP_URL; ?>web/static/css/common.css">
    <link rel="stylesheet" href="<?php echo HTTP_URL; ?>web/static/css/observedet.css">
    <style type="text/css">
        p span{
            line-height: 26px;

        }
        p{
            padding: 10px 0;
            text-indent: 2em;
        }
        span img{
            margin: 0 auto;
        }
        .observe-main-left .text-head h2 {
            width: 100%;
            height: 33px;
            /* margin-top: 34px; */
            margin-bottom: 10px;
            font-size: 20px;
            line-height: 33px;
        }
        .list-main a {
            margin: 10px 12px !important;
            padding: 0 12px !important;
            font-size: 14px !important;
            line-height: 28px !important;

        }

        .observe-main-right .new-list .list-main a {
            margin: 10px 12px !important;
            padding: 0 12px !important;
            font-size: 16px !important;
            line-height: 28px !important;
        }
        .observe-main-right .text-list .list-main a:before {
            content: '';
            display: block;
            position: absolute;
            top: 6px;
            left: 0;
            width: 4px;
            height: 16px;
            background: #38bcff;
        }
        .observe-main-right .text-list .list-head {
            width: 160px;
            height: 26px;
            margin-left: 75px;
            margin-bottom: 14px;
            color: #fff;
            font-size: 16px;
            line-height: 22px;
            background: #38bcff;
        }
        .observe-main-right .ly-border {
            position: relative;
            border-top: 4px solid #38bcff;
        }
        .observe-main-right .about .about-head {
            width: 160px;
            height: 26px;
            margin-left: 75px;
            margin-bottom: 5px;
            color: #fff;
            font-size: 16px;
            line-height: 22px;
            background: #38bcff;
        }



        .observe-main-right .new-list .list-main a:before {
            width: 4px !important;
        }
    </style>
</head>
<body>
    <!--公共头部 start-->
    <header class="public-header">
        <nav class="ly-1210 clearfix">
            <h1 class="logo fl"><a class="inlie wh-100" href="/"></a></h1>
            <ul class="nav fl">
                <li class="fl db"><a href="/">首页</a></li>
                <li class="fl db "><a href="/industryrmb">指数</a></li>
                <li class="fl db  select"><a href="/observe">观察</a></li>
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

    <!--内容部分 start-->
    <div class="observe-main">
        <div class="ly-1210 clearfix">
            <!--左边内容 start-->
            <section class="observe-main-left fl">
                <!--文章头部 start-->
                <div class="text-head clearfix">
                    <h2 class="fl"><?php echo $results[0]->post_title;  ?></h2>
                    <span class="author fl hidden">编辑:<?php echo $results[0]->display_name;  ?></span>
                    <time class="fl"><?php echo date('m.d H:i', strtotime($results[0]->post_modified)); ?></time>

                </div>
                <!--文章头部 end-->

                <!-- 文章内容 start -->
                <div class="text-content"><?php  echo $results[0]->post_content;?></div>
                <!-- 文章内容 end -->
            </section>
            <!--左边内容 end-->

            <!--右边内容 start-->
            <section class="observe-main-right fr clearfix">
                <!--文章榜单 start-->
                <div class="text-list ly-border fl clearfix">
                    <div class="list-head fl center">相关文章</div>
                    <!--文章列表 start-->
                    <ul class="list-main fl list-week">
                        <?php foreach ($relation as $key =>$value){ ?>
                        <li>
                            <a class="db rel" href="/articl_detail?id=<?php echo $value->ID;  ?>"><?php  echo $value->post_title; ?></a>
                        </li>
                        <?php } ?>

                    </ul>
                    <!--文章列表 end-->
                </div>
                <!--文章榜单 end-->

                <!--关于头部 start-->
                <div class="about ly-border fl clearfix">
                    <div class="about-head fl center">关于头部</div>
                    <dl class="fl">
<!--                        <dt>关于头部：</dt>-->
                        <dd>头部大数据平台覆盖多家热门直播平台，每日监控上千万主播直播动态，经过科学算法，生成指数榜单。关注公众号，同步查看榜单与资讯。</dd>
                    </dl>
                    <figure class="fl">
                        <img src="<?php echo HTTP_URL; ?>web/static/images/observedet-erweima.png" alt="扫描二维码">
                        <figcaption class="center">扫一扫关注“头部”公众号</figcaption>
                    </figure>
                </div>
                <!--关于头部 end-->
            </section>
            <!--右边内容 end-->
        </div>
    </div>
    <!--内容部分 end-->

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
<script src="<?php echo HTTP_URL; ?>web/static/js/observedet.bundle.js"></script>
</body>
</html>