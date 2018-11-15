/**
 * Created by miaoyu on 2016/12/16 0016.
 */
<style lang="less" scoped>
    #p-anchorset {
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
            
            .btn-add,
            .btn-import {
                width: 24px;
                height: 24px;
                line-height: 25px;
                vertical-align: middle;
                background: #05bcd4;
            }
            .btn-add {
                margin-left: 16px;
            }
            .btn-import {
                margin-left: 30px;
            }
            p {
                color: #05bcd4;
                vertical-align: middle;
            }
            .search {
                width: 218px;
                height: 28px;
                margin-top: 11px;
                margin-right: 12px;
                background: #f7f7f7;
                border-radius: 20px;

                input {
                    width: 170px;
                    height: 14px;
                    margin-left: 17px;
                    padding: 7px 0;
                    color: #757b81;
                    background: transparent;
                }
                .icon-seach {
                    width: 28px;
                    height: 28px;
                    line-height: 28px;
                }
            }
        }

        /*主体*/
        .main-sel {
            margin: 0 20px 20px 20px;
            background: #fff;
        }
        .sel-title {
            height: 52px;
            color: #8a8f94;
            background: #f7f7f7;
            border-bottom: 1px solid #eaeaea;

            .sel-tab {
                padding: 0 20px;
                line-height: 52px;
        
                &:after {
                    content: '';
                    position: absolute;
                    top: 19px;
                    right: -1px;
                    width: 1px;
                    height: 15px;
                    background: #eaeaea;
                }
                &.sel {
                    z-index: 2;
                    background: #fff;
                    padding: 0 19px;
                    border-left: 1px solid #eaeaea;
                    border-right: 1px solid #eaeaea;
                    border-bottom: 1px solid #fff;

                    &:after {
                        content: none;
                    }
                }
            }
        }
        .sel-cont {
            margin-bottom: 20px;
            background: #fff;

            .table {
                // height: 919px;
            }
            .table-thead {
                height: 55px;
                border-bottom: 2px solid #eaeaea;
            }
            .table-tfooter {
                height: 72px;
            }

            /*小组贡献榜*/
            .sign-table,
            .not-sign-table {
                .table-cont {
                    // height: 789px;
                    border-bottom: 1px solid #eaeaea;
                }
                .table-thead,
                .table-th {
                    line-height: 55px;
                }
                .table-tr {
                    height: 78px;
                    border-bottom: 1px solid #eaeaea;
                }
                .table-th,
                .table-td {
                    &:nth-child(1) {
                        width: 21%;
                    }
                    &:nth-child(2) {
                        width: 13%;
                    }
                    &:nth-child(3) {
                        width: 13%;
                    }
                    &:nth-child(4) {
                        width: 13%;
                    }
                    &:nth-child(5) {
                        width: 13%;
                    }
                    &:nth-child(6) {
                        width: 13%;
                    }
                    &:nth-child(7) {
                        width: 14%;
                    }
                }
                .table-td {
                    color: #333c44;
                    line-height: 78px;

                    .btn-edit,
                    .btn-del {
                        color: #05bcd4;
                    }
                    .btn-edit {
                        padding-right: 10px;
                    }
                }
            }
        }

        /*切换动画*/
        .table-fade-enter-active, .table-fade-leave-active {
            transition: opacity .3s
        }
        .table-fade-enter, .table-fade-leave-active {
            opacity: 0
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
    <div id="p-anchorset">
        <header class="header">
            <span class="title h-100 font-18 font-bold fl">主播设置</span>
        </header>
        <section class="fn-block">
            <span class="btn btn-di btn-add arc"
                  @click="addAnchor">
                <span class="ico icon-add color-white"></span>
            </span>
            <p class="di font-16 c-pointer"
               @click="addAnchor">添加主播</p>
            <span class="btn btn-di btn-import arc"
                  @click="importAnchor">
                <span class="ico icon-box-remove color-white"></span>
            </span>
            <p class="di font-16 c-pointer"
               @click="importAnchor">批量导入主播</p>
            <div class="search fr">
                <input class="fl" type="text" placeholder="请输入ID、昵称、平台进行搜索">
                <span class="btn btn-search fr">
                    <span class="ico ico-di icon-seach font-14"></span>
                </span>
            </div>
        </section>
        <section class="main-sel">
            <ul class="sel-title clear">
                <li class="sel-tab font-16 text-center text-none-sel fl rel c-pointer"
                    :class="{'sel': currShow === 0}"
                    @click="switchTab(0)">签约主播</li>
                <li class="sel-tab font-16 text-center text-none-sel fl rel c-pointer"
                    :class="{'sel': currShow === 1}"
                    @click="switchTab(1)">解约主播</li>
            </ul>
            <div class="sel-cont">
                <transition name="table-fade">
                    <!-- 签约主播 -->
                    <div class="sign-table table" v-if="currShow === 0" key="table0">
                        <div class="table-thead clear">
                            <span class="table-th font-16 font-bold text-center fl">主播</span>
                            <span class="table-th font-16 font-bold text-center fl">备注姓名</span>
                            <span class="table-th font-16 font-bold text-center fl">平台</span>
                            <span class="table-th font-16 font-bold text-center fl">ID</span>
                            <span class="table-th font-16 font-bold text-center fl">经纪人</span>
                            <span class="table-th font-16 font-bold text-center fl">主播等级</span>
                            <span class="table-th font-16 font-bold text-center fl">操作</span>
                        </div>
                        <ul class="table-tbody">
                            <li class="table-tr">
                                <div class="table-td h-100 font-16 text-hidden text-center fl">社会你求解扒拉了</div>
                                <div class="table-td h-100 font-16 text-hidden text-center fl">求求</div>
                                <div class="table-td h-100 font-16 text-hidden text-center fl">映客直播</div>
                                <div class="table-td h-100 font-16 text-hidden text-center fl">14723046</div>
                                <div class="table-td h-100 font-16 text-hidden text-center fl">王晶晶</div>
                                <div class="table-td h-100 font-16 text-hidden text-center fl">S</div>
                                <div class="table-td h-100 font-16 text-center text-hidden fl">
                                    <span class="btn btn-edit btn-di">编辑</span>
                                    <span class="btn btn-del btn-di">删除</span>
                                </div>
                            </li>
                        </ul>
                        <div class="table-tfooter">
                            <co-pages :index="signPagesOp.index"
                                      :limit="signPagesOp.limit"
                                      :total="signPagesOp.total"
                                      v-on:switchPage="signSwitchPage" />
                        </div>
                    </div>
                    <!-- 未签约主播 -->
                    <div class="not-sign-table table" v-if="currShow === 1" key="table1">
                        <div class="table-thead clear">
                            <span class="table-th font-16 font-bold text-center fl">主播</span>
                            <span class="table-th font-16 font-bold text-center fl">备注姓名</span>
                            <span class="table-th font-16 font-bold text-center fl">平台</span>
                            <span class="table-th font-16 font-bold text-center fl">ID</span>
                            <span class="table-th font-16 font-bold text-center fl">经纪人</span>
                            <span class="table-th font-16 font-bold text-center fl">主播等级</span>
                            <span class="table-th font-16 font-bold text-center fl">解约日期</span>
                        </div>
                        <ul class="table-tbody">
                            <li class="table-tr">
                                <div class="table-td h-100 font-16 text-hidden text-center fl">社会你求解扒拉了</div>
                                <div class="table-td h-100 font-16 text-hidden text-center fl">求求</div>
                                <div class="table-td h-100 font-16 text-hidden text-center fl">映客直播</div>
                                <div class="table-td h-100 font-16 text-hidden text-center fl">14723046</div>
                                <div class="table-td h-100 font-16 text-hidden text-center fl">王晶晶</div>
                                <div class="table-td h-100 font-16 text-hidden text-center fl">S</div>
                                <div class="table-td h-100 font-16 text-hidden text-center fl">2016-12-07</div>
                            </li>
                        </ul>
                        <div class="table-tfooter">
                            <co-pages :index="signPagesOp.index"
                                      :limit="signPagesOp.limit"
                                      :total="signPagesOp.total"
                                      v-on:switchPage="notSignSwitchPage" />
                        </div>
                    </div>
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
    currShow: 0,   // 当前展示的表格
    signPagesOp: { // 签约主播分页配置
        index: 1,  //—— 当前的页码
        limit: 10, //—— 翻页的条数
        total: 10, //—— 总条数
        data: []   //—— 数据储存
    },
    notSignPagesOp: { // 未签约主播分页配置
        index: 1,     //—— 当前的页码
        limit: 10,    //—— 翻页的条数
        total: 10,    //—— 总条数
        data: []      //—— 数据储存
    },
    popupOp: {                  // 弹出框配置
        show: false,            //—— 是否弹出框
        content: null,          //—— 弹出框的文本内容
        btnCon: {               //—— 确认按钮配置
            show: true,         //—— 是否显示按钮
            text: '确定',       //—— 按钮名称
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
    // 切换表格
    switchTab(index) {
        if (index !== this.currShow) this.currShow = index;
    },
    // 签约主播切换分页切换分页
    signSwitchPage(index) {
        console.log(index);
    },
    // 未签约主播切换分页切换分页
    notSignSwitchPage(index) {
        console.log(index);
    },
    // 添加主播
    addAnchor() {
        if (!this.popupOp.show) this.popupOp.show = true;
    },
    // 批量导入主播
    importAnchor() {
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
export default Object.assign({ name: 'p-anchorset' }, { data, methods, components });
</script>