webpackJsonp([3],[
/* 0 */
/***/ function(module, exports) {

	/**
	 * Created by Administrator on 2016/11/2 0002.
	 */
	'use strict';

	// 配置对象
	var configO = {
		// domain: 'http://www.itoubu.com',  // 生产服务域名
		domain: 'http://test.itoubu.com', // 测试服务域名
	};

	// 配置全局常量
	module.exports = {
		/**
		 * api地址
		 */
		'API_URL': configO.domain +'/',

		/**
		 * js地址
		 */
		'JS_URL': config.domain +'/app/public/web/static/js/',

		/**
		 * css地址
		 */
		'CSS_URL': config.domain +'/app/public/web/static/css/',

		/**
		 * img地址
		 */
		'IMG_URL': config.domain +'/app/public/web/static/images/'
	};

/***/ }
]);