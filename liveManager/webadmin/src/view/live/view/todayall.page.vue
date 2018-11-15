/**
 * Created by miaoyu on 2016/12/16 0016.
 */
<style lang="less" scoped>
    #p-todayall {
        /*头部样式*/
        .header {
            height: 50px;
            background: #fff;
            
            /*按钮*/
            .btn-switch {
                width: 128px;
                height: 32px;
                margin-top: 9px;
                margin-left: 10px;
                color: #878c91;
                line-height: 32px;
                background: #e5e5e5;
                border-radius: 6px;

                &:first-child {
                    margin-left: 20px;
                }
            }
            .btn-switch.sel {
                color: white;
                background: #05bcd4;
                cursor: not-allowed;
                transition: all .6s;
            }

            /*今日总览刷新*/
            .autoref {
                margin-top: 19px;
                margin-right: 20px;
                color: #757b81;
                line-height: 14px;

                .ico {
                    animation: refrotate 3s linear infinite;
                }
            }
            @keyframes refrotate {
                0% {
                    transform: rotate(0deg);
                }
                50% {
                    transform: rotate(180deg);
                }
                100% {
                    transform: rotate(360deg);
                }
            }
        }
        
        /*页面主体*/
        .main {
            width: 200%;

            /*展示块*/
            .show-block {
                height: 120px;
                margin: 20px;

                .block-item {
                    height: 115px;
                }
                .block-item:nth-child(1) {
                    border-bottom: 5px solid #85c737;
                }
                .block-item:nth-child(2) {
                    border-bottom: 5px solid #ef4d39;
                }
                .block-item:nth-child(3) {
                    border-bottom: 5px solid #fad771;
                }
                .block-item:nth-child(4) {
                    border-bottom: 5px solid #29c9f1;
                }
            }
            
            /*分析图*/
            .trend-img {
                height: 472px;
                margin: 0 20px;
                background: #fff;
            }

            /*排行*/
            .ranking {
                margin: 10px;

                .ra-table {
                    box-sizing: border-box;
                    width: 50%;
                    height: 480px;
                    background: #fff;
                    border: 10px solid #f2f2f2;
                }

                .table-title {
                    height: 54px;

                    .title {
                        margin-left: 21px;
                        line-height: 54px;
                    }
                    .btn-more {
                        margin: 16px 10px 0 0;
                        padding: 0 10px;
                        color: #b0bcd4;
                        line-height: 22px;
                    }
                }
                .tr {
                    height: 80px;
                    border-bottom: 1px solid #eaeaea;

                    &:last-child {
                        border-bottom: none;
                    }
                    &:hover {
                        transition: all .2s;
                        border-bottom-color: #fff;
                        box-shadow: 0 5px 5px -3px rgba(0,0,0,0.3);
                    }
                }
                .td {
                    figure {
                        line-height: 80px;
                    }
                    img {
                        width: 52px;
                        height: 52px;
                        vertical-align: middle;
                    }
                    .name {
                        height: 28px;
                        margin-top: 12px;
                        line-height: 28px;
                        
                        .color {
                            color: #05bcd4;
                        }
                    }
                    .info {
                        height: 26px;
                        color: #aaa;
                        line-height: 26px;
                    }

                    &:nth-child(1) {
                        width: 20%;
                    }
                    &:nth-child(2) {
                        width: 52%;
                    }
                    &:nth-child(3) {
                        width: 10%;
                        color: #757b81;
                        line-height: 80px;
                    }
                    &:nth-child(4) {
                        width: 18%;
                        color: #757b81;
                        line-height: 80px;
                    }
                }
                .curr-table {
                    .table-title {
                        border-bottom: 2px solid #85c737;
                    }
                }
                .income-table {
                    .table-title {
                        border-bottom: 2px solid #fad771;
                    }
                    .td {
                        .ico {
                            color: #fad771;
                        }
                    }
                }
                .addfans-table {
                    .table-title {
                        border-bottom: 2px solid #29c9f1;
                    }
                }
                .longtime-table {
                    .table-title {
                        border-bottom: 2px solid #ef4d39;
                    }
                }
            }

            /*饼图*/
            .cake-img {
                margin: 0 20px 20px 20px;
                height: 441px;
                background: #fff;

                .cake-title {
                    height: 56px;
                    line-height: 56px;
                    text-indent: 20px;
                    border-bottom: 1px solid #eaeaea;
                }
                .cake-cont {
                    height: 384px;
                }
                    
                .lable-w {
                    top: 340px;
                }
                .label {
                    width: 33.333333333%;
                    color: #333c44;
                }
            }
            
            .main-left {
                .block-item {
                    width: 25%;
                }
            }
            .main-right {
                .block-item {
                    width: 33.3333333%;
                }
            }
            .ly-main {
                width: 50%;

                .block-item {
                    background: #fff;

                    &:after {
                        content: '';
                        position: absolute;
                        top: 0;
                        left: 0;
                        width: 1px;
                        height: 100%;
                        background: #efefef;
                    }

                    &:first-child:after {
                        content: none;
                    }
                }
                .item {
                    height: 62px;
                    color: #757b81;
                    line-height: 62px;
                }
                .cont {
                    height: 31px;
                    line-height: 31px;
                }
            }
        }

        /*页面动画*/
        .ani-lateLeft {
            transition: transform .6s;
            transform: translateX(-50%);
        }
        .ani-lateRight {
            transition: transform .6s;
            transform: translateX(0);
        }
    }
</style>

