/**
 * Created by miaoyu on 2016/12/20 0020.
 */
<template>
    <div id="p-retrieve" class="h-100 rel hidden">
        <div class="ly-block ly-1210 abs">
            <div class="ly-cont rel">
                <section class="ly-form abs">
                    <div class="form-caption font-18 text-center">重置密码</div>
                    <p class="form-phone form-input" 
                      :class="{error: !phone.validator && phone.val !== null}">
                        <label class="ico icon-home c-pointer fl" for="ret-phone"></label>
                        <input id="ret-phone" class="fl font-14 color-black" v-model="phone.val" type="text" placeholder="手机号">
                        <span class="ico-img fr h-100" 
                              :class="{'icon-img-success': phone.validator && phone.val !== null, 
                                       'icon-img-error': !phone.validator && phone.val !== null}"></span>
                    </p>
                    <p class="form-code form-input" 
                      :class="{error: !code.validator && code.val !== null}">
                        <label class="ico icon-home c-pointer fl" for="ret-code"></label>
                        <input id="ret-code" class="fl font-14 color-black" v-model="code.val" type="text" placeholder="验证码">
                        <span class="btn btn-send-code fl color-white"
                              :class="{'btn-dis c-default': sendCodeInput.isSend}"
                              @click="sendCode()">{{sendCodeInput.text}}</span>
                    </p>
                    <p class="form-pass form-input" 
                       :class="{error: !pass.validator && pass.val !== null}">
                        <label class="ico icon-home c-pointer fl" for="ret-pass"></label>
                        <input id="ret-pass" class="fl font-14 color-black" v-model="pass.val" type="password" placeholder="密码">
                        <span class="ico-img fr h-100" 
                              :class="{'icon-img-success': pass.validator && pass.val !== null,
                                       'icon-img-error': !pass.validator && pass.val !== null}"></span>
                    </p>
                    <p class="form-conpass form-input" 
                       :class="{error: !conpass.validator && conpass.val !== null}">
                        <label class="ico icon-home c-pointer fl" for="ret-conpass"></label>
                        <input id="ret-conpass" class="fl font-14 color-black" v-model="conpass.val" type="password" placeholder="确认密码">
                        <span class="ico-img fr h-100" 
                              :class="{'icon-img-success': conpass.validator && conpass.val !== null,
                                       'icon-img-error': !conpass.validator && conpass.val !== null}"></span>
                    </p>
                    <p class="form-submit form-button hidden">
                        <button type="submit" class="wh-100 font-14 color-white" 
                                :disabled="!validate"
                                @click="submit()">登录</button>
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

// 密码验证
function passValidator(isPass, curr, _this) {
    const passPatt = _this.$store.state.user.validator.pass;

    if (isPass === 'pass') {
        const conpassVal =  _this.conpass.val;

        // 验证密码是否合格
        _this.pass.validator = passPatt.test(curr) ? true : false;

        // 如果确认密码已经输入，再次验证
        if (conpassVal !== null) _this.conpass.validator = conpassVal === curr && passPatt.test(conpassVal) ? true : false;
    } else {
        // 验证确认密码是否合法
        _this.conpass.validator = 
            curr === _this.pass.val && passPatt.test(curr) ? true : false;
    };

    // 判断表单数据是否全部合法
    _this.validate = validatorForm([_this.phone, _this.code, _this.pass, _this.conpass]);
};


