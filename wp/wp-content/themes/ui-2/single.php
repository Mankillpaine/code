<?php get_header();?>
	<!-- content start -->
	<div class="content">
		<div class="arc_detail">
<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>
			<div class="de_head">
				<div class="de_title">
					<?php the_title_attribute(); ?>
				</div>
				<div class="de_note">

					<span class="de_author">编辑/<?php echo get_the_author() ?> </span>
					<span class="de_time"><?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . '前'; ?></span>
				</div>
			</div>
			<div class="de_content">
				<?php the_content("Read More..."); ?>
			</div>
			<?php   $custom_fields = get_post_custom_keys($post_id);if (!in_array ('bianji_value', $custom_fields)) : ?>
			<?php else: ?>
				<?php  $custom = get_post_custom($post_id);	$custom_value = $custom['bianji_value']; ?>
				<div class="bulid">文章来源：<?php echo get_post_meta($post->ID,"bianji_value",true);?></div>
			<?php endif; ?>

		</div>
<?php endwhile; endif;?>
	</div>
	<!-- content end -->
<?php
$user_id =  get_post_meta($post->ID,"zuozhe_value",true);
$blogusers = get_users( array( 'search' => $user_id ) );
?>

<?php  $tougaoren =  get_post_meta($post->ID,"tougaoren_value",true); if($tougaoren):?>




<?php   //$custom_fields = get_post_custom_keys($post_id);if (!in_array ('tougaoren_value', $custom_fields)) : ?>

<div class="bu_tor">

	<div class="butor">
		<div class="bu_thumbe">
			<?php echo get_avatar( get_the_author_email() );?>
		</div>
		<div class="bu_content">
			<div class="bu-top">
				<span class="bu_name"><?php echo get_the_author_meta( 'display_name', $user_id ) ?></span> / 特约撰稿人
			</div>
			<div class="bu-bottom">
						<span>
							<?php echo get_the_author_meta( 'description', $user_id ) ?>
						</span>
			</div>
		</div>
	</div>
</div>
<?php //}
endif;

// ?>
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