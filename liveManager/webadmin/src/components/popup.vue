/**
 * Created by miaoyu on 2016/12/16 0016.
 */
<template>
    <!-- 遮罩层动画 -->
    <transition name="popup-ani">
        <article id="co-popup" class="fixed wh-100 text-none-sel c-pointer" @click="close" v-show="openPopup">
            <div class="popup-ly-w text-center">
                <!-- 内容框动画 -->
                <transition enter-active-class="animated bounceInDown" leave-active-class="animated bounceOutUp">
                    <div class="popup-cont di c-default" v-if="openPopup">
                        <div class="popup-title">
                            <slot name="title">
                                <span class="ico icon-home font-20 fl"></span>
                            </slot>
                        </div>
                        <div class="popup-main font-14">
                            <slot></slot>
                        </div>
                        <div class="popup-footer font-0">
                            <span class="btn btn-di font-14" v-if="btnCon.show" @click="btnCon.cb($parent, next)">{{btnCon.text}}</span>
                            <span class="btn btn-di font-14" v-if="btnCan.show" @click="btnCan.cb($parent, next)">{{btnCan.text}}</span>
                        </div>
                    </div>         
                </transition>   
            </div>
        </article> 
    </transition>       
</template>


<script>
/**
 * <popup></popup> —— 弹出框组件
 * slot：
 *     content - 默认插槽为弹出框需要显示的内容
 * prop: 
 *     openPopup(Boolean) - 父组件传递进来的控制标示，true为打开弹出框，false为关闭弹出框，默认为false
 *     btnCon(Object) - 确认按钮配置对象{show：是否显示，text：按钮名称，cb：按钮点击的回调}，默认不显示
 *     btnCan(Object) - 取消按钮配置对象{show：是否显示，text：按钮名称，cb：按钮点击的回调}，默认不显示
 * 备注：
 *     btnCon / btnCan 的回调中，内置一个next方法，调用即可在回调中关闭弹出框
 */
export default {
    name: 'co-popup',
    props: {
        // 是否显示弹出框，默认为不显示，类型为布尔值
        openPopup: {
            type: Boolean,
            default: false
        },
        // 是否显示确认按钮，默认为不显示，类型为对象，默认名称为：确定
        btnCon: {
            type: Object,
            default: () => ({show: false, text: '确定', cb: () => {}})
        },
        // 是否显示取消按钮，默认为不显示，类型为对象，默认名称为：取消
        btnCan: {
            type: Object,
            default: () => ({show: false, text: '取消', cb: () => {}})
        }
    },
    methods: {
        // 关闭弹出框，并向父组件推送参数false
        close(e) {
            if (e.target.className === 'popup-ly-w text-center') this.$emit('closePopup', false);
        },
        // 会让关闭状态的钩子调用
        next() {
            this.$emit('closePopup', false);
        }
    }
};
</script>


<style lang="less" scoped>
    /*弹出框*/
    #co-popup {
        top: 0;
        left: 0;
        z-index: 9;
        display: table;
        background: rgba(0,0,0,0.3);
        
        /*布局*/
        .popup-ly-w {
            display: table-cell;
            vertical-align: middle;
        }
        .popup-cont {
            width: 360px;
            min-height: 216px;
            background: #fff;
            border-radius: 6px;
        }

        /*弹出框头部*/
        .popup-title {
            height: 60px;
            line-height: 60px;

            .ico {
                color: #8c9195;
                margin-top: 20px;
                margin-left: 170px;
            }
        }

        /*弹出框内容*/
        .popup-main {
            margin: 18px 15px 4px 15px;
            color: #757b81;
            line-height: 22px;
        }

        /*弹出框底部*/
        .popup-footer {
            height: 112px;

            .btn {
                color: #757b81;
                width: 118px;
                height: 38px;
                margin: 36px 15px 0 15px;
                line-height: 38px;
                border: 1px solid #05bcd4;
                border-radius: 6px;

                &:hover {
                    color: #fff;
                    background: #05bcd4;
                }
            }
        }
    }
    
    /*遮罩层动画*/
    .popup-ani-enter-active {
        animation: popup-ani-in 1s;
    }
    .popup-ani-leave-active {
        animation: popup-ani-out 1s;
    }
    @keyframes popup-ani-in {
        0% {
            opacity: 0;
        }
        20% {
            opacity: 0.8;
        }
        100% {
            opacity: 1;
        }
    }
    @keyframes popup-ani-out {
        0% {
            opacity: 1;
        }
        80% {
            opacity: 0.8;
        }
        100% {
            opacity: 0;
        }
    }
</style>