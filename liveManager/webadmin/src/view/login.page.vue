/**
 * Created by miaoyu on 2016/12/20 0020.
 */
<template>
    <div id="p-login" class="h-100 rel hidden">
        <div class="ly-block ly-1210 abs">
            <div class="ly-cont rel">
                <section class="ly-form abs">
                    <p class="form-phone form-input" 
                      :class="{error: !phone.validator && phone.val !== null}">
                        <label class="ico icon-home c-pointer fl" for="login-phone"></label>
                        <input id="login-phone" type="text" class="fl font-14 color-black" 
                               v-model="phone.val" placeholder="手机号">
                    </p>
                    <p class="form-pass form-input" 
                       :class="{error: !pass.validator && pass.val !== null}">
                        <label class="ico icon-home c-pointer fl" for="login-pass"></label>
                        <input id="login-pass" type="password" class="fl font-14 color-black"
                               v-model="pass.val" 
                               @keyup.enter="submit()" placeholder="密码">
                    </p>
                    <p class="form-submit form-button hidden">
                        <button type="submit" class="wh-100 font-14 color-white" 
                                :disabled="!validate"
                                @click="submit()">登录</button>
                    </p>
                    <p class="form-other text-right">
                        <router-link class="font-14" to="/retrieve">忘记密码？</router-link>
                    </p>
                </section>
            </div>
        </div>
        <!-- 弹出框 -->
        <co-popup :openPopup="popup.show" 
                  :btnCon="popup.btnCon"
                  :btnCan="popup.btnCan"
                  v-on:closePopup="isOpenPopup">
            {{popup.content}}
        </co-popup>
    </div>
</template>


<script>
import store from './../store/store.config.js';
import coPopup from './../components/popup.vue';


// 判断表单验证是否通过
function validatorForm(valS) {
    let index = 0;

    valS.forEach( ({ validator } = val) => {
        if (validator) index++;
    });

    // 如果验证成功返回true 失败则返回 false
    if (index === valS.length) return true;
    return false;
};


// 定义组件vm
const vm = {
    // 进入路由之前开始验证的钩子操作
    beforeRouteEnter (to, from, next) {
        const { token } = store.state.user;

        // 如果已经登陆成功了，那么就跳转首页
        if (token) {
            next(vm => vm.$router.push({ path: '/index' }));
        } else {
            next();
        };
    },
    data: () => ({
        phone: {             // 手机数据 / 是否验证通过
            val: null, //—— 手机号
            validator: false //—— 手机号是否验证通过
        },
        pass: {              // 密码数据 / 是否验证通过
            val: null, //—— 密码
            validator: false //—— 密码是否验证通过
        },
        validate: false, // 表单是否验证通过
        popup: {                   // 弹出框控件
            show: false,           //—— 是否弹出框
            content: '',           //—— 弹出框的文本内容
            btnCon: {              //—— 确认按钮配置
                show: true,        //—— 是否显示按钮
                text: '确定',      //—— 按钮名称
                cb: (vm, next) => next() //—— 执行函数内部的next回调
            }
        }
    }),
    watch: {
        // 手机号验证成功修改标示
        ['phone.val'](curr) {
            this.phone.validator = this.$store.state.user.validator.phone.test(curr) ? true : false;
            
            // 判断表单数据是否全部合法
            this.validate = validatorForm([this.phone, this.pass]);
        },
        // 密码验证成功修改标示
        ['pass.val'](curr) {
            this.pass.validator = this.$store.state.user.validator.pass.test(curr) ? true : false;
            
            // 判断表单数据是否全部合法
            this.validate = validatorForm([this.phone, this.pass]);
        }
    },
    methods: {
        // 提交验证
        submit() {
            const
                vm = this, 
                {   
                    state: {api: {user: {login: API_LOGIN}}},
                    commit
                } = vm.$store;

            // 查询参数
            let query = {
                username: this.phone.val,
                password: this.pass.val
            };

            // 请求登陆接口
            vm.$http.post(API_LOGIN, query).then(({body: {data}}) => {
                // 登陆成功存储用户信息
                commit('updateUserInfo', Object.assign(data, query));

                // 登陆成功跳转首页
                vm.$router.push('/index');
            }, ({body: {msg}}) => {
                // 登陆失败弹窗
                vm.popup.show = true;
                vm.popup.content = msg

                // 删除储存信息
                commit('updateUserInfo', null);
            });        
        },
        // 是否关闭弹出框
        // 如果组件内部返回false就是关闭遮罩层
        isOpenPopup(close) {
            if (close === false) {
                this.popup.show = false;
            } else {
                this.popup.show = true;
            };
        }
    },
    components: { coPopup }
};


// 暴露组件配置
export default Object.assign({ name: 'p-login' }, vm);
</script>


<style lang="less" scoped>
    #p-login {
        min-height: 448px;
        background: #05bcd4;

        /*布局区块*/
        .ly-block {
            top: 50%;
            left: 50%;
            height: 448px;
            transform: translate(-50%, -50%)
        }
        .ly-cont {
            height: 623px;
            background: url(../public/images/login-bg.png) no-repeat center bottom;
        }

        /*表单*/
        .ly-form {
            left: 50%;
            width: 382px;
            height: 432px;
            margin-left: -191px;
            border-radius: 6px;
            background: #fff url(../public/images/login-form-bg.png) no-repeat;
        }
        .ico {
            width: 48px;
            height: 48px;
            color: #05bcd4;
            font-size: 22px;
            line-height: 48px;
        }
        .form-button,
        .form-input,
        .form-other {
            margin-left: 40px;
            margin-right: 40px;
            border-radius: 6px;
        }
        .form-input {
            height: 48px;
            border: 1px solid #05bcd4;
            
            &.error {
                border: 1px solid #ff576f;
            }

            input {
                width: 218px;
                height: 16px;
                padding: 16px 0;
                line-height: 16px;
                text-indent: 0;
            }
        }
        .form-phone {
            margin-top: 150px;
        }
        .form-pass {
            margin-top: 20px;
        }
        .form-button {
            height: 40px;
            margin-top: 20px;

            button {
                background: #05bcd4;
            }
            button[disabled] {
                background: #aaa;
            }
        }
        .form-other {
            margin-top: 20px;

            a {
                color: #05bcd4;
            }
        }
    }
</style>