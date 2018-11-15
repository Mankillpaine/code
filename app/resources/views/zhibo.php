<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, target-densitydpi=device-dpi" />
    <title>直播助手-聪明的主播都在用-头部出品</title>
    <link rel="stylesheet" type="text/css" href="<?php echo HTTP_URL; ?>boostrap/css/bootstrap-theme.css">
    <link rel="stylesheet" type="text/css" href="<?php echo HTTP_URL; ?>boostrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="<?php echo HTTP_URL; ?>css/wecss.css">
    <script type="text/javascript" src="<?php echo HTTP_URL; ?>js/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo HTTP_URL; ?>boostrap/js/bootstrap.js"></script>
    <script type="text/javascript" src="<?php echo HTTP_URL; ?>js/screen.js"></script>
    <script type="text/javascript" src="<?php echo HTTP_URL; ?>js/Chart.js"></script>
    <script type="text/javascript" src="<?php echo HTTP_URL; ?>js/socket.io-1.4.5.js"></script>
    <?php  if($platformid==3) { ?>
    <script type="text/javascript" src="<?php echo HTTP_URL; ?>js/huajiao_ws.js"></script>
    <script type="text/javascript" src="<?php echo HTTP_URL; ?>js/socket-io-websocket-base.js"></script>
    <?php   } ?>
</head>
<body>
<div class="warpper" id="aa">

    <div class="s_head">
        <div class="head_top">
            <img src="<?php echo HTTP_URL; ?>images/start.png" style="width: 0.16rem;height: 0.16rem;">
            <span class="start_t"><?php echo date("H:i") ?>开播</span>
            <span class="ico"></span>
            <span  id="redhacker">已记录0:0:0</span>
            <input name="duration" id="duration" type="hidden" value="0">
        </div>
        <div class="head_content">
            <ul>
                <li>
                    <div class="dis_num">
                        <span class="num" id="maxnum" >0</span>
                        <span>最高在线</span>
                    </div>

                    <div class="dis_num">
                        <span class="num" id="fan">0</span>
                        <span >粉丝增长</span>
                    </div>

                    <div class="dis_num">
                        <span class="num" id="gold">0</span>
                        <span>金币增长</span>
                    </div>
                </li>

                <li>
                    <div class="dis_num">
                        <span class="num" id="view">0</span>
                        <span>当前在线</span>
                    </div>

                    <div class="dis_num">
                        <span class="num" id="speak">0</span>
                        <span>发言人数</span>
                    </div>

                    <div class="dis_num">
                        <span class="num" id="reward">0</span>
                        <span>打赏人数</span>
                    </div>
                </li>

            </ul>
        </div>
    </div>

    <div class="rank" style="display: none;">
<!--        <div class="top"> <img src="--><?php //echo HTTP_URL; ?><!--images/top.png">当前映客北京榜第<span>6</span>名</div>-->
    </div>

    <span class="fansnews"></span>
    <div class="container" style="border-bottom: 0.98rem; background-color: #fff; margin: 0; width: 100%; ">
        <ul class="news_list" style="margin-bottom: 0.96rem;">
        </ul>
    </div>
</div>



<div class="warpper1"  style="display: none;"  id="bb">
    <div class="chart">
<!--        <canvas id="myChart" style="width:100%; height:2.94rem; "></canvas>-->
        <canvas id="myChart" style="height:2.94rem; "></canvas>
        <div class="class_bt">
            <button class="chart_btn0">在线</button>
            <button>聊天</button>
            <button>打赏</button>
            <button>增粉</button>
        </div>
    </div>
    <div class="content">

        <div class="rank_title">
            <ul style="min-height: 0;">
                <li style="border: 0;" id="ds" class="rank_active">打赏榜</li>
                <li style="border: 0;" id="fy">发言榜</li>
                <li style="border: 0;" id="lw">礼物记录</li>
            </ul>
        </div>
        <div class="rank_content">
            <ul id="dashang" style="display: block; margin-top: 0; margin-bottom: 0.96rem; min-height: 3.84rem;background-color: #fff;"></ul>

            <ul id="fayan" style="display: none; margin-top: 0; margin-bottom: 0.96rem; min-height: 3.84rem; background-color: #fff;"></ul>

            <ul id="liwu" style="display: none; margin-top: 0; margin-bottom: 0.96rem; min-height: 3.84rem; background-color: #fff;"></ul>

        </div>
    </div>
</div>


<div class="booter">
        <li class="tab active" id="ss">
            实时
        </li>
        <li class="tab last  " id="tj">
            统计
        </li>
</div>
 <script>


$('.booter').find('li').click(function() {
    // 为当前点击的导航加上高亮，其余的移除高亮
    $(this).addClass('active').siblings('li').removeClass('active');
});
$('.rank_title').find('li').click(function() {
    // 为当前点击的导航加上高亮，其余的移除高亮
    $(this).addClass('rank_active').siblings('li').removeClass('rank_active');
});

$('.class_bt').find('button').click(function() {
    // 为当前点击的导航加上高亮，其余的移除高亮
   if($(this).index() ==0){

       $(this).addClass('chart_btn0').siblings('button').removeClass('chart_btn1').removeClass('chart_btn2').removeClass('chart_btn3');
   }
    if($(this).index() ==1){

        $(this).addClass('chart_btn1').siblings('button').removeClass('chart_btn0').removeClass('chart_btn2').removeClass('chart_btn3');
    }
    if($(this).index() ==2){

        $(this).addClass('chart_btn2').siblings('button').removeClass('chart_btn1').removeClass('chart_btn0').removeClass('chart_btn3');
    }
    if($(this).index() ==3){

        $(this).addClass('chart_btn3').siblings('button').removeClass('chart_btn1').removeClass('chart_btn2').removeClass('chart_btn0');
    }


    //  $(this).addClass('rank_active').siblings('li').removeClass('rank_active');
});



 </script>


