<html>
<head>
    <title>榜单</title>
</head>
  <body>
  <script type="text/javascript" src="<?php echo HTTP_URL; ?>js/jquery.min.js"></script>
  <script>
      $.get('/app/bd',{},function (data) {
         console.log(data);

          data1 = eval('(' + data + ')');
             console.log(data1);
      });
  </script>
  </body>
</html>