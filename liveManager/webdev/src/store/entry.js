/**
 * Created by miaoyu on 2016/12/16 0016.
 */
// vue前端仓库
import Vue from 'vue';
import Vuex from 'vuex';

// 声明依赖
Vue.use(Vuex);


// 配置store仓库信息
let option = {
	state: {
		token: '123456'
	},
	mutations: {
		updateToken: (state, newToken) => state.token = newToken
	},
	actions: {
		updateTokenAsync: (context, newToken) => context.commit('updateToken', newToken)
	}
};


// 生成并导出store仓库
export default new Vuex.Store(option);