<script type="text/javascript">
    
    window.onload=function () {
    <?php     if($platformid==1) {   ?>
            inke("<?php echo $userid;  ?>", "<?php echo $id;?>");
     <?php   }   ?>

        // 计算响应式比例
        var number = document.documentElement.clientWidth / 750 * 625;

        if(number < 625){
            document.getElementsByTagName('html')[0].style.fontSize = number +'%';
        }    else {
            document.getElementsByTagName('html')[0].style.fontSize = '625%';
        }

//        console.log(document.getElementsByTagName('html')[0].style.fontSize = '100px');

        number = null;
    } ;
    /*
    获取贡献票数的前200人
     */
    var gxsz = new Array(); //贡献榜前200名数组的初始化
    <?php if($platformid ==1){ ?>
        var gxph = "<?php echo $userid;  ?>";
        $.get('/app/getgp',{"userid":gxph},function(data) {
            data = eval('(' + data + ')');
            gxsz = data.contributions;  //贡献票数的资料

        });
    <?php  }else if($platformid ==7){ ?>
        var gxph = "<?php echo $userid;  ?>";
        $.get('/app/getgp',{"userid":gxph},function(data) {
            data = eval('(' + data + ')');
            gxsz = data.data.list;  //贡献票数的资料

        });
    <?php }if($platformid ==3) { ?>
    var gxph = "<?php echo $userid;  ?>";
    $.get('/app/getgp',{"userid":gxph},function(data) {
        data = eval('(' + data + ')');
        gxsz = data.data;  //贡献票数的资料

    });
     <?php }  ?>

  <?php   if(isset($num_followers)) {   ?>
        var i = <?php echo $num_followers; ?>//;
        var fansn = i.num_followers;   //粉丝数

        setInterval("getfansnum()", 5000);
        function getfansnum() {
            var userid = "<?php echo $userid;  ?>";
            $.get('/app/getfans', {"userid": userid}, function (data) {
                data = eval('(' + data + ')');
                var fans = data.num_followers;
                if (fans > fansn) {

                    $('#fan').html(fans - fansn);
                }


            });
        };
   <? }?>

   <?php  if($platformid == 1) {       ?>

        function inke(userid, liveid) {

            var dataAPI = "http://webapi.busi.inke.com/web/live_share_pc?uid=" + userid + "&id=" + liveid;
            var data = $.getJSON(dataAPI, function (data) {
                data = data.data;
                var ip = data.sio_ip;
                var nonce = data.nonce;
                var sec = data.sec;
                var t = new Date().getTime();
                var t1 = new Date().getTime() - 2000;
                var t2 = t1.toString().substr(0, 10);
                t2 = data.time;

                var keyUrl = "http://" + ip + "/socket.io/1/?uid=&place=room&sid=1&roomid=" + liveid + "&token=&time=" + t2 + "&nonce=" + nonce + "&sec=" + sec + "&t=" + t;

                var dataX = $.get(keyUrl, function (data) {

                    var str = dataX.responseText.split(":")[0];
                    wsUri = "ws://" + ip + "/socket.io/1/websocket/" + str + "?uid=&place=room&sid=1&roomid=" + liveid + "&token=&time=" + t2 + "&nonce=" + nonce + "&sec=" + sec;


                    connectWebSocket();

                });


            });

        }


        function connectWebSocket() {

            websocket = new WebSocket(wsUri);


            websocket.onopen = function (evt) {
                onOpen(evt);
                setTimeout("sendHeart()", 3000);
            };
            websocket.onclose = function (evt) {
                onClose(evt)
            };
            websocket.onmessage = function (evt) {
                onMessage(evt)
            };
            websocket.onerror = function (evt) {
                onError(evt)
            };
        }

        function sendHeart() {

            doSend('2::');

            setTimeout("sendHeart()", 2000);

        }

        function onOpen(evt) {

            //doSend('0::');
            //doSend(joinStr);
        }

        function onClose(evt) {

        }
   <?php  } ?>

   <?php   if($platformid ==7){     ?>

        this.socket = io.connect("ws://ws.yizhibo.com", {
            reconnectionAttemptes: 10,
            reconnectionDelay: 3e3,
            transports: ["websocket"],
            path: "/yizhibo",
            "force new connection": !0
        });
        var a = this;

        this.socket.on("connect", function() {
            a.socket.emit("joinRoom", "<?php echo $live; ?>")
        }),
            this.socket.on("disconnect", function() {}),
            a.socket.on("comment", function(t) {

                var  data1 = eval('(' + t + ')');
                var mem = data1.memberid;   //用户id
                nickname   =data1.nickname;  //用户昵称
                var leavel   = data1.level;
                var content  = data1.content; //聊天信息
                adds(user,{"id":mem,"nic":nickname,"value":1});
                user =  _SpeakSort(user);
                sp(user.length);
                dsdata(mem,nickname,leavel,content,giftu.length);

//                发言榜
                adds(user,{"id":mem,"nic":nickname,"value":1});
                user =  _SpeakSort(user);
                fybdata();
                ljds(mem,content);

            }),
            a.socket.on("gift", function(t) {
                console.log("礼物");
                var  data1 = eval('(' + t + ')');
                var giftid = data1.giftid; //礼物id
                var giftname   = data1.name;   //礼物名
                var nickname   = data1.nickname;
				
                var goldcoin = getGiftCoin(giftid);
                
				menberid   = data1.memberid;
                var cid = giftu.indexOf(menberid);
                if(cid==-1){
                    giftu.push(menberid);
                }
                var face = data1.avatar;
                console.log(giftu);  //送礼物的人
                var  giftnum =   giftu.length;
                var repeat = 1;
                rewards(giftnum);
                MoneyUp(goldcoin);


                if(goldcoin != 0){
                    if(!gift[giftname]){
                        gift[giftname] = {
                            point: goldcoin,
                            repeat:repeat,
                        };
                    } else {
                        gift[giftname].repeat +=repeat;

                    };
                }

                //土豪榜

                addGold(income,{"userid":menberid,"gold":goldcoin,"nic":nickname,"face":face});
                income = _getSort(income);
                thbdata();

                giftpr();

            }),
            a.socket.on("live_info", function(t) {
                console.log("直播信息");
                var  data1 = eval('(' + t + ')');
				
                var  online     = data1.online;   //在线人数
				var  max_online  = data1.max_online;  //最高人数
				
                onlineview(online);
                getHeightNum(max_online);
                

            }),
            a.socket.on("praise", function() {}),
            a.socket.on("login", function(t) {
                console.log("login");
                var  data1 = eval('(' + t + ')');
                 console.log(data1);
                var  online     = data1[0].online;   //在线人数
                var  max_online  = data1[0].onlines;  //最高人数

                onlineview(online);
                getHeightNum(max_online);
                console.log(t);
                //i.login(t)
            }),
            a.socket.on("message", function(t) {
                var  data1 = eval('(' + t + ')');
                if(data1.message.indexOf('关注了主播')>=0){
                    fans+=1;
                    fensi(fans);
                }

                //i.message(t)
            });
        a.socket.on("room", function(t) {
            var  data1 = eval('(' + t + ')');
            var level  =    data1.level;
            var nicname = data1.nickname;
            if(level>50){
                thcmdata(level,nicname);
            }

            //i.message(t)
        });
   <?php } ?>

    <?php if( $platformid ==3 ){ ?>

    //SocketIO类的初始化
    (function(e) {
        var t = function(t, n) {
            var r = this;
            t = t || {},
                t.primary = t.primary || "auto",
                t.base = t.base || "",
                t.primary === "websocket" ? this.useFlash = !1 : t.primary === "flash" ? this.useFlash = !0 : this.useFlash = !e.ArrayBuffer || !e.Uint8Array || !e.WebSocket;
            if (t.primary === "auto") {
                var i = document.createElement("script"),
                //s = t.base + "socket-io-" + (this.useFlash ? "flash-base": "websocket-base") + (t.min ? ".min": "") + ".js";
                    s = "socket-io-websocket-base.js";
                i.type = "text/javascript",
                    i.src = s;
                if ("onload" in i) i.onload = function() {
                    r._initSocket(t, n)
                };
                else {
                    if (! ("onreadystatechange" in i)) throw new Error(s + " \u52a0\u8f7d\u5931\u8d25");
                    i.onreadystatechange = function() {
                        var e = i.readyState;
                        if (e === "loaded" || e === "complete") i.onreadystatechange = null,
                            r._initSocket(t, n)
                    }
                }
                i.onerror = function() {
                    throw new Error(s + " \u52a0\u8f7d\u5931\u8d25")
                },
                    document.getElementsByTagName("head")[0].appendChild(i)
            } else this._initSocket(t, n)
        };
        t.MESSAGE_TYPE_CONTS = {
            FOLLOW: 1,
            LIVE_START: 2,
            LIVE_STOP: 3,
            FORCAST_PUBLISH: 4,
            FORCAST_PLAY: 5,
            BROADCAST_LIVE: 6,
            BROADCAST_FORECAST: 7,
            PRAISE: 8,
            CHAT: 9,
            JOIN: 10,
            HOT: 11,
            VISITOR_JOIN: 12,
            FEEDBACK: 13,
            JOINBACK: 14,
            BUGLE: 15,
            QUIT: 16,
            BROADCAST_FOLLOW: 17,
            FORBIDEN: 18
        };
        var n = t.prototype;
        n._initSocket = function(e, t) {
            if (this.socket) return;
            this.useFlash ? this.socket = new FlashSocketIO(e) : this.socket = new WebSocketIO(e);
            var n = ["connect", "reconnect", "close"],
                r = EventEmitter.prototype;
            for (var i in r) r.hasOwnProperty(i) && !/^_/.test(i) && n.push(i);
            for (var s = 0; s < n.length; s++) this[n[s]] = this._createInterfaceMethodHandler(n[s]);
            t && t.call(this)
        },
            n._createInterfaceMethodHandler = function(e) {
                var t = this;
                return function() {
                    t.socket[e].apply(t.socket, arguments)
                }
            },
            n.destroy = function() {
                this.destroyed || (this.destroyed = !0, this.socket.destroy(), this.socket = null)
            },
            e.SocketIO = t
    })(window);


    //建立连接需要的参数
    var userid = "<?php echo $live; ?>";
    this.options = { atMeMessageText: "<a href='#' data-rel='scrollToLast'><i></i> <span>有{0}条@我的消息</span></a>" , autoScrollThreshold: 80 , base: "http://static.huajiao.com/huajiao/web/static/module/socket-io/" , datetimeFormat: "YYYY-MM-DD HH:mm:ss" , deleteFailText: "删除失败" , deleteSuccessText: "删除成功" , deleteText: "删除" , lastPageText: "没有更多了" , liveId: userid , loadText: "查看更多聊天记录" , loadingText: "加载中..." ,messageMaxIntervalMinute: 20 , moreMessageText: "<a href='#' data-rel='scrollToLast'><i></i> <span>有更多新的消息</span></a>" , ownerQid: "31469066" , ownerText: "摄像机主人" , reloadText: "加载失败！点击重新加载" , replyText: "回复" , selfText: "我" , topicId: userid };


    //建立连接
    _tts = new SocketIO({
        roomId: this.options.topicId,
        userId: this._currentLoginUser && this._currentLoginUser.qid || n(11, !0) + Date.now(),
        base: this.options.base,
        addressBookProto: this.options.addressBookProto,
        chatroomProto: this.options.chatroomProto,
        swfUrl: this.options.swfUrl
    });



    //生成随机数的函数
    function n(e, n) {
        var t = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        var r = [],
            i = n ? t.slice(0, 10) : t;
        for (var s = 0; s < e; s++) r.push(i.charAt(Math.floor(Math.random() * i.length)));
        return r.join("")
    }

    function hjdate(t) {
        console.log(t);
        if(t.type ==10){
            onlineview(t.extends.watches);    //当前在线人数
            getHeightNum(t.extends.watches);  //获取最高在线
        }else if(t.type ==9){
           var id =  t.extends.userid;    //用户id
            var name =  t.extends.nickname;    //用户昵称
            var level = t.extends.level;  //发言人等级
            var chat = t.text;               //发言内容
            adds(user,{"id":id,"nic":name,"value":1});
            user =  _SpeakSort(user);
            sp(user.length);
            dsdata(id,name,level,chat,giftu.length);
            fybdata();
            ljds(id,chat,level);

        }else if(t.type ==30){
            var gold  = t.extends.giftinfo.giftname;  //名字
            point = t.extends.giftinfo.amount ; //单价

           var giftid = t.extends.giftinfo.giftid; //礼物id
            var giftname   = t.extends.giftinfo.giftname;   //礼物名
            var nickname   = t.extends.sender.nickname;
            var face      = t.extends.sender.avatar;
            var goldcoin = t.extends.giftinfo.amount;
            menberid   = t.extends.sender.uid ;
            var cid = giftu.indexOf(menberid);
            if(cid==-1){
                giftu.push(menberid);
            }
            console.log(giftu);  //送礼物的人
            var  giftnum =   giftu.length;
            var repeat = 1;
            rewards(giftnum);
            MoneyUp(goldcoin);
            if(goldcoin != 0){
                if(!gift[giftname]){
                    gift[giftname] = {
                        point: goldcoin,
                        repeat:repeat,
                    };
                } else {
                    gift[giftname].repeat +=repeat;

                };


        }
            //土豪榜
            addGold(income,{"userid":menberid,"gold":goldcoin,"nic":nickname,"face":face});
            income = _getSort(income);
            thbdata();

            giftpr();


        }
    }

    <?php }  ?>

    var dsrs=0;//打赏人数
    var userstren=0; //发言
    var view=0;//当前在线
    var giftu   = new Array();
    var user    = new Array();
    var userArr = new Array();
    var income  = new Array();
    var gift    = {};
    var point=0; //个数
    var repeat=0;
    <?php   if($platformid ==1){ ?>
    function onMessage(evt) {

        var dataAll = evt.data;
        if(evt.data.indexOf('1::')>=0){
        } else if(evt.data.indexOf('3::')>=0){
            var data = dataAll.replace("3:::","");
            var json = JSON.parse(data);
            if (json.hasOwnProperty("dest")) {
                if (json.ms[0].hasOwnProperty("n")) {
                    view = json.ms[0].n; //当‘’前在线人数
                    $('#view').html(view);
                    getHeightNum(view);     //获取最高观看人数

                }

                /*
                 贡献榜单里面的人的发言
                 */


                if(json.ms[0].hasOwnProperty("c") && !json.ms[0].hasOwnProperty("gift")&&  (json.ms[0].tp != "rn" ) &&  (json.ms[0].tp != "jr" ) && (json.ms[0].tp != "sys" ) ){
                    var userid = json.userid;//用户id
                    if(gxsz.length>0) {
                        for (var i = 0; i < gxsz.length; i++) {
                            var id = gxsz[i].user.id;
                            if (id == userid) {
                                $('.news_list').prepend("<li> <span class='lvls'>" + json.ms[0].from.lvl + "级</span>  <span class='nicname'>" + json.ms[0].from.nic + "</span><span class='inroom'>说:</span><span class='tips'><img src='<?php echo HTTP_URL; ?>images/offer.png'><p class='deep'>累计打赏</p>" + gxsz[i].contribution + "&nbsp; </span> <span class='news'>	" + json.ms[0].c + "</span> </li>");
                                         if($('.news_list li').length > 20){$('.news_list li:last-child').remove();}
                            }
                        }
                    }
                }



                /*
                 级别高的用户进入房间
                 */
                if(json.ms[0].tp == 'jr' && json.ms[0].u.hasOwnProperty("lvl")  ){
                    //function thcmdata(lvl,nic) {
                    var lvl = json.ms[0].u.lvl;
                    var nic = json.ms[0].u.nic;
                    thcmdata(lvl,nic);
                   // $('.news_list').prepend("<li><span class='lvls'>"+json.ms[0].u.lvl + "级</span> <span class='nicname'>"+json.ms[0].u.nic + "</span><span class='inroom'>进入房间</span><span class='tips'><img src='<?php echo HTTP_URL; ?>images/rich.png'>土豪出没</span> </li>");
                          //   if($('.news_list li').length > 20){$('.news_list li:last-child').remove();}
                }
                // 金币增长
                if(json.ms[0].hasOwnProperty("gift")){
                    var gold = json.ms[0].gift.gold;  //金币数
                    var userid = json.userid;
                    var cid = giftu.indexOf(userid);
                    if(cid==-1){
                        giftu.push(userid);
                    }
                    rewards(giftu.length);
                  //  $('#reward').html(giftu.length);
                    dsrs =giftu.length;
                    MoneyUp(gold);
                }

                //土豪榜
                if(json.ms[0].hasOwnProperty("gift")){
                    var gold = json.ms[0].gift.gold;  //金币数
                    var userid = json.userid;
                    var nic           = json.ms[0].from.nic;
                    if(json.ms[0].from.ptr.indexOf('.cn')>0){
                        var face    = json.ms[0].from.ptr;
                    }else{
                        var face    = "http://img.meelive.cn/"+json.ms[0].from.ptr;
                    }

                    var i=0;
                    addGold(income,{"userid":userid,"gold":gold,"nic":nic,"face":face});
                    income = _getSort(income);
                    thbdata();

//
//                    var userstren  = income.length;
//                    var i=0;
//                    var themp ="";
//                    while(i<20 && i<userstren)
//                    {
//                        themp += "<li> <span class='rank_name'>" + income[i].nic + "</span><span class='rank_num'> X "+ income[i].gold + "</span></li>";
//                        i++;
//                    }
//
//                    $('#dashang').html(themp);

                }




                //礼物记录
                if(json.ms[0].hasOwnProperty("gift")){
                    var gold  = json.ms[0].gift.name;  //名字

                    point = json.ms[0].gift.point; //个数
                     repeat = json.ms[0].gift. repeat;

                    if(!gift[gold]){
                        gift[gold] = {
                            point: point,
                            repeat:repeat,
                        };
                    } else {
//                        gift[gold].point += point;
                         gift[gold].repeat +=repeat;

                    };
                    giftpr();
//                    var xy="" ;
//                    for(var item in gift){
//
//                        xy+= "<li> <span class='rank_name'>"+ item + " (单价:" + gift[item].point + ") </span><span class='rank_num'> X" + gift[item].repeat +"</span></li>";
//                    };
//
//                    $('#liwu').html(xy);

                }

                if(json.ms[0].hasOwnProperty("c") && !json.ms[0].hasOwnProperty("gift") && json.ms[0].tp!='sys'&&  (json.ms[0].tp != "jr" ) && (json.ms[0].tp != "sys" ) &&!json.ms[0].hasOwnProperty("f") ){
                    var userid = json.userid;//用户id
                    var nic           = json.ms[0].from.nic; //发言人的昵称
                    var leavel        = json.ms[0].from.lvl;  //发言人的等级
                    var chat = json.ms[0].c; //聊天信息
                    var dsrs =  income.length; //打赏人数
                    //用户id，昵称，等级，发言，打赏人数
                    dsdata(userid,nic,leavel,chat,dsrs);
//                    for( var i=0; i<dsrs; i++ ){
//                        if(userid==income[i].userid){
//                            $('.news_list').prepend("<li> <span class='lvls'>" + json.ms[0].from.lvl + "级</span>  <span class='nicname'>" + json.ms[0].from.nic + "</span><span class='inroom'>说:</span><span class='tips'><img src='<?php //echo HTTP_URL; ?>//images/offer.png'><p class='deep'>本场打赏 </p>" + income[i].gold + " &nbsp;</span> <span class='news'>	" + json.ms[0].c + "</span> </li>");
//                                     if($('.news_list li').length > 20){$('.news_list li:last-child').remove();}
//                        }
//
//                    }

                    Speaking(chat,userid,nic);
                    // getLength(userid);

                }




            }
        }


    }


    function onError(evt) {

    }

    function doSend(message) {

        websocket.send(message);
    }


   <?php } ?>

    /*
     粉丝数
     */
    function fensi(n) {
        $('#fan').html(n);
    }
    //    当前在线人数
    function onlineview(n) {
        $('#view').html(n);
    }



    /*
     获取最高在线
     */
    var maxnum=0;
    function getHeightNum(n) {
        if(n>maxnum){
            maxnum= n;
            $('#maxnum').html(maxnum);
        }
    }



    /*
     金币增长
     */
    var reward=0;//打赏人数
    var money=0;
    function MoneyUp(g) {
        money+=Number(g);
        $('#gold').html(money);

    }
    /*
     发言人数和粉丝增长
     */
    var fans=0;
    function Speaking(c , id,nic) {
        var userLeng = new Array();
        if(c.indexOf('一道金光闪过')>=0){

        }
        if(c.indexOf('关注了主播，不错过下一次直播')>=0){

            fans++;

        }else {

            adds(user,{"id":id,"nic":nic,"value":1});
            user =  _SpeakSort(user);
        }
        $('#speak').html(user.length); //发言人数
         userstren  = user.length;
        var i=0;
        var themp ="";

        while(i<20 && i<userstren)
        {
            themp += "<li> <span class='rank_name'>" + user[i].nic + "</span> <span class='rank_num'>X "+ user[i].value + "</span> </li>";
            i++;
        }
        $('#fayan').html(themp);
    }

    //发言人数
    function sp(n) {
        $('#speak').html(n); //发言人数

    }
    //打赏人数
    var reward=0;//打赏人数
    function rewards(n) {
        $('#reward').html(n);
    }
    //礼物数
    var xy="" ;
    function giftpr() {
        console.log(gift);
		$('#liwu').html();
        xy ="";
        for(var item in gift){

            xy+= "<li> <span class='rank_name'>"+ item + " (单价:" + gift[item].point + ") </span><span class='rank_num'> X" + gift[item].repeat +"</span></li>";
        };
        $('#liwu').html(xy);
    }
    /*土豪榜*/
    function thbdata() {
        var userstren  = income.length;
        var i=0;
        var themp ="";
        while(i<20 && i<userstren)
        {
            themp += "<li> <span class='rank_name'>" + income[i].nic + "</span><span class='rank_num'> X "+ income[i].gold + "</span></li>";
            i++;
        }

        $('#dashang').html(themp);
    }
    /*
     发言榜
     */
    function fybdata() {
        userstren  = user.length;
        var i=0;
        var themp ="";

        while(i<20 && i<userstren)
        {
            themp += "<li> <span class='rank_name'>" + user[i].nic + "</span> <span class='rank_num'>X "+ user[i].value + "</span> </li>";
            i++;
        }
        $('#fayan').html(themp);

    }



    /*
     本场打赏的人发言
     用户id，昵称，等级，发言，打赏人数
     */
    function dsdata(userid,nic,leavel,chat,dsrs) {
        for( var i=0; i<dsrs; i++ ){
            console.log(income);
			if(income.length>0){
				if(userid==income[i].userid){
					$('.news_list').prepend("<li> <span class='lvls'>" + leavel + "级</span>  <span class='nicname'>" + nic + "</span><span class='inroom'>说:</span><span class='tips'><img src='<?php echo HTTP_URL; ?>images/offer.png'><p class='deep'>本场打赏 </p>" + income[i].gold + " &nbsp;</span> <span class='news'>	" + chat + "</span> </li>");
					//  if($('.news_list li').length > 20){$('.news_list li:last-child').remove();}
				}
			}

        }
    }


    /*土豪出没*/
    //    等级，昵称
    function thcmdata(lvl,nic) {
        $('.news_list').prepend("<li><span class='lvls'>"+lvl + "级</span> <span class='nicname'>"+nic + "</span><span class='inroom'>进入房间</span><span class='tips'><img src='<?php echo HTTP_URL; ?>images/rich.png'>土豪出没</span> </li>");
        if($('.news_list li').length > 20){$('.news_list li:last-child').remove();}
    }


    // 获取数组成员数出现的次数
    function getLength(arrS){
        var arr = [],
            objS = {};

        arrS.forEach(function(value, key){
            if(arr.indexOf(value) === -1){
                arr.push(value);

                objS[value] = 1;
            } else {
                objS[value]++;
            };
        });

        return objS;
    };
    // 发言数排序
    function getSort(info){
        var arrS = [],
            conpare;

        conpare = function(value1, value2){
            if(value1[0] > value2[0]){
                return -1;
            } else if(value1[0] < value2[0]){
                return 1;
            } else {
                return 0;
            }
        };

        for(var item in info){
            arrS.push([info[item], item]);
        };

        return arrS.sort(conpare);
    };
    /*
     礼物排序
     */
    function _getSort(info){
        var conpare;

        conpare = function(value1, value2){
            if(value1['gold'] > value2['gold']){
                return -1;
            } else if(value1['gold'] < value2['gold']){
                return 1;
            } else {
                return 0;
            }
        };

        return info.sort(conpare);
    };

    function addGold(arr, item){
        var index = 0;
       item.gold = Number(item.gold);
        for(var n = 0; n < arr.length; n++){
            if(arr[n].userid === item.userid){
                arr[n].gold += Number(item.gold);

                break;
            };

            index++;
        };

        if(index === arr.length) arr.push(item);
    };

    function adds(arr, item){
        var index = 0;

        for(var n = 0; n < arr.length; n++){
            if(arr[n].id === item.id){
                arr[n].value += item.value;

                break;
            };

            index++;
        };

        if(index === arr.length) arr.push(item);
    };
    /*
     发言排序
     */
    function _SpeakSort(info){
        var conpare;

        conpare = function(value1, value2){
            if(value1['value'] > value2['value']){
                return -1;
            } else if(value1['value'] < value2['value']){
                return 1;
            } else {
                return 0;
            }
        };

        return info.sort(conpare);
    }

    /*
    累计打赏
    */
    <?php if($platformid ==7) { ?>
   function ljds(userid,cc) {
       if(gxsz.length>0) {
           for (var i = 0; i < gxsz.length; i++) {
               var id = gxsz[i].memberid;
               if (id == userid) {


                   $('.news_list').prepend("<li> <span class='lvls'>" + gxsz[i].level + "级</span>  <span class='nicname'>" +gxsz[i].nickname + "</span><span class='inroom'>说:</span><span class='tips'><img src='<?php echo HTTP_URL; ?>images/offer.png'><p class='deep'>累计打赏</p>" + gxsz[i].goldcoin + "&nbsp; </span> <span class='news'>	" + cc + "</span> </li>");
                   if($('.news_list li').length > 20){$('.news_list li:last-child').remove();}

               }
           }
       }
   }
    <?php }if($platformid ==3){ ?>
    function ljds(userid,cc,level) {
        if(gxsz.length>0) {
            for (var i = 0; i < gxsz.length; i++) {
                var id = gxsz[i].uid;
                if (id == userid) {

                    $('.news_list').prepend("<li> <span class='lvls'>" + level + "级</span>  <span class='nicname'>" +gxsz[i].name + "</span><span class='inroom'>说:</span><span class='tips'><img src='<?php echo HTTP_URL; ?>images/offer.png'><p class='deep'>累计打赏</p>" + gxsz[i].score + "&nbsp; </span> <span class='news'>	" + cc + "</span> </li>");
                    if($('.news_list li').length > 20){$('.news_list li:last-child').remove();}

                }
            }
        }
    }

	<?php } ?>
	giftArray = Array();
	
    /* 一直播的礼物金币对算 */
    function updateGiftArray() {
        $.get('/app/yzbgift',function (data) {
            var  gfit = eval('(' + data + ')');
            giftArray = gfit.data.list; //礼物数组
        });
    };
	
	updateGiftArray();
	
	/* 从缓存中获取礼物金币数 */
	function getGiftCoin(id){
		
		if(giftArray.length > 0){
			var i=0;
            while(i<giftArray.length){
                if(giftArray[i].giftid == id){
					console.log("id:"+id+",名称:"+giftArray[i].name+",金币:"+giftArray[i].goldcoin);
                    return giftArray[i].goldcoin;
                }
                i++;
            };	
		}
		
		console.log('数组中没发现这个礼物'+id);
		return 0;	
			
	}


