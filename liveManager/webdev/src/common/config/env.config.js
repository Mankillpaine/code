/**
 * Created by miaoyu on 2016/12/16 0016.
 */
import Vue from 'vue';

// base配置
const baseConfig = {
	optionMergeStrategies: { 			   // 定义全局策略
		constant: {			 			   //—— 定义全局常量策略
			"DOMAIN": process.env.DOMAIN,  //———— 网站域名
			"API_URL": process.env.API_URL //———— API域名
		}
	}	
};


// 测试环境配置
if (process.env.NODE_ENV === 'development') {
	// 如果为当前的环境为测试环境，就导入初始加载模板方便开发
	// 用requie是因为ES6的module并不支持判断引入，因为这是错误的语法
	require('./../index.html');

	// 并入Vue原始对象
	Object.assign(Vue.config, baseConfig);
};


// 生产环境配置
if (process.env.NODE_ENV === 'production') {
	const vueConfig = {    
		silent: true, 	 // 取消Vue的所有日志与警告
		devtools: false, // 禁止 vue-devtools 检查代码
	};

	// 并入Vue原始对象
	Object.assign(Vue.config, baseConfig, vueConfig);
};