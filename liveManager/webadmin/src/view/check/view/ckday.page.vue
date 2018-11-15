/**
 * Created by miaoyu on 2016/12/16 0016.
 */
<template>
    <div id="p-checkday">
    	<header class="header">
			<span class="title h-100 font-18 font-bold fl">日考勤报表</span>
            <div class="seldate font-14 fr">
                <co-seldate class="sel-input"
                            :options="dateCF"
                            :placeholder="currDate"
                            @updateDate="updateDate" />
            </div>
    	</header>
        <section class="show-block">
            <div class="block-item h-100 rel fl text-center">
                <div class="item font-14">考勤人数 (人)</div>
                <div class="cont font-30 font-bold text-hidden">{{ allCheck }}</div>
            </div>
            <div class="block-item h-100 rel fl text-center">
                <div class="item font-14">达标人数 (元)</div>
                <div class="cont font-30 font-bold text-hidden">{{ standard }}</div>
            </div>
            <div class="block-item h-100 rel fl text-center">
                <div class="item font-14">达标率 (人)</div>
                <div class="cont font-30 font-bold text-hidden">{{ standardRate }}%</div>
            </div>
        </section>
        <section class="main-sel">
            <ul class="sel-title clear">
                <li class="sel-tab font-16 text-center text-none-sel fl rel c-pointer"
                    :class="{'sel': currShow === 0}"
                    @click="switchTab(0)">达标主播</li>
                <li class="sel-tab font-16 text-center text-none-sel fl rel c-pointer"
                    :class="{'sel': currShow === 1}"
                    @click="switchTab(1)">未达标主播</li>
                <li class="sel-tab font-16 text-center text-none-sel fl rel c-pointer"
                    :class="{'sel': currShow === 2}"
                    @click="switchTab(2)">小组考勤</li>
            </ul>
            <div class="sel-cont">
                <transition name="table-fade">
                    <!-- 达标主播 -->
                    <div class="Standard-table table" v-if="currShow === 0" key="table0">
                        <div class="table-thead clear">
                            <span class="table-th font-16 font-bold text-center fl">主播</span>
                            <span class="table-th font-16 font-bold text-center fl">达标</span>
                            <span class="table-th font-16 font-bold text-center fl">在播时长</span>
                            <span class="table-th font-16 font-bold text-center fl">平台&ID</span>
                            <span class="table-th font-16 font-bold text-center fl">收入</span>
                            <span class="table-th font-16 font-bold text-center fl">增粉</span>
                            <span class="table-th font-16 font-bold text-center fl">等级</span>
                            <span class="table-th font-16 font-bold text-center fl">经纪人</span>
                        </div>
                        <ul class="table-tbody">
                            <router-link :to="'/admin/ahdetail/'+ item.platform +'/'+ item.platformid"
                                         class="table-tr clear c-pointer" 
                                         v-for="(item, $index) in monthStarRateTable" tag="li">
                                <div class="table-td h-100 font-16 fl">
                                	<span class="sort font-16 text-center text-hidden fl">{{ $index + 1 }}</span>
                                	<img class="userimg arc fl" :src="item.avatar" 
                                                                :alt="item.remark || item.nickname">
                                	<div class="username font-16 text-hidden">{{ item.remark || item.nickname }}</div>
                                </div>
                                <div class="table-td h-100 font-16 text-center fl">
                                	<span class="ico icon-home" v-show="item.reachStandard === 1"></span>
                                </div>
                                <div class="table-td h-100 font-16 text-center text-hidden fl">{{ item.workTime }}小时</div>
                                <div class="table-td h-100 font-16 text-center text-hidden fl">
                                	<p class="platform font-16 text-center text-hidden">{{ item.platname }}</p>
                                	<p class="anchor-id font-14 text-center text-hidden">ID:{{ item.platformid }}</p>
                                </div>
                                <div class="table-td h-100 font-16 text-center text-hidden fl">
                                	<p class="rmb font-16 text-center text-hidden">{{ item.rmb }}元</p>
                                	<p class="game font-14 text-center text-hidden">{{ item.income }}{{ item.ratename }}</p>
                                </div>
                                <div class="table-td h-100 font-16 text-center text-hidden fl">{{ item.follower }}人</div>
                                <div class="table-td h-100 font-16 text-center text-hidden fl">{{ item.levelname }}</div>
                                <div class="table-td h-100 font-16 text-center text-hidden fl">{{ item.agentname }}</div>
                            </router-link>
                        </ul>
                        <div class="table-tfooter">
                            <co-pages :index="monthStarRatePages.index"
                                      :limit="monthStarRatePages.limit"
                                      :total="monthStarRatePages.total"
                                      v-on:switchPage="monthStarRateSwitchPage" />
                        </div>
                    </div>
                    <!-- 未达标主播 -->
                    <div class="notStandard-table table" v-if="currShow === 1" key="table1">
                        <div class="table-thead clear">
                            <span class="table-th font-16 font-bold text-center fl">主播</span>
                            <span class="table-th font-16 font-bold text-center fl">未达标</span>
                            <span class="table-th font-16 font-bold text-center fl">在播时长</span>
                            <span class="table-th font-16 font-bold text-center fl">平台&ID</span>
                            <span class="table-th font-16 font-bold text-center fl">收入</span>
                            <span class="table-th font-16 font-bold text-center fl">增粉</span>
                            <span class="table-th font-16 font-bold text-center fl">等级</span>
                            <span class="table-th font-16 font-bold text-center fl">经纪人</span>
                        </div>
                        <ul class="table-tbody">
                            <router-link :to="'/admin/ahdetail/'+ item.platform +'/'+ item.platformid"
                                         class="table-tr clear c-pointer" 
                                         v-for="(item, $index) in monthUnrateStarTable" tag="li">
                                <div class="table-td h-100 font-16 fl">
                                	<span class="sort font-16 text-center text-hidden fl">{{ $index + 1 }}</span>
                                	<img class="userimg arc fl" :src="item.avatar" 
                                                                :alt="item.remark || item.nickname">
                                	<div class="username font-16 text-hidden">{{ item.remark || item.nickname }}</div>
                                </div>
                                <div class="table-td h-100 font-16 text-center fl">
                                	<span class="ico icon-home" v-show="item.reachStandard === 0 || item.reachStandard === null"></span>
                                </div>
                                <div class="table-td h-100 font-16 text-center text-hidden fl">{{ item.workTime }}小时</div>
                                <div class="table-td h-100 font-16 text-center text-hidden fl">
                                	<p class="platform font-16 text-center text-hidden">{{ item.platname }}</p>
                                	<p class="anchor-id font-14 text-center text-hidden">ID:{{ item.platformid }}</p>
                                </div>
                                <div class="table-td h-100 font-16 text-center text-hidden fl">
                                	<p class="rmb font-16 text-center text-hidden">{{ item.rmb }}元</p>
                                	<p class="game font-14 text-center text-hidden">{{ item.income }}{{ item.ratename }}</p>
                                </div>
                                <div class="table-td h-100 font-16 text-center text-hidden fl">{{ item.follower }}人</div>
                                <div class="table-td h-100 font-16 text-center text-hidden fl">{{ item.levelname }}</div>
                                <div class="table-td h-100 font-16 text-center text-hidden fl">{{ item.agentname }}</div>
                            </router-link>
                        </ul>
                        <div class="table-tfooter">
                            <co-pages :index="monthUnrateStarPages.index"
                                      :limit="monthUnrateStarPages.limit"
                                      :total="monthUnrateStarPages.total"
                                      v-on:switchPage="monthUnrateStarSwitchPage" />
                        </div>
                    </div>
                    <!-- 小组考勤 -->
                    <div class="group-table table" v-if="currShow === 2" key="table2">
                        <div class="table-thead clear">
                            <span class="table-th font-16 font-bold text-center fl">排名</span>
                            <span class="table-th font-16 font-bold text-center fl">经纪人</span>
                            <span class="table-th font-16 font-bold text-center fl">旗下主播</span>
                            <span class="table-th font-16 font-bold text-center fl">达标人数</span>
                            <span class="table-th font-16 font-bold text-center fl">未达标人数</span>
                            <span class="table-th font-16 font-bold text-center fl">达标率</span>
                        </div>
                        <ul class="table-tbody">
                            <li class="table-tr" v-for="(item, $index) in monthGourpsTable">
								<div class="table-td h-100 font-16 text-center text-hidden fl">{{ $index + 1 }}</div>
								<div class="table-td h-100 font-16 text-center text-hidden fl">{{ item.agentname }}</div>
								<div class="table-td h-100 font-16 text-center text-hidden fl">{{ item.icount }}人</div>
                                <div class="table-td h-100 font-16 text-center text-hidden fl">{{ item.irate }}人</div>
                                <div class="table-td h-100 font-16 text-center text-hidden fl">{{ item.unrate }}人</div>
                                <div class="table-td h-100 font-16 text-center text-hidden fl">{{ item.percent }}%</div>
                            </li>
                        </ul>
                        <div class="table-tfooter">
                            <co-pages :index="monthGourpsPages.index"
                                      :limit="monthGourpsPages.limit"
                                      :total="monthGourpsPages.total"
                                      v-on:switchPage="monthGourpsSwitchPage" />
                        </div>
                    </div>
                </transition>
            </div>	
        </section>
    </div>
