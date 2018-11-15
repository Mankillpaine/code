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
    <link rel="stylesheet" href="<?php echo HTTP_URL; ?>web/static/css/search.css">
    <style type="text/css">
        .search-content .table-th:nth-child(8), .search-content .table-td:nth-child(8) {
            width: 116px;
        }
        .search-content .table-th:nth-child(3), .search-content .table-td:nth-child(3) {
            width: 278px;
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
                <li class="fl db select"><a href="/industryrmb">指数</a></li>
                <li class="fl db"><a href="/observe">观察</a></li>
                <li class="fl db"><a href="/server">服务</a></li>
            </ul>
            <div class="search fr">
            <form action="/searchStar" method="get" style="margin:0px;" id="headSearch">
                <div class="ly-sel rel fl">
                    <span class="button btn-sel"></span>
                    <span class="ico abs"></span>
                    <ul class="sel-list public-header-sprite clearfix abs"></ul>
                </div>
                <input class="fl" type="text" id="keyword" name="keyword" placeholder="">
                <input type="hidden" id="searchType" value="1" >
                <span class="button btn-search public-header-sprite fr" onClick="doSearch();"></span>
            </form>
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
		}
	</script>
    <!--公共头部 end-->

<!-- 搜索框 start -->
<section class="search-search">
    <div class="ly-1210">
        <form action="?" method="get" id="userSearch">
            <input class="fl" type="text" name="keyword" placeholder="输入昵称或ID搜索主播" value="<?=$args["keyword"]?>">
            <span class="button fl btn-search" onclick="document.getElementById('userSearch').submit();">搜索</span>

        </form>
    </div>
</section>
<!-- 搜索框 end -->

