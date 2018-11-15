/**
 * Created by miaoyu on 2016/12/16 0016.
 */
<style lang="less" scoped>
    #p_levelset {
        /*头部样式*/
        .header {
            height: 50px;
            background: #fff;
            
            .title {
                margin-left: 20px;
                line-height: 50px;
            }
        }

        /*功能块样式*/
        .fn-block {
            height: 50px;
            margin: 20px;
            line-height: 50px;
            background: #fff;

            .btn-add {
                width: 24px;
                height: 24px;
                line-height: 25px;
                vertical-align: middle;
                background: #05bcd4;
            }
            p {
                color: #05bcd4;
                vertical-align: middle;
            }
        }

        /*表格样式*/
        .table {
            margin: 20px;
            background: #fff;

            .table-thead {
                height: 56px;
                border-bottom: 2px solid #eaeaea;
            }
            .table-tr {
                height: 78px;
                border-bottom: 1px solid #eaeaea;
            }
            .table-th,
            .table-td {
                &:nth-child(1) {
                    width: 20%;
                }
                &:nth-child(2) {
                    width: 20%;
                }
                &:nth-child(3) {
                    width: 20%;
                }
                &:nth-child(4) {
                    width: 20%;
                }
                &:nth-child(5) {
                    width: 20%;
                }
            }
            .table-th {
                line-height: 56px;
            }
            .table-td {
                line-height: 78px;
                color: #333c44;

                .btn-edit,
                .btn-del {
                    color: #05bcd4;
                }
                .btn-edit {
                    padding-right: 10px;
                }
            }
            .table-footer {
                height: 72px;
            }
        }
        
        /*弹出框样式*/
        .pupup-title-slot {
            color: #81868b;
        }
        .pupup-main-slot {
            .ly-input {
                width: 298px;
                height: 48px;
                border: 1px solid #05bcd4;
                border-radius: 6px;
            }     
            label {
                padding: 0 11px;
                line-height: 48px;
            }   
            #agent_user {
                width: 238px;
                padding: 16px 0;
                height: 16px;
            }
        }
    }
</style>

<template>
    <div id="p_levelset">
        <header class="header">
            <span class="title h-100 font-18 font-bold fl">主播级别设置</span>
        </header>
        <section class="fn-block text-center">
            <span class="btn btn-di btn-add arc"
                  @click="addAgent">
                <span class="ico icon-add color-white"></span>
            </span>
            <p class="di font-16 c-pointer"
               @click="addAgent">添加级别</p>
        </section>
        <section class="table">
            <div class="table-thead clear">
                <span class="table-th di h-100 font-16 font-bold text-center fl">级别</span>
                <span class="table-th di h-100 font-16 font-bold text-center fl">月收入</span>
                <span class="table-th di h-100 font-16 font-bold text-center fl">日时长</span>
                <span class="table-th di h-100 font-16 font-bold text-center fl">考勤天数</span>
                <span class="table-th di h-100 font-16 font-bold text-center fl">操作</span>
            </div>
            <ul class="table-tbody">
                <li class="table-tr clear">
                    <div class="table-td h-100 font-16 text-center text-hidden fl">S</div>
                    <div class="table-td h-100 font-16 text-center text-hidden fl">5000元</div>
                    <div class="table-td h-100 font-16 text-center text-hidden fl">2小时</div>
                    <div class="table-td h-100 font-16 text-center text-hidden fl">20天</div>
                    <div class="table-td h-100 font-16 text-center text-hidden fl">
                        <span class="btn btn-edit btn-di">编辑</span>
                        <span class="btn btn-del btn-di">删除</span>
                    </div>
                </li>
            </ul>
            <div class="table-footer">
                <!-- 分页 -->
                <co-pages :index="pagesOp.index"
                          :limit="pagesOp.limit"
                          :total="pagesOp.total"
                          v-on:switchPage="switchPage" />
            </div>
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
import coPages from './../../../components/pages.vue';
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
    // 切换分页
    switchPage(index) {
        console.log(index);
    },
    // 添加经纪人
    addAgent() {
        if (!this.popupOp.show) this.popupOp.show = true;
    },
    // 是否关闭弹出框
    // 如果组件内部返回false就是关闭遮罩层
    isClosePopup(close) {
        if (!close) this.popupOp.show = false;
    }
};


// 引用组件
const components = { coPages, coPopup };


// 暴露组件配置
export default Object.assign({ name: 'p_levelset' }, { data, methods, components });
</script>