<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
    <title><?php wp_title( '|', true, 'right' ); ?>头部</title>
	<?php
	    if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' );
	    wp_enqueue_script( 'jquery' );
	    wp_head();
    ?>
	<meta name="viewport" content="width=device-width initial-scale=1.0 maximum-scale=1.0 user-scalable=yes" />
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/css/style.css">
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/css/css.css">
	<!-- <link href="css/css.css" id="css" rel="stylesheet" type="text/css" /> -->
	<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery.min.js"></script>
	<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/screen.js"></script>
	<link type="text/css" rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/jquery.mmenu.all.css" />
	<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery.mmenu.all.min.js"></script>
	<script type="text/javascript">
			$(function() {
			$('nav#menu').mmenu();
		});
	</script>
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/idangerous.swiper.css">
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/swiper-demos.css">
	<script src="<?php bloginfo('template_directory'); ?>/js/idangerous.swiper-1.9.1.min.js"></script>
	<script src="<?php bloginfo('template_directory'); ?>/js/idangerous.swiper.scrollbar-1.2.js"></script>
	<script src="<?php bloginfo('template_directory'); ?>/js/swiper-demos.js"></script>
    <?php echo stripslashes( get_option( 'hs-tj' ) ); ?>
</head>
<body>
<!--	<div class="content-wk">-->
<!-- web start -->
	<div class="wapper" id="page">
	<!-- head start -->
		<div class="header">
			<div class="menu">
				<a href="#menu"><img src="<?php bloginfo('template_directory'); ?>/images/menu.png" /></a>
			</div>
			<div class="log">
				<img src="<?php echo get_option( 'logo' ); ?>" />
			</div>
			<div class="search">
				<img src="<?php bloginfo('template_directory'); ?>/images/search.png" />
			</div>
		</div>
	<!-- head end -->
	<!-- search windows start -->
	<div class="search_open" >
		<form action="/" method="get">
			<div class="search_input">
				<input type="text" name="s" placeholder="请输入关键字搜索相关内容">
				<input type="submit" value="搜索">
			</div>
		</form>


<!--		<form action="/" method="get">-->
<!--			<input name="s" type="text" placeholder="网站检索" id="s" value="--><?// the_search_query(); ?><!--" />-->
<!--			<input name="sa" value="检索" type="image" src="--><?php //bloginfo('template_url'); ?><!--/images/search_icon.gif" align="top" class="btn" />-->
<!--		</form>-->

	</div>

	<!-- search windows end -->


	<!-- menu strat	 -->
		<nav id="menu">
			<ul>
				<?php if(function_exists('wp_nav_menu')) wp_nav_menu(array('container' => false, 'items_wrap' => '%3$s', 'theme_location' => 'main')); ?>
			</ul>
		</nav>
	<!-- menu end -->