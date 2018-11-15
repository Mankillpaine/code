<!-- <div class="banner"> -->
			<div class="home-device">
		    <div class="swiper-main">
		      <div class="swiper-container swiper1">
		        <div class="swiper-wrapper">
				<?php for( $f=1; $f<=5; $f++ ): if( get_option( 'flash-'.$f ) ): ?>
		          <div class="swiper-slide"><a href="<?php echo get_option( 'url-'.$f ); ?>"> <img src="<?php echo get_option( 'flash-'.$f ); ?>" /></a></div>
				<?php endif; endfor; ?>
		        </div>
		      </div>
		    </div>
			<div class="pagination pagination1"></div>
		  </div>

		<!-- </div> -->