/**
 * Created by miaoyu on 2016/12/16 0016.
 */

// 获取指定格式时间
const getDesignatedTime = function({year, month, day, hours, minute, second}, format) {
	// 自动补全2位
	const comTwo = str => {
		if (str.length === 1) return `0${str}`;
		return str;
	};

	const 
		patt     = /^(y{0,4})([^a-zA-Z0-9]?)(M{0,2})([^a-zA-Z0-9]?)(d{0,2})(\s?)(h{0,2})([^a-zA-Z0-9]?)(m{0,2})([^a-zA-Z0-9]?)(s{0,2})$/,
		result   = patt.exec(format),
		_y       = result[1],
		_M       = result[3],
		_d       = result[5],
		_h       = result[7],
		_m       = result[9],
		_s       = result[11];

	let reStr  = '';


	// 根据判断写出：年？月？日？时？分？秒？
	if (_y) reStr += `${year.slice(-_y.length)}${result[2]}`;
	if (_M) reStr += `${comTwo(month.slice(-_M.length))}${result[4]}`;
	if (_d) reStr += `${comTwo(day.slice(-_d.length))}${result[6]}`;
	if (_h) reStr += `${comTwo(hours.slice(-_h.length))}${result[8]}`;
	if (_m) reStr += `${comTwo(minute.slice(-_m.length))}${result[10]}`;
	if (_s) reStr += `${comTwo(second.slice(-_s.length))}`;	

	return 	reStr;
};


/*
 * 字符串时间日期过滤器
 * 备注：
 * 		该过滤器的第一个参数必须是完整的时间格式，如：2017-11-13 11:11:11
 * 参数：
 * 		dateStr(string) - 需要转换的时间
 * 		format(string) - 转为后的时间格式：y - 年，M - 月，d - 日，h - 时，m - 分，s - 秒
 * 	返回：
 * 		string，转换后指定的时间日期格式
 */
export const dateStrFilter = function(dateStr, format) {
	const 
		patt   = /^(\d{0,4})([^a-zA-Z0-9]?)(\d{0,2})([^a-zA-Z0-9]?)(\d{0,2})(\s?)(\d{0,2})([^a-zA-Z0-9]?)(\d{0,2})([^a-zA-Z0-9]?)(\d{0,2})$/,
		result = patt.exec(dateStr),
		dateS  = {
			year: result[1],
			month: result[3],
			day: result[5],
			hours: result[7],
			minute: result[9],
			second: result[11]
		};

	return getDesignatedTime(dateS, format);
};


/*
 * 时间戳时间日期过滤器
 * 备注：
 * 		该过滤器的第一个参数必须是完整是时间戳
 * 参数：
 * 		num(number / string) - 需要转换的时间戳
 * 		format(string) - 转为后的时间格式：y - 年，M - 月，d - 日，h - 时，m - 分，s - 秒
 * 	返回：
 * 		string，转换后指定的时间日期格式
 */
export const dateNumFilter = function(num, format) {
	const 
		currDate = new Date(Number(num)),
		dateS = {
			year: currDate.getFullYear().toString(), 
			month: (currDate.getMonth() + 1).toString(), 
			day: currDate.getDate().toString(), 
			hours: currDate.getHours().toString(), 
			minute: currDate.getMinutes().toString(), 
			second: currDate.getSeconds().toString()
		};

	return getDesignatedTime(dateS, format);
};


// 暴露默认方法
export default { dateStrFilter, dateNumFilter };