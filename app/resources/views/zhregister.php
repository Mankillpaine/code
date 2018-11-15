<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, target-densitydpi=device-dpi" />
    <title>注册</title>
    <link rel="stylesheet" type="text/css" href="<?php echo HTTP_URL; ?>boostrap/css/bootstrap-theme.css">
    <link rel="stylesheet" type="text/css" href="<?php echo HTTP_URL; ?>boostrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="<?php echo HTTP_URL; ?>css/wecss.css">
    <script type="text/javascript" src="<?php echo HTTP_URL; ?>js/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo HTTP_URL; ?>boostrap/js/bootstrap.js"></script>
    <script type="text/javascript" src="<?php echo HTTP_URL; ?>js/screen.js"></script>
    <script type="text/javascript" src="<?php echo HTTP_URL; ?>js/Chart.js"></script>
     <style>
         .regis ul li input{
             width: 3.6rem;
         }
         body{
             background-color: #f6fcff !important;
         }
     </style>
</head>
<body>
<div class="warpper"id="aa">
    <form  method="post" action="reg">
    <div class="regis">
        <ul>

                <li>
                    <span class="regis_name">手机号</span>
                    <input type="text" name="mobile" id="mobile" placeholder="请输入手机号" style="width: 2.5rem;">
<!--                    <button class="code" id="codes" type="button" style="width: 2rem;">发送验证码</button>-->
                </li>
                <li>
                    <span class="regis_name">设置密码</span>
                    <input type="password" name="password" placeholder="请输入密码" id="password">
                </li>
<!--                <li>-->
<!--                    <span class="regis_name">验证码</span>-->
<!--                    <input type="text" name="code" placeholder="请输入验证码" id="code">-->
<!--                </li>-->

        </ul>
        <div class="regis_btn">

            <input type="submit" name="submit" value="完成注册" class="button_y">

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


    $('#codes').click(function(){
        
		var mobile = $('#mobile').val();
		
		if(mobile == ""){
			alert('手机号不能为空');
			return false;	
		}
        $.get('/app/sendRegcode',{"mobile":mobile},function (data) {
            data = eval( "(" + data + ")" );
			if(data.code == "0"){
				alert('短信发送成功 : ' + data.msg);	
			}else{
				alert('短信发送失败 : ' + data.detail);	
			}
        });
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
//        if($("#code").val().length==0){
//            alert('验证码不能为空');
//            return false;
//        }
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