<!-- 筛选 start -->
<section class="search-screen">
    <div class="ly-1210">
        <ul class="screen">

            <li class="list-row clearfix">
                <em class="fl">平台:</em>
                <ul class="sel-list fl clearfix hidden">

                    <li class="list-item fl"><a class="link-wh-100 <?php if($args["platform"] ==""){ echo 'sel'; } ?>"  href="?platform=&income=<?=$args['income']?>&gender=<?=$args['gender']?>&city=<?=$args["city"]?>&follower=<?=$args['follower']?>&orderby=<?=$args['orderby']?>&keyword=<?=$args['keyword']?>">不限</a></li>

                    <?php foreach ($platform as $key => $value){   ?>
                        <li class="list-item fl"><a class="link-wh-100 <?php if($args['platform'] ==$value->id){ echo 'sel'; } ?>" href="?platform=<?=$value->id?>&income=<?=$args['income']?>&gender=<?=$args['gender']?>&city=<?=$args["city"]?>&follower=<?=$args['follower']?>&orderby=<?=$args['orderby']?>&keyword=<?=$args['keyword']?>" ><?=$value->name?></a></li>
                    <?php  } ?>

                </ul>
                    <span class="button btn-other hide fr">
                        其它
                        <span class="ico ico-triangle"></span>
                    </span>
            </li>

            <?
            $income_args = array();
            $income_args["0-1"]="1万以下";
            $income_args["1-5"]="1万-5万";
            $income_args["5-10"]="5万到10万";
            $income_args["10-20"]="10万到20万";
            $income_args["20-50"]="20万到50万";
            $income_args["50-100"]="50万到100万";
            $income_args["100-200"]="100万到200万";
            $income_args["200-99999"]="200万以上";

            ?>

            <li class="list-row clearfix">
                <em class="fl">收入:</em>
                <ul class="sel-list fl clearfix hidden">

                    <li class="list-item fl"><a class="link-wh-100 <?php if($args['income'] == ''){ echo "sel"; } ?> " href="?income=&platform=<?=$args['platform']?>&gender=<?=$args['gender']?>&city=<?=$args["city"]?>&follower=<?=$args['follower']?>&orderby=<?=$args['orderby']?>&keyword=<?=$args['keyword']?>">不限</a></li>

                    <? foreach ($income_args as $key => $value){ ?>
                        <li class="list-item fl"><a class="link-wh-100 <?php if($args['income'] == $key){ echo "sel"; } ?>" href="?income=<?=$key?>&platform=<?=$args['platform']?>&gender=<?=$args['gender']?>&city=<?=$args["city"]?>&follower=<?=$args['follower']?>&orderby=<?=$args['orderby']?>&keyword=<?=$args['keyword']?>" ><?=$value?></a></li>
                    <? } ?>

                </ul>
                    <span class="button btn-other fr hide">
                        其它
                        <span class="ico ico-triangle"></span>
                    </span>
            </li>


            <?
            $follower_args = array();
            $follower_args["0-1"]="1万以下";
            $follower_args["1-5"]="1万-5万";
            $follower_args["5-10"]="5万到10万";
            $follower_args["10-20"]="10万到20万";
            $follower_args["20-50"]="20万到50万";
            $follower_args["50-100"]="50万到100万";
            $follower_args["100-200"]="100万到200万";
            $follower_args["200-99999"]="200万以上";

            ?>

            <li class="list-row clearfix">
                <em class="fl">粉丝:</em>
                <ul class="sel-list fl clearfix hidden">

                    <li class="list-item fl"><a class="link-wh-100 <?php if($args['follower'] == ''){ echo "sel"; } ?> " href="?follower=&platform=<?=$args['platform']?>&gender=<?=$args['gender']?>&city=<?=$args["city"]?>&income=<?=$args['income']?>&orderby=<?=$args['orderby']?>&keyword=<?=$args['keyword']?>">不限</a></li>

                    <? foreach ($income_args as $key => $value){ ?>
                        <li class="list-item fl"><a class="link-wh-100 <?php if($args['follower'] == $key){ echo "sel"; } ?>" href="?follower=<?=$key?>&platform=<?=$args['platform']?>&gender=<?=$args['gender']?>&city=<?=$args["city"]?>&income=<?=$args['income']?>&orderby=<?=$args['orderby']?>&keyword=<?=$args['keyword']?>" ><?=$value?></a></li>
                    <? } ?>

                </ul>
                    <span class="button btn-other fr hide">
                        其它
                        <span class="ico ico-triangle"></span>
                    </span>
            </li>


            <li class="list-row clearfix">
                <em class="fl">省份:</em>
                <ul class="sel-list fl clearfix hidden">

                    <li class="list-item fl"><a class="link-wh-100 <?php if($args['city'] == ''){ echo "sel"; } ?> " href="?city=&platform=<?=$args['platform']?>&gender=<?=$args['gender']?>&follower=<?=$args["follower"]?>&income=<?=$args['income']?>&orderby=<?=$args['orderby']?>&keyword=<?=$args['keyword']?>">不限</a></li>

                    <?php foreach ($city as $key => $value){ ?>
                        <li class="list-item fl"><a href="?city=<?php echo $value->id?>&platform=<?=$args['platform']?>&gender=<?=$args['gender']?>&follower=<?=$args["follower"]?>&income=<?=$args['income']?>&orderby=<?=$args['orderby']?>&keyword=<?=$args['keyword']?>" <?php  if($args['city'] ==$value->id){ echo "class='sel'"; } ?>  class="link-wh-100"><?php echo $value->province; ?></a> </li>
                    <?php } ?>

                </ul>
                    <span class="button btn-other hide fr">
                        其它
                        <span class="ico ico-triangle"></span>
                    </span>
            </li>

            <li class="list-row clearfix">
                <em class="fl">性别:</em>
                <ul class="sel-list fl clearfix hidden">

                    <li class="list-item fl"><a class="link-wh-100 <?php if($args['gender'] == ''){ echo "sel"; } ?> " href="?gender=&platform=<?=$args['platform']?>&city=<?=$args['city']?>&follower=<?=$args["follower"]?>&income=<?=$args['income']?>&orderby=<?=$args['orderby']?>&keyword=<?=$args['keyword']?>">不限</a></li>

                    <li class="list-item fl"><a class="link-wh-100 <?php if($args['gender'] == '1'){ echo "sel"; } ?> " href="?gender=1&platform=<?=$args['platform']?>&city=<?=$args['city']?>&follower=<?=$args["follower"]?>&income=<?=$args['income']?>&orderby=<?=$args['orderby']?>&keyword=<?=$args['keyword']?>">男</a></li>

                    <li class="list-item fl"><a class="link-wh-100 <?php if($args['gender'] == '0'){ echo "sel"; } ?> " href="?gender=0&platform=<?=$args['platform']?>&city=<?=$args['city']?>&follower=<?=$args["follower"]?>&income=<?=$args['income']?>&orderby=<?=$args['orderby']?>&keyword=<?=$args['keyword']?>">女</a></li>

                </ul>
                    <span class="button btn-other fr hide">
                        其它
                        <span class="ico ico-triangle"></span>
                    </span>
            </li>
        </ul>
    </div>