</script>

<script>
    /*
     时间计算器
     */

    var time = branch = second = 0;
    setInterval(function(){
        second++;

        if(second === 60){
            branch++;
            second = 0;
        };

        if(branch === 60){
            time++;
            branch = 0;
        };

        $('#redhacker').html('已记录'+time+':'+branch+':'+second);
		$('#duration').val(Number($('#duration').val())+1);
    }, 1000);
</script>
 <script>
     $((".news_list li").length).change(function(){

         $('.news_list li:last-child').css('margin-bottom','0.96rem')
     });


     $('#ds').click(function () {
         $("#dashang").css({"display":"block"});
         $("#fayan").css({"display":"none"});
         $("#liwu").css({"display":"none"});
     });

     $('#fy').click(function () {
         $("#dashang").css({"display":"none"});
         $("#fayan").css({"display":"block"});
         $("#liwu").css({"display":"none"});
     });
     $('#lw').click(function () {
         $("#dashang").css({"display":"none"});
         $("#fayan").css({"display":"none"});
         $("#liwu").css({"display":"block"});
     });


     $('#ss').click(function () {
         $("#aa").css({"display":"block"});
         $("#bb").css({"display":"none"});
     });

     $('#tj').click(function () {
         $("#bb").css({"display":"block"});
         $("#aa").css({"display":"none"});
     });
 </script>

