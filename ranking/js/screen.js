//  $(function () {
//             //判断是否宽屏
//             var winWide = window.screen.width;
            
//             var wideScreen = false;
//             if (winWide <= 750) {//1024及以下分辨率
//                 $("#css").attr("href", "css/css.css");
                
//             } else {
//                 $("#css").attr("href", "css/main.css");
               
//                 wideScreen = true; //是宽屏
//             }
// })


		// $(window).on(function() { 
					// 计算响应式比例
			var number = document.documentElement.clientWidth / 750 * 625;

			if(number < 625) document.getElementsByTagName('html')[0].style.fontSize = number +'%';
			number = null;
		// });


		    var index = 0;
    // 默认高亮
    $('.list1-title a').eq(index).css('color', '#51a5fe');
    // 切换高亮
    $('.list1-title a').click(function(){
        index = $('.list1-title a').index(this);

        $('.list1-title a').css('color', '#8389a1').eq(index).css('color', '#51a5fe');
    });