</section>
<!-- 筛选 end -->

<!-- 搜索内容 start -->
<section class="search-content">
    <div class="ly-1210">
        <div class="table clearfix">
            <?php        if(isset($search_results)&&!empty($search_results) ){      ?>
            <div class="table-head clearfix">
                <span class="label fl">搜索结果<!--small>共3条搜索结果</small--></span>
                <div class="tab-wk fr clearfix">
                    <b class="fl">排序方式:</b>
                    <ul class="fl">
                        <li class="fl rel <? if($args["orderby"] == "indexnum"){echo "sel";} ?>" onClick='location.href="?orderby=indexnum&platform=<?=$args['platform']?>&city=<?=$args['city']?>&follower=<?=$args["follower"]?>&income=<?=$args['income']?>&gender=<?=$args['gender']?>&keyword=<?=$args['keyword']?>";'>头部指数</a></li>
                        <li class="fl rel <? if($args["orderby"] == "rmb"){echo "sel";} ?>" onClick='location.href="?orderby=rmb&platform=<?=$args['platform']?>&city=<?=$args['city']?>&follower=<?=$args["follower"]?>&income=<?=$args['income']?>&gender=<?=$args['gender']?>&keyword=<?=$args['keyword']?>";'>收入</li>
                        <li class="fl rel <? if($args["orderby"] == "follower"){echo "sel";} ?>" onClick='location.href="?orderby=follower&platform=<?=$args['platform']?>&city=<?=$args['city']?>&follower=<?=$args["follower"]?>&income=<?=$args['income']?>&gender=<?=$args['gender']?>&keyword=<?=$args['keyword']?>";'>粉丝</a></li>
                    </ul>
                </div>
            </div>
            <div class="table-thead">
                <div class="table-tr clearfix">
                    <div class="table-th fl">账号</div>
                    <div class="table-th fl">平台</div>
                    <div class="table-th fl">收入</div>
                    <div class="table-th fl">粉丝</div>
                    <div class="table-th fl">主播综合指数<span class="ico sprite rel">
                            <div class="ly-alert hide abs">
                                <p>“主播综合指数”是根据主播的粉丝、收入、在线时长等数据结合专业算法得出的指数值。</p>
                            </div>
                            <div class="decorate hide sprite abs"></div>
                        </span></div>
                    <!--                    <div class="table-th fl">主播热度指数<span class="ico sprite rel">-->
                    <!--                            <div class="ly-alert hide abs">-->
                    <!--                                <p>“主播热度指数榜”是根据主播的日增收入、日增粉丝、在线时长等数据结合专业算法得出的指数值，指数值越高排名越高。</p>-->
                    <!--                            </div>-->
                    <!--                            <div class="decorate hide sprite abs"></div>-->
                    <!--                        </span></div>-->
                    <div class="table-th fl">城市</div>
                    <div class="table-th fl">性别</div>
                    <!--                    <div class="table-th fl">趋势<span class="ico sprite rel">-->
                    <!--                            <div class="ly-alert hide abs">-->
                    <!--                                <p>“趋势”是根据主播粉丝、金币的增长值、金币、粉丝总数等数据对比昨日数据综合算出的主播趋势。</p>-->
                    <!--                            </div>-->
                    <!--                            <div class="decorate hide sprite abs"></div>-->
                    <!--                        </span></div>-->
                    <div class="table-th fl">更多</div>
                </div>
            </div>
            <div class="table-tbody">
                <!-- 循环表格 start -->
                <?php  foreach ($search_results as $key =>$value){ ?>
                    <a class="table-tr db hidden clearfix" target="_blank" href="/zbdetail?id=<?php  echo $value->platform;  ?>&platformid=<?php echo $value->platformid;  ?>">
                        <div class="table-td fl">
                            <figure class="clearfix">
                                <img class="fl" src="<?php if($value->avatar ==null){ echo HTTP_URL."images/0.jpg"; }  else {if(strpos($value->avatar,"http")===true) echo $value->avatar;else if(strpos($value->avatar,"http")===false && $value->platform ==1 &&$value->platform !=6 )  {echo "http://img.meelive.cn/".$value->avatar; }else if($value->platform==6){  echo "http://s.momocdn.com/w/u/img/2016/04/01/1459499443848-401_S.png";  }  else  echo $value->avatar;} ?>" alt="<?php echo $value->nickname; ?>">
                                <figcaption class="fl">
                                    <span class="user-name hidden fl"><?php echo $value->nickname; ?></span>
                                    <span class="user-id hidden fl">ID:<?php  echo $value->platformid;  ?></span>
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
                            else if($value->platform ==10) {echo "斗鱼直播"; }

                            ?></span>
                        </div>
                        <div class="table-td fl">
                            <span class="user-income center fl"><?php echo $value->rmb; ?>元</span>
                        <span class="user-total center fl"> <?php
                             if($value->platform ==10) {echo ($value->income/100)."KG"; }
                            if($value->platform ==1) {echo  $value->income."映票"; }
                            else if($value->platform ==2) {echo $value->income."礼券"; }
                            else if($value->platform ==3) {echo $value->income."花椒币"; }
                            else if($value->platform ==4) {echo $value->income."身高"; }
                            else if($value->platform ==5) {echo $value->income."战斗力"; }
                            else if($value->platform ==6) {echo $value->income."星光值"; }
                            else if($value->platform ==7) {echo $value->income."金币"; }
                            else if($value->platform ==8) {echo $value->income."美拍豆"; }
                            else if($value->platform ==9) {echo $value->income."星豆"; }
                            
                            ?></span>
                        </div>
                        <div class="table-td fl">
                            <span class="user-income center fl"><?php echo $value->follower; ?></span>
                            <!--                        <span class="user-total center fl">总:--> <!--</span>-->
                        </div>
                        <div class="table-td fl">
                            <span class="user-comprehensive db"><?php echo $value->indexnum; ?></span>
                        </div>
                        <!--                    <div class="table-td fl">-->
                        <!--                        <span class="user-heat db">4125</span>-->
                        <!--                    </div>-->
                        <div class="table-td fl">
                            <span class="user-area db"><?php if($value->cityname){ echo $value->cityname;}else{ echo "未知"; } ?></span>
                        </div>
                        <div class="table-td fl">
                            <span class="user-sex db"><?php  if ($value->gender==0 ){echo "女";}else if($value->gender==1){echo "男";}else{echo "秘密"; }; ?></span>
                        </div>
                        <!--                    <div class="table-td fl">-->
                        <!-- 三种可能：-->
                        <!-- ico-new - 最热 -->
                        <!-- ico-rise - 上升 -->
                        <!-- ico-drop - 下降 -->
                        <!--                        <span class="ico ico-new sprite fl"></span>-->
                        <!--                    </div>-->
                        <div class="table-td fl">
                            <span class="button btn-more fl">主播详情</span>
                        </div>
                    </a>
                <?php } }else{ ?>
                    <!-- 未搜索到结果 start -->
                    <!-- ps：如果没有搜索到结果移除lass：hide  -->
                    <div class="notsearch">
                        <p class="fl center">抱歉，未能找到相关资讯</p>
                    </div>
                    <!-- 未搜索到结果 end -->
                    <!-- <span style="text-align: center;padding: 10px 0;display: block;">暂时还没有你想要的结果哟~</span> -->
                <?php } ?>
                <!-- 循环表格 end -->
            </div>
        </div>
<!--         <?php if($search_results) echo '
        <div class="button-wk center">
            <span class="button inlie btn-more">加载更多...</span>
        </div>
        ' ?> -->
    </div>
</section>
<!-- 搜索内容 end -->

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
<script src="<?php echo HTTP_URL; ?>web/static/js/search.bundle.js"></script>
</body>
</html>