<script>

    var canvas = $("#myChart").get(0);
    var ctx = canvas.getContext("2d");
	
	tabFlag = 0;
	
    // 初始化图像
	
	myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: [""],
                datasets: [{
					label: [""],
					data: [0],
					borderWidth: 1,
					backgroundColor: "rgba(75,192,192,0.4)",
					borderColor: "rgba(75,192,192,1)",
					pointBorderColor: "rgba(75,192,192,1)",
				}]
            },
            options: {
                title: {
                    display: false
                },
                tooltips: {
                    display: false
                },
                legend: {
                    display: false
                },
                scales: {
                    xAxes: [{
                        display: true
                    }]
                }
            }
        });


    // 画图
    function picture(datasets){
		
		datasets = datasets[tabFlag];
		
		//console.log(datasets);
		//console.log(myChart);
		//console.log(myChart.boxes);
		//console.log(myChart.boxes.datasets);

		
        myChart.data.labels=datasets[0].label;
		datasets[0].label = [];
		myChart.data.datasets=datasets;
		
        myChart.update();
		
		return;
		
        myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: datasets[0].label,
                datasets: datasets
            },
            options: {
                title: {
                    display: false
                },
                tooltips: {
                    display: false
                },
                legend: {
                    display: false
                },
                scales: {
                    xAxes: [{
                        display: true
                    }]
                }
            }
        });

