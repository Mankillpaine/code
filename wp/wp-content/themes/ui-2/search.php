<?php get_header();?>
	<!-- content start -->
	<div class="content">
		<!-- <div class="arc_detail"> -->
		<div class="nav_name">
			<div class="nav_icon">
				<img src="<?php bloginfo('template_directory'); ?>/images/nav.png" >
			</div>
			<div class="navr_name">搜索结果</div>
		</div>
		<div class="arc_list">
			<ul>
           <?php if ( !have_posts() ) : ?> 
				<div class="ser_no">
					<img src="<?php bloginfo('template_directory'); ?>/images/notfound.png" >
					<?php _e('没有找到相关的内容'); ?></p>
				</div>
			<?php else: ?>
			<?php while(have_posts()) : the_post(); ?>
            <?php
            $title = get_the_title();
            $content = mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 600,"......");
            $keys = explode(" ",$s);
            $title = preg_replace('/('.implode('|', $keys) .')/iu','<span style="color:#ff4360;background:#fff;border:0;font-weight:normal;">\0</span>',$title);
            $content = preg_replace('/('.implode('|', $keys) .')/iu','<span>\0</span>',$content);
            ?>
				<li>
					<div class="content-left">
						<span class="thumb">
<!--							--><?php //wpjam_post_thumbnail(array(240,142),$crop=1);?>
							<img src="<?php echo get_template_directory_uri(); ?>/timthumb.php?src=<?php echo post_thumbnail_src(); ?>&h=142&w=240&zc=1" />
						</span>
					</div>
					<div class="content-right">
						<span class="news-title">
							<a href="<?php the_permalink(); ?>"><?php echo $title; ?></a>
						</span>
						<span class="athor">
							小编 /<?php echo get_the_author() ?>
						</span>
						<span class="time">
							<?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . '前'; ?>
						</span>
					</div>
				</li>
				<?php endwhile; ?>
				<div class="clear"></div>
                <?php endif; ?>
<!--						--><?php //{
//			echo '<div class="clearfix"></div><div class="post-read-more">';
//			next_posts_link('加载更多','');
//			echo '</div>';
//
//			}?>
			</ul>
		<!-- </div> -->
		</div>
	
	</div>
	<!-- content end -->
<?php get_footer();?>
	</div>
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