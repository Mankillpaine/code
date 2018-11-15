<?php get_header();?>
	<!-- content start -->
	<div class="content">
		<div class="ser_no">
			<img src="<?php bloginfo('template_directory'); ?>/images/notfound.png" >
			<p>暂无相关内容</p>
		</div>
	
	</div>
	<!-- content end -->
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