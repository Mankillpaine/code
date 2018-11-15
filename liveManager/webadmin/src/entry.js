/**
 * Created by miaoyu on 2016/12/16 0016.
 */
// 导入全局样式
import './public/style/reset.less';
import './public/style/class.less';
import './public/style/animate.css';
import './public/style/ico.css';

// 导入全局配置项
import './config/env.config.js';
import './config/resource.config.js';

// 引入项目依赖块
import Vue from 'vue';
import store from './store/store.config.js';
import router from './config/router.config.js';


// 声明全局VM对象
var vm = new Vue({ router, store }).$mount('#app');




//import closeAin from './config/complete.config.js';
// 关闭开机动画
// 开机动画的执行时间是无法预料的，根据每个访问的带宽有关
//closeAin();