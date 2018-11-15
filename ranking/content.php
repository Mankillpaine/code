<html>
<meta charset="utf8">
<meta name="viewport" content="width=device-width initial-scale=1.0 maximum-scale=1.0 user-scalable=yes" />
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" type="text/css" href="css/css.css">
<link href="css/tab.css" rel="stylesheet" type="text/css" >
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/check.js"></script>
<script type="text/javascript" src="js/screen.js"></script>

<head>
    <title></title>
</head>
<?php
//        $sql = "SELECT a.*,users.`nickname`,users.`avatar`  from (select income_log.*  from `income_log` where `idate` = CURRENT_DATE()  and `platform` = ". $_GET['platform']. " order by `increase_rmb`   desc limit 100) as a inner join users on  `a`.`platform` =`users`.`platform`  and `a`.`platformid` =users.`platformid` ORDER BY `a`.`increase_rmb` DESC";
$servername = "rm-2ze2211tvnc3k0c0fo.mysql.rds.aliyuncs.com";
$username = "spider";
$password = "Toubu123";
$dbname = "star";

// 创建连接
$conn = new mysqli($servername, $username, $password, $dbname);
// 检测连接
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}

$rr = $_GET['num'];
 require 'public.php';
if($_POST)
{
   $company =  $_POST['company'];
   $product =  $_POST['product'];
   $keyword =  $_POST['keyword'];
   $username=  $_POST['username'];
   $mobile  =  $_POST['mobile'];
   $rr      =  $_POST['starid'];
    $len = strlen($rr);
    if($len >5){
        $plat = (int)substr($rr, 3, 2);
        $fix  = substr($rr, 0, 3); // 取到ID前三位
        $end_plat = substr($rr, 5, $len-5); //取到ID后五位
        $platformid = (int)($end_plat . $fix);

    }
    else{
        $plat = (int)substr($rr,-2);
        $platformid = (int)substr($rr,0,$len-2);
    }
    $sql = "INSERT INTO contact (company, product, keyword,username,mobile,platform,platformid) VALUE ('".$company."','".$product."','".$keyword."','".$username."','".$mobile."','".$plat."','".$platformid."')";
    $result = $conn->query($sql);
    if($result){
        echo "<script>alert('提交成功，我们会尽快与您联系！');history.go(-2);</script>";
    }
}



?>
<body>
<div class="wapper" id="page">

    <form method="post" action="" style="margin:0px;" onsubmit="return check()">
        <div style=" width:90%; -moz-border-radius: 12px; border-radius: 12px; background:#f6fbfd; border:1px #cacaca solid; margin:0 auto; margin-top:30px; padding-bottom:30px; margin-bottom: 30px;">
            <table border="0" align="center" cellpadding="0" cellspacing="0" style="width:90%; margin:0 auto;">
                <tr>
                    <td align="center" style="padding:24px; font-weight:bold;">联系主播</td>
                </tr>
                <tr>
                    <td style=" padding:12px; color:#999999;">请您填写几个小问题，让我们更了解您的营销需求，为您更精准的对接主播。</td>
                </tr>
                <tr>
                    <td style=" padding:12px;">1. 您企业所在的行业？ </td>
                </tr>
                <tr>
                    <td style=" padding:12px;"><label for="company"></label>
                        <input type="text" name="company" id="company" style="line-height:24px; border:1px #cacaca solid; width:80%;  -moz-border-radius: 5px; border-radius: 5px;">
                    </td>
                </tr>
                <tr>
                    <td style=" padding:12px;">2. 您要推广的产品？</td>
                </tr>
                <tr>
                    <td style=" padding:12px;"><label for="company"></label>
                        <input name="product" type="text" id="product" style="line-height:24px; border:1px #cacaca solid; width:80%;  -moz-border-radius: 5px; border-radius: 5px;" placeholder="如实物产品/服务/网站/APP等">
                    </td>
                </tr>
                <tr>
                    <td style=" padding:12px;"> 3. 您的营销关键词?</td>
                </tr>
                <tr>
                    <td style=" padding:12px;"><label for="company"></label>
                        <input name="keyword" type="text" id="keyword" style="line-height:24px; border:1px #cacaca solid; width:80%;  -moz-border-radius: 5px; border-radius: 5px;" placeholder="什么样的主播符合您的产品定位?">
                    </td>
                </tr>
                <tr>
                    <td style=" padding:12px;">
                        4. 您的称呼</td>
                </tr>
                <tr>
                    <td style=" padding:12px;"><label for="company"></label>
                        <input name="username" type="text" id="username" style="line-height:24px; border:1px #cacaca solid; width:80%;  -moz-border-radius: 5px; border-radius: 5px;" placeholder="您的称呼">
                    </td>
                </tr>
                <tr>
                    <td style=" padding:12px;">
                        5. 您的联系方式</td>
                </tr>
                <tr>
                    <td style=" padding:12px;"><label for="company"></label>
                        <input name="mobile" type="text" id="mobile" style="line-height:24px; border:1px #cacaca solid; width:80%;  -moz-border-radius: 5px; border-radius: 5px;" placeholder="您的常用手机号码">
                    </td>
                </tr>
                <tr>
                    <td style=" padding:12px; text-align:center;">
                        <input name="submit" type="submit" value="确认提交信息" style=" width:50%; display:block; line-height:32px; font-size:16px; border:1px #cccccc solid; background:#9CF; margin:0 auto; margin-top:20px;" >
                    </td>
                </tr>
            </table>
        </div>

        <input name="starid" type="hidden" value="<?php echo $rr  ?>">

    </form>

</div>

<!-- web end -->
<script type="text/javascript">

    window.onresize = function () {
        // 计算响应式比例
        var number = document.documentElement.clientWidth / 750 * 625;

        if(number < 625) document.getElementsByTagName('html')[0].style.fontSize = number +'%';
        number = null;
    }
    function  check() {
        if (document.getElementById('company').value.length == 0) {
            alert("请输入所在的行业!");

            return false;
        }
        if (document.getElementById('product').value.length == 0) {
            alert("请输入你要推广的产品!");
//            document.form.product.focus();
            return false;
        }
        if (document.getElementById('keyword').value.length == 0) {
            alert("请输入营销关键字!");
//            document.form.keyword.focus();
            return false;
        }
        if (document.getElementById('username').value.length == 0) {
            alert("请输入您的称呼!");
//            document.form.username.focus();
            return false;
        }
        if (document.getElementById('mobile').value.length == 0) {
            alert("请输入您的联系方式!");
//            document.form.mobile.focus();
            return false;
        }
        // var  s;
        // s = document.getElementById('mobile');

        // if(isNaN(s)){
        //     alert("请输入正确的联系方式");
        //     document.getElementById('mobile').value="";
        //     return false;
        // }


    }



</script>

<div style="display:none;">
<script language="javascript" type="text/javascript" src="http://js.users.51.la/18934637.js"></script>
<noscript><a href="http://www.51.la/?18934637" target="_blank"><img alt="&#x6211;&#x8981;&#x5566;&#x514D;&#x8D39;&#x7EDF;&#x8BA1;" src="http://img.users.51.la/18934637.asp" style="border:none" /></a></noscript>
</div>

</body>
</html>