/**
 * Created by miaoyu on 2016/12/16 0016.
 */
import './../public/style/pageloading.less';

const config = {
	idName: 'tem-pageloading', // 容器的名称
	navW: 250,				   // 导航默认的宽度
	headH: 60,  			   // 头部默认的高度
	delay: 200				   // 延迟时间
};


// 创建动画容器
const create = function() {
	const 
		ele = document.createElement('article'),
		aniCont = document.createElement('div'),
		width = window.innerWidth,
		height = window.innerHeight;


	// 遍历5个动画条
	for (let n = 0; n < 5; n++) {
		const line = document.createElement('div');

		line.className = 'pageloading-line fl';

		aniCont.appendChild(line);
	};
	aniCont.className = 'pageloading-cont';


	// 完善容器节点信息
	ele.id = config.idName;
	ele.style.width = `${width - config.navW}px`;
	ele.style.height = `${height - config.headH}px`;
	ele.appendChild(aniCont);

	// 延迟以后在插入
	setTimeout(() => document.body.appendChild(ele), config.delay);

	return ele;
};


// 打开加载页面login层
export const openPgloading = function() {
	const ele = document.getElementById(config.idName) || create();

	// 显示区块
	ele.style.zIndex = 10;
	ele.style.opacity = 1;
};


// 关闭加载页面login层
export const closePgloading = function() {
	let ele = document.getElementById(config.idName);

	if (!ele) {
		setTimeout(() => {
			ele = document.getElementById(config.idName);

			ele.style.zIndex = -1;
			ele.style.opacity = 0;
		}, config.delay);
	} else {
		ele.style.zIndex = -1;
		ele.style.opacity = 0;
	};
};


// 暴露默认对象
export default {
	openPgloading,
	closePgloading
};