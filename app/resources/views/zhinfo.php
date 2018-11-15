<!DOCTYPE html>
<html lang="zh-CN" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>主播信息页</title>
    <link rel="stylesheet" type="text/css" href="<?php echo HTTP_URL; ?>boostrap/css/bootstrap-theme.css">
    <link rel="stylesheet" type="text/css" href="<?php echo HTTP_URL; ?>boostrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="<?php echo HTTP_URL; ?>css/wecss.css">
    <script type="text/javascript" src="<?php echo HTTP_URL; ?>js/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo HTTP_URL; ?>boostrap/js/bootstrap.js"></script>
    <script type="text/javascript" src="<?php echo HTTP_URL; ?>js/screen.js"></script>
    <script type="text/javascript" src="<?php echo HTTP_URL; ?>js/Chart.js"></script>
    <script type="text/javascript" src="<?php echo HTTP_URL; ?>js/birthday.js"></script>
    <style>
        .regis ul li input{ width: 5.2rem;}
        body{background-color: #f6fcff !important;}
        @media (min-width: 760px) and (max-width: 1380px) {
            .regis ul li input{ width: 3.5rem;}
            .gender{
                width: 3.32rem;
            }
            .sel_year, .sel_month, .sel_day {
                width: 1.3rem;
                border: 0;
                height: 0.6rem;
                background-color: transparent;
                text-align: right;
            }
            .city_p, .cityname {
                width: 2rem;
                font-size: 0.28rem;
                height: 0.6rem;
                background-color: transparent;
                border: 0;
            }

        }
    </style>
</head>

<body>

<div class="warpper"id="aa">
    <form action="/app/info" method="post">
    <div class="upload_th">
        <img id="imgbox" src="<?php  if(isset($result)){ echo $result[0]->avatar; } else{
            $info  = json_decode($gxs);

            if($platformid ==1){

                if(!$info->dm_error) {
                    echo "http://img.meelive.cn/".$info->users[0]->user->portrait;
                };
            }else if($platformid ==7){
                echo $info->data->avatar;
            }else if($platformid ==3){
                echo $info->data->feeds[0]->feed->image;
            }

        } ?>"  onclick='window.frames[0].document.getElementById("up_btn").click();' />
        <input type="hidden"  name="avatar" value=" <?php  if(isset($result)){  echo $result[0]->avatar;} else{

            $info  = json_decode($gxs);
        if($platformid ==1){
            if(!$info->dm_error) {
                echo "http://img.meelive.cn/".$info->users[0]->user->portrait;
            };
        }else if($platformid ==7){
            echo $info->data->avatar;
        }else if($platformid ==3){
            echo $info->data->feeds[0]->feed->image;
        }
        } ?> " id="pic_url" />

        <iframe width="0" height="0" src="/qiniu_upload/upload.php?func=showimg" frameborder="0"></iframe>

    </div>
    <div class="regis" style="padding-top: 0.32rem;">

        <ul>
            <li> <input type="hidden" name="userid" value="<?php  echo $userid;?>">
                <input type="hidden" name="platformid" value="<?php echo $platformid;?>">
                <span class="regis_name">主播姓名</span>
                <input type="text" name="nickname"  value="<?php  if(isset($result)){ echo $result[0]->nickname;} else{

                    $info  = json_decode($gxs);
                if($platformid ==1) {
                    if (!$info->dm_error) {
                        echo $info->users[0]->user->nick;
                    };
                }else if($platformid ==7){
                    echo $info->data->nickname;
                } else if($platformid ==3){
                    echo   $info->data->feeds[0]->author->nickname;
                }
                } ?>">

            </li>
            <li>
                <span class="regis_name">主播性别</span>
                <select name="gender" class="gender">
                    <option value="0" <?php if(isset($result)){ if( $result[0]->gender == 0) echo " selected = 'selected' ";} else {
                        $info  = json_decode($gxs);
                    if($platformid ==1) {
                        if (!$info->dm_error) {
                            if ($info->users[0]->user->gender == 0) echo " selected = 'selected' ";
                        };
                    }else if($platformid ==7){
                         if($info->data->sex ==2){
                             echo  " selected = 'selected'";
                         }
                    }else if($platformid ==3){

                    }
                    } ?>>美人</option>
                    <option value="1"  <?php if(isset($result)){ if( $result[0]->gender ==1) echo " selected = 'selected' ";} else{
                        $info  = json_decode($gxs);
                        if($platformid == 1){
                        if(!$info->dm_error) {
                             if($info->users[0]->user->gender == 1) echo " selected = 'selected' " ;
                        };
                        }else if($platformid ==7){
                            if($info->data->sex ==1){
                                echo  " selected = 'selected'";
                            }
                        }
                    }  ?> >英雄</option>
                </select>
            </li>
            <li>
                <span class="regis_name">出生日期</span>
                 <input type="hidden" name="date"  id="date" value="">
                <select class="sel_year" rel="<?php if(isset($result)){ echo  date('Y',strtotime( $result[0]->birthday));  } else{

                    $info  = json_decode($gxs);
                    if($platformid == 1) {
                        if (!$info->dm_error) {
                            echo date('Y', strtotime($info->users[0]->user->birth));

                        };
                    }
                } ?>"></select>
                <select class="sel_month" rel="<?php if(isset($result)){  echo  date('m',strtotime( $result[0]->birthday)); } else{
                    $info  = json_decode($gxs);
                if($platformid == 1) {
                    if (!$info->dm_error) {
                        echo date('m', strtotime($info->users[0]->user->birth));

                    };
                }
                } ?>"></select>
                <select class="sel_day" rel="<?php if(isset($result)){ echo  date('d',strtotime( $result[0]->birthday)); } else{
                    $info  = json_decode($gxs);
                    if($platformid == 1) {
                        if (!$info->dm_error) {
                            echo date('d', strtotime($info->users[0]->user->birth));
                        };
                    }
                }?>"></select>


            </li>
            <li>
                <span class="regis_name">所在城市</span>
                <select name="city" class="city_p">
                    <?php if(isset($result)){ foreach ($city_parent as $key =>$value) { ?>
                    <option value="<?php echo $value->id;?> " <?php  if($result[0]->cityid == $value->id){echo "selected = 'selected'"; }   ?>  >
                        <?php  echo $value->province; ?></option>
                 <?php }  }else{ $info  = json_decode($gxs);
                        if($platformid == 1) {
                            if (!$info->dm_error) {
                                foreach ($city_parent as $key => $value) { ?>
                                    <option
                                        value="<?php echo $value->id; ?> " <?php if ($info->users[0]->user->location == $value->province) {
                                        echo "selected = 'selected'";
                                    } ?> ><?php echo $value->province; ?></option>
                                <?php }
                            };
                        } else{   foreach ($city_parent as $key => $value) { ?>
                            <option value="<?php  echo $value->id; ?> " <?php if($value->id ==2){echo  "selected = 'selected'"; }   ?>><?php echo $value->province; ?></option>

                            <?php
                        } }
                    };  ?>
                </select>

                 <select class="cityname" name="cityname">
                      <option></option>
                 </select>
            </li>
        </ul>
        <div class="regis_btn">
            <input type="submit" name="submit" value="保存个人资料" class="button_y">
        </div>
        </form>
    </div>
    <div class="regis_bk">
        <img src="<?php echo HTTP_URL; ?>images/bg.png">
    </div>


