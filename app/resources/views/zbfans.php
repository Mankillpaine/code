<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, target-densitydpi=device-dpi" />
    <title>粉丝统计</title>
    <link rel="stylesheet" type="text/css" href="<?php echo HTTP_URL; ?>boostrap/css/bootstrap-theme.css">
    <link rel="stylesheet" type="text/css" href="<?php echo HTTP_URL; ?>boostrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="<?php echo HTTP_URL; ?>css/wecss.css">
    <script type="text/javascript" src="<?php echo HTTP_URL; ?>js/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo HTTP_URL; ?>boostrap/js/bootstrap.js"></script>
    <script type="text/javascript" src="<?php echo HTTP_URL; ?>js/screen.js"></script>
    <script type="text/javascript" src="<?php echo HTTP_URL; ?>js/Chart.js"></script>

</head>
<body>
<div class="warpper"    id="bb">
    <div class="chart">
        <!--        <canvas id="myChart" style="width:100%; height:2.94rem; "></canvas>-->
        <canvas id="myChart" style="height:2.94rem;"></canvas>

    </div>
    <div class="rank_title">
        <ul>
            <li>日期</li>
            <li>粉丝</li>
            <li >增量</li>
        </ul>
    </div>
    <div class="zh_income">
        <ul>
            <?php  if(!isset($zbfans)) { ?>
                <li>
                    <span><?php echo date('m-d',time()); ?></span>
                    <span>0</span>
                    <span> 0</span>
                </li>


                <?php
            } else
            foreach ($zbfans as $key =>$value) {  ?>
                <li>
                    <span><?php echo $value->idate;  ?></span>
                    <span><?php echo $value->follower; ?></span>
                    <span> <?php echo $value->increase_follower; ?></span>
                </li>
            <?php    }  ?>
        </ul>
    </div>
</div>

<script>

    var ctx = $("#myChart").get(0).getContext("2d");

    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: [""],
            datasets: [{
                label: null,
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
                    display: false
                }]
            }
        }
    });


    function addData(obj,name,value){

        obj.data.datasets[0].data.push(value);
        obj.data.labels.push(name);
        obj.update();

    }
    <?php
   if(isset($zbfans)) {
    foreach ($zbfans as $key =>$value)
    {  ?>
    addData(myChart,"<?php echo $value->idate;  ?>",<?php echo $value->increase_follower; ?>);


    <?php    } } ?>


</script>
<script type="text/javascript">
    window.onload=function () {
        // 计算响应式比例
        var number = document.documentElement.clientWidth / 750 * 625;

        if(number < 625){
            document.getElementsByTagName('html')[0].style.fontSize = number +'%';
        }    else {
            document.getElementsByTagName('html')[0].style.fontSize = '625%';
        }

//        console.log(document.getElementsByTagName('html')[0].style.fontSize = '100px');

        number = null;
    }
</script>


<?php require_once("common/footer.php"); ?>


</body>
</html>