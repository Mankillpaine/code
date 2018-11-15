<!DOCTYPE html>
<html lang="zh-CN" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>直播</title>
    <link rel="stylesheet" type="text/css" href="<?php echo HTTP_URL; ?>boostrap/css/bootstrap-theme.css">
    <link rel="stylesheet" type="text/css" href="<?php echo HTTP_URL; ?>boostrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="<?php echo HTTP_URL; ?>css/wecss.css">
    <script type="text/javascript" src="<?php echo HTTP_URL; ?>js/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo HTTP_URL; ?>boostrap/js/bootstrap.js"></script>
    <script type="text/javascript" src="<?php echo HTTP_URL; ?>js/screen.js"></script>
    <script type="text/javascript" src="<?php echo HTTP_URL; ?>js/Chart.js"></script>
     <style>
         .regis ul li input{ width: 3.6rem;  }
         body{
             background-color:#f6fcff;
         }
     </style>
</head>
<body>
<div class="warpper">
        <div class="index_inco">
            <img src="<?php echo HTTP_URL; ?>images/logo.png">
        </div>
        <form action="login" method="post">
        <div class="regis">
            <ul>

                <li>
                    <span class="regis_name">手机号</span>
                    <input type="text" name="mobile" placeholder="请输入手机号" id="mobile">

                </li>
                <li>
                    <span class="regis_name">密码</span>
                    <input type="password" name="password" placeholder="请输入密码" id="password">
                </li>
            </ul>
            <div class="regis_btn"  >
<!--                <a href="/app/reg">忘记密码?</a>-->
                <input type="submit" name="submit" value="马上登录" class="button_y">
                <span>立即注册</span>
            </div>
        </div>
        </form>
        <div class="regis_bk">
            <img src="<?php echo HTTP_URL; ?>images/bg.png">
        </div>
    </div>

 </div>

</div>
<script type="text/javascript">

    window.onload=function () {
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
    $(".regis_btn span").click(function () {
        window.location.href="/app/reg";
    });


    $('.button_y').click(function () {
        if($("#mobile").val().length==0){
            alert('手机号不能为空');
            return false;
        }
        if($("#password").val().length==0){
            alert('密码不能为空');
            return false;
        }
        if($("#mobile").val().length!=11){
            alert('手机号码有误，请重新输入');
            return false;
        }


        var re = /^[0-9]+.?[0-9]*$/; //判断字符串是否为数字 //判断正整数 /^[1-9]+[0-9]*]*$/
        var nubmer = $("#mobile").val();
        if (!re.test(nubmer)) {
            alert("手机号码有误，请重新输入");
            return false;
        }



    });



</script>
<?php require_once("common/footer.php"); ?>

</body>
</html>