<template>
    <div id="p-todayall">
    	<header class="header">
    		<span class="btn btn-di fl font-18 btn-switch" 
                  :class="{'sel': currIndex === 0}"
                  @click="switchCurrIndex(0)">今日实时数据</span>
    		<span class="btn btn-di fl font-18 btn-switch"
                  :class="{'sel': currIndex === 1}"
                  @click="switchCurrIndex(1)">昨日数据</span>
    		<!-- 今日总览 -->
    		<div class="autoref font-14 fr">
    			<span>{{ refTime }}秒后刷新数据</span>
				<span class="ico icon-refresh"></span>
    		</div>
    	</header>
    	<div class="main clear" :class="currIndex === 0 ? 'ani-lateRight' : 'ani-lateLeft'">
    		<!-- 今日总览 -->
    		<div class="main-left ly-main fl">
                <!-- 展示块 -->
                <section class="show-block">
                    <div class="block-item h-100 rel fl text-center">
                        <div class="item font-14">当前在播 (人)</div>
                        <div class="cont font-30 font-bold text-hidden">{{ showBlock.liveStar }}</div>
                    </div>
                    <div class="block-item h-100 rel fl text-center">
                        <div class="item font-14">日累计上播 (人)</div>
                        <div class="cont font-30 font-bold text-hidden">{{ showBlock.sumLive }}</div>
                    </div>
                    <div class="block-item h-100 rel fl text-center">
                        <div class="item font-14">当日收入 (元)</div>
                        <div class="cont font-30 font-bold text-hidden">{{ showBlock.sumRmb }}</div>
                    </div>
                    <div class="block-item h-100 rel fl text-center">
                        <div class="item font-14">当日增粉 (人)</div>
                        <div class="cont font-30 font-bold text-hidden">{{ showBlock.sumFollower }}</div>
                    </div>
                </section>
                <!-- 趋势图 -->
                <section class="trend-img" v-eline="'inAdd'"></section>
                <!-- 排行 -->
                <section class="ranking clear">
                    <!-- 当前在线最高主播 -->
                    <div class="ra-table curr-table fl">
                        <div class="table-title">
                            <span class="title font-18 font-bold fl">当前在线最高主播</span>
                            <router-link class="btn btn-more font-14 fr"
                                         to="/admin/currolanchor" tag="span">
                                <span>完整报表</span>
                                <span class="ico icon-more"></span>
                            </router-link>
                        </div>
                        <ul>
                            <router-link :to="'/admin/ahdetail/'+ item.platform +'/'+ item.platformid"
                                         class="tr c-pointer" 
                                         v-for="item of topOnline" tag="li">
                                <div class="td h-100 text-center fl">
                                    <figure class="di h-100">
                                        <img class="arc" :src="item.avatar" 
                                                         :alt="item.remark || item.nickname">
                                    </figure>
                                </div>
                                <div class="td h-100 fl">
                                    <p class="name w-100 font-16 fl text-hidden">
                                        {{ item.remark || item.nickname }}
                                        <span class="color font-bold">·</span>
                                        {{ item.platname }}</p>
                                    <p class="info w-100 font-14 fl text-hidden">
                                        {{ item.starttime | showhms }}
                                        开播&nbsp;&nbsp;&nbsp;在线
                                        {{ item.online }}</p>
                                </div>
                                <div class="td h-100 fl font-16 text-center text-hidden">{{ item.levelname }}</div>
                                <div class="td h-100 fl font-16 text-center text-hidden">{{ item.agentname }}</div>
                            </router-link>
                        </ul>
                    </div>
                    <!-- 日收入最高主播 -->
                    <div class="ra-table income-table fl">
                        <div class="table-title">
                            <span class="title font-18 font-bold fl">日收入最高主播</span>
                            <router-link class="btn btn-more font-14 fr"
                                         to="/admin/curricanchor" tag="span">
                                <span>完整报表</span>
                                <span class="ico icon-more"></span>
                            </router-link>
                        </div>
                        <ul>
                            <router-link :to="'/admin/ahdetail/'+ item.platform +'/'+ item.platformid"
                                         class="tr c-pointer" 
                                         v-for="item of topIncome" tag="li">
                                <div class="td h-100 text-center fl">
                                    <figure class="di h-100">
                                        <img class="arc" :src="item.avatar" 
                                                         :alt="item.remark || item.nickname">
                                    </figure>
                                </div>
                                <div class="td h-100 fl">
                                    <p class="name w-100 font-16 fl text-hidden">
                                        {{ item.remark || item.nickname }}
                                        <span class="color font-bold">·</span> 
                                        {{ item.platname }}
                                    </p>
                                    <p class="info w-100 font-14 fl text-hidden">
                                        <span class="ico icon-income font-12"></span>
                                        {{ item.increase_rmb }}&nbsp;&nbsp;
                                        {{ item.increase_income +' '+ item.ratename }}
                                    </p>
                                </div>
                                <div class="td h-100 fl font-16 text-center text-hidden">{{ item.levelname }}</div>
                                <div class="td h-100 fl font-16 text-center text-hidden">{{ item.agentname }}</div>
                            </router-link>
                        </ul>
                    </div>
                    <!-- 日增粉最高主播 -->
                    <div class="ra-table addfans-table fl">
                        <div class="table-title">
                            <span class="title font-18 font-bold fl">日增粉最多主播</span>
                            <router-link class="btn btn-more font-14 fr"
                                         to="/admin/currafanchor" tag="span">
                                <span>完整报表</span>
                                <span class="ico icon-more"></span>
                            </router-link>
                        </div>
                        <ul>
                            <router-link :to="'/admin/ahdetail/'+ item.platform +'/'+ item.platformid"
                                         class="tr c-pointer" 
                                         v-for="item of topFans" tag="li">
                                <div class="td h-100 text-center fl">
                                    <figure class="di h-100">
                                        <img class="arc" :src="item.avatar" 
                                                         :alt="item.remark || item.nickname">
                                    </figure>
                                </div>
                                <div class="td h-100 fl">
                                    <p class="name w-100 font-16 fl text-hidden">
                                        {{ item.remark || item.nickname }}
                                        <span class="color font-bold">·</span>
                                        {{ item.platname }}</p>
                                    <p class="info w-100 font-14 fl text-hidden">
                                        日新增粉丝
                                        {{ item.increase_follower }}
                                    </p>
                                </div>
                                <div class="td h-100 fl font-16 text-center text-hidden">{{ item.levename }}</div>
                                <div class="td h-100 fl font-16 text-center text-hidden">{{ item.agentname }}</div>
                            </router-link>
                        </ul>
                    </div>
                    <!-- 日上播时间最长主播 -->
                    <div class="ra-table longtime-table fl">
                        <div class="table-title">
                            <span class="title font-18 font-bold fl">日上播时间最长主播</span>
                            <router-link class="btn btn-more font-14 fr"
                                         to="/admin/currtlanchor" tag="span">
                                <span>完整报表</span>
                                <span class="ico icon-more"></span>
                            </router-link>
                        </div>
                        <ul>
                            <router-link :to="'/admin/ahdetail/'+ item.platform +'/'+ item.platformid"
                                         class="tr c-pointer" 
                                         v-for="item of topLivetime" tag="li">
                                <div class="td h-100 text-center fl">
                                    <figure class="di h-100">
                                        <img class="arc" :src="item.avatar" 
                                                         :alt="item.remark || item.nickname">
                                    </figure>
                                </div>
                                <div class="td h-100 fl">
                                    <p class="name w-100 font-16 fl text-hidden">
                                        {{ item.remark || item.nickname }}
                                        <span class="color font-bold">·</span>
                                        {{ item.platname }}
                                    </p>
                                    <p class="info w-100 font-14 fl text-hidden">
                                        日总直播时长 {{ item.workTime }}
                                    </p>
                                </div>
                                <div class="td h-100 fl font-16 text-center text-hidden">{{ item.levename }}</div>
                                <div class="td h-100 fl font-16 text-center text-hidden">{{ item.agentname }}</div>
                            </router-link>
                        </ul>
                    </div>
                </section>
    			<!-- 饼图 -->
    			<section class="cake-img rel">
    				<div class="cake-title font-18 font-bold">日平台数据分布</div>
    				<div class="cake-cont" v-eline="'dis'"></div>
    				<div class="lable-w w-100 abs">
	    				<p class="label font-14 font-bold text-center fl">活跃主播占比</p>
						<p class="label font-14 font-bold text-center fl">日收入占比</p>
						<p class="label font-14 font-bold text-center fl">日增粉占比</p> 		
    				</div>
    			</section>
    		</div>
    		<!-- 昨日总览 -->
            <div class="main-right ly-main fl">
                <!-- 展示块 -->
                <section class="show-block">
                    <div class="block-item h-100 rel fl text-center">
                        <div class="item font-14">日累计上播 (人)</div>
                        <div class="cont font-30 font-bold text-hidden">{{ ysShowBlock.sumLive }}</div>
                    </div>
                    <div class="block-item h-100 rel fl text-center">
                        <div class="item font-14">当日收入 (元)</div>
                        <div class="cont font-30 font-bold text-hidden">{{ ysShowBlock.sumRmb }}</div>
                    </div>
                    <div class="block-item h-100 rel fl text-center">
                        <div class="item font-14">当日增粉 (人)</div>
                        <div class="cont font-30 font-bold text-hidden">{{ ysShowBlock.sumFollower }}</div>
                    </div>
                </section>
                <!-- 趋势图 -->
                <section class="trend-img" v-eline="'ysInAdd'"></section>
                <!-- 排行 -->
                <section class="ranking clear">
                    <!-- 当前在线最高主播 -->
                    <div class="ra-table curr-table fl">
                        <div class="table-title">
                            <span class="title font-18 font-bold fl">昨日在线最高主播</span>
                            <router-link class="btn btn-more font-14 fr"
                                         to="/admin/ysolanchor" tag="span">
                                <span>完整报表</span>
                                <span class="ico icon-more"></span>
                            </router-link>
                        </div>
                        <ul>
                            <router-link :to="'/admin/ahdetail/'+ item.platform +'/'+ item.platformid"
                                         class="tr c-pointer" 
                                         v-for="item of ysTopOnline" tag="li">
                                <div class="td h-100 text-center fl">
                                    <figure class="di h-100">
                                        <img class="arc" :src="item.avatar" 
                                                         :alt="item.remark || item.nickname">
                                    </figure>
                                </div>
                                <div class="td h-100 fl">
                                    <p class="name w-100 font-16 fl text-hidden">
                                        {{ item.remark || item.nickname }}
                                        <span class="color font-bold">·</span>
                                        {{ item.platname }}</p>
                                    <p class="info w-100 font-14 fl text-hidden">
                                        {{ item.starttime | showhms }}
                                        开播&nbsp;&nbsp;&nbsp;在线
                                        {{ item.online }}</p>
                                </div>
                                <div class="td h-100 fl font-16 text-center text-hidden">{{ item.levelname }}</div>
                                <div class="td h-100 fl font-16 text-center text-hidden">{{ item.agentname }}</div>
                            </router-link>
                        </ul>
                    </div>
                    <!-- 日收入最高主播 -->
                    <div class="ra-table income-table fl">
                        <div class="table-title">
                            <span class="title font-18 font-bold fl">昨日收入最高主播</span>
                            <router-link class="btn btn-more font-14 fr"
                                         to="/admin/ysicanchor" tag="span">
                                <span>完整报表</span>
                                <span class="ico icon-more"></span>
                            </router-link>
                        </div>
                        <ul>
                            <router-link :to="'/admin/ahdetail/'+ item.platform +'/'+ item.platformid"
                                         class="tr c-pointer" 
                                         v-for="item of ysTopIncome" tag="li">
                                <div class="td h-100 text-center fl">
                                    <figure class="di h-100">
                                        <img class="arc" :src="item.avatar" 
                                                         :alt="item.remark || item.nickname">
                                    </figure>
                                </div>
                                <div class="td h-100 fl">
                                    <p class="name w-100 font-16 fl text-hidden">
                                        {{ item.remark || item.nickname }}
                                        <span class="color font-bold">·</span> 
                                        {{ item.platname }}
                                    </p>
                                    <p class="info w-100 font-14 fl text-hidden">
                                        <span class="ico icon-income font-12"></span>
                                        {{ item.increase_rmb }}&nbsp;&nbsp;
                                        {{ item.increase_income +' '+ item.ratename }}
                                    </p>
                                </div>
                                <div class="td h-100 fl font-16 text-center text-hidden">{{ item.levelname }}</div>
                                <div class="td h-100 fl font-16 text-center text-hidden">{{ item.agentname }}</div>
                            </router-link>
                        </ul>
                    </div>
                    <!-- 日增粉最高主播 -->
                    <div class="ra-table addfans-table fl">
                        <div class="table-title">
                            <span class="title font-18 font-bold fl">昨日增粉最多主播</span>
                            <router-link class="btn btn-more font-14 fr"
                                         to="/admin/ysafanchor" tag="span">
                                <span>完整报表</span>
                                <span class="ico icon-more"></span>
                            </router-link>
                        </div>
                        <ul>
                            <router-link :to="'/admin/ahdetail/'+ item.platform +'/'+ item.platformid"
                                         class="tr c-pointer" 
                                         v-for="item of ysTopFans" tag="li">
                                <div class="td h-100 text-center fl">
                                    <figure class="di h-100">
                                        <img class="arc" :src="item.avatar" 
                                                         :alt="item.remark || item.nickname">
                                    </figure>
                                </div>
                                <div class="td h-100 fl">
                                    <p class="name w-100 font-16 fl text-hidden">
                                        {{ item.remark || item.nickname }}
                                        <span class="color font-bold">·</span>
                                        {{ item.platname }}</p>
                                    <p class="info w-100 font-14 fl text-hidden">
                                        日新增粉丝
                                        {{ item.increase_follower }}
                                    </p>
                                </div>
                                <div class="td h-100 fl font-16 text-center text-hidden">{{ item.levename }}</div>
                                <div class="td h-100 fl font-16 text-center text-hidden">{{ item.agentname }}</div>
                            </router-link>
                        </ul>
                    </div>
                    <!-- 日上播时间最长主播 -->
                    <div class="ra-table longtime-table fl">
                        <div class="table-title">
                            <span class="title font-18 font-bold fl">昨日上播时间最长主播</span>
                            <router-link class="btn btn-more font-14 fr"
                                         to="/admin/ystlanchor" tag="span">
                                <span>完整报表</span>
                                <span class="ico icon-more"></span>
                            </router-link>
                        </div>
                        <ul>
                            <router-link :to="'/admin/ahdetail/'+ item.platform +'/'+ item.platformid"
                                         class="tr c-pointer" 
                                         v-for="item of ysTopLivetime" tag="li">
                                <div class="td h-100 text-center fl">
                                    <figure class="di h-100">
                                        <img class="arc" :src="item.avatar" 
                                                         :alt="item.remark || item.nickname">
                                    </figure>
                                </div>
                                <div class="td h-100 fl">
                                    <p class="name w-100 font-16 fl text-hidden">
                                        {{ item.remark || item.nickname }}
                                        <span class="color font-bold">·</span>
                                        {{ item.platname }}
                                    </p>
                                    <p class="info w-100 font-14 fl text-hidden">
                                        日总直播时长 {{ item.workTime }}
                                    </p>
                                </div>
                                <div class="td h-100 fl font-16 text-center text-hidden">{{ item.levename }}</div>
                                <div class="td h-100 fl font-16 text-center text-hidden">{{ item.agentname }}</div>
                            </router-link>
                        </ul>
                    </div>
                </section>
                <!-- 饼图 -->
                <section class="cake-img rel">
                    <div class="cake-title font-18 font-bold">日平台数据分布</div>
                    <div class="cake-cont" v-eline="'ysDis'"></div>
                    <div class="lable-w w-100 abs">
                        <p class="label font-14 font-bold text-center fl">活跃主播占比</p>
                        <p class="label font-14 font-bold text-center fl">日收入占比</p>
                        <p class="label font-14 font-bold text-center fl">日增粉占比</p>         
                    </div>
                </section>
            </div>
    	</div>
    </div>
