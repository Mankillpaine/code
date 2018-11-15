/**
 * Created by miaoyu on 2016/12/16 0016.
 */
// 导入全局样式
import './style/reset.less';
import './style/class.less';
import './style/ico.less';

// 导入全局配置项
import './config/env.config.js';

// 引入项目依赖块
import Vue from 'vue';
import router from './config/router.config.js';


// 声明全局VM对象
new Vue({ router }).$mount('#app');





//import closeAin from './config/complete.config.js';
// 关闭开机动画
// 开机动画的执行时间是无法预料的，根据每个访问的带宽有关
//closeAin();