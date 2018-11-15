<?php 	//输入数据

include( 'data.php' );

/*
$data=array(
	'top-title'=>array('title'=>'顶部','type'=>'line'),
	'text'=>array('title'=>'单行文本','type'=>'text','size'=>'60','maxlength'=>'60','value'=>'1','des'=>'描述文本1','tips'=>'气泡提示文字描述回答是开发过度使用速度恢复过来黑色的额佛山的'),
	'textarea'=>array('title'=>'多行文本','type'=>'textarea','width'=>'500px','height'=>'100px','value'=>'2','des'=>'描述文本2','tips'=>'气泡提示文字描述'),
	'password'=>array('title'=>'密码','type'=>'password','size'=>'60','maxlength'=>'6','value'=>'3','des'=>'描述文本3'),
	'radio'=>array('title'=>'单选','type'=>'radio','value'=>array('北京'=>'beijing','上海'=>'shanghai','广州'=>'guangzhou'),'tips'=>'气泡提示文字描述'),
	'checkbox'=>array('title'=>'多选','type'=>'checkbox','value'=>array('足球'=>'football','游泳'=>'swimming','跑步'=>'play'),'des'=>'描述文本3','tips'=>'气泡提示文字描述'),	
	'select'=>array('title'=>'列表','type'=>'select','value'=>array('陈奕迅'=>'富士山下','张学友'=>'情书','刘德华'=>'一起走过的日子'),'des'=>'描述文本3','tips'=>'气泡提示文字描述'),	
	'multiple'=>array('title'=>'菜单','type'=>'multiple','value'=>array('开心'=>'happy','伤心'=>'sad','愤怒'=>'angary'),'des'=>'描述文本3','tips'=>'气泡提示文字描述'),								
	'upload'=>array('title'=>'上传','type'=>'upload','size'=>'60','des'=>'描述文本4','tips'=>'气泡提示文字描述'),
	'upload-logo'=>array('title'=>'logo上传','type'=>'upload','size'=>'60','des'=>'描述文本4','tips'=>'气泡提示文字描述'),						
	'my_category'=>$args=array('title'=>'分类目录','type'=>'cat','des'=>'描述文本5','tips'=>'气泡提示文字描述'),
	'my_page'=>$args=array('title'=>'页面','type'=>'page','des'=>'描述文本6','tips'=>'气泡提示文字描述'),		
	'my_user'=>$args=array('title'=>'用户','type'=>'user','tips'=>'气泡提示文字描述'),	
	'hide'=>$args=array('type'=>'hidden','value'=>'10'),					
);
*/
?>

<?php 	
/* ------------------------------------------------------------------------------------------------------------------------------------------- */
//保存选项
	if($_POST['submit']){
		$DLB_seo=get_option( 'other-2' );
		if(!empty($data)){
			foreach($data as $key=>$result){
				if($result['type']=='line') continue;
				update_option($key,$_POST[$key]);
			}
		}
		$DLB_seo_new=get_option( 'other-2' );
		if( $DLB_seo_new[0] != $DLB_seo[0] ) echo '<script type="text/javascript">location.replace(location);</script>';		
	}
?>

