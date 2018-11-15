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
    <title>头部 - 搜索</title>
    <link rel="stylesheet" href="<?php echo HTTP_URL; ?>web/static/css/common.css">
    <link rel="stylesheet" href="<?php echo HTTP_URL; ?>web/static/css/consultsearch.css">
    <style type="text/css">
        .observe-main-right .new-list .list-main a {
            margin: 10px 12px;
            padding: 0 12px;
            font-size: 16px;
            line-height: 28px;
        }
        .observe-main-right .new-list .list-main a:before {
            width: 4px;
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
                <li class="fl db"><a href="/industryrmb">指数</a></li>
                <li class="fl db select"><a href="/observe">观察</a></li>
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

    <!-- 搜索框 start -->
    <section class="consultsearch-search">
        <div class="ly-1210">
        	<form action="?" method="get" id="artSearch">
            <input class="fl" type="text"  id="keyword" name="keyword"  placeholder="请输入需要搜索的内容" value="<?php echo $keyword; ?>">
            </form>
            <span class="button fl btn-search " onClick="document.getElementById('artSearch').submit();">搜索</span>
        </div>
    </section>
    <!-- 搜索框 end -->

    <!-- 主题内容 start -->
    <section class="consultsearch-main">
        <div class="ly-1210 clearfix">
            <!--左边内容 start-->
            <div class="observe-main-left fl">
                <!-- 搜索结果提示 start -->
                <!-- ps：如果没有搜索到结果添加class：hide  -->
                <div class="search-result">您搜索的关键字 <span class="ly-color">"<?php echo $keyword; ?>" </span>共 <span class="ly-color"><?php echo count($count); ?></span> 条搜索结果</div>
                <!-- 搜索结果提示 end -->

                <!--搜索列表内容 start-->
                <!-- ps：如果没有搜索到结果添加class：hide  -->
                <ul class="list-main new-main clearfix">

                    <?php  foreach ($results as $key =>$value){ ?>
                    <li class="fl">
                        <a class="link wh-100 " target="_blank" href="/articl_detail?id=<?php echo $value->ID;  ?>">
                            <img class="img fl" src="<?php if(isset($thumb[$value->ID][0])){  echo "http://www.itoubu.com/wp/wp-content/themes/ui-2/timthumb.php?src=".$thumb[$value->ID][0]."&h=142&w=240&zc=1";}else{ echo HTTP_URL."web/static/images/newslist.png";}   ?>"" alt="<?php echo $value->post_title;  ?>">
                            <div class="title fl text-over-hidden"><?php  echo $value->post_title; ?></div>
                            <div class="content hd fl"><?php echo mb_substr($value->post_content,0,1000,'utf-8'); ?></div>
                            <span class="author fl">作者：<?php echo $value->display_name;  ?></span>
                            <time class="fr right"> <?php
                                $enddate=strtotime(date("Y-m-d h:i:s"));
                                $startdate =strtotime($value->post_modified);
                                $timeout = $enddate-$startdate;
                                if($timeout>3600)
                                {
                                    echo date('Y-m-d', strtotime($results[0]->post_modified));
                                } else{
                                    $hourout = $timeout/3600;
                                    $minuetsout = $timeout/100;
                                    if($hourout){
                                        echo ceil(abs($hourout)) . "小时前发表";
                                    }else {
                                        echo ceil(abs($minuetsout)) ."分钟发表";
                                    }
                                }
                                ?>
                            </time>
                        </a>
                    </li>    
                    <?php } ?>
                </ul>
                <!--搜索列表内容 end-->

                <!--加载更多 start-->
                <?php if(count($count)>10){ ?>
                <!-- ps：如果条数大于10条则移除class：hide  -->
                <div class="button-wk center">
                    <span class="button inlie btn-more">加载更多...</span>
                </div>
                <?php } ?>
                <!--加载更多 end-->

                <?php if(!count($count)){ ?>
                <!-- 未搜索到结果 start -->
                <!-- ps：如果没有搜索到结果移除lass：hide  -->
                <div class="notsearch">
                    <p class="fl center">抱歉，未能找到相关资讯</p>
                </div>
                <!-- 未搜索到结果 end -->
                <?php } ?>
            </div>
            <!--左边内容 end-->

            <!--右边内容 start-->
            <div class="observe-main-right fr">
                <!--热门榜单 start-->
                <div class="new-list ly-border fl clearfix">
                    <div class="list-head">
                        <b class="fl center sel">本周热门</b>
                        <b class="fl center">本月热门</b>
                    </div>
                    <!--周榜单 start-->
                    <ul class="list-main list-week">
                        <?php foreach ($weekhot as $key =>$value){ ?>
                        <li>
                            <a class="db rel" target="_blank" href="/articl_detail?id=<?php echo $value->ID;  ?>"><?php  echo $value->post_title; ?></a>
                        </li>
                        <?php } ?>
                    </ul>
                    <!--周榜单 end-->

                    <!--月榜单 start-->
                    <ul class="list-main list-month hide">
                        <?php foreach ($month as $key =>$value){ ?>
                            <li>
                                <a class="db rel" target="_blank" href="/articl_detail?id=<?php echo $value->ID;  ?>"><?php  echo $value->post_title; ?></a>
                            </li>
                        <?php } ?>
                    </ul>
                    <!--月榜单 end-->
                </div>
                <!--热门榜单 end-->

                <!--关于头部 start-->
                <div class="about ly-border fl clearfix">
                    <div class="about-head fl center">关于头部</div>
                    <dl class="fl">
                        <dt>关于头部：</dt>
                        <dd>头部大数据平台覆盖多家热门直播平台，每日监控上千万主播直播动态，经过科学算法，生成指数榜单。关注公众号，同步查看榜单与资讯。</dd>
                    </dl>
                    <figure class="fl">
                        <img src="<?php echo HTTP_URL; ?>web/static/images/consultsearch-erweima.png" alt="扫描二维码">
                        <figcaption class="center">扫一扫关注“头部”公众号</figcaption>
                    </figure>
                </div>
                <!--关于头部 end-->
            </div>
            <!--右边内容 end-->
        </div>
    </section>
    <!-- 主题内容 end -->

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
<script src="<?php echo HTTP_URL; ?>web/static/js/consultsearch.bundle.js"></script>
</body>
</html>