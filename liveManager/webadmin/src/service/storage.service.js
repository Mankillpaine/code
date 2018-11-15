/**
 * Created by miaoyu on 2016/12/16 0016.
 */

/**
 * 写入 storage 
 * 参数：
 * 		key(string/object) - 需要写入的键名或者一个对象
 * 		[value](all)       - 只有当 key 不为 object 的时候才需要传入写入的键值
 * 返回：
 * 		-
 */
export const saveStorage = function(key, value) {
	if (key instanceof Object) {
		// 传入对象写入 storage
		Object.keys(key).forEach(k => localStorage[k] = JSON.stringify(key[k]));
	} else {
		// 传入非对象写入 storage
		localStorage[key] = JSON.stringify(value);
	};
};


/**
 * 查询 storage
 * 参数：
 * 		key(string/array) - 需要查询的 storage 的键名或者查询包含键名的数组,传统all返回整个storage对象
 * 返回：
 * 		all，返回通用型数据
 */
export const findStorage = function(key) {
	let isArray = key instanceof Array;

	// 返回全部
	if (key === 'all') {
		let storageS = {};

		Object.keys(localStorage).forEach(k => {
			let val = localStorage[k];

			if (val) storageS[k] = JSON.parse(val);
		});

		return storageS;
	};

	// 传入数组查询集合 storage
	if (isArray) {
		let storageS = {};

		key.forEach(k => {
			let val = localStorage[k];

			if (val) storageS[k] = JSON.parse(val);
		});

		return storageS;
	};

	// 传入其他类型key查询
	if (!isArray) {
		let val = localStorage[key];

		if (val) return JSON.parse(val);

		return null;
	};
};


/**
 * 删除 storage
 * 参数：
 * 		key(string/array) - 需要删除的 storage 的键名或者删除包含键名的数组
 * 返回：
 * 		bollean，成功删除返回true
 */
export const delStorage = function(key) {
	let isArray = key instanceof Array;

	// 传入数组查询集合 storage
	if (isArray) key.forEach(k => delete localStorage[k]);

	// 传入其他类型key查询
	if (!isArray) delete localStorage[key];

	return true;
};


/**
 * 清空 storage
 * 备注：
 * 		该操作是危险操作，请慎重!
 * 返回：
 * 		bollean，成功清空返回true
 */
export const clearStorage = function() {
	Object.keys(localStorage).forEach(k => delete localStorage[k]);

	return true;
};


/**
 * 写入 session
 * 参数：
 * 		key(string/object) - 需要写入的键名或者一个对象
 * 		[value](all)       - 只有当 key 不为 object 的时候才需要传入写入的键值
 * 返回：
 * 		-
 */
export const saveSession = function(key, value) {	
	if (key instanceof Object) {
		// 传入对象写入 session
		Object.keys(key).forEach(k => sessionStorage[k] = JSON.stringify(key[k]));
	} else {
		// 传入非对象写入 session
		sessionStorage[key] = JSON.stringify(value);
	};
};


/**
 * 查询 session
 * 参数：
 * 		key(string/array) - 需要查询的 session 的键名或者查询包含键名的数组,传统all返回整个session对象
 * 返回：
 * 		all，返回通用型数据
 */
export const findSession = function(key) {
	let isArray = key instanceof Array;

	// 返回全部
	if (key === 'all') {
		let sessionS = {};

		Object.keys(sessionStorage).forEach(k => {
			let val = sessionStorage[k];

			if (val) sessionS[k] = JSON.parse(val);
		});

		return sessionS;
	};

	// 传入数组查询集合 session
	if (isArray) {
		let sessionS = {};

		key.forEach(k => {
			let val = sessionStorage[k];

			if (val) sessionS[k] = JSON.parse(val);
		});

		return sessionS;
	};

	// 传入其他类型key查询
	if (!isArray) {
		let val = sessionStorage[key];

		if (val) return JSON.parse(val);

		return null;
	};
};


/**
 * 删除 session
 * 参数：
 * 		key(string/array) - 需要删除的 session 的键名或者删除包含键名的数组
 * 返回：
 * 		bollean，成功删除返回true
 */
export const delSession = function(key) {
	let isArray = key instanceof Array;

	// 传入数组查询集合 session
	if (isArray) key.forEach(k => delete sessionStorage[k]);

	// 传入其他类型key查询
	if (!isArray) delete sessionStorage[key];

	return true;
};


/**
 * 清空 session
 * 备注：
 * 		该操作是危险操作，请慎重!
 * 返回：
 * 		bollean，成功清空返回true
 */
export const clearSession = function() {
	Object.keys(sessionStorage).forEach(k => delete sessionStorage[k]);

	return true;
};


// 暴露方法
export default {
	saveStorage, saveSession,
	findStorage, findSession,
	delStorage, delSession,
	clearStorage, clearSession
};