// 定义组件vm
const vm = {
    data: () => ({
        // 手机数据 / 是否验证通过
        phone: {
            val: null,
            validator: false
        },
        // 验证码数据 / 是否验证通过
        code: {
            val: null,
            validator: false
        },
        // 密码数据 / 是否验证通过
        pass: {
            val: null,
            validator: false
        },
        // 确认密码数据 / 是否验证通过
        conpass: {
            val: null,
            validator: false
        },
        // 发送验证码控件
        sendCodeInput: {
            isSend: false,      // 是否发送验证码
            text: '发送验证码', // 控件文本
            time: 60            // 发送倒计时
        },
        // 表单是否验证通过
        validate: false,
        // 弹出框控件
        popup : {
            show: false,
            content: '您输入的帐户不存在，请重新输入。',
            btnCon: {
                show: true,
                text: '确定1',
                cb: () => {console.log('点击了确定了！')}
            },
            btnCan: {
                show: true,
                text: '取消',
                cb: next => next()
            }
        }
    }),
    watch: {
        // 手机号验证成功修改标示
        ['phone.val'](curr) {
            this.phone.validator = this.$store.state.user.validator.phone.test(curr) ? true : false;
            
            // 判断表单数据是否全部合法
            this.validate = validatorForm([this.phone, this.code, this.pass, this.conpass]);
        },
        // 验证码验证成功修改标示
        ['code.val'](curr) {
            this.code.validator = this.$store.state.user.validator.code.test(curr) ? true : false;
            
            // 判断表单数据是否全部合法
            this.validate = validatorForm([this.phone, this.code, this.pass, this.conpass]);
        },
        // 密码验证成功修改标示
        ['pass.val'](curr) {
            passValidator('pass', curr, this)
        },
        // 确认密码验证成功修改标示
        ['conpass.val'](curr) {
            passValidator('conpass', curr, this)
        }
    },
    methods: {
        // 发送验证码
        sendCode() {
            const vm = this;

            // 判断控件是否可以点状态
            if (!vm.sendCodeInput.isSend) {
                const oldText = vm.sendCodeInput.text;
                    
                let startTime = vm.sendCodeInput.time,
                    interId;

                // 禁止点击
                vm.sendCodeInput.isSend = true;

                // 开始倒计时
                interId = setInterval(() => {
                    // 修改控件文本，并且修改计数标示
                    vm.sendCodeInput.text = `${startTime}S`;
                    --startTime;

                    // 如果计数为0 重新开启控件
                    if (startTime === 0) {
                        vm.sendCodeInput.text = '重新发送';
                        vm.sendCodeInput.isSend = false;

                        // 取消计时器
                        clearInterval(interId);
                    };
                }, 1000);
            };
        },
        // 提交验证
        submit() {
            // // 打开弹出框
            this.isOpenPopup();
            // 
            // 
            // this.$http.post('/login', {
            //     username: 18759360126,
            //     password: '123456789'
            // }).then(function(res) {
            //     console.log(res);
            // }, function() {
            //     console.log(2);
            // });
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
export default Object.assign({ name: 'p-retrieve' }, vm);
</script>


<style lang="less" scoped>
    #p-retrieve {
        min-height: 526px;
        background: #05bcd4;

        /*布局区块*/
        .ly-block {
            top: 50%;
            left: 50%;
            height: 526px;
            transform: translate(-50%, -50%)
        }
        .ly-cont {
            height: 701px;
            background: url(../public/images/login-bg.png) no-repeat center bottom;
        }

        /*表单*/
        .ly-form {
            left: 50%;
            width: 382px;
            height: 510px;
            margin-left: -191px;
            border-radius: 6px;
            background: #fff;
        }
        .form-caption {
            height: 124px;
            color: #757b81;
            line-height: 124px;
        }
        .ico {
            width: 48px;
            height: 48px;
            color: #05bcd4;
            font-size: 22px;
            line-height: 48px;
        }
        .ico-img {
            display: block;
            width: 32px;

            &.icon-img-success {
                background: url(../public/images/input-ico-success.png) no-repeat center;
            }
            &.icon-img-error {
                background: url(../public/images/input-ico-error.png) no-repeat center;
            }
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
            #ret-code {
                width: 136px;
            }

            // 验证码控件
            .btn-send-code {
                width: 97px;
                height: 29px;
                margin-top: 9px;
                margin-left: 8px;
                line-height: 29px;
                background: #05bcd4;
                border-radius: 6px;
            }
            .btn-send-code.btn-dis {
                background: #aaa;
            }
        }
        .form-code,
        .form-pass,
        .form-conpass {
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