/**
 * Created by miaoyu on 2016/12/16 0016.
 */
<style lang="less" scoped>
    #p-updatepass {
        /*头部样式*/
        .header {
            height: 50px;
            background: #fff;
            
            .title {
                margin-left: 20px;
                line-height: 50px;
            }
        }
        
        /*主体样式*/
        .updatepass-main {
            margin: 20px;
            background: #fff;

            .main-h {
                height: 124px;
                color: #757b81;
                line-height: 124px;
            }
        }
    }
</style>

<template>
    <div id="p-updatepass">
        <header class="header">
            <span class="title h-100 font-18 font-bold fl">密码修改</span>
        </header>
        <section class="updatepass-main">
            <h2 class="main-h font-18 text-center">修改密码</h2>
<!--             <p class="form-phone form-input" 
               :class="{error: !phone.validator && phone.val !== null}">
                <label class="ico icon-home c-pointer fl" for="login-phone"></label>
                <input id="login-phone" type="text" class="fl font-14 color-black" 
                       v-model="phone.val" placeholder="手机号">
            </p> -->
        </section>
        <!-- 弹出框 -->
        <co-popup :openPopup="popupOp.show" 
                  :btnCon="popupOp.btnCon"
                  :btnCan="popupOp.btnCan"
                  v-on:closePopup="isClosePopup">
            <div class="pupup-title-slot font-18" slot="title">添加经纪人</div>
            <div class="pupup-main-slot text-center">
                <p class="ly-input di hidden">
                    <label class="font-16 fl" for="agent_user">昵称</label>
                    <input id="agent_user" class="font-14 fl" type="text" 
                           placeholder="请输入2～6个字的经纪人名字"
                           v-model="popupOp.content">
                </p>
            </div>
        </co-popup>
    </div>
</template>

<script>
import coPopup from './../../../components/popup.vue';
import { closePgloading } from './../../../service/pageloading.service.js';

closePgloading();


// data
const data = () => ({
    pagesOp: {     // 经纪人分页配置
        index: 1,  //—— 当前的页码
        limit: 10, //—— 翻页的条数
        total: 10, //—— 总条数
    },
    popupOp: {                 // 弹出框配置
        show: false,           //—— 是否弹出框
        content: null,         //—— 弹出框的文本内容
        btnCon: {              //—— 确认按钮配置
            show: true,        //—— 是否显示按钮
            text: '确定',      //—— 按钮名称
            cb: (vm, next) => { //—— 执行函数内部的next回调
                console.log(vm.popupOp.content);

                next();
            }   
        },
        btnCan: {              //—— 取消按钮配置
            show: true,        //—— 是否显示按钮
            text: '取消',      //—— 按钮名称
            cb: (vm, next) => next() //—— 执行函数内部的next回调
        }
    }
});


// 方法集合
const methods = {
    // 是否关闭弹出框
    // 如果组件内部返回false就是关闭遮罩层
    isClosePopup(close) {
        if (!close) this.popupOp.show = false;
    }
};


// 引用组件
const components = { coPopup };


// 暴露组件配置
export default Object.assign({ name: 'p-updatepass' }, { data, methods, components });
</script>