<script type="text/javascript">

    window.onload =function () {
        // 计算响应式比例
        var number = document.documentElement.clientWidth / 750 * 625;

        if(number < 625){
            document.getElementsByTagName('html')[0].style.fontSize = number +'%';
        }    else {
            document.getElementsByTagName('html')[0].style.fontSize = '625%';
        }

        number = null;
    } ;

</script>
<script type="text/javascript">


    //图片上传完成后的回调函数
    function showimg(url){
        //设置用于预览的img标签
        document.getElementById("imgbox").src = url;
        //设置用于表单提交的数据库表单字段
         document.getElementById("pic_url").value = url;
        console.log(document.getElementById("pic_url").src) ;
    }


</script>

<script>
    $(function () {
        $.ms_DatePicker({
            YearSelector: ".sel_year",
            MonthSelector: ".sel_month",
            DaySelector: ".sel_day"

        });
        $.ms_DatePicker();

          <?php if(isset($result)){     ?>
        var parent  = Number(<?php   if(isset($result[0]->cityid)) { echo  $result[0]->cityid; } else {echo 1; }?>);
            $.get('/app/cityname',{"parentid":parent},function (data) {
                if(data){
                data = eval('(' + data + ')');
                var leng="";
                for(var i=0; i<data.length;i++)
                {
                    leng +=("<option value="+data[i].id  +"> "+ data[i].city+ "</option>" );
                    if(data[i].id==<?php echo $result[0]->cityid; ?>){
                        leng +=  ("<option value="+data[i].id  + "selected='selected' > "+ data[i].city+ "</option>" );
                    }
                }
                $('.cityname').html(leng);
            }}) ;
    <?php  } else{ ?>
        var parent  = '2 ';
        $.get('/app/cityname',{"parentid":parent},function (data) {
            if(data){
            data = eval('(' + data + ')');
            var leng="";
            for(var i=0; i<data.length;i++)
            {
                leng +=("<option value="+data[i].id  +"> "+ data[i].city+ "</option>" );
             <?php    if($platformid == 1) {    ?>
                    if (data[i].city == "<?php echo $info->users[0]->user->location;  ?>") {
                        leng += ("<option value=" + data[i].id + "selected='selected' > " + data[i].city + "</option>" );
                    }
            <?php     }  ?>

            }
            $('.cityname').html(leng);
        }else {
                $('.cityname').html("<option>——</option>");
            }
        }) ;



        <?php     }      ?>
    });
