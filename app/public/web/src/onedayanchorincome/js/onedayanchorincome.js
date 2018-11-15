/**
 * Created by Administrator on 2016/11/2 0002.
 */
'use strict';

var $ = require('jquery');

// 搜索展开其他
function searchOpen() {
	var ele = $('.anchorcomindex-main-right .table-head'),
		selList = ele.find('.list-nav'),
		item = selList.find('.list-item'),
		btn = ele.find('.btn-other'), 
		triangle = ele.find('.ico-triangle'),
		maxWidth = selList.width(),
		curWidth = 0,
		isOpen = false;
		
	// 循环判断是否超过了长度
	for (var n = 0; n < item.length; n++) {
		curWidth += item.eq(n).width() + 38;

		// 大于最大宽度就显示其他功能按钮
		if (curWidth > maxWidth) {
			btn.show();

			// 绑定点击展开事件
			btn.click(function() {
				if (!isOpen) {
					selList.css('height', 'auto');
					triangle.css('transform', 'rotate(180deg)');
				} else {
					selList.css('height', '26px');
					triangle.css('transform', 'rotate(0deg)');
				};

				isOpen = !isOpen;
			});

			break;
		}
	};
};
searchOpen();