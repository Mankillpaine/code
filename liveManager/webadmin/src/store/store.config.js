/**
 * Created by miaoyu on 2016/12/16 0016.
 */
// vue前端仓库
import vue from 'vue';
import Vuex from 'vuex';
import api from './../config/api.config.js';
import common from './module/common.store.js';
import user from './module/user.store.js';

// 声明依赖
vue.use(Vuex);


// 配置store仓库信息
const option = {
	state: {
		api // api配置
	},
    modules: {
    	common, // 公共仓库
        user    // 用户仓库
    }
};


// 生成并导出store仓库
export default new Vuex.Store(option);