</template>


<script>
import coPages from './../../../components/pages.vue';
import coSeldate from './../../../components/seldate.vue';
import { closePgloading } from './../../../service/pageloading.service.js';



// 获取当前时间的：年-月-日
function getCurrYMD() {
    const curD = new Date();

    let year = curD.getFullYear(),
        month = curD.getMonth() + 1,
        day = curD.getDate();

    // 位数不够自动补0
    if (String(month).length === 1) month = `0${month}`;
    if (String(day).length === 1) day = `0${day}`;

    return `${year}-${month}-${day}`;
};

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

// 获取本月初 或 本月尾日期：年-月-日
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


// vm对象
const vm = {
    // 组件创建完成后的钩子
    // 这里获取到页面渲染所需的数据
    created() {
        closePgloading();
        
        const
            vm = this,
            { state: {api: {dayCheck: {
                pageWork: API_PAGEWORK,
                starRate: API_STARRATE,
                unrateStar: API_UNRATESTAR,
                gourps: API_GOURPS
            }}} } = vm.$store;    


        // 请求日考勤统计数据        
        vm.$http.post(API_PAGEWORK, { startTime: getCurrYMDHMS() }).then(({body: {data: {workNum, rateNum, percent}}}) => {
            vm.allCheck = workNum;
            vm.standard = rateNum;
            vm.standardRate = percent;
        }, ({body: {msg}}) => console.log(msg));    


        // 请求达标数据
        vm.$http.post(API_STARRATE, {
            startTime: getCurrYMDHMS(),
            page: vm.monthStarRatePages.index,
            total: vm.monthStarRatePages.limit
        }).then(({body: {data: {pageNum, data}}}) => {
            // 挂载数据
            vm.monthStarRatePages.total = vm.monthStarRatePages.limit * pageNum;
            vm.monthStarRateTable = data;
        }, ({body: {msg}}) => console.log(msg));


        // 请求未达标数据
        vm.$http.post(API_UNRATESTAR, {
            startTime: getCurrYMDHMS(),
            page: vm.monthUnrateStarPages.index,
            total: vm.monthUnrateStarPages.limit
        }).then(({body: {data: {pageNum, data}}}) => {
            // 挂载数据
            vm.monthUnrateStarPages.total = vm.monthUnrateStarPages.limit * pageNum;
            vm.monthUnrateStarTable = data;
        }, ({body: {msg}}) => console.log(msg));


        // 请求小组榜数据
        vm.$http.post(API_GOURPS, {
            startTime: getCurrYMDHMS(),
            page: vm.monthGourpsPages.index,
            total: vm.monthGourpsPages.limit
        }).then(({body: {data: {pageNum, data}}}) => {
            // 挂载数据
            vm.monthGourpsPages.total = vm.monthGourpsPages.limit * pageNum;
            vm.monthGourpsTable = data;
        }, ({body: {msg}}) => console.log(msg));
    },
    data: () => ({
        dateCF: {                 // 时间组件配置
            mode: 'single',       //—— 选择的模式
            maxDate: getCurrYMD(), //—— 最大可选择时间
        },      
        currDate: getCurrYMD(), // 时间组件当前选择的时间
        currShow: 0,            //—— 当前显示榜单
        allCheck: null,         //—— 考勤总人数
        standard: null,         //—— 达标总人数
        standardRate: null,     //—— 总达标率
        monthStarRateTable: [], //—— 月达标主播数据
        monthStarRatePages: {   //—— 月达标主播明细分页
            index: 1,           //—— 当前的页码
            limit: 10,          //—— 翻页的条数
            total: 10,          //—— 总条数
        }, 
        monthUnrateStarTable: [], //—— 月未达标主播数据
        monthUnrateStarPages: {   //—— 月未达标主播明细分页
            index: 1,             //—— 当前的页码
            limit: 10,            //—— 翻页的条数
            total: 10,            //—— 总条数
        }, 
        monthGourpsTable: [], //—— 小组数据
        monthGourpsPages: {   //—— 小组明细分页
            index: 1,         //—— 当前的页码
            limit: 10,        //—— 翻页的条数
            total: 10,        //—— 总条数
        }, 
    }),
    components: { coPages, coSeldate },
    methods: {
        // 修改日期
        updateDate(dateStr) {
            if (this.currDate !== dateStr) {
                const
                    vm = this,
                    { state: {api: {dayCheck: {
                        pageWork: API_PAGEWORK,
                        starRate: API_STARRATE,
                        unrateStar: API_UNRATESTAR,
                        gourps: API_GOURPS
                    }}} } = vm.$store;    


                // 请求日考勤统计数据        
                vm.$http.post(API_PAGEWORK, { startTime: dateStr }).then(({body: {data: {workNum, rateNum, percent}}}) => {
                    vm.allCheck = workNum;
                    vm.standard = rateNum;
                    vm.standardRate = percent;
                }, ({body: {msg}}) => console.log(msg));    


                // 请求榜数据
                vm.$http.post(API_STARRATE, {
                    startTime: dateStr,
                    page: vm.monthStarRatePages.index,
                    total: vm.monthStarRatePages.limit
                }).then(({body: {data: {pageNum, data}}}) => {
                    // 挂载数据
                    vm.monthStarRatePages.index = 1;
                    vm.monthStarRatePages.total = vm.monthStarRatePages.limit * pageNum;
                    vm.monthStarRateTable = data;
                }, ({body: {msg}}) => console.log(msg));


                // 请求平台榜数据
                vm.$http.post(API_UNRATESTAR, {
                    startTime: dateStr,
                    page: vm.monthUnrateStarPages.index,
                    total: vm.monthUnrateStarPages.limit
                }).then(({body: {data: {pageNum, data}}}) => {
                    // 挂载数据
                    vm.monthUnrateStarPages.index = 1;
                    vm.monthUnrateStarPages.total = vm.monthUnrateStarPages.limit * pageNum;
                    vm.monthUnrateStarTable = data;
                }, ({body: {msg}}) => console.log(msg));


                // 请求平台榜数据
                vm.$http.post(API_GOURPS, {
                    startTime: dateStr,
                    page: vm.monthGourpsPages.index,
                    total: vm.monthGourpsPages.limit
                }).then(({body: {data: {pageNum, data}}}) => {
                    // 挂载数据
                    vm.monthGourpsPages.index = 1;
                    vm.monthGourpsPages.total = vm.monthGourpsPages.limit * pageNum;
                    vm.monthGourpsTable = data;
                }, ({body: {msg}}) => console.log(msg));
            };
        },
        // 切换达标主播明细分页
        monthStarRateSwitchPage(index) {
            const 
                vm = this,
                API_STARRATE = vm.$store.state.api.dayCheck.starRate;

            // 请求数据
            vm.$http.post(API_STARRATE, {
                startTime: getCurrYMDHMS(),
                page: index,
                total: vm.monthStarRatePages.limit
            }).then(({body: {data: {pageNum, data}}}) => {
                // 挂载数据
                vm.monthStarRatePages.index = index;
                vm.monthStarRateTable = data;    
            }, ({body: {msg}}) => console.log(msg));
        },
        // 切换未达标明细分页
        monthUnrateStarSwitchPage(index) {
            const 
                vm = this,
                API_UNRATESTAR = vm.$store.state.api.dayCheck.unrateStar;

            // 请求数据
            vm.$http.post(API_UNRATESTAR, {
                startTime: getCurrYMDHMS(),
                page: index,
                total: vm.monthUnrateStarPages.limit
            }).then(({body: {data: {pageNum, data}}}) => {
                // 挂载数据
                vm.monthUnrateStarPages.index = index;
                vm.monthUnrateStarTable = data;    
            }, ({body: {msg}}) => console.log(msg));
        },
        // 切换小组明细分页
        monthGourpsSwitchPage(index) {
            const 
                vm = this,
                API_GOURPS = vm.$store.state.api.dayCheck.gourps;

            // 请求数据
            vm.$http.post(API_GOURPS, {
                startTime: getCurrYMDHMS(),
                page: index,
                total: vm.monthGourpsPages.limit
            }).then(({body: {data: {pageNum, data}}}) => {
                // 挂载数据
                vm.monthGourpsPages.index = index;
                vm.monthGourpsTable = data;    
            }, ({body: {msg}}) => console.log(msg));
        },
        // 切换榜单
        switchTab(index) {
            if (index !== this.currShow) this.currShow = index;
        }    	
    }
};