<!------------------------------------------------------------------------------------------------------------------------------------------------>
<!--css代码-->
<style type="text/css" media="screen">
	#m_all div{min-width:80px;}
	.td{padding:5px;display:inline;vertical-align:middle;  
    display:table-cell; }
	.theme_options{width:800px;float: left;border: 1px solid #ccc;padding: 0px 0px 0px 10px;}
	.hidden{display:none;}
	div.th{text-align:left;font-weight:normal;padding-right:20px;color:#000;vertical-align:middle;  
    display:table-cell;}
	.des{color:#999;}
	img.tips{vertical-align:middle;display:block;}
	.img-tips{position:relative;}
	div.tips{display:none;background:#000;color:#fff;padding:10px;position:absolute;width:150px;height:auto;-webkit-border-radius:5px;border-radius:5px;border-width:1px;border-style:solid;z-index:10;}
	#head-title{margin-bottom:10px;}
	.line{background-color:#CCC;font-weight:bold;padding:3px;-webkit-border-radius:3px;border-radius:3px;}
	.htmbcl{left: 1000px;position: fixed;width: 360px;}
	#kz_neirong{float: left;margin-left: 20px;width: 332px;height: 200px;}
	.uk-panel-box {float: left;float: left;border: 1px solid #ccc;padding: 10px;margin-left: 20px;width: 310px;-webkit-border-radius: 3px;border-radius: 3px;}
	.nav-tab{}
	.nav-tab-active{}
	.nav-tab-wrapper{margin-bottom: 20px !important;}
</style>

<!----------------------------------------------------------------------------------------------------------------------------------------------->
<!--jquery代码-->
<script type="text/javascript">
	jQuery(document).ready(function($) {
		<?php foreach($data as $key=>$result):?>
		<?php if($result['tips']):?>
		$('<?php echo '#'.$key.'-img-tips' ?>').mouseover(function(){
			$('<?php echo '#'.$key.'-div-tips' ?>').fadeTo(500,0.6,function(){$('<?php echo '#'.$key.'-div-tips' ?>').css('display','block')});	
		});
		$('<?php echo '#'.$key.'-img-tips' ?>').mouseout(function(){
			$('<?php echo '#'.$key.'-div-tips' ?>').fadeOut(500,function(){$('<?php echo '#'.$key.'-div-tips' ?>').css('display','none');})
		});
		<?php endif;?>	
<?php if($result['type']=='upload'):?>
		$('<?php echo '#'.$key.'-button'; ?>').click(function() {
		 formfield = jQuery('<?php echo '#'.$key; ?>').attr('name');
		 tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
		 destination = '<?php echo $key ?>';
		 return false;
		});
<?php endif;endforeach;?>
		window.send_to_editor = function(html) {
			switch(destination)
			{		
<?php foreach($data as $key=>$result): if($result['type']=='upload'):?>		
				case '<?php echo $key ?>':
					 imgurl = jQuery('img',html).attr('src');
					 jQuery('<?php echo '#'.$key; ?>').val(imgurl);
				break; 	
<?php endif;endforeach;?>
			}
			tb_remove();
		}	
	});
jQuery(document).ready(function(){
	jQuery(function($){
	var hidden=$('#m_all .div-hidden'),tabs=$('#m_all .nav-tab');
	hidden.hide();
	hidden.first().show();
	tabs.on('click',function(){
		hidden.hide();
		tabs.removeClass('nav-tab-active');
		$(this).addClass('nav-tab-active');
		$(hidden[$(this).index()]).show();
		});
	});
});
</script>

<!------------------------------------------------------------------------------------------------------------------------------------------------>
<!--表单代码-->
​<div class="wrap">
	<div id="icon-themes" class="icon32"><br></div>
	<h2 id="head-title">Banner图设置</h2>
	<div class="theme_options">
		<form action="" method="post" class="" id="" name="">
		<div id="m_all" class="wrap">
			<h2 class="nav-tab-wrapper">
			<a class="nav-tab" href="javascript:;">Logo设置</a>
			<a class="nav-tab" href="javascript:;">观察频道轮播图 </a>
			<a class="nav-tab" href="javascript:;">首页轮播图</a>
			<a class="nav-tab" href="javascript:;">统计代码</a>
			<a class="nav-tab" href="javascript:;">SEO设置</a>
			</h2>
		<?php foreach($data as $key=>$result): switch($result['type']):?>
<?php case 'tab1':?>
<div id="tab-1" class="div-hidden">
<?php break;?>
<?php case 'tab2':?>
</div><div id="tab-2" class="div-hidden">
<?php break;?>
<?php case 'tab3':?>
</div><div id="tab-3" class="div-hidden">
<?php break;?>
<?php case 'tab4':?>
</div><div id="tab-4" class="div-hidden">
<?php break;?>
<?php case 'tab5':?>
</div><div id="tab-5" class="div-hidden">
<?php break;?>

<?php case 'text':?>
		<div>
			<div class="th"><?php echo $result['title']; ?></div>
			<div class="td">
				<input name="<?php echo $key;?>" type="text" class="text" id="<?php echo $key;?>" size="<?php echo $result['size']; ?>"  maxlength="<?php echo $result['maxlength'] ?>" <?php if(get_option($key)) echo 'value="'.stripslashes(get_option($key)).'"';else echo 'value="'.$result['value'].'"';?>/>
			</div>
			<?php if($result['tips']):?>	
			<div class="td"><div class="img-tips">	
				<img class="tips" id="<?php echo $key.'-img-tips' ?>" src="<?php echo bloginfo('template_url'); ?>/admin-option/help.png"/>
				<div class="tips" id="<?php echo $key.'-div-tips' ?>" ><?php echo $result['tips']; ?></div>
			</div></div>
			<?php endif;?>
		</div>
		<?php if($result['des']):?>
		<div><div></div><div class="des" id="<?php echo $key.'-des' ?>"><?php echo $result['des'] ?></div></div>
		<?php endif;?>
<?php break;?>

<?php case 'textarea':?>		
		<div>
			<div class="th"><?php echo $result['title']; ?></div>
			<div class="td">
				<textarea name="<?php echo $key;?>" class="textarea" id="<?php echo $key;?>" style="width:<?php echo $result['width']; ?>;height:<?php echo $result['height'];?>"><?php if(get_option($key)) echo stripslashes(get_option($key));else echo $result['value'];?></textarea>
			</div>
			<?php if($result['tips']):?>	
			<div class="td"><div class="img-tips" id="textarea-tips">	
				<img class="tips" id="<?php echo $key.'-img-tips' ?>" src="<?php echo bloginfo('template_url') ?>/admin-option/help.png"/>
				<div class="tips" id="<?php echo $key.'-div-tips' ?>" ><?php echo $result['tips']; ?></div>
			</div></div>
			<?php endif;?>
		</div>
		<?php if($result['des']):?>
		<div><div></div><div class="des" id="<?php echo $key.'-des' ?>"><?php echo $result['des'] ?></div></div>
		<?php endif;?>		
<?php break;?>

<?php case 'password':?>
		<div>
			<div class="th"><?php echo $result['title']; ?></div>
			<div class="td">
				<input name="<?php echo $key; ?>" type="password" class="password" id="<?php echo $key; ?>" size="<?php echo $result['size'] ?>" maxlength="<?php echo $result['maxlength'] ?>" value="<?php echo get_option($key); ?>"/>
			</div>
			<?php if($result['tips']):?>	
			<div class="td"><div class="img-tips">	
				<img class="tips" id="<?php echo $key.'-img-tips' ?>" src="<?php echo bloginfo('template_url') ?>/admin-option/help.png"/>
				<div class="tips" id="<?php echo $key.'-div-tips' ?>" ><?php echo $result['tips']; ?></div>
			</div></div>
			<?php endif;?>
		</div>
		<?php if($result['des']):?>
		<div><div></div><div class="des" id="<?php echo $key.'-des' ?>"><?php echo $result['des'] ?></div></div>
		<?php endif;?>		
<?php break;?>

<?php case 'radio':?>
		<div>
			<div class="th"><?php echo $result['title']; ?></div>
			<div class="td">
				<?php if(!empty($result['value'])): $i=1;foreach($result['value'] as $text=>$value): ?>
				<input name="<?php echo $key; ?>" type="radio" class="radio" id="<?php echo $key.'-'.$i++; ?>" value="<?php echo $value ?>" <?php if(get_option($key)==$value) echo 'checked';?> /><?php echo $text; ?>
				<?php endforeach;endif;?>
			</div>	
			<?php if($result['tips']):?>	
			<div class="td"><div class="img-tips">	
				<img class="tips" id="<?php echo $key.'-img-tips' ?>" src="<?php echo bloginfo('template_url') ?>/admin-option/help.png"/>
				<div class="tips" id="<?php echo $key.'-div-tips' ?>" ><?php echo $result['tips']; ?></div>
			</div></div>
			<?php endif;?>
		</div>
		<?php if($result['des']):?>
		<div><div></div><div class="des" id="<?php echo $key.'-des' ?>"><?php echo $result['des'] ?></div></div>
		<?php endif;?>		
<?php break;?>

<?php case 'checkbox':?>
		<div>
			<div class="th"><?php echo $result['title']; ?></div>
			<div class="td">
				<?php if(!empty($result['value'])): $i=1;foreach($result['value'] as $text=>$value): ?>
				<input name="<?php echo $key.'[]'; ?>" type="checkbox" class="checkbox" id="<?php echo $key.'-'.$i++; ?>" value="<?php echo $value; ?>" <?php $checkboxes=get_option($key); if(!empty($checkboxes)){foreach($checkboxes as $checkbox){if($checkbox == $value) echo 'checked';}}?> /><?php echo $text; ?>
				<?php endforeach;endif;?>
			</div>
			<?php if($result['tips']):?>	
			<div class="td"><div class="img-tips">	
				<img class="tips" id="<?php echo $key.'-img-tips' ?>" src="<?php echo bloginfo('template_url') ?>/admin-option/help.png"/>
				<div class="tips" id="<?php echo $key.'-div-tips' ?>" ><?php echo $result['tips']; ?></div>
			</div></div>
			<?php endif;?>
		</div>
		<?php if($result['des']):?>
		<div><div></div><div class="des" id="<?php echo $key.'-des' ?>"><?php echo $result['des'] ?></div></div>
		<?php endif;?>		
<?php break;?>

<?php case 'select':?>
		<div>
			<div class="th"><?php echo $result['title']; ?></div>
			<div class="td">
				<select name="<?php echo $key ?>" class="select" id="<?php echo $key ?>" >
				<?php $selects=$result['value'];if(!empty($selects)): foreach($selects as $text=>$value):?>
				<option value="<?php echo $value; ?>" <?php if(get_option($key)==$value) echo 'selected'?>><?php echo $text; ?></option>
				<?php endforeach;endif;?>
				</select>
			</div>
			<?php if($result['tips']):?>	
			<div class="td"><div class="img-tips">	
				<img class="tips" id="<?php echo $key.'-img-tips' ?>" src="<?php echo bloginfo('template_url') ?>/admin-option/help.png"/>
				<div class="tips" id="<?php echo $key.'-div-tips' ?>" ><?php echo $result['tips']; ?></div>
			</div></div>
			<?php endif;?>
		</div>
		<?php if($result['des']):?>
		<div><div></div><div class="des" id="<?php echo $key.'-des' ?>"><?php echo $result['des'] ?></div></div>
		<?php endif;?>		
<?php break;?>

<?php case 'multiple':?>
		<div>
			<div class="th"><?php echo $result['title']; ?></div>
			<div class="td">
				<select name="<?php echo $key.'[]' ?>" class="multiple" id="<?php echo $key ?>" multiple >
				<?php $selects=$result['value'];if(!empty($selects)): foreach($selects as $text=>$value):?>
				<option value="<?php echo $value; ?>" <?php $multiples=get_option($key); if(!empty($multiples)){foreach($multiples as $multiple){if($multiple==$value) echo 'selected';}}?>><?php echo $text; ?></option>
				<?php endforeach;endif;?>
				</select>
			</div>
			<?php if($result['tips']):?>	
			<div class="td"><div class="img-tips">	
				<img class="tips" id="<?php echo $key.'-img-tips' ?>" src="<?php echo bloginfo('template_url') ?>/admin-option/help.png"/>
				<div class="tips" id="<?php echo $key.'-div-tips' ?>" ><?php echo $result['tips']; ?></div>
			</div></div>
			<?php endif;?>
		</div>
		<?php if($result['des']):?>
		<div><div></div><div class="des" id="<?php echo $key.'-des' ?>"><?php echo $result['des'] ?></div></div>
		<?php endif;?>		
<?php break;?>

<?php case 'upload':?>
		<div>
			<div class="th"><?php echo $result['title']; ?></div>
			<div class="td"><input class="media-upload-text" id="<?php echo $key ?>" type="text" size="60" name="<?php echo $key ?>" <?php if(get_option($key)) echo 'value="'.get_option($key).'"';else echo 'value="'.$result['value'].'"';?> /><input id="<?php echo $key.'-button'; ?>" class="media-upload-button" type="button" value="上传图片" />
			</div>
			<?php if($result['tips']):?>	
			<div class="td"><div class="img-tips">	
				<img class="tips" id="<?php echo $key.'-img-tips' ?>" src="<?php echo bloginfo('template_url') ?>/admin-option/help.png"/>
				<div class="tips" id="<?php echo $key.'-div-tips' ?>" ><?php echo $result['tips']; ?></div>
			</div></div>
			<?php endif;?>
		</div>	
		<?php if($result['des']):?>
		<div><div></div><div class="des" id="<?php echo $key.'-des' ?>"><?php echo $result['des'] ?></div></div>
		<?php endif;?>		
<?php break;?>

<?php case 'cat':?>
		<?php if($_POST[$key]) $selected=$_POST[$key]; else $selected=get_option($key);$args=array('name'=>$key,'selected'=>$selected,'depth'=>0,'hierarchical'=>1,'show_option_all'=>'所有');?>
		<div>
			<div class="th"><?php echo $result['title']; ?></div>
			<div class="td"><?php wp_dropdown_categories($args);?></div>
			<?php if($result['tips']):?>	
			<div class="td"><div class="img-tips">	
				<img class="tips" id="<?php echo $key.'-img-tips' ?>" src="<?php echo bloginfo('template_url') ?>/admin-option/help.png"/>
				<div class="tips" id="<?php echo $key.'-div-tips' ?>" ><?php echo $result['tips']; ?></div>
			</div></div>
			<?php endif;?>			
		</div>
		<?php if($result['des']):?>
		<div><div></div><div class="des" id="<?php echo $key.'-des' ?>"><?php echo $result['des'] ?></div></div>
		<?php endif;?>		
<?php break;?>

<?php case 'bookmarks':?>
		<?php if($_POST[$key]) $selected=$_POST[$key]; else $selected=get_option($key);$args=array('name'=>$key,'selected'=>$selected,'depth'=>0,'hierarchical'=>1,'show_option_all'=>'无','taxonomy'=>'link_category');?>
		<div>
			<div class="th"><?php echo $result['title']; ?></div>
			<div class="td"><?php wp_dropdown_categories($args);?></div>
			<?php if($result['tips']):?>	
			<div class="td"><div class="img-tips">	
				<img class="tips" id="<?php echo $key.'-img-tips' ?>" src="<?php echo bloginfo('template_url') ?>/admin-option/help.png"/>
				<div class="tips" id="<?php echo $key.'-div-tips' ?>" ><?php echo $result['tips']; ?></div>
			</div></div>
			<?php endif;?>			
		</div>
		<?php if($result['des']):?>
		<div><div></div><div class="des" id="<?php echo $key.'-des' ?>"><?php echo $result['des'] ?></div></div>
		<?php endif;?>		
<?php break;?>

<?php case 'page':?>
		<?php if($_POST[$key]) $selected=$_POST[$key]; else $selected=get_option($key);$args=array('name'=>$key,'selected'=>$selected,'depth'=>0);?>
		<div>
			<div class="th"><?php echo $result['title']; ?></div>
			<div class="td"><?php wp_dropdown_pages($args);?></div>
			<?php if($result['tips']):?>	
			<div class="td"><div class="img-tips">	
				<img class="tips" id="<?php echo $key.'-img-tips' ?>" src="<?php echo bloginfo('template_url') ?>/admin-option/help.png"/>
				<div class="tips" id="<?php echo $key.'-div-tips' ?>" ><?php echo $result['tips']; ?></div>
			</div></div>
			<?php endif;?>		
		</div>
		<?php if($result['des']):?>
		<div><div></div><div class="des" id="<?php echo $key.'-des' ?>"><?php echo $result['des'] ?></div></div>
		<?php endif;?>		
<?php break;?>	

<?php case 'user':?>
		<?php if($_POST[$key]) $selected=$_POST[$key]; else $selected=get_option($key);$args=array('name'=>$key,'selected'=>$selected);?>
		<div>
			<div class="th"><?php echo $result['title']; ?></div>
			<div class="td"><?php wp_dropdown_users($args);?></div>
			<?php if($result['tips']):?>	
			<div class="td"><div class="img-tips">	
				<img class="tips" id="<?php echo $key.'-img-tips' ?>" src="<?php echo bloginfo('template_url') ?>/admin-option/help.png"/>
				<div class="tips" id="<?php echo $key.'-div-tips' ?>" ><?php echo $result['tips']; ?></div>
			</div></div>
			<?php endif;?>
		</div>
		<?php if($result['des']):?>
		<div><div></div><div class="des" id="<?php echo $key.'-des' ?>"><?php echo $result['des'] ?></div></div>
		<?php endif;?>		
<?php break;?>

<?php case 'editor':?>
		<div>
			<div class="th"><?php echo $result['title']; ?></div>
			<?php $settings=array('media_buttons'=>false,'textarea_rows'=>5);?>
			<div class="td"><?php wp_editor( stripslashes(get_option('')), $key, $settings );?></div>
			<?php if($result['tips']):?>	
			<div class="td"><div class="img-tips">	
				<img class="tips" id="<?php echo $key.'-img-tips' ?>" src="<?php echo bloginfo('template_url') ?>/admin-option/help.png"/>
				<div class="tips" id="<?php echo $key.'-div-tips' ?>" ><?php echo $result['tips']; ?></div>
			</div></div>
			<?php endif;?>			
		</div>
		<?php if($result['des']):?>
		<div><div></div><div class="des" id="<?php echo $key.'-des' ?>"><?php echo $result['des'] ?></div></div>
		<?php endif;?>		
<?php break;?>	

<?php case 'line':?>
		<div class="line"><div class="line-title" colspan="2"><?php echo $result['title']; ?></div></div>	
<?php break;?>	

<?php case 'hidden':?>
		<div class="hidden"><div><input name="<?php echo $key ?>" type="hidden" value="<?php echo $result['value'] ?>"/></div></div>	
<?php break;?>		
		
		<?php endswitch;endforeach;?>
		</div><div><div colspan="2"><?php submit_button();?></div></div>
		</div></form>
	</div>
</div>