//        function addData(obj,name,value){
//            obj.boxes.datasets[0].data.push(value);
//            obj.data.labels.push(name);
//            obj.update();
//
//        }

    }



    var initData = [
        [{
            label: [""],
            data: [0],
            borderWidth: 1,
            backgroundColor: "rgba(71,241,253,0.2)",
            borderColor: "rgba(71,241,253,1)",
            pointBorderColor: "rgba(71,241,254,1)",
        }],
        [{
            label: [""],
            data: [0],
            borderWidth: 1,
             backgroundColor: "rgba(78,153,254,0.2)",
            borderColor: "rgba(78,153,254,1)",
            pointBorderColor: "rgba(78,153,254,1)",
        }],
        [{
            label: [""],
            data: [0],
            borderWidth: 1,
             backgroundColor: "rgba(255,215,43,0.2)",
            borderColor: "rgba(255,215,43,1)",
            pointBorderColor: "rgba(255,215,43,1)",
        }],
        [{
            label: [""],
            data: [0],
            borderWidth: 1,
             backgroundColor: "rgba(254,57,113,0.2)",
            borderColor: "rgba(254,57,113,1)",
            pointBorderColor: "rgba(254,57,113,1)",
        }],
    ];

    window.setInterval(taxx, 10000);    // 60000   //一分钟执行一次
    var  ltline = new Array();       //聊天数组
    var  dssline = new Array(); //打赏数组
    var zfline  = new Array();//增粉数组
    var zxline  = new Array();//在线数组
    var timeline = new Array(); //获取时间
    function taxx() {
        var date =  new Date();
        var t    = date.getMinutes();
        var h    = date.getHours();
		var s    = date.getSeconds();
        var able = h+":"+t+":"+s;  //时间
        var  speak  = Number(document.getElementById("speak").innerHTML);    //聊天人数   1
        var  ds     = Number(document.getElementById("gold").innerHTML); //打赏
         var zf      = Number(document.getElementById("fan").innerHTML);   //增粉
        var online  = Number(document.getElementById("view").innerHTML);    //在线    0
		var dsr  = Number(document.getElementById("reward").innerHTML);    //打伤人数    0
        ltline.push(speak);
        dssline.push(ds);
        zfline.push(zf);
        zxline.push(online);
        timeline.push(able);

        initData[1][0].label=timeline;
        initData[1][0].data=ltline;

        initData[2][0].label=timeline;
        initData[2][0].data=dssline;

            initData[3][0].label=timeline;
        initData[3][0].data=  zfline;

            initData[0][0].label=timeline;
        initData[0][0].data=   zxline;
		
		picture(initData);
		
			saveData(online,speak,ds,zf,dsr);


    }
	
	function saveData(online,speak,gold,zf,dsrs){
		
		$.get('/app/saveData',{"platform":"<? echo $platformid; ?>","platformid":"<? echo $userid; ?>","liveid":"<? echo $live; ?>","online":online,"chat":speak,"gold":gold,"fans":zf,"goldfans":dsrs,},function (data) {
            console.log(data);
		});
			
	}
	
    picture(initData);

    // 点击切换
    var btn = $('button');
    btn.click(function(){
        if(btn.index(this) === 0){
			tabFlag = 0;
            //ctx.clearRect(0, 0, canvas.width, canvas.height)
            picture(initData);
        }else  if(btn.index(this) === 1){
            //ctx.clearRect(0, 0, canvas.width, canvas.height)
			tabFlag = 1;
            picture(initData);
        }else  if(btn.index(this) === 2){
            //ctx.clearRect(0, 0, canvas.width, canvas.height)
			tabFlag = 2;
            picture(initData);
        }  else {
            //ctx.clearRect(0, 0, canvas.width, canvas.height)
			tabFlag = 3;
            picture(initData);
        };
    });


    window.setInterval(livezhubo, 10000);


    window.setInterval(tests,2000);
    function tests() {

        //查看直播是否在榜单
        $.get('/app/bd',{},function (data) {
            var i;
            var data2;
            var reg = new RegExp("[\\u4E00-\\u9FFF]+","g");
            var h='<div class="top"> <img src="<?php echo HTTP_URL; ?>images/top11.png" style="margin-top:0;" >';
            console.log(data);
            if(data!='0'){
                data1 = eval('(' + data + ')');

                for( i=0; i<data1.length;i++){
                    data2 =data1[i];
                    for(var x in data2){
                        if(data2[x]=='-1'){
                            h+="热榜第<span>"+x +"</span>名,";
                        }
                        if(data2[x]=='-2'){
                            h+="推荐榜第<span>"+x +"</span>名,";
                        }else if(reg.test(data2[x])){
                            h+=data2[x]+"榜第<span>"+x +"</span>名,";
                        }

                    }

                }
                h=h.substring(0,h.length-1);
                h +="</div>";
                $(".rank").css('display','block');
                $(".rank").html(h);
            }else{
                $(".rank").css('display','none');
            }


        });

    }




    function livezhubo() {
        $.get('/app/livezhubo',{"userid":<?php echo $userid; ?>},function (data) {
            console.log(data);
            if(data == '1'){

//
//                //查看直播是否在榜单
//                $.get('/app/bd',{},function (data) {
//                    var i;
//                    var data2;
//                    var reg = new RegExp("[\\u4E00-\\u9FFF]+","g");
//                    var h='<div class="top"> <img src="<?php //echo HTTP_URL; ?>//images/top.png">';
//                    if(data){
//                        data1 = eval('(' + data + ')');
//
//                        for( i=0; i<data1.length;i++){
//                            data2 =data1[i];
//                            for(var x in data2){
//                                if(data2[x]=='-1'){
//                                    h+="热榜第<span>"+x +"</span>名,";
//                                }
//                                if(data2[x]=='-2'){
//                                    h+="推荐榜第<span>"+x +"</span>名,";
//                                }else if(reg.test(data2[x])){
//                                    h+=data2[x]+"榜第<span>"+x +"</span>名,";
//                                }
//
//                            }
//
//                        }
//                        h=h.substring(0,h.length-1);
//                        h +="</div>";
//                        $(".rank").css('display','block');
//                        $(".rank").html(h);
//                    }else{
//                        $(".rank").css('display','none');
//                    }
//
//
//                });


            }else {
                console.log('我没在直播啦');
                sendShareData();
            }
        });
    }

    function sendShareData(){

        var start_t = "<?php echo date("Y-m-d H:i:s") ?>"; //开播时间
        var duration = Number($('#duration').val()); //开播时长
        var maxnum = Number($('#maxnum').text());   //最高在线
        var follower = Number($('#fan').text());
        var gold =  Number($('#gold').text());
        if(typeof(income) == "undefined"){
          income = new Array();
        }

        var income_top = JSON.stringify(income);
		var giftlog = JSON.stringify(gift);

        console.log(gold);

        $.post('/app/saveLiveData',{"userid":61491104,"start_t":start_t,"duration":duration,"maxnum":maxnum,"follower":follower,"gold":gold,"income_top":income_top,"giftlog":giftlog},function (data) {
            if(data == ""){
                alert('保存失败，请联系管理员');
            }else{
                location.href = "/app/share/id/"+data;
            }
        });

    }



</script>







<?php require_once("common/footer.php"); ?>


</body>
</html>