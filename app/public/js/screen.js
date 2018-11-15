

	// 计算响应式比例
	var number = document.documentElement.clientWidth / 750 * 625;

	if(number < 625){
		document.getElementsByTagName('html')[0].style.fontSize = number +'%';
	}    else {
		document.getElementsByTagName('html')[0].style.fontSize = '625%';
	}

	number = null;







