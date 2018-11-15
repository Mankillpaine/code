/**
 * Created by miaoyu on 2016/12/16 0016.
 */
import Vue from 'vue';
import VueRouter from 'vue-router';
import admin from './../components/admin.vue';
import {config as liveConfig} from './../../live/router.config.js';

// 声明注入
Vue.use(VueRouter);


// 定义路由配置
const routes = [{
    name: 'admin',
	path: '/admin',
    alias: ['/', '/index'],
	component: admin,
	children: liveConfig
}, {
	path: '/404',
	// component: 
}];


// 生成路由实例
const rTo = new VueRouter({ routes });


// 导出路由实例
export default rTo;