<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, target-densitydpi=device-dpi" />
    <title>平台验证</title>
    <link rel="stylesheet" type="text/css" href="<?php echo HTTP_URL; ?>boostrap/css/bootstrap-theme.css">
    <link rel="stylesheet" type="text/css" href="<?php echo HTTP_URL; ?>boostrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="<?php echo HTTP_URL; ?>css/check.css">
    <script type="text/javascript" src="<?php echo HTTP_URL; ?>js/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo HTTP_URL; ?>boostrap/js/bootstrap.js"></script>
    <script type="text/javascript" src="<?php echo HTTP_URL; ?>js/screen.js"></script>
    <script type="text/javascript" src="<?php echo HTTP_URL; ?>js/Chart.js"></script>

</head>
<body>
<div class="warpper"    id="bb">
    <div class="content">
        <div class="container">
            <p>
                <label for="selPlatform">直播平台</label>
                <select class="seloption" name="platformid">
                    <option value="1">映客</option>
                    <option value="7">一直播</option>
                    <option value="3">花椒</option>
                </select>
            </p>
            <p>
                <label for="platformID">平台ID</label>
                <input type="text" class="platformID" id="platid"  name="platid" placeholder="您在直播平台的主播ID">
            </p>
            <p>
                <span class="button btn-submit">验证主播身份</span>
            </p>
            <p>
            	<span class="button btn-close reset">暂时跳过验证,进入首页</span>
            </p>
        </div>
    </div>
    
    <article class="alert-box1 hide ">
        <div class="container">
            <dl>
                <dt>如何验证我的身份？</dt>
                <dd>
                    <span>请登录直播APP，修改您的个人信息，在个人介绍中添加“主播小秘书<b class="codeid"><?php echo $userid; ?></b>”。</span>
                    <span>保存个人信息后，点击下方按钮开始验证。</span>

                    <div id="tipbox" style="display: none;">
                        <span style="text-align: center; margin-top: 0.54rem;"><img src="/app/public/images/warning.png" style="display: inline-block;   width: 0.58rem;   height: 0.58rem;}"></span>
                        <span>没有在您映客个人信息中检测到“主播小秘书<b class="codeid"><?php echo $userid; ?></b>”，请检查填写是否正确，然后点击按钮重新验证。</span>
                    </div>

                </dd>
            </dl>
            <span class="button btn-validate">已填写，马上验证</span>
            <span class="button btn-close quite">退出验证</span>
        </div>
    </article>
    <article class="regis_bk">
        <img src="<?php echo HTTP_URL; ?>images/bg.png">
    </article>
</div>

<script type="text/javascript">
    /*
    退出
     */
    $('.quite').click(function () {
        $(this).parents('article').removeClass('show').addClass('hide');
		$('#tipbox').hide();
    });
    /*
    跳转回首页
     */
   $('.reset').click(function () {
       window.location.href="/app/zbindex";
   });


    $('.btn-submit').click(function () {
		
		if($("#platid").val() == ""){
			alert('请输入您在直播平台的主播id');
			return false;	
		}
		
		$('.alert-box1').addClass("show").removeClass("hide");
		


    });

    $('.btn-validate').click(function () {

        var platid = document.getElementById('platid').value;
        var sr  = $(".seloption  option:selected").val();
        $.get('/app/checkplat',{'userid':platid,'platid':sr},function (data) {
            if(sr ==1) {
             data = eval('(' + data + ')');
				if(data.users[0].user.description.indexOf('主播小秘书<?php echo $userid; ?>')>-1){
					alert('验证成功，快完善您的主播资料吧');
					window.location.href='/app/info?userid='+platid+'&platid='+sr;
				}else {
					$('#tipbox').show();
				}
            }else  if(sr ==7) {
                data = eval('(' + data + ')');
                if(data.data.desc.indexOf('主播小秘书<?php echo $userid; ?>')>-1) {
                    window.location.href='/app/info?userid='+platid+'&platid='+sr;
                }else {
                    $('#tipbox').show();
                }
            } else  if(sr ==3) {
				
                data = eval('(' + data + ')');
                console.log(data);
				
				if(data.data.feeds.length>0){
					if(data.data.feeds[0].author.verifiedinfo.credentials.indexOf('主播小秘书<?php echo $userid; ?>')>-1){
						window.location.href='/app/info?userid='+platid+'&platid='+sr;
					}else {
						$('#tipbox').show();
					}
				}else{
					alert('请在第一次直播结束后，再进行主播身份验证');	
				}
				
            }  else{
                alert('网络错误，请联系管理员');
            }
        } );
    });

</script>



</body>
</html>