</template>

<script>
import echarts from 'echarts';
import { closePgloading } from './../../../service/pageloading.service.js';

// 获取当前时间的：年-月-日 时:分:秒
function getCurrYMDHMS() {
    const curD = new Date();

    let year = curD.getFullYear(),
        month = curD.getMonth() + 1,
        day = curD.getDate(),
        hours = curD.getHours(),
        minutes = curD.getMinutes(),
        seconds = curD.getSeconds();

    // 位数不够自动补0
    if (String(month).length === 1) month = `0${month}`;
    if (String(day).length === 1) day = `0${day}`;
    if (String(hours).length === 1) hours = `0${hours}`;
    if (String(minutes).length === 1) minutes = `0${minutes}`;
    if (String(seconds).length === 1) seconds = `0${seconds}`;

    return `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;
};

// 获取本月初 或 本月尾日期：年-月-日s
function getStartEndTime(type) {
    const curD = new Date();

    let year = curD.getFullYear(),
        month = curD.getMonth() + 1,
        day = curD.getDate();

    // 位数不够自动补0
    if (String(month).length === 1) month = `0${month}`;
    if (String(day).length === 1) day = `0${day}`;

    // 返回月初日期
    if (type === 'start') return `${year}-${month}-01`;

    // 返回月尾日期
    return `${year}-${month}-${day}`;
};

// 获取昨天的日期：年-月-日
function getYsTime() {
    const 
        ysD = new Date(Date.parse(new Date()) - 1000 * 60 * 60 * 24),
        patt = /^([0-9]+)-([0-9]+)-([0-9]+)$/;

    let year = ysD.getFullYear(),
        month = ysD.getMonth() + 1,
        day = ysD.getDate();

    // 位数不够自动补0
    if (String(month).length === 1) month = `0${month}`;
    if (String(day).length === 1) day = `0${day}`;

    return `${year}-${month}-${day}`;
};

// 获取本月初 或 昨日的日期：年-月-日
function getStartYsTime(type) {
    const ysD = new Date(Date.parse(new Date()) - 1000 * 60 * 60 * 24);

    let year = ysD.getFullYear(),
        month = ysD.getMonth() + 1,
        day = ysD.getDate();

    // 位数不够自动补0
    if (String(month).length === 1) month = `0${month}`;
    if (String(day).length === 1) day = `0${day}`;

    // 返回月初日期
    if (type === 'start') return `${year}-${month}-01`;

    // 返回月尾日期
    return `${year}-${month}-${day}`;
};
    
    // 公共折线图配置
let comLineOptions = {
        title: {
            text: '最近一月数据趋势图',
            padding: 19
        },
        legend: {
            data: ['月收入趋势', '月增粉趋势'],
            right: 19,
            top: 19
        },
        tooltip: { trigger: 'axis' },
        grid: {
            left: '32px',
            right: '64px',
            bottom: '19px',
            containLabel: true
        },
        backgroundColor: '#fff'
    },

    // 公共饼图配置
    comCakeOptions = {
        tooltip: {
            trigger: 'item',
            formatter: "{a} <br/>{b} : {c} ({d}%)"
        }
    },

    // echarts插件具体配置
    echart = {
        // 当前月 收入/增粉 趋势折线图
        inAdd: {
            sref: null,
            options: null
        },
        // 昨日月 收入/增粉 趋势折线图
        ysInAdd: {
            sref: null,
            options: null
        },
        // 当日平台数据分布
        dis: {
            sref: null,
            options: null
        },
        ysDis: {
            sref: null,
            options: null
        }
    },
	InterId;

// vm对象
const vm = {
    // 组件创建完成后的钩子
    // 这里获取到页面渲染所需的数据
    created() {
        closePgloading();
        
        const 
            vm = this,
            { 
                alltoday: API_ALLTODAY,
                incomeImg: API_INCOMEIMG,
                followerImg: API_FOLLOWERIMG,
                topOnline: API_TOPONLINE,
                topIncome: API_TOINCOME,
                topFans: API_TOFANS,
                topLivetime: API_TOLIVETIME
            } = vm.$store.state.api.todayall;


        /*---------------------------------- 今日数据 ---------------------------------*/
        // 请求总览数据（实时数据、日平台数据分布）
        const alltodayPromise = new Promise((resolve, reject) => {
            vm.$http.post(API_ALLTODAY, { startTime: getCurrYMDHMS() }).then(({body: {data}}) => {
                const  { platStar, platIncome, platFollower } = data;


                let legendData = [],
                    platStarData = [],
                    platIncomeData = [],
                    platFollowerData = [];

                // 遍历可操作数据
                platStar.forEach(({name, color, sumLive: value} = val) => {
                    legendData.push(name);
                    platStarData.push({
                        name,
                        value,
                        itemStyle: {normal: {color: `#${color}`}}
                    });
                });
                platIncome.forEach(({name, color, sumRmb: value} = val) => {
                    legendData.push(name);
                    platIncomeData.push({
                        name,
                        value,
                        itemStyle: {normal: {color: `#${color}`}}
                    });
                });
                platFollower.forEach(({name, color, sumfollower: value} = val) => {
                    legendData.push(name);
                    platFollowerData.push({
                        name,
                        value,
                        itemStyle: {normal: {color: `#${color}`}}
                    });
                });

                // 剔除重复的平台字段
                legendData = [...new Set(legendData)];
                    

                // 饼图配置参数
                echart.dis.options = Object.assign({}, comCakeOptions, {
                    legend: {
                        itemGap: 30,
                        bottom: 30,
                        data: legendData
                    },
                    series: [{
                        name: '活跃主播占比',
                        type: 'pie',
                        roseType: 'radius',
                        label: { 
                            normal: { show: false },
                            emphasis: { show: true } 
                        },
                        radius: ['20%', '55%'],
                        center: ['17%', '43%'],
                        data: platStarData
                    }, {
                        name: '日收入占比',
                        type: 'pie',
                        radius: ['25%', '55%'],
                        center: ['50%', '41%'],
                        label: { 
                            normal: { show: false },
                            emphasis: { show: true } 
                        },
                        data: platIncomeData
                    }, {
                        name: '日增粉占比',
                        type: 'pie',
                        radius: ['25%', '55%'],
                        center: ['83.5%', '41%'],
                        label: { 
                            normal: { show: false },
                            emphasis: { show: true } 
                        },
                        data: platFollowerData
                    }]                    
                });
                echart.dis.sref.setOption(echart.dis.options); 
                
                // 保存数据 / 提交成功流                
                vm.showBlock = data;
                resolve(data);
            }, ({body: {msg}}) => reject(msg));
        });

        // 请求月收入趋势数据（曲线图）
        const incomePromise = new Promise((resolve, reject) => {
            vm.$http.post(API_INCOMEIMG, {
                startTime: getStartEndTime('start'),
                endTime: getStartEndTime('end')
            }).then(({body: {data}}) => resolve(data), ({body: {msg}}) => reject(msg));
        });

        // 请求月增粉趋势数据（曲线图）
        const followerPromise = new Promise((resolve, reject) => {
            vm.$http.post(API_FOLLOWERIMG, {
                startTime: getStartEndTime('start'),
                endTime: getStartEndTime('end')
            }).then(({body: {data}}) => resolve(data), ({body: {msg}}) => reject(msg));
        });

        // 月收入趋势 / 月增粉趋势总回调流
        Promise.all([incomePromise, followerPromise]).then(([income, follower]) => {
            const patt = /^([0-9]+-[0-9]+-[0-9]+)/;

            let xaxisData = [],
                incomeData = [],
                followerData = [],
                yaxisMax = 0;

            // 遍历操作月收入数据
            income.forEach(({idate, increase_rmb} = val) => {
                if (yaxisMax < increase_rmb) yaxisMax = increase_rmb;
                if (patt.test(idate)) xaxisData.unshift(RegExp.$1);

                incomeData.unshift(increase_rmb);
            });

            // 遍历操作月增粉数据
            follower.forEach(({idate, increase_follower} = val) => {
                if (yaxisMax < increase_follower) yaxisMax = increase_follower;
                if (patt.test(idate)) xaxisData.unshift(RegExp.$1);

                followerData.unshift(increase_follower);
            });

            // 剔除重复时间段
            xaxisData = [...new Set(xaxisData)];


            // 混合通用折线配置 / 渲染数据
            echart.inAdd.options = Object.assign({}, comLineOptions, {
                xAxis: {
                    splitLine: { show: true },
                    boundaryGap: false,
                    data: xaxisData
                },
                yAxis: {
                    min: 0,
                    max: yaxisMax
                },
                series: [{
                    name: '月收入趋势',
                    type: 'line',
                    smooth: true,
                    itemStyle: { normal: { color: '#29c9f1'} },
                    lineStyle: { normal: { color: '#29c9f1'} },
                    areaStyle: { normal: { color: '#54d1f0', opacity: '0.4' } },
                    data: incomeData
                }, {
                    name: '月增粉趋势',
                    type: 'line',
                    smooth: true,
                    itemStyle: { normal: { color: '#ffcb34'} },
                    lineStyle: { normal: { color: '#ffcb34' } },
                    areaStyle: { normal: { color: '#fad771', opacity: '0.4' } },
                    data: followerData
                }]
            }); 
            echart.inAdd.sref.setOption(echart.inAdd.options); 
        }).catch(msg => console.log(msg));

        // 请求在线最高主播数据
        const topOnlinePromise = new Promise((resolve, reject) => {
            vm.$http.post(API_TOPONLINE, {
                startTime: getCurrYMDHMS(),
                total: 5,
                page: 1                
            }).then(({body: {data: {data}}}) => {
                // console.log(data);
                vm.topOnline = data;

                resolve(data);
            }, ({body: {msg}}) => reject(msg));
        });

        // 请求日收入最多主播数据
        const topIncomePromise = new Promise((resolve, reject) => {
            vm.$http.post(API_TOINCOME, {
                startTime: getCurrYMDHMS(),
                total: 5,
                page: 1                
            }).then(({body: {data: {data}}}) => {
                vm.topIncome = data;

                resolve(data);
            }, ({body: {msg}}) => reject(msg));
        });

        // 请求日增粉最多主播数据
        const topFansPromise = new Promise((resolve, reject) => {
            vm.$http.post(API_TOFANS, {
                startTime: getCurrYMDHMS(),
                total: 5,
                page: 1                
            }).then(({body: {data: {data}}}) => {
                vm.topFans = data;

                resolve(data);
            }, ({body: {msg}}) => reject(msg));
        });

        // 请求日上播最多主播数据
        const topLivetimePromise = new Promise((resolve, reject) => {
            vm.$http.post(API_TOLIVETIME, {
                startTime: getCurrYMDHMS(),
                total: 5,
                page: 1
            }).then(({body: {data: {data}}}) => {
                vm.topLivetime = data;

                resolve(data);
            }, ({body: {msg}}) => reject(msg));
        });

        // 今日总览全部数据取回后总流
        Promise.all([
            alltodayPromise, 
            incomePromise, 
            followerPromise, 
            topOnlinePromise, 
            topIncomePromise, 
            topFansPromise, 
            topLivetimePromise
        ]).then(() => {
            vm.openRefTime();

            
        }).catch(msg => console.log(msg));


        /*---------------------------------- 昨日数据 ---------------------------------*/
        // 请求昨日总览数据
        const ysAlltodayPromise = new Promise((resolve, reject) => {
            vm.$http.post(API_ALLTODAY, { startTime: getYsTime() }).then(({body: {data}}) => {
                const { platStar, platIncome, platFollower } = data;
                    
                let legendData = [],
                    platStarData = [],
                    platIncomeData = [],
                    platFollowerData = [];

                // 遍历可操作数据
                platStar.forEach(({name, color, sumLive: value} = val) => {
                    legendData.push(name);
                    platStarData.push({
                        name,
                        value,
                        itemStyle: {normal: {color: `#${color}`}}
                    });
                });
                platIncome.forEach(({name, color, sumRmb: value} = val) => {
                    legendData.push(name);
                    platIncomeData.push({
                        name,
                        value,
                        itemStyle: {normal: {color: `#${color}`}}
                    });
                });
                platFollower.forEach(({name, color, sumfollower: value} = val) => {
                    legendData.push(name);
                    platFollowerData.push({
                        name,
                        value,
                        itemStyle: {normal: {color: `#${color}`}}
                    });
                });

                // 剔除重复的平台字段
                legendData = [...new Set(legendData)];

                // 饼图配置参数 / 渲染饼图
                echart.ysDis.options = Object.assign({}, comCakeOptions, {
                    legend: {
                        itemGap: 30,
                        bottom: 30,
                        data: legendData
                    },
                    series: [{
                        name: '活跃主播占比',
                        type: 'pie',
                        roseType: 'radius',
                        label: { 
                            normal: { show: false },
                            emphasis: { show: true } 
                        },
                        radius: ['20%', '55%'],
                        center: ['17%', '43%'],
                        data: platStarData
                    }, {
                        name: '日收入占比',
                        type: 'pie',
                        radius: ['25%', '55%'],
                        center: ['50%', '41%'],
                        label: { 
                            normal: { show: false },
                            emphasis: { show: true } 
                        },
                        data: platIncomeData
                    }, {
                        name: '日增粉占比',
                        type: 'pie',
                        radius: ['25%', '55%'],
                        center: ['83.5%', '41%'],
                        label: { 
                            normal: { show: false },
                            emphasis: { show: true } 
                        },
                        data: platFollowerData
                    }]                    
                });
                echart.ysDis.sref.setOption(echart.ysDis.options); 

                // 保存数据                
                vm.ysShowBlock = data;

                resolve(data);
            }, ({body: {msg}}) => reject(msg));
        });        

        // 请求昨日月收入趋势数据（曲线图）
        const ysIncomePromise = new Promise((resolve, reject) => {
            vm.$http.post(API_INCOMEIMG, {
                startTime: getStartYsTime('start'),
                endTime: getStartYsTime('end')
            }).then(({body: {data}}) => resolve(data), ({body: {msg}}) => reject(msg));
        });

        // 请求昨日月增粉趋势数据（曲线图）
        const ysFollowerPromise = new Promise((resolve, reject) => {
            vm.$http.post(API_FOLLOWERIMG, {
                startTime: getStartYsTime('start'),
                endTime: getStartYsTime('end')
            }).then(({body: {data}}) => resolve(data), ({body: {msg}}) => reject(msg));
        });

        // 昨日月收入趋势 / 昨日月增粉趋势总回调流
        Promise.all([ysIncomePromise, ysFollowerPromise]).then(([income, follower]) => {
            const patt = /^([0-9]+-[0-9]+-[0-9]+)/;

            let xaxisData = [],
                incomeData = [],
                followerData = [],
                yaxisMax = 0;

            // 遍历操作月收入数据
            income.forEach(({idate, increase_rmb} = val) => {
                if (yaxisMax < increase_rmb) yaxisMax = increase_rmb;
                if (patt.test(idate)) xaxisData.unshift(RegExp.$1);

                incomeData.unshift(increase_rmb);
            });

            // 遍历操作月增粉数据
            follower.forEach(({idate, increase_follower} = val) => {
                if (yaxisMax < increase_follower) yaxisMax = increase_follower;
                if (patt.test(idate)) xaxisData.unshift(RegExp.$1);

                followerData.unshift(increase_follower);
            });

            // 剔除重复时间段
            xaxisData = [...new Set(xaxisData)];

            // 折线配置 / 渲染折线图
            echart.ysInAdd.options = Object.assign({}, comLineOptions, {
                xAxis: {
                    splitLine: { show: true },
                    boundaryGap: false,
                    data: xaxisData
                },
                yAxis: {
                    min: 0,
                    max: yaxisMax
                },
                series: [{
                    name: '月收入趋势',
                    type: 'line',
                    smooth: true,
                    itemStyle: { normal: { color: '#29c9f1'} },
                    lineStyle: { normal: { color: '#29c9f1'} },
                    areaStyle: { normal: { color: '#54d1f0', opacity: '0.4' } },
                    data: incomeData
                }, {
                    name: '月增粉趋势',
                    type: 'line',
                    smooth: true,
                    itemStyle: { normal: { color: '#ffcb34'} },
                    lineStyle: { normal: { color: '#ffcb34' } },
                    areaStyle: { normal: { color: '#fad771', opacity: '0.4' } },
                    data: followerData
                }]                  
            }); 
            echart.ysInAdd.sref.setOption(echart.ysInAdd.options); 
        }).catch(msg => console.log(msg));

        // 请求昨日在线最高主播数据
        const ysTopOnlinePromise = new Promise((resolve, reject) => {
            vm.$http.post(API_TOPONLINE, {
                startTime: getYsTime(),
                total: 5,
                page: 1                
            }).then(({body: {data: {data}}}) => {
                // console.log(data);
                vm.ysTopOnline = data;

                resolve(data);
            }, ({body: {msg}}) => reject(msg));
        });

        // 请求昨日收入最多主播数据
        const ysTopIncomePromise = new Promise((resolve, reject) => {
            vm.$http.post(API_TOINCOME, {
                startTime: getYsTime(),
                total: 5,
                page: 1
            }).then(({body: {data: {data}}}) => {
                vm.ysTopIncome = data;

                resolve(data);
            }, ({body: {msg}}) => reject(msg));
        });

        // 请求昨日日增粉最多主播数据
        const ysTopFansPromise = new Promise((resolve, reject) => {
            vm.$http.post(API_TOFANS, {
                startTime: getYsTime(),
                total: 5,
                page: 1
            }).then(({body: {data: {data}}}) => {
                vm.ysTopFans = data;

                resolve(data);
            }, ({body: {msg}}) => reject(msg));
        });

        // 请求昨日增粉最多主播数据
        const ysTopLivetimePromise = new Promise((resolve, reject) => {
            vm.$http.post(API_TOLIVETIME, {
                startTime: getYsTime(),
                total: 5,
                page: 1                
            }).then(({body: {data: {data}}}) => {
                vm.ysTopLivetime = data;

                resolve(data);
            }, ({body: {msg}}) => reject(msg));
        });
    },
    data: () => ({
        currIndex: 0,     // 当前所在，0代表今日总览，1代表昨日总览
        refTime: 90,      // 今日总览定时刷新时长
        showBlock: {},    // 当前直播总览数据
        ysShowBlock: {},  // 昨日直播总览数据
        topOnline: [],    // 当前在线最高主播数据
        ysTopOnline: [],  // 昨日在线最高主播数据
        topIncome: [],    // 当前收入最高主播数据
        ysTopIncome: [],  // 昨日收入最高主播数据
        topFans: [],      // 当前增粉最多主播数据
        ysTopFans: [],    // 昨日增粉最多主播数据
        topLivetime: [],  // 当前上播时长最多主播数据
        ysTopLivetime: [] // 昨日上播时长最多主播数据
    }),
    watch: {
        ['refTime'](curr) {
            const 
                vm = this,
                { 
                    alltoday: API_ALLTODAY,
                    incomeImg: API_INCOMEIMG,
                    followerImg: API_FOLLOWERIMG,
                    topOnline: API_TOPONLINE,
                    topIncome: API_TOINCOME,
                    topFans: API_TOFANS,
                    topLivetime: API_TOLIVETIME
                } = vm.$store.state.api.todayall;

            // 重新启动时间倒计时器
            if (curr === 90) vm.openRefTime();

            // 异步调用新数据
            if (curr === 0) {
                vm.closeRefTime();

                // 请求总览数据（实时数据、日平台数据分布）
                const alltodayPromise = new Promise((resolve, reject) => {
                    vm.$http.post(API_ALLTODAY, { startTime: getCurrYMDHMS() }).then(({body: {data}}) => {
                        const { platStar, platIncome, platFollower } = data;
                            
                        let legendData = [],
                            platStarData = [],
                            platIncomeData = [],
                            platFollowerData = [];

                        // 遍历可操作数据
                        platStar.forEach(({name, color, sumLive: value} = val) => {
                            legendData.push(name);
                            platStarData.push({
                                name,
                                value,
                                itemStyle: {normal: {color: `#${color}`}}
                            });
                        });
                        platIncome.forEach(({name, color, sumRmb: value} = val) => {
                            legendData.push(name);
                            platIncomeData.push({
                                name,
                                value,
                                itemStyle: {normal: {color: `#${color}`}}
                            });
                        });
                        platFollower.forEach(({name, color, sumfollower: value} = val) => {
                            legendData.push(name);
                            platFollowerData.push({
                                name,
                                value,
                                itemStyle: {normal: {color: `#${color}`}}
                            });
                        });

                        // 剔除重复的平台字段
                        legendData = [...new Set(legendData)];

                        // 饼图配置参数 / 渲染饼图
                        echart.dis.options = Object.assign({}, comCakeOptions, {
                            legend: {
                                itemGap: 30,
                                bottom: 30,
                                data: legendData
                            },
                            series: [{
                                name: '活跃主播占比',
                                type: 'pie',
                                roseType: 'radius',
                                label: { 
                                    normal: { show: false },
                                    emphasis: { show: true } 
                                },
                                radius: ['20%', '55%'],
                                center: ['17%', '43%'],
                                data: platStarData
                            }, {
                                name: '日收入占比',
                                type: 'pie',
                                radius: ['25%', '55%'],
                                center: ['50%', '41%'],
                                label: { 
                                    normal: { show: false },
                                    emphasis: { show: true } 
                                },
                                data: platIncomeData
                            }, {
                                name: '日增粉占比',
                                type: 'pie',
                                radius: ['25%', '55%'],
                                center: ['83.5%', '41%'],
                                label: { 
                                    normal: { show: false },
                                    emphasis: { show: true } 
                                },
                                data: platFollowerData
                            }]                            
                        });
                        echart.dis.sref.setOption(echart.dis.options); 

                        // 保存数据                
                        vm.showBlock = data;

                        resolve(data);
                    }, ({body: {msg}}) => reject(msg));
                });

                // 请求月收入趋势数据（曲线图）
                const incomePromise = new Promise((resolve, reject) => {
                    vm.$http.post(API_INCOMEIMG, {
                        startTime: getStartEndTime('start'),
                        endTime: getStartEndTime('end')
                    }).then(({body: {data}}) => resolve(data), ({body: {msg}}) => reject(msg));   
                });

                // 请求月增粉趋势数据（曲线图）
                const followerPromise = new Promise((resolve, reject) => {
                    vm.$http.post(API_FOLLOWERIMG, {
                        startTime: getStartEndTime('start'),
                        endTime: getStartEndTime('end')                        
                    }).then(({body: {data}}) => resolve(data), ({body: {msg}}) => reject(msg));
                });

                // 月收入趋势 / 月增粉趋势总回调流
                Promise.all([incomePromise, followerPromise]).then(([income, follower]) => {
                    const patt = /^([0-9]+-[0-9]+-[0-9]+)/;

                    let xaxisData = [],
                        incomeData = [],
                        followerData = [],
                        yaxisMax = 0;

                    // 遍历操作月收入数据
                    income.forEach(({idate, increase_rmb} = val) => {
                        if (yaxisMax < increase_rmb) yaxisMax = increase_rmb;
                        if (patt.test(idate)) xaxisData.unshift(RegExp.$1);

                        incomeData.unshift(increase_rmb);
                    });

                    // 遍历操作月增粉数据
                    follower.forEach(({idate, increase_follower} = val) => {
                        if (yaxisMax < increase_follower) yaxisMax = increase_follower;
                        if (patt.test(idate)) xaxisData.unshift(RegExp.$1);

                        followerData.unshift(increase_follower);
                    });

                    // 剔除重复时间段
                    xaxisData = [...new Set(xaxisData)];

                    // 折线配置 / 渲染折线图
                    echart.inAdd.options = Object.assign({}, comLineOptions, {
                        xAxis: {
                            splitLine: { show: true },
                            boundaryGap: false,
                            data: xaxisData
                        },
                        yAxis: {
                            min: 0,
                            max: yaxisMax
                        },
                        series: [{
                            name: '月收入趋势',
                            type: 'line',
                            smooth: true,
                            itemStyle: { normal: { color: '#29c9f1'} },
                            lineStyle: { normal: { color: '#29c9f1'} },
                            areaStyle: { normal: { color: '#54d1f0', opacity: '0.4' } },
                            data: incomeData
                        }, {
                            name: '月增粉趋势',
                            type: 'line',
                            smooth: true,
                            itemStyle: { normal: { color: '#ffcb34'} },
                            lineStyle: { normal: { color: '#ffcb34' } },
                            areaStyle: { normal: { color: '#fad771', opacity: '0.4' } },
                            data: followerData
                        }]        
                    }); 
                    echart.inAdd.sref.setOption(echart.inAdd.options); 
                }).catch(msg => console.log(msg));

                // 请求在线最高主播数据
                const topOnlinePromise = new Promise((resolve, reject) => {
                    vm.$http.post(API_TOPONLINE, {
                        startTime: getCurrYMDHMS(),
                        total: 5,
                        page: 1                        
                    }).then(({body: {data: {data}}}) => {
                        vm.topOnline = data;

                        resolve(data);
                    }, ({body: {msg}}) => reject(msg));
                });

                // 请求日收入最多主播数据
                const topIncomePromise = new Promise((resolve, reject) => {
                    vm.$http.post(API_TOINCOME, {
                        startTime: getCurrYMDHMS(),
                        total: 5,
                        page: 1                            
                    }).then(({body: {data: {data}}}) => {
                        vm.topIncome = data;

                        resolve(data);
                    }, ({body: {msg}}) => reject(msg));
                });

                // 请求日增粉最多主播数据
                const topFansPromise = new Promise((resolve, reject) => {
                    vm.$http.post(API_TOFANS, {
                        startTime: getCurrYMDHMS(),
                        total: 5,
                        page: 1                            
                    }).then(({body: {data: {data}}}) => {
                        vm.topFans = data;

                        resolve(data);
                    }, ({body: {msg}}) => reject(msg));
                });

                // 请求日增粉最多主播数据
                const topLivetimePromise = new Promise((resolve, reject) => {
                    vm.$http.post(API_TOLIVETIME, {
                        startTime: getCurrYMDHMS(),
                        total: 5,
                        page: 1                           
                    }).then(({body: {data: {data}}}) => {
                        vm.topLivetime = data;

                        resolve(data);
                    }, ({body: {msg}}) => reject(msg));
                });

                // 今日总览全部数据取回后总流
                Promise.all([
                    alltodayPromise, 
                    incomePromise, 
                    followerPromise, 
                    topOnlinePromise, 
                    topIncomePromise, 
                    topFansPromise, 
                    topLivetimePromise
                ]).then(() => vm.refTime = 90).catch(msg => console.log(msg));
            };
        }
    },
    filters: {
        // 显示时分秒
        showhms: val => {
            if (/\s([0-9]+:[0-9]+:[0-9]+)$/.test(val)) return RegExp.$1;   

            return val;
        }
    },
    methods: {
        // 切换今日总览和昨天总览
        switchCurrIndex(index) {
            if (this.currIndex !== index) this.currIndex = index;
        },
        // 开启时长刷新器
        openRefTime() {
            let vm = this;

            InterId = setInterval(() => {
                vm.refTime = --vm.refTime;
            }, 1000);
        },
        // 关闭时长刷新器
        closeRefTime() {
            clearInterval(InterId);
        }
    },
    directives: {
        // echart插件的折线图指令
        eline: {
            inserted: (el, {value} = binding) => {
                echart[value].sref = echarts.init(el);
            }
        }
    }
};


// 暴露组件配置
export default Object.assign({ name: 'p-todayall' }, vm);
</script>