/**
 * Created by miaoyu on 2016/12/16 0016.
 */
<template>
    <div id="p-ckmonth">
		<header class="header">
			<span class="title h-100 font-18 font-bold fl">月考勤报表</span>
            <div class="seldate font-14 fr">
                <co-seldate class="sel-input"
                            :options="dateCF"
                            :placeholder="currDate"
                            @updateDate="updateDate" />
            </div>
    	</header>
    	<section class="all-show">
    		<div class="all-left h-100 fl">
    			<span class="label db font-14">本月考勤达标率</span>
    			<p class="cont text-hidden font-30 font-bold color-white"
    			   :title="monthIncome">{{ monthRate }}%</p>
    			<span class="label db font-14">考勤人数(人)</span>
    			<p class="cont text-hidden font-30 font-bold color-white" 
    			   :title="allIncome">{{ allPerson }}</p>
    		</div>
    		<div class="all-right h-100" v-eline="'inAdd'"></div>
    	</section>
    	<section class="main-sel">
            <ul class="sel-title clear">
                <li class="sel-tab font-16 text-center text-none-sel fl rel c-pointer"
                    :class="{'sel': currShow === 0}"
                    @click="switchTab(0)">本月考勤明细</li>
                <li class="sel-tab font-16 text-center text-none-sel fl rel c-pointer"
                    :class="{'sel': currShow === 1}"
                    @click="switchTab(1)">全勤主播</li>
                <li class="sel-tab font-16 text-center text-none-sel fl rel c-pointer"
                    :class="{'sel': currShow === 2}"
                    @click="switchTab(2)">缺勤主播</li>
                    <li class="sel-tab font-16 text-center text-none-sel fl rel c-pointer"
                    :class="{'sel': currShow === 3}"
                    @click="switchTab(3)">小组考勤</li>
            </ul>
            <div class="sel-cont">
                <transition name="table-fade">
                    <!-- 达标主播 -->
                    <div class="month-table table" v-if="currShow === 0" key="table0">
                        <div class="table-thead clear">
                            <span class="table-th font-16 font-bold text-center fl">日期</span>
                            <span class="table-th font-16 font-bold text-center fl">考勤人数</span>
                            <span class="table-th font-16 font-bold text-center fl">达标人数</span>
                            <span class="table-th font-16 font-bold text-center fl">达标率</span>
                            <span class="table-th font-16 font-bold text-center fl">人均在线时长</span>
                        </div>
                        <ul class="table-tbody">
                            <li class="table-tr" v-for="item of monthdetailPages.data">
								<div class="table-td h-100 font-16 text-center text-hidden fl">{{ item.idate | showymd }}</div>
								<div class="table-td h-100 font-16 text-center text-hidden fl">{{ item.attendStar }}人</div>
                                <div class="table-td h-100 font-16 text-center text-hidden fl">{{ item.achieveNum }}人</div>
                                <div class="table-td h-100 font-16 text-center text-hidden fl">{{ item.achieveNum }}%</div>
                                <div class="table-td h-100 font-16 text-center text-hidden fl">{{ item.avgWorkTime }}小时</div>
                            </li>
                        </ul>
                        <div class="table-tfooter">
                            <co-pages :index="monthdetailPages.index"
                                      :limit="monthdetailPages.limit"
                                      :total="monthdetailPages.total"
                                      v-on:switchPage="monthdetailSwitchPage" />
                        </div>
                    </div>
                    <!-- 全勤主播 -->
                    <div class="check-table table" v-if="currShow === 1" key="table1">
                        <div class="table-thead clear">
                            <span class="table-th font-16 font-bold text-center fl">主播</span>
                            <span class="table-th font-16 font-bold text-center fl">达标</span>
                            <span class="table-th font-16 font-bold text-center fl">考勤天数</span>
                            <span class="table-th font-16 font-bold text-center fl">达标天数</span>
                            <span class="table-th font-16 font-bold text-center fl">月在播时长</span>
                            <span class="table-th font-16 font-bold text-center fl">月达标率</span>
                            <span class="table-th font-16 font-bold text-center fl">等级</span>
                            <span class="table-th font-16 font-bold text-center fl">经纪人</span>
                        </div>
                        <ul class="table-tbody">
                            <router-link :to="'/admin/ahdetail/'+ item.platform +'/'+ item.platformid"
                                         class="table-tr clear c-pointer" 
                                         v-for="(item, $index) in rateStarPages.data" tag="li">
                                <div class="table-td h-100 font-16 fl">
                                	<span class="sort font-16 text-center text-hidden fl">{{ $index + 1 }}</span>
                                	<img class="userimg arc fl" :src="item.avatar" 
                                                                :alt="item.remark || item.nickname">
                                	<div class="username font-16 text-hidden">{{ item.remark || item.nickname }}</div>
                                	<div class="anchor-id font-14 text-hidden">{{ item.platname }}:{{ item.platformid }}</div>
                                </div>
                                <div class="table-td h-100 font-16 text-center fl">
                                	<span class="ico icon-home" v-show="item.reachStandard === 1"></span>
                                </div>
                                <div class="table-td h-100 font-16 text-center text-hidden fl">{{ item.icount }}天</div>
                                <div class="table-td h-100 font-16 text-center text-hidden fl">{{ item.ratedays }}天</div>
                                <div class="table-td h-100 font-16 text-center text-hidden fl">{{ item.worktime }}小时</div>
                                <div class="table-td h-100 font-16 text-center text-hidden fl">{{ item.percent }}%</div>
                                <div class="table-td h-100 font-16 text-center text-hidden fl">{{ item.levelname }}</div>
                                <div class="table-td h-100 font-16 text-center text-hidden fl">{{ item.agentname }}</div>
                            </router-link>
                        </ul>
                        <div class="table-tfooter">
                            <co-pages :index="rateStarPages.index"
                                      :limit="rateStarPages.limit"
                                      :total="rateStarPages.total"
                                      v-on:switchPage="rateStarSwitchPage" />
                        </div>
                    </div>
                    <!-- 缺勤主播 -->
                    <div class="not-check-table table" v-if="currShow === 2" key="table2">
                        <div class="table-thead clear">
                            <span class="table-th font-16 font-bold text-center fl">主播</span>
                            <span class="table-th font-16 font-bold text-center fl">未达标</span>
                            <span class="table-th font-16 font-bold text-center fl">考勤天数</span>
                            <span class="table-th font-16 font-bold text-center fl">达标天数</span>
                            <span class="table-th font-16 font-bold text-center fl">月在播时长</span>
                            <span class="table-th font-16 font-bold text-center fl">月达标率</span>
                            <span class="table-th font-16 font-bold text-center fl">等级</span>
                            <span class="table-th font-16 font-bold text-center fl">经纪人</span>
                        </div>
                        <ul class="table-tbody">
                            <router-link :to="'/admin/ahdetail/'+ item.platform +'/'+ item.platformid"
                                         class="table-tr clear c-pointer" 
                                         v-for="(item, $index) in unrateStarPages.data" tag="li">
                                <div class="table-td h-100 font-16 fl">
                                	<span class="sort font-16 text-center text-hidden fl">{{ $index + 1 }}</span>
                                	<img class="userimg arc fl" :src="item.avatar" 
                                                                :alt="item.remark || item.nickname">
                                	<div class="username font-16 text-hidden">{{ item.remark || item.nickname }}</div>
                                	<div class="anchor-id font-14 text-hidden">{{ item.platname }}:{{ item.platformid }}</div>
                                </div>
                                <div class="table-td h-100 font-16 text-center fl">
                                	<span class="ico icon-home" v-show="item.reachStandard === 0 || item.reachStandard === null"></span>
                                </div>
                                <div class="table-td h-100 font-16 text-center text-hidden fl">{{ item.icount }}天</div>
                                <div class="table-td h-100 font-16 text-center text-hidden fl">{{ item.ratedays }}天</div>
                                <div class="table-td h-100 font-16 text-center text-hidden fl">{{ item.worktime }}小时</div>
                                <div class="table-td h-100 font-16 text-center text-hidden fl">{{ item.percent }}%</div>
                                <div class="table-td h-100 font-16 text-center text-hidden fl">{{ item.levelname }}</div>
                                <div class="table-td h-100 font-16 text-center text-hidden fl">{{ item.agentname }}</div>
                            </router-link>
                        </ul>
                        <div class="table-tfooter">
                            <co-pages :index="unrateStarPages.index"
                                      :limit="unrateStarPages.limit"
                                      :total="unrateStarPages.total"
                                      v-on:switchPage="unrateStarSwitchPage" />
                        </div>
                    </div>
                    <!-- 小组考勤 -->
                    <div class="group-table table" v-if="currShow === 3" key="table3">
                        <div class="table-thead clear">
                            <span class="table-th font-16 font-bold text-center fl">排名</span>
                            <span class="table-th font-16 font-bold text-center fl">经纪人</span>
                            <span class="table-th font-16 font-bold text-center fl">旗下主播</span>
                            <span class="table-th font-16 font-bold text-center fl">月达标人数</span>
                            <span class="table-th font-16 font-bold text-center fl">月未达标人数</span>
                            <span class="table-th font-16 font-bold text-center fl">月达标率</span>
                        </div>
                        <ul class="table-tbody">
                            <li class="table-tr" v-for="(item, $index) in monthWorkPages.data">
                            	<div class="table-td h-100 font-16 text-center text-hidden fl">{{ $index + 1 }}</div>
								<div class="table-td h-100 font-16 text-center text-hidden fl">{{ item.name }}</div>
								<div class="table-td h-100 font-16 text-center text-hidden fl">{{ item.iratedays }}人</div>
                                <div class="table-td h-100 font-16 text-center text-hidden fl">{{ item.irate }}人</div>
                                <div class="table-td h-100 font-16 text-center text-hidden fl">{{ item.unrate }}人</div>
                                <div class="table-td h-100 font-16 text-center text-hidden fl">{{ item.percent }}%</div>
                            </li>
                        </ul>
                        <div class="table-tfooter">
                            <co-pages :index="monthWorkPages.index"
                                      :limit="monthWorkPages.limit"
                                      :total="monthWorkPages.total"
                                      v-on:switchPage="monthWorkSwitchPage" />
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
import echarts from 'echarts';
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


    // echarts插件具体配置
