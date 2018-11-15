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
    <title>头部 - 观察</title>
    <link rel="stylesheet" href="<?php echo HTTP_URL; ?>web/static/css/common.css">
    <link rel="stylesheet" href="<?php echo HTTP_URL; ?>web/static/css/observe.css">
    <style type="text/css">


        .list-week a {
            margin: 10px 12px !important;
            padding: 0 12px !important;
            font-size: 14px !important;
            /*line-height: 28px !important;*/

        }
        .observe-main-left .list-head h2 {
            height: 55px;
            color: #38bcff;
            font-size: 24px;
            line-height: 55px;
        }
        .observe-main-left .list-head li.sel {
            color: #38bcff;
        }
        .observe-main-right .text-list .list-main a:before {

            background: #38bcff;
        }
        .observe-main-right .text-list .list-head {

            background: #38bcff;
        }
        .observe-main-right .ly-border {
            position: relative;
            border-top: 4px solid #38bcff;
        }
        .observe-main-right .about .about-head {

            background: #38bcff;
        }
        .observe-main-right .new-list .list-head {

            background: #38bcff;
        }
        .observe-main-right .must .must-head {

            background: #38bcff;
        }
        .observe-main-right .new-list .list-main a:before {
            content: '';
            display: block;
            position: absolute;
            top: 6px;
            left: 0;
            width: 1px;
            height: 16px;
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
                <li class="fl db"><a href="/industryrmb">指数</a></li>
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
                <!--轮播器 start-->
                <div class="carousel fl">
                    <div class="carousel-main hidden rel wh-100">
                        <ul class="img-list abs">
                            <?php   foreach ($banner as $key =>$value){  ?>
                            <li class="fl rel">
                                <a class="link-wh-100" href="<?php echo $value['url']; ?>">
                                    <img class="link-wh-100" src="<?php echo "http://www.itoubu.com/wp/wp-content/themes/ui-2/timthumb.php?src=".$value['img']."&h=384&w=800&zc=1"; ?>" alt="">
                                    <p class="title abs">
                                        <span class="db text-over-hidden"><?php echo $value['title']; ?></span>
                                    </p>
                                </a>
                            </li>
                            <?php } ?>
                        </ul>
                        <ul class="arc-list abs center"></ul>
                    </div>
                </div>
                <!--轮播器 end-->

                <!--列表标题 start-->
                <div class="list-head clearfix">
                    <h2 class="fl">头部观察</h2>
                    <ul class="clearfix">
                        <li class="fl rel center sel">最新资讯</li>
                        <li class="fl rel center">红咖</li>
                        <li class="fl rel center">行业资讯</li>
                    </ul>
                </div>
                <!--列表标题 end-->

                <!--最新资讯内容 start-->
                <ul class="list-main new-main">
                    <!-- 新闻列表循环10次 start-->
                    <?php  foreach ($results as $key =>$value){ ?>
                    <li class="fl">
                        <a class="link wh-100 " target="_blank" href="/articl_detail?id=<?php echo $value->ID;  ?>">
                            <img class="img fl" src="<?php if(isset($thumb[$value->ID][0])){  echo "http://www.itoubu.com/wp/wp-content/themes/ui-2/timthumb.php?src=".$thumb[$value->ID][0]."&h=142&w=240&zc=1";}else{echo HTTP_URL."web/static/images/newslist.png";} ?>" alt="<?php echo $value->post_title;  ?>">
                            <div class="title fl text-over-hidden"><?php  echo $value->post_title; ?></div>
                            <div class="content hd fl"><?php  echo mb_substr($value->post_content,0,80,'utf-8'); ?></div>
                            <span class="author fl">编辑:<?php echo $value->display_name;  ?></span>
                            <time class="fr right">
                            <?php
                            $enddate=strtotime(date("Y-m-d h:i:s"));
                            $startdate =strtotime($value->post_modified);
                            $timeout = $enddate-$startdate;
                            if($timeout>3600)
                            {
                                echo date('Y-m-d', strtotime($value->post_modified));
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
                    <!-- 新闻列表循环10次 end-->
                </ul>
                <!--最新列表内容 end-->

                <!--主播列表内容 start-->
                <ul class="list-main anchor-main hide">
                    <!-- 新闻列表循环10次 start-->
                    <?php  foreach ($whyjy as $key =>$value){ ?>
                    <li class="fl">
                        <a class="link wh-100 " target="_blank" href="/articl_detail?id=<?php echo $value->ID;  ?>">
                            <img class="img fl" src="<?php if(isset($thumb[$value->ID][0])){  echo "http://www.itoubu.com/wp/wp-content/themes/ui-2/timthumb.php?src=".$thumb[$value->ID][0]."&h=142&w=240&zc=1";}else{echo HTTP_URL."web/static/images/newslist.png";} ?>" alt="<?php echo $value->post_title;  ?>">
                            <div class="title fl text-over-hidden"><?php  echo $value->post_title; ?></div>
                            <div class="content hd fl"><?php  echo mb_substr($value->post_content,0,80,'utf-8'); ?></div>
                            <span class="author fl">作者:<?php echo $value->display_name;  ?></span>
                            <time class="fr right">
                                <?php
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
                    <!-- 新闻列表循环10次 end-->
                </ul>
                <!--主播列表内容 end-->

                <!--平台列表内容 start-->
                <ul class="list-main terrace-main hide">
                    <!-- 新闻列表循环10次 start-->
                    <?php  foreach ($news as $key =>$value){ ?>
                        <li class="fl">
                            <a class="link wh-100 " target="_blank" href="/articl_detail?id=<?php echo $value->ID;  ?>">
                                <img class="img fl" src="<?php if(isset($thumb[$value->ID][0])){  echo "http://www.itoubu.com/wp/wp-content/themes/ui-2/timthumb.php?src=".$thumb[$value->ID][0]."&h=142&w=240&zc=1";}else{echo HTTP_URL."web/static/images/newslist.png";} ?>" alt="<?php echo $value->post_title;  ?>">
                                <div class="title fl text-over-hidden"><?php  echo $value->post_title; ?></div>
                                <div class="content hd fl"><?php  echo mb_substr($value->post_content,0,80,'utf-8'); ?></div>
                                <span class="author fl">作者:<?php echo $value->display_name;  ?></span>
                                <time class="fr right">
                                <?php
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
                                ?></time>
                            </a>
                        </li> 
                    <?php } ?>
                    <!-- 新闻列表循环10次 end-->
                </ul>
                <!--平台列表内容 end-->

                <!--加载更多 start-->
                <div class="button-wk center">
                    <span class="button inlie btn-more">加载更多...</span>
                </div>
                <!--加载更多 end-->
            </section>
            <!--左边内容 end-->

            <!--右边内容 start-->
            <section class="observe-main-right fr clearfix">
                <!--热门榜单 start-->
                <div class="new-list ly-border fl clearfix">
                    <div class="list-head">
                        <b class="fl center sel">本周热门</b>
                        <b class="fl center">本月热门</b>
                    </div>
                    <!--周榜单 start-->
                    <ul class="list-main list-week">
                        <?php  foreach ($weekhot as $key =>$value){ ?>
                        <li>
                            <a class="db rel" target="_blank" href="/articl_detail?id=<?php echo $value->ID;  ?>"><?php echo $value->post_title;  ?></a>
                        </li>
                        <?php } ?>
                    </ul>
                    <!--周榜单 end-->

                    <!--月榜单 start-->
                    <ul class="list-main list-month hide">
                        <?php  foreach ($monthhot as $key =>$value){ ?>
                            <li>
                                <a class="db rel" target="_blank" href="/articl_detail?id=<?php echo $value->ID;  ?>"><?php echo $value->post_title;  ?></a>
                            </li>
                        <?php } ?>
                    </ul>
                    <!--月榜单 end-->
                </div>
                <!--热门榜单 end-->

                <!--投稿需知 start-->
                <div class="must ly-border fl clearfix">
                    <div class="must-head fl center">投稿须知</div>
                    <dl class="fl">
                        <dt>关于投稿：</dt>
                        <dd>请点击我要投稿按钮跳转到官方邮箱进行投稿，投稿成功后将进入短暂的审核期，由于后台量巨大，请勿着急。</dd>
                    </dl>
                    <dl class="fl">
                        <dt>关于文章：</dt>
                        <dd>只要和主播、直播相关的文章，不管是专业的干货、逗趣的吐槽还是犀利的观点，我们都诚挚的欢迎。不排斥一稿多投，但更欢迎独家首发稿件。</dd>
                    </dl>
                </div>
                <!--投稿需知 end-->
                <span class="button btn-deliver fl"><a href="mailto:zhuyong@itoubu.com">立即投稿</a></span>
                <!-- <span class="button btn-deliver fl"><a href="mailto:zhuyong@itoubu.com">立即投稿</a></span> -->
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
<script src="<?php echo HTTP_URL; ?>web/static/js/observe.bundle.js"></script>
</body>
</html>