// 暴露组件配置
export default Object.assign({ name: 'p-checkday' }, vm);
</script>


<style lang="less" scoped>
    #p-checkday {
        /*头部样式*/
        .header {
            height: 50px;
            background: #fff;
            
            .title {
                margin-left: 20px;
                line-height: 50px;
            }
            .seldate {
                width: 118px;
                height: 28px;
                margin-top: 11px;
                margin-right: 20px;
                background: #f7f7f7;
                border-radius: 18px;
            }
            .sel-input {
                width: 100%;
                height: 14px;
                padding: 7px 0;
                color: #05bcd4;
                background: transparent;
            }
        }

		/*展示块*/
		.show-block {
			height: 120px;
			margin: 20px;
			background: #fff;

			.block-item {
				width: 33.33333333%;
				height: 115px;

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

				&:nth-child(1) {
					border-bottom: 5px solid #fad771;
				}
				&:nth-child(2) {
					border-bottom: 5px solid #85c737;
				}
				&:nth-child(3) {
					border-bottom: 5px solid #29c9f1;
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

        /*主体*/
        .main-sel {
            margin: 0 20px;
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
                height: 919px;
            }
            .table-thead {
                height: 55px;
                border-bottom: 2px solid #eaeaea;
            }
            .table-tfooter {
                height: 72px;
            }

            /*达标主播*/
            .Standard-table,
            .notStandard-table {
            	.table-tr {
                    height: 78px;
                    border-bottom: 1px solid #eaeaea;
                }
                .table-th,
                .table-td {
                	&:nth-child(1) {
                		width: 24%;
                	}
                	&:nth-child(2) {
                		width: 11%;
                	}
                	&:nth-child(3) {
                		width: 12%;
                	}
                	&:nth-child(4) {
                		width: 12%;
                	}
                	&:nth-child(5) {
                		width: 14%;
                	}
                	&:nth-child(6) {
                		width: 10%;
                	}
                	&:nth-child(7) {
                		width: 7%;
                	}
                	&:nth-child(8) {
                		width: 10%;
                	}
                }
                .table-th {
                    line-height: 55px;
                }
                .table-td {
                    color: #333c44;
                    line-height: 78px;
                }
                .sort {
                	width: 39px;
                	line-height: 78px;
                }
                .userimg {
                	width: 52px;
                	height: 52px;
                	margin-top: 13px;
                }
                .username {
                	margin-left: 103px;
                }
                .ico {
                	color: #ff597c;
                	font-size: 54px;
                	line-height: 78px;
                }
                .platform,
                .rmb{
                	height: 30px;
                	margin-top: 11px;
                	line-height: 30px;
                }
                .anchor-id,
                .game {
                	height: 24px;
                	color: #c1c1c1;
                	line-height: 24px;
                }

            }

            /*小组考勤*/
            .group-table {
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
                        width: 12%;
                    }
                    &:nth-child(2) {
                        width: 18%;
                    }
                    &:nth-child(3) {
                        width: 18%;
                    }
                    &:nth-child(4) {
                        width: 18%;
                    }
                    &:nth-child(5) {
                        width: 17%;
                    }
                    &:nth-child(6) {
                        width: 17%;
                    }
                }
                .table-td {
                	line-height: 78px;
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
    }
</style>