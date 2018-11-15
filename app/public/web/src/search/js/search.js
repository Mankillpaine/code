/**
 * Created by Administrator on 2016/11/2 0002.
 */
'use strict';

var $ = require('jquery');

// 搜索展开其他
function searchOpen() {
	var ele = $('.search-screen .screen'),
		row = ele.find('.list-row'),
		selList = ele.find('.sel-list'),
		maxWidth = selList.width();

	// 遍历是否显示其他功能按钮
	selList.each(function() {
		var item = $(this).find('.list-item'),
			index = selList.index(this),
			curWidth = 0,
			isOpen = false,
			btn, triangle;
		
		// 循环判断是否超过了长度
		for (var n = 0; n < item.length; n++) {
			curWidth += item.eq(n).width() + 30;

			// 大于最大宽度就显示其他功能按钮
			if (curWidth > maxWidth) {
				btn = row.eq(index).find('.btn-other');
				triangle = row.eq(index).find('.ico-triangle');
				btn.show();

				// 绑定点击展开事件
				btn.click(function() {
					if (!isOpen) {
						selList.eq(index).css('height', 'auto');
						triangle.css('transform', 'rotate(180deg)');
					} else {
						selList.eq(index).css('height', '40px');
						triangle.css('transform', 'rotate(0deg)');
					};

					isOpen = !isOpen;
				});

				break;
			}
		};
	});
};
searchOpen();