let echart = {
        // 本月收入趋势折线图
        inAdd: {
            sref: null,
            options: null
        }
    };

// vm对象
const vm = {
    // 组件创建完成后的钩子
    // 这里获取到页面渲染所需的数据
    created() {
        closePgloading()

        const
            vm = this,
            { state: {api: {monthCheck: {
                pagemonthWork: API_PAGEMONTHWORK,
                monthDetail: API_MONTHDETAIL,
                rateStar: API_RATESTAR,
                unrateStar: API_UNRATESTAR,
                monthWork: API_MONTHWORK
            }}} } = vm.$store;    


        // 请求本月考勤总览数据
        vm.$http.post(API_PAGEMONTHWORK, { startTime: getCurrYMDHMS() }).then(({body: {data: {monthrate, person}}}) => {
            vm.monthRate = monthrate;
            vm.allPerson = person;
        }, ({body: {msg}}) => console.log(msg));  


        // 请求本月考勤折线数据数据
        vm.$http.post(API_MONTHDETAIL, {
            startTime: getCurrYMDHMS(),
            page: 1,
            total: 31
        }).then(({body: {data: {data}}}) => {
            const patt = /^([0-9]+-[0-9]+-[0-9]+)/;

            let xaxisData = [],
                checkData = [],
                yaxisMax = 0;

            // 遍历操作月收入数据
            data.forEach(({idate, attendStar} = val) => {
                if (yaxisMax < attendStar) yaxisMax = attendStar;
                if (patt.test(idate)) xaxisData.push(RegExp.$1);

                checkData.push(attendStar);
            });

            // 月收入趋势数据
            echart.inAdd.options = {
                tooltip: { trigger: 'axis' },
                grid: {
                    top: '30px',
                    left: '15px',
                    right: '40px',
                    bottom: '19px',
                    containLabel: true
                },
                backgroundColor: '#fff',
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
                    name: '月考勤趋势',
                    type: 'line',
                    smooth: true,
                    itemStyle: { normal: { color: '#ffcb34'} },
                    lineStyle: { normal: { color: '#ffcb34'} },
                    areaStyle: { normal: { color: '#fad771'} },
                    data: checkData
                }]                
            }; 
            echart.inAdd.sref.setOption(echart.inAdd.options);            
        }, ({body: {msg}}) => console.log(msg));  


        // 请求本月考勤数据
        vm.$http.post(API_MONTHDETAIL, {
            startTime: getCurrYMDHMS(),
            page: vm.monthdetailPages.index,
            total: vm.monthdetailPages.limit
        }).then(({body: {data: {pageNum, data}}}) => {
            // 挂载数据
            vm.monthdetailPages.total = vm.monthdetailPages.limit * pageNum;
            vm.monthdetailPages.data = data;
        }, ({body: {msg}}) => console.log(msg));   
    

        // 请求全勤主播数据
        vm.$http.post(API_RATESTAR, {
            startTime: getCurrYMDHMS(),
            page: vm.rateStarPages.index,
            total: vm.rateStarPages.limit
        }).then(({body: {data: {pageNum, data}}}) => {
            // 挂载数据
            vm.rateStarPages.total = vm.rateStarPages.limit * pageNum;
            vm.rateStarPages.data = data;
        }, ({body: {msg}}) => console.log(msg));   


        // 请求缺勤主播数据
        vm.$http.post(API_UNRATESTAR, {
            startTime: getCurrYMDHMS(),
            page: vm.unrateStarPages.index,
            total: vm.unrateStarPages.limit
        }).then(({body: {data: {pageNum, data}}}) => {
            // 挂载数据
            vm.unrateStarPages.total = vm.unrateStarPages.limit * pageNum;
            vm.unrateStarPages.data = data;
        }, ({body: {msg}}) => console.log(msg));   


        // 请求小组考勤数据
        vm.$http.post(API_MONTHWORK, {
            startTime: getCurrYMDHMS(),
            page: vm.monthWorkPages.index,
            total: vm.monthWorkPages.limit
        }).then(({body: {data: {pageNum, data}}}) => {
            // 挂载数据
            vm.monthWorkPages.total = vm.monthWorkPages.limit * pageNum;
            vm.monthWorkPages.data = data;
        }, ({body: {msg}}) => console.log(msg)); 
    },
	data: () => ({
        dateCF: {                 // 时间组件配置
            mode: 'single',       //—— 选择的模式
            maxDate: getCurrYMD(), //—— 最大可选择时间
        },      
        currDate: getCurrYMD(), // 时间组件当前选择的时间
		currShow: 0,		// 当前显示榜单
        monthRate: null,    // 月考勤达标率
        allPerson: null,    // 月考勤总人数
        monthdetailPages: { // 月考勤明细分页
            index: 1,       //—— 当前的页码
            limit: 10,      //—— 翻页的条数
            total: 10,      //—— 总条数
            data: []        //—— 储存数据
        },
        rateStarPages: { // 全勤明细分页
            index: 1,    //—— 当前的页码
            limit: 10,   //—— 翻页的条数
            total: 10,   //—— 总条数
            data: []     //—— 储存数据
        },
        unrateStarPages: { // 缺勤明细分页
            index: 1,      //—— 当前的页码
            limit: 10,     //—— 翻页的条数
            total: 10,     //—— 总条数
            data: []       //—— 储存数据
        },
        monthWorkPages: { // 小组考勤明细分页
            index: 1,     //—— 当前的页码
            limit: 10,    //—— 翻页的条数
            total: 10,    //—— 总条数
            data: []      //—— 储存数据
        }
	}),
    components: { coPages, coSeldate },
	methods: {
        // 修改日期
        updateDate(dateStr) {
            if (this.currDate !== dateStr) {
                const
                    vm = this,
                    { state: {api: {monthCheck: {
                        pagemonthWork: API_PAGEMONTHWORK,
                        monthDetail: API_MONTHDETAIL,
                        rateStar: API_RATESTAR,
                        unrateStar: API_UNRATESTAR,
                        monthWork: API_MONTHWORK
                    }}} } = vm.$store;    


                // 请求本月考勤总览数据
                vm.$http.post(API_PAGEMONTHWORK, { startTime: dateStr }).then(({body: {data: {monthrate, person}}}) => {
                    vm.monthRate = monthrate;
                    vm.allPerson = person;
                }, ({body: {msg}}) => console.log(msg));  


                // 请求本月考勤折线数据数据
                vm.$http.post(API_MONTHDETAIL, {
                    startTime: dateStr,
                    page: 1,
                    total: 31
                }).then(({body: {data: {data}}}) => {
                    const patt = /^([0-9]+-[0-9]+-[0-9]+)/;

                    let xaxisData = [],
                        checkData = [],
                        yaxisMax = 0;

                    // 遍历操作月收入数据
                    data.forEach(({idate, attendStar} = val) => {
                        if (yaxisMax < attendStar) yaxisMax = attendStar;
                        if (patt.test(idate)) xaxisData.push(RegExp.$1);

                        checkData.push(attendStar);
                    });

                    // 月收入趋势数据
                    echart.inAdd.options = {
                        tooltip: { trigger: 'axis' },
                        grid: {
                            top: '30px',
                            left: '15px',
                            right: '40px',
                            bottom: '19px',
                            containLabel: true
                        },
                        backgroundColor: '#fff',
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
                            name: '月考勤趋势',
                            type: 'line',
                            smooth: true,
                            itemStyle: { normal: { color: '#ffcb34'} },
                            lineStyle: { normal: { color: '#ffcb34'} },
                            areaStyle: { normal: { color: '#fad771'} },
                            data: checkData
                        }]                
                    }; 
                    echart.inAdd.sref.setOption(echart.inAdd.options);            
                }, ({body: {msg}}) => console.log(msg));  


                // 请求本月考勤数据
                vm.$http.post(API_MONTHDETAIL, {
                    startTime: dateStr,
                    page: vm.monthdetailPages.index,
                    total: vm.monthdetailPages.limit
                }).then(({body: {data: {pageNum, data}}}) => {
                    // 挂载数据
                    vm.monthdetailPages.index = 1;
                    vm.monthdetailPages.total = vm.monthdetailPages.limit * pageNum;
                    vm.monthdetailPages.data = data;
                }, ({body: {msg}}) => console.log(msg));   
            

                // 请求全勤主播数据
                vm.$http.post(API_RATESTAR, {
                    startTime: dateStr,
                    page: vm.rateStarPages.index,
                    total: vm.rateStarPages.limit
                }).then(({body: {data: {pageNum, data}}}) => {
                    // 挂载数据
                    vm.rateStarPages.index = 1;
                    vm.rateStarPages.total = vm.rateStarPages.limit * pageNum;
                    vm.rateStarPages.data = data;
                }, ({body: {msg}}) => console.log(msg));   


                // 请求缺勤主播数据
                vm.$http.post(API_UNRATESTAR, {
                    startTime: dateStr,
                    page: vm.unrateStarPages.index,
                    total: vm.unrateStarPages.limit
                }).then(({body: {data: {pageNum, data}}}) => {
                    // 挂载数据
                    vm.unrateStarPages.index = 1;
                    vm.unrateStarPages.total = vm.unrateStarPages.limit * pageNum;
                    vm.unrateStarPages.data = data;
                }, ({body: {msg}}) => console.log(msg));   


                // 请求小组考勤数据
                vm.$http.post(API_MONTHWORK, {
                    startTime: dateStr,
                    page: vm.monthWorkPages.index,
                    total: vm.monthWorkPages.limit
                }).then(({body: {data: {pageNum, data}}}) => {
                    // 挂载数据
                    vm.monthWorkPages.index = 1;
                    vm.monthWorkPages.total = vm.monthWorkPages.limit * pageNum;
                    vm.monthWorkPages.data = data;
                }, ({body: {msg}}) => console.log(msg)); 
            };
        },
        // 切换月考勤明细分页
        monthdetailSwitchPage(index) {
            const 
                vm = this,
                API_MONTHDETAIL = vm.$store.state.api.monthCheck.monthDetail;

            // 请求数据
            vm.$http.post(API_MONTHDETAIL, {
                startTime: getCurrYMDHMS(),
                page: index,
                total: vm.monthdetailPages.limit
            }).then(({body: {data: {pageNum, data}}}) => {
                // 挂载数据
                vm.monthdetailPages.index = index;
                vm.monthdetailPages.data = data;    
            }, ({body: {msg}}) => console.log(msg));
        },
        // 切换全勤明细分页
        rateStarSwitchPage(index) {
            const 
                vm = this,
                API_RATESTAR = vm.$store.state.api.monthCheck.rateStar;

            // 请求数据
            vm.$http.post(API_RATESTAR, {
                startTime: getCurrYMDHMS(),
                page: index,
                total: vm.rateStarPages.limit
            }).then(({body: {data: {pageNum, data}}}) => {
                // 挂载数据
                vm.rateStarPages.index = index;
                vm.rateStarPages.data = data;    
            }, ({body: {msg}}) => console.log(msg));
        },
        // 切换缺勤明细分页
        unrateStarSwitchPage(index) {
            const 
                vm = this,
                API_UNRATESTAR = vm.$store.state.api.monthCheck.unrateStar;

            // 请求数据
            vm.$http.post(API_UNRATESTAR, {
                startTime: getCurrYMDHMS(),
                page: index,
                total: vm.unrateStarPages.limit
            }).then(({body: {data: {pageNum, data}}}) => {
                // 挂载数据
                vm.unrateStarPages.index = index;
                vm.unrateStarPages.data = data;    
            }, ({body: {msg}}) => console.log(msg));
        },
        // 切换小组考勤明细分页
        monthWorkSwitchPage(index) {
            const 
                vm = this,
                API_MONTHWORK = vm.$store.state.api.monthCheck.monthWork;

            // 请求数据
            vm.$http.post(API_MONTHWORK, {
                startTime: getCurrYMDHMS(),
                page: index,
                total: vm.monthWorkPages.limit
            }).then(({body: {data: {pageNum, data}}}) => {
                // 挂载数据
                vm.monthWorkPages.index = index;
                vm.monthWorkPages.data = data;    
            }, ({body: {msg}}) => console.log(msg));
        },
        // 切换榜单
        switchTab(index) {
            if (index !== this.currShow) this.currShow = index;
        }    	
    },
    // 过滤器集合
    filters: {
        // 显示年月日
        showymd: val => {
            if (/^([0-9]+-[0-9]+-[0-9]+)\s/.test(val)) return RegExp.$1;   

            return val;
        }
    },
    // 组件内部指令
    directives: {
        // echart插件的折线图指令
        eline: {
            inserted: (el, {value} = binding) => {
            	const {options} = echart[value];

            	if (options) {
            		let echart = echarts.init(el);

                	echart.setOption(options);
            	} else {
            		echart[value].sref = echarts.init(el);
            	};
            }
        }
    }
};


