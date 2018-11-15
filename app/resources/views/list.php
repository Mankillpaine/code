<html>
    <meta charset="UTF-8">
    <head>
        <title>周收入增量榜</title>
    </head>
    <body>
        <table border="1">
              <tr>
                  <th>平台</th>
                  <th>平台ID</th>
                  <th>昵称</th>
                  <th>金币收入</th>
                  <th>人民币收入</th>
                  <th>人民币收入_上周</th>
                  <th>收入增长速度</th>
                  <th>周增幅</th>
                  <th>总金币</th>
                  <th>个性介绍</th>
                  <th>认证信息</th>
              </tr>
            <?php foreach ($result as $key => $value){?>
                <tr>
                        <td><?php  echo $value->平台; ?></td>
                        <td><?php  echo $value->platformid; ?> </td>
                    <td><?php  echo $value->nickname; ?> </td>
                    <td><?php  echo $value->金币收入; ?> </td>
                    <td><?php  echo $value->人民币收入; ?> </td>
                    <td><?php  echo $value->人民币收入_上周; ?> </td>
                    <td><?php echo $value->收入增长速度;?></td>
                    <td><?php  echo $value->周增幅; ?> </td>
                    <td><?php  echo $value->总金币; ?> </td>
                    <td><?php  echo $value->intro; ?> </td>
                    <td><?php  echo $value->veri_info; ?> </td>

                </tr>

             <?php } ?>
        </table>
    </body>
</html>