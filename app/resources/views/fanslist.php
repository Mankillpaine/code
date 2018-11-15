<html>
    <meta charset="UTF-8">
    <head>
        <title>周粉丝增量榜</title>
    </head>
    <body>
        <table border="1">
              <tr>
                  <th>平台</th>
                  <th>平台ID</th>
                  <th>昵称</th>
                  <th>粉丝增加</th>
                  <th>周增幅</th>
                  <th>粉丝数</th>
                  <th>个性介绍</th>
                  <th>认证信息</th>
              </tr>
            <?php foreach ($result as $key => $value){?>
                <tr>
                        <td><?php  echo $value->平台; ?></td>
                        <td><?php  echo $value->platformid; ?> </td>
                    <td><?php  echo $value->nickname; ?> </td>
                    <td><?php  echo $value->粉丝增加; ?> </td>
                    <td><?php  echo $value->周增幅; ?> </td>
                    <td><?php  echo $value->follower; ?> </td>
                    <td><?php  echo $value->intro; ?> </td>
                    <td><?php  echo $value->veri_info; ?> </td>

                </tr>

             <?php } ?>
        </table>
    </body>
</html>