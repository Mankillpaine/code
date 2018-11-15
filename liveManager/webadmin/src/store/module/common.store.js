/**
 * Created by miaoyu on 2016/12/21 0021.
 */

// 暴露common-store信息
export default {
    state: {
        rtState: null, // 路由的当前状态，配合pageloading的service来完全页面切换的动效
    },
    mutations: {
        // 修改路由当前状态
        updateRtState: (state, currState) => state.rtState = currState
    }
};