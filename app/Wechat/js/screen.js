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