/**
 * Created by miaoyu on 2016/12/16 0016.
 */
const 
	_ele = document.querySelector('title'),
	patt = /^(.+)\s-\s(.+)$/;


/**
 * 设置网页 title
 * 参数：
 * 		title(string) - 需要设置的 title信息
 * 返回：
 * 		-
 */
export const browserSet = function(title) {
	const prefix = patt.test(_ele.innerText) ? RegExp.$1 : '';

	_ele.innerText = `${prefix} - ${title}`;
};


/**
 * 获取网页 title
 * 参数：
 * 		-
 * 返回：
 * 		string，返回当前网页的title
 */
export const browserGet = function() {
	let title = _ele.innerText;

	return patt.test(title) ? RegExp.$2 : title;
};


// 暴露方法
export default { browserSet, browserGet };