// 暴露组件配置
export default Object.assign({ name: 'p-ckmonth' }, vm);
</script>


<style lang="less" scoped>
    #p-ckmonth {
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

		/*总展示块*/
		.all-show {
			height: 296px;
			margin: 20px;
			background: #fff;
		}
		.all-left {
			width: 200px;
			background: #3adab9;

			.label {
				height: 42px;
				margin-top: 37px;
				color: #2d816f;
				line-height: 42px;
				text-indent: 19px;
			}
			.cont {
				height: 51px;
				line-height: 51px;
				text-indent: 19px;
			}
		}
		.all-right {
			margin-left: 200px;
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
			
			/*本月考勤*/
            .month-table {
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
                		width: 19%;
                	}
                	&:nth-child(3) {
                		width: 20%;
                	}
                	&:nth-child(4) {
                		width: 19%;
                	}
                	&:nth-child(5) {
                		width: 22%;
                	}
                }
                .table-th {
                    line-height: 55px;
                }
                .table-td {
                    color: #333c44;
                    line-height: 78px;
                }		
            }
			
			/*全勤主播*/
            .check-table,
            .not-check-table {
            	.table-tr {
                    height: 78px;
                    border-bottom: 1px solid #eaeaea;
                }	
                .table-th,
                .table-td {
                	&:nth-child(1) {
                		width: 23.5%;
                	}
                	&:nth-child(2) {
                		width: 10%;
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
                		width: 5.5%;
                	}
                	&:nth-child(8) {
                		width: 9%;
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
                	height: 30px;
                	margin-top: 11px;
                	line-height: 30px;
                	margin-left: 103px;
                }
                .anchor-id {
                	height: 24px;
                	margin-left: 103px;
                	color: #c1c1c1;
                	line-height: 24px                	
                }
                .ico {
                	color: #ff597c;
                	font-size: 54px;
                	line-height: 78px;
                }
                .platform,
                .rmb {
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
                		width: 18%;
                	}
                	&:nth-child(6) {
                		width: 16%;
                	}
                }
                .table-th {
                    line-height: 55px;
                }
                .table-td {
                    color: #333c44;
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