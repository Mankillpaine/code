/**
 * Created by miaoyu on 2016/12/21 0021.
 */
import { saveSession, findSession, delSession } from './../../service/storage.service.js';


// 获取session用户信息
// 根据type字段来区分要获取到的信息类别
const getUserInfo = function(type) {
    let info = findSession('userInfo');

    // 如果用户信息数组不存在，则返回null
    if (!info) return null;

    return info[type] || null;
};

// 暴露user-store信息
export default {
    state: {
        token: getUserInfo('token'),         // token信息
        companyId: getUserInfo('companyId'), // 商家id
        username: getUserInfo('username'),   // 用户名
        password: getUserInfo('password'),   // 密码
        validator: {                           // 规则验证
            phone: /^1[3|4|5|7|8][0-9]\d{8}$/, //—— 手机号验证规则
            pass: /^[a-z0-9]{8,16}$/,          //—— 密码验证规则
            code: /^[a-z0-9]{4,6}$/            //—— code验证规则
        }
    },
    mutations: {
        // 修改用户信息
        updateUserInfo: (state, info) => {
            if (!info) {
                // 修改状态储存
                state.token = null;
                state.companyId = null;
                state.username = null;
                state.password = null;

                // 删除储存信息
                delSession('userInfo');
            } else {
                // 修改状态储存
                state.token = info.token;
                state.companyId = info.companyId;
                state.username = info.username;
                state.password = info.password;

                // 储存到临时状态
                saveSession('userInfo', info);
            };
        }
    }
};