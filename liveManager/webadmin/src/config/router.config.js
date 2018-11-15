/**
 * Created by miaoyu on 2016/12/16 0016.
 */
import vue from 'vue';
import VueRouter from 'vue-router';
import store from './../store/store.config.js';
import p_admin from './../view/admin.page.vue';
import p_login from './../view/login.page.vue';
import p_retrieve from './../view/retrieve.page.vue';
import p_404 from './../view/404.page.vue';
import p_debug from './../view/debug.page.vue';
import { config as liveCF } from './../view/live/router.config.js';
import { config as anchorCF } from './../view/anchor/router.config.js';
import { config as checkCF } from './../view/check/router.config.js';
import { config as guildCF } from './../view/guild/router.config.js';
import { openPgloading } from './../service/pageloading.service.js';

// 声明注入
vue.use(VueRouter);

// 测试页面
const debugPage = {
	path: 'debug',
	component: p_debug
};

// 定义路由配置
const routes = [
	{   // admin总路由
	    name: 'admin',
		path: '/admin',
	    alias: ['/', '/index'],
	    redirect: '/admin/todayall',
		component: p_admin,
		children: [...liveCF, ...checkCF, ...anchorCF, ...guildCF, debugPage]
		// liveCF.concat(checkCF).concat(anchorCF).concat(guildCF).concat(debugPage)
	}, 
	{   // 用户登陆路由         
		name: 'login',
		path: '/login',
		component: p_login
	}, 
	{   // 用户找回密码路由
		name: 'retrieve',
		path: '/retrieve',
		component: p_retrieve
	}, 
	{   // 404路由
		name: '404',
		path: '/*',
		component: p_404
	}
];


// 生成路由实例
const rTo = new VueRouter({ routes });


// 定义路由钩子 - 是否有权限进入到路由切换
rTo.beforeEach(({name}, from, next) => {
	const { token } = store.state.user;

	// 如果没有登陆的话，那么将跳转到登陆页面
	if (!token && name !== 'login' && name !== 'retrieve') {
		next({name: 'login'});
	} else {
		next();
	};
});


// 定义路由钩子 - 切换展开动画
rTo.beforeEach(({name}, from, next) => {
	// 这些页面
	if (name !== 'login' && name !== 'retrieve' && name !== '404') openPgloading();

	next();
});


// 导出路由实例
export default rTo;