
<html>
<meta charset="UTF-8">

<head>
    <title>  </title>

    <script src="http://cdn.bootcss.com/jquery/3.1.0/jquery.min.js"></script>
</head>
<body>
        <form method="post" action="reg">
            手机号：<input type="text" name="mobile" id="mobile" />    <input type="button" value="验证码" id="codes" >
            密码：<input type="password" name="password">
            验证码：<input type="text" name="code">
            <input type="submit" name="submit" value="确认">
        </form>
      <script>

         $('#codes').click(function(){
             var moblie = $('#mobile').val();
             $.get('sendRegcode',{"mobile":moblie},function (data) {
                console.log(data);
            });
         });

      </script>
</body>
</html>




