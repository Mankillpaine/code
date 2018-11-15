<?php get_header();?>
	<!-- content start -->
	<div class="content">
		<!-- <div class="arc_detail"> -->
		<div class="nav_name">
			<div class="nav_icon">
				<img src="<?php bloginfo('template_directory'); ?>/images/nav.png" >
			</div>
			<div class="navr_name"><?php $thiscat = get_category($cat); echo $thiscat ->name;?></div>
		</div>
		<div class="arc_list">
			<ul>
<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>
				<li>
					<div class="content-left">
						<span class="thumb">
							<img src="<?php echo get_template_directory_uri(); ?>/timthumb.php?src=<?php echo post_thumbnail_src(); ?>&h=142&w=240&zc=1" />
						</span>
					</div>
					<div class="content-right">
						<span class="news-title">
							<a href="<?php the_permalink(); ?>"><?php the_title_attribute(); ?></a>
						</span>
						<span class="athor">
							编辑/<?php echo get_the_author() ?>
						</span>
						<span class="time">
							<?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . '前'; ?>
						</span>
					</div>
				</li>
				<div class="clear"></div>
<?php endwhile; endif;?>
			</ul>
		<!-- </div> -->
		</div>
	
	</div>
	<!-- content end -->
	</div>

<?php get_footer();?>
<!-- web end -->
	<script type="text/javascript">
		// $(function() {
		// 	$('nav#menu').mmenu();
		// });
		$('.search').click(function(){
			$(".search_open").toggleClass("add");
		});

		// $(window).resize(function() { 
		// 			// 计算响应式比例
		// 	var number = document.documentElement.clientWidth / 750 * 625;

		// 	if(number < 625) document.getElementsByTagName('html')[0].style.fontSize = number +'%';
		// 	number = null;
		// });
window.onresize = function () {
			// 计算响应式比例
			var number = document.documentElement.clientWidth / 750 * 625;

			if(number < 625) document.getElementsByTagName('html')[0].style.fontSize = number +'%';
			number = null;
	

}

	</script>
<?php echo stripslashes( get_option( 'yj-tj' ) ); ?>
</body>
</html>