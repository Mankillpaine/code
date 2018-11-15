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
    <title>头部 - 首页</title>
    <link rel="stylesheet" href="<?php echo HTTP_URL; ?>web/static/css/common.css">
    <link rel="stylesheet" href="<?php echo HTTP_URL; ?>web/static/css/index.css">
</head>
<body>
    <!--公共头部 start-->
    <header class="public-header">
        <nav class="ly-1210 clearfix">
            <h1 class="logo fl"><a class="inlie wh-100" href="/app/toubu"></a></h1>
            <ul class="nav fl">
                <li class="fl db select"><a href="/app/toubu">首页</a></li>
                <li class="fl db"><a href="/app/industryrmb">指数</a></li>
                <li class="fl db"><a href="/app/observe">观察</a></li>
                <li class="fl db"><a href="/app/server">服务</a></li>
            </ul>
            <div class="search fr">
            
                <div class="ly-sel rel fl">
                    <span class="button btn-sel"></span>
                    <span class="ico abs"></span>
                    <ul class="sel-list public-header-sprite clearfix abs"></ul>
                </div>
                <form action="/app/searchStar" method="get" style="margin:0px;" id="headSearch" onSubmit="return doSearch();">
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

    <!--展示部分内容 start-->
    <section class="index-show">
        <div class="ly-1210 rel clearfix">
            <div style="width:50%;">
                <time class="time fl"><?php   $hourse = date("H", time());
                if($hourse>=9) { echo date("Y.m.d",strtotime("-1 day"));}else{ echo date("Y.m.d",strtotime("-2 day"));} ?></time>
                <h2 class="title fl">头部·<span class="color">直播行业指数</span></h2>
                <em class="index fl"><?php if($hyzs) {echo $hyzs[0]->index;} else {echo "0"; } ?></em>
            </div>


            <!--地图 start-->
            <div class="map abs">
                <div class="map-main"></div>
                <div class="map-user abs">
                    <div class="user-default center hide rel">
                        <p>3500000人在线</p>
                        <figure class="inlie hd">
                            <img src="<?php echo HTTP_URL; ?>images/timg.jpg" alt="小官主播">
                        </figure>
                    </div>
                    <a class="user-hover hide hidden" target="_blank" href="#">
                        <figure class="hd fl rel">
                            <img src="<?php echo HTTP_URL; ?>images/timg.jpg" alt="小官主播">
                        </figure>
                        <div class="ly-block fr">
                            <p class="name-platform">
                                <span class="name fl hidden">社会你球姐</span>
                                <span class="color bold">·</span>
                                <span class="platform">映客直播</span>
                            </p>
                            <p class="influence-index">
                                头部指数
                                <span class="color">1200</span>
                            </p>
                            <p class="people-size sprite">
                                直播中
                                <span class="color">2561234人在线</span>
                            </p>
                        </div>
                    </a>
                </div>
            </div>
            <!--地图 end-->

            <!--榜单 start-->
            <div class="listsingle abs clearfix">
                <div class="list-head clearfix">
                    <time class="center fl"><?php $hourse = date("H", time());
                        if($hourse>=9) {  echo date("m月d日",strtotime("-1 day")); }else{echo date("m月d日",strtotime("-2 day")); }?></time>
                    <span class="em center fl">平台指数榜</span>
                    <span class="em center fl">主播活跃榜</span>
                </div>
                <ul class="list-left fl">
                    <?php foreach($platmba as $key =>$value){ ?>
                    <li>
                        <a class="link-wh-100 clearfix" href="/app/terracermb">
                            <b class="fl center ly-mar"><?php echo $key+1;?></b>
                            <img class="fl ly-mar" src="<?php echo HTTP_URL."web/static/images/".$value->id.".png"; ?>" alt="<?php echo $value->name; ?>">
                            <p class="fl ly-mar text-over-hidden" title="<?php echo $value->name; ?>"><?php echo $value->name; ?></p>
                            <strong class="fl ly-mar db text-over-hidden" title="<?php echo $value->index; ?>"><?php echo $value->index; ?></strong>
                        </a>
                    </li>
                    <?php } ?>
                </ul>
                <ul class="list-right fl">
                    <?php foreach($zbmba as $key =>$value){?>
                        <li>

                            <a class="link-wh-100 clearfix" target="_blank" href="/zbdetail?id=<?php  echo $value->platform;  ?>&platformid=<?php echo $value->platformid;  ?>">
                                <b class="fl center ly-mar"><?php echo $key+1;?></b>
                                <img class="fl  ly-mar" src="<?php if($value->avatar ==null){ echo "<?php echo HTTP_URL; ?>images/0.jpg"; } else {if(strpos($value->avatar,".cn")>0) echo $value->avatar;else if(strpos($value->avatar,".cn")==0 && $value->platform ==1 &&$value->platform !=6 )  {echo "http://img.meelive.cn/".$value->avatar; }else if($value->platform==6){  echo "http://s.momocdn.com/w/u/img/2016/04/01/1459499443848-401_S.png";  }  else  echo $value->avatar;} ?>" alt="<?php echo $value->nickname; ?>">
                                <p class="fl ly-mar text-over-hidden" title="<?php echo $value->nickname; ?>"><?php echo $value->nickname; ?></p>
                                <strong class="fl ly-mar db text-over-hidden" title="<?php echo $value->indexnum; ?>"><?php echo $value->indexnum; ?></strong>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
                <div class="list-foot">
                    <a class="em center fl" href="/app/terracermb">完整榜单</a>
                    <a class="em center fl" href="/app/dayhot">完整榜单</a>
                </div>
            </div>
            <!--榜单 end-->

            <!--轮播器 start-->
            <div class="carousel abs">
                <div class="carousel-main hidden rel wh-100">
                    <ul class="img-list abs">
                        <?php foreach ($banner as $key => $value){ ?>
                        <li class="fl">
                            <a class="link-wh-100" href="<?php echo $value['url'] ?>">
                                <img class="link-wh-100" src="<?php echo $value['img'] ?>" alt="直播市场还火爆吗？">
                            </a>
                        </li>
                        <?php } ?>
<!--                         <li class="fl">
                            <a class="link-wh-100" href="#">
                                <img class="link-wh-100" src="<?php echo HTTP_URL; ?>images/timg.jpg" alt="直播市场还火爆吗？">
                            </a>
                        </li>
                        <li class="fl">
                            <a class="link-wh-100" href="#">
                                <img class="link-wh-100" src="<?php echo HTTP_URL; ?>images/timg.jpg" alt="直播市场还火爆吗？">
                            </a>
                        </li> -->
                    </ul>
                    <ul class="arc-list">

                    </ul>
                </div>
            </div>
            <!--轮播器 end-->
        </div>
    </section>
    <!--展示部分内容 end-->

    <!--头部指数 start-->
    <section class="index-tbindex">
        <div class="ly-1210 sprite hd">
            <p class="center">头部直播大数据平台实时跟踪多家主流直播平台的直播动态，对每日数十万场直播进行数据分析与统计，经过科学的算法，生成直播行业指数、平台指数和主播指数，旨在通过数据反映行业动态、发掘直播价值</p>
        </div>
    </section>
    <!--头部指数 end-->

    <!--数据 start-->
    <section class="index-data">
        <div class="ly-1210 clearfix">
            <div class="ly-block fl clearfix">
                <span class="number db fl center hd sprite">10</span>
                <span class="label db fl center sprite">覆盖10大热门平台</span>
            </div>
            <div class="ly-block fl clearfix">
                <span class="number db fl center hd sprite">1000万</span>
                <span class="label db fl center sprite">收录1000万热门主播</span>
            </div>
        </div>
    </section>
    <!--数据 end-->

    <!--文章列表 start-->
    <section class="index-newlist">
        <div class="ly-1210">
            <div class="list-head">
                <b>头部观察</b>
                <a class="button fr" href="/app/observe">更多</a>
            </div>
            <ul class="list-main clearfix">
                <?php   $pattern = "/<img class=.+?src=\"(.*?)\" alt/";

                foreach($results as $key => $value) {    ?>
                <!--循环6次文章列表 start-->
                <li class="fl hidden">
                    <a class="link wh-100 rel" target="_blank" href="/app/articl_detail?id=<?php echo $value->ID;  ?>">
                        <img class="img" src="http://www.itoubu.com/wp/wp-content/themes/ui-2/timthumb.php?src=<?php if(isset($thumb[$value->ID][0])){echo $thumb[$value->ID][0];}else{echo HTTP_URL."web/static/images/newslist.png"; }  ?>&h=280&w=580&zc=1" alt="<?php echo $value->post_title;  ?>">
                        <div class="fl-div abs">
                            <h3 class="text-over-hidden" title="<?php echo $value->post_title;  ?>"><?php echo $value->post_title;  ?></h3>
                            <span class="author db fl">编辑:<?php echo $value->display_name;  ?></span>
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
                        </div>
                    </a>
                </li>
                <?php  } ?>
                <!--循环6次文章列表 end-->
            </ul>
        </div>
    </section>
    <!--文章列表 end-->

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
    <script src="<?php echo HTTP_URL; ?>web/static/js/index.bundle.js"></script>
</body>
</html>