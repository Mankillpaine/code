<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2016/11/28
 * Time: 15:20
 */
echo "manger"
//phpinfo();
 ?>


<html>
    <meta charset="utf-8">
    <head>
       <title>Manager</title>
    </head>
    <body>
    <form method="post" action="/liveManager/setexcel" enctype="multipart/form-data">
        <h3>导入Excel表：</h3>
        <input type="file" name="file" id="file" />
        <input type="submit"  value="导入" />
    </form>
    </body>
</html>