</script>


<script>
    $('.sel_year').change(function () {
        var year      =($('.sel_year').children('option:selected').val());
        var month      =($('.sel_month').children('option:selected').val());
        var day       =($('.sel_day').children('option:selected').val());
        $('#date').val(year+ "-"+month+"-"+day);

    });
    $('.sel_month').change(function () {
        var year      =($('.sel_year').children('option:selected').val());
        var month      =($('.sel_month').children('option:selected').val());
        var day       =($('.sel_day').children('option:selected').val());
        $('#date').val(year+ "-"+month+"-"+day);
    });
    $('.sel_day').change(function () {
        var year      =($('.sel_year').children('option:selected').val());
        var month      =($('.sel_month').children('option:selected').val());
        var day       =($('.sel_day').children('option:selected').val());
        $('#date').val(year+ "-"+month+"-"+day);
    });

    <?php if(isset($result)){     ?>
    $('.city_p').change(function () {
      var parent  = ($(this).children('option:selected').val());
       $.get('/app/cityname',{"parentid":parent},function (data) {
           if(data==""){
               $('.cityname').html("<option>——</option>");
           }else {
               data = eval('(' + data + ')');
               var leng = "";
               for (var i = 0; i < data.length; i++) {
                   leng += ("<option value=" + data[i].id + "> " + data[i].city + "</option>" );
                   if (data[i].id ==<?php echo $result[0]->cityid; ?>) {
                       leng += ("<option value=" + data[i].id + "selected='selected' > " + data[i].city + "</option>" );
                   }
               }
               $('.cityname').html(leng);
           };
        }) ;
    });

    <?php } else {        ?>

    $('.city_p').change(function () {
        var parent  = ($(this).children('option:selected').val());

        $.get('/app/cityname',{"parentid":parent},function (data) {
            if(data ==""){
                $('.cityname').html("<option>——</option>");
            }else {
                data = eval('(' + data + ')');

                var leng = "";
                for (var i = 0; i < data.length; i++) {
                    leng += ("<option value=" + data[i].id + "> " + data[i].city + "</option>" );
                    <?php     if($platformid == 1) {     ?>
                    if (data[i].city == "<?php echo $info->users[0]->user->location;  ?>") {
                        leng += ("<option value=" + data[i].id + "selected='selected' > " + data[i].city + "</option>" );
                    }
                    <?php } ?>
                }
                $('.cityname').html(leng);
            }
        }) ;
    });




<?php } ?>



</script>

<?php require_once("common/footer.php"); ?>


</body>
</html>