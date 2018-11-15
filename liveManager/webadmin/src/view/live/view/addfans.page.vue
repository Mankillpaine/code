/**
 * Created by miaoyu on 2016/12/16 0016.
 */
<template>
    <div id="p-addfans">
    	<header class="header">
			<span class="title h-100 font-18 font-bold fl">增粉分析</span>
            <div class="seldate font-14 fr">
                <co-seldate class="sel-input"
                            :options="dateCF"
                            :placeholder="currDate"
                            @updateDate="updateDate" />
            </div>
    	</header>
    	<section class="all-show">
    		<div class="all-left h-100 fl">
    			<span class="label db font-14">本月累计增粉(人)</span>
    			<p class="cont text-hidden font-30 font-bold color-white"
                   :title="monthAddfans">{{ monthAddfans || 0 }}</p>
    			<span class="label db font-14">累积增粉(人)</span>
    			<p class="cont text-hidden font-30 font-bold color-white"
                   :title="allAddfans">{{ allAddfans || 0 }}</p>
    		</div>
    		<div class="all-right h-100" v-eline="'inAdd'"></div>
    	</section>
        <section class="main-sel">
            <ul class="sel-title clear">
                <li class="sel-tab font-16 text-center text-none-sel fl rel c-pointer"
                    :class="{'sel': currShow === 0}"
                    @click="switchTab(0)">本月增粉明细</li>
                <li class="sel-tab font-16 text-center text-none-sel fl rel c-pointer"
                    :class="{'sel': currShow === 1}"
                    @click="switchTab(1)">平台增粉榜</li>
                <li class="sel-tab font-16 text-center text-none-sel fl rel c-pointer"
                    :class="{'sel': currShow === 2}"
                    @click="switchTab(2)">小组增粉榜</li>
                <li class="sel-tab font-16 text-center text-none-sel fl rel c-pointer"
                    :class="{'sel': currShow === 3}"
                    @click="switchTab(3)">主播增粉榜</li>
            </ul>
            <div class="sel-cont">
                <transition name="table-fade">
                    <!-- 本月增粉明细 -->
                    <div class="addfans-table table" v-if="currShow === 0" key="table0">
                        <div class="table-thead clear">
                            <span class="table-th font-16 font-bold text-center fl">日期</span>
                            <span class="table-th font-16 font-bold text-center fl">增粉</span>
                        </div>
                        <ul class="table-tbody">
                            <li class="table-tr" v-for="item of monthAddfansPages.data">
                                <div class="table-td h-100 font-16 text-hidden text-center fl">{{ item.idate | showymd }}</div>
                                <div class="table-td h-100 font-16 text-hidden text-center fl">{{ item.increase_follower }}人</div>
                            </li>
                        </ul>
                        <div class="table-tfooter">
                            <co-pages :index="monthAddfansPages.index"
                                      :limit="monthAddfansPages.limit"
                                      :total="monthAddfansPages.total"
                                      v-on:switchPage="monthAddfansSwitchPage" />
                        </div>
                    </div>
                    <!-- 平台增粉榜 -->
                    <div class="platform-table table" v-else-if="currShow === 1" key="table1">
                        <div class="table-right fr">
                            <div class="table-thead font-16 font-bold text-center">平台增粉占比图</div>
                            <div class="table-cont" v-eline="'platform'"></div>
                        </div>
                        <div class="table-left">
                            <div class="table-thead font-16 font-bold clear">
                                <span class="table-th db h-100 text-center fl">排名</span>
                                <span class="table-th db h-100 text-center fl">平台</span>
                                <span class="table-th db h-100 text-center fl">月增粉</span>
                            </div>
                            <ul class="table-tbody">
                                <li class="table-tr clear" v-for="(item, $index) in monthPageFllowerPlatTable">
                                    <div class="table-td h-100 font-16 text-center text-hidden fl">{{ $index + 1 }}</div>
                                    <div class="table-td h-100 font-0 fl">
                                        <figure class="text-center text-hidden">
                                            <img class="di" :src="'http://1.itoubu.com/liveManager/'+ item.platurl" 
                                                            :alt="item.name">
                                            <figcaption class="di font-16">{{ item.name }}</figcaption>
                                        </figure>
                                    </div>
                                    <div class="table-td h-100 font-16 text-center text-hidden fl">2588471人</div>
                                </li>
                            </ul>
                        </div>
                        <div class="table-tfooter">
                            <co-pages :index="monthPageFllowerPlatPages.index"
                                      :limit="monthPageFllowerPlatPages.limit"
                                      :total="monthPageFllowerPlatPages.total"
                                      v-on:switchPage="monthPagePlatincomeSwitchPage" />
                        </div>
                    </div>
                    <!-- 小组增粉榜 -->
                    <div class="group-table table" v-else-if="currShow === 2" key="table2">
                        <div class="table-right fr">
                            <div class="table-thead font-16 font-bold text-center">小组增粉占比</div>
                            <div class="table-cont" v-eline="'group'"></div>
                        </div>
                        <div class="table-left">
                            <div class="table-thead font-16 font-bold clear">
                                <span class="table-th db h-100 text-center fl">排名</span>
                                <span class="table-th db h-100 text-center fl">经纪人</span>
                                <span class="table-th db h-100 text-center fl">旗下主播</span>
                                <span class="table-th db h-100 text-center fl">月增粉</span>
                            </div>
                            <ul class="table-tbody">
                                <li class="table-tr clear" v-for="(item, $index) in monthGroupAddfansTable">
                                    <div class="table-td h-100 font-16 text-center text-hidden fl">{{ $index + 1 }}</div>
                                    <div class="table-td h-100 font-16 text-center text-hidden fl">{{ item.name }}</div>
                                    <div class="table-td h-100 font-16 text-center text-hidden fl">{{ item.groupstar }}名</div>
                                    <div class="table-td h-100 font-16 text-center text-hidden fl">{{ item.follower }}人</div>
                                </li>
                            </ul>
                        </div>
                        <div class="table-tfooter">
                            <co-pages :index="monthGroupAddfansPages.index"
                                      :limit="monthGroupAddfansPages.limit"
                                      :total="monthGroupAddfansPages.total"
                                      v-on:switchPage="monthGroupAddfansSwitchPage" />
                        </div>
                    </div>
                    <!-- 主播增粉榜 -->
                    <div class="anchor-table table" v-else-if="currShow === 3" key="table3">
                        <div class="table-right fr">
                            <div class="table-thead font-16 font-bold text-center">主播增粉占比</div>
                            <div class="table-cont" v-eline="'anchor'"></div>
                        </div>
                        <div class="table-left">
                            <div class="table-thead font-16 font-bold clear">
                                <span class="table-th db h-100 text-center fl">排名</span>
                                <span class="table-th db h-100 text-center fl">主播</span>
                                <span class="table-th db h-100 text-center fl">当前增粉</span>
                                <span class="table-th db h-100 text-center fl">平台&ID</span>
                                <span class="table-th db h-100 text-center fl">等级</span>
                                <span class="table-th db h-100 text-center fl">经纪人</span>
                            </div>
                            <ul class="table-tbody">
                                <router-link :to="'/admin/ahdetail/'+ item.platform +'/'+ item.platformid"
                                         class="table-tr clear c-pointer" 
                                         v-for="(item, $index) in monthAnchorAddfansTable" tag="li">
                                    <div class="table-td h-100 font-16 text-center text-hidden fl">{{ $index + 1 }}</div>
                                    <div class="table-td h-100 font-16 fl">
                                        <img class="arc fl" :src="item.avatar" 
                                                            :alt="item.remark || item.nickname">
                                        <p class="username text-hidden">{{ item.remark || item.nickname }}</p>
                                    </div>
                                    <div class="table-td h-100 font-16 text-center text-hidden fl">{{ item.increase_follower }}人</div>
                                    <div class="table-td h-100 font-16 text-center fl">
                                        <p class="platform text-hidden">{{ item.platname }}</p>
                                        <p class="platform-id text-hidden">ID:{{ item.platformid }}</p>
                                    </div>
                                    <div class="table-td h-100 font-16 text-center text-hidden fl">{{ item.levename }}</div>
                                    <div class="table-td h-100 font-16 text-center text-hidden fl">{{ item.agentname }}</div>
                                </router-link>
                            </ul>
                        </div>
                        <div class="table-tfooter">
                            <co-pages :index="monthAnchorAddfansPages.index"
                                      :limit="monthAnchorAddfansPages.limit"
                                      :total="monthAnchorAddfansPages.total"
                                      v-on:switchPage="monthAnchorAddfansSwitchPage" />
                        </div>
                    </div>
                </transition>
            </div>
        </section>
    </div>
</template>


<script>
import echarts from 'echarts';
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


    // echarts插件具体配置
let echart = {
        // 本月增粉趋势折线图
        inAdd: {
            sref: null,
            options: null
        },
        // 平台增粉饼图
        platform: {
            sref: null,
            options: null
        },
        // 小组增粉饼图
        group: {    
            sref: null,
            options: null
        },
        // 主播增粉饼图
        anchor: {
            sref: null,
            options: null
        }
    };

// vm对象
const vm = {
    // 组件创建完成后的钩子
    // 这里获取到页面渲染所需的数据
    created() {
        closePgloading();
        
        const
            vm = this,
            { state: {api: {addfans: {
                followerImg: API_FOLLOWERIMG,
                pageFollower: API_PAGEFOLLOWER,
                pageFllowerPlat: API_PAGEFLLOWERPLAT,
                groupFollower: API_GROUPFOLLOWER,
                monthStarfans: API_MONTHSTARFANS
            }}} } = vm.$store;


        // 请求月增粉统计数据        
        vm.$http.post(API_PAGEFOLLOWER, { startTime: getCurrYMDHMS() }).then(({body: {data: {monthFollower, follower}}}) => {
            vm.allAddfans = follower;
            vm.monthAddfans = monthFollower;
        }, ({body: {msg}}) => console.log(msg));


        // 请求月收入趋势数据（曲线图）
        vm.$http.post(API_FOLLOWERIMG, {
            startTime: getStartEndTime('start'),
            endTime: getStartEndTime()
        }).then(({body: {data}}) => {
            const patt = /^([0-9]+-[0-9]+-[0-9]+)/;

            let xaxisData = [],
                addfansData = [],
                yaxisMax = 0;

            // 遍历操作月收入数据
            data.forEach(({idate, increase_follower} = val) => {
                if (yaxisMax < increase_follower) yaxisMax = increase_follower;
                if (patt.test(idate)) xaxisData.unshift(RegExp.$1);

                addfansData.unshift(increase_follower);
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
                    name: '月增粉趋势',
                    type: 'line',
                    smooth: true,
                    itemStyle: { normal: { color: '#ffcb34'} },
                    lineStyle: { normal: { color: '#ffcb34'} },
                    areaStyle: { normal: { color: '#fad771'} },
                    data: addfansData
                }]                
            }; 
            echart.inAdd.sref.setOption(echart.inAdd.options); 

            // 挂载数据
            vm.monthAddfansTable = data;
            vm.monthAddfansPages.total = data.length;
            vm.monthAddfansPages.data = data.slice(0, vm.monthAddfansPages.limit);
        }, ({body: {msg}}) => console.log(msg));


        // 请求平台榜数据
        vm.$http.post(API_PAGEFLLOWERPLAT, {
            startTime: getCurrYMDHMS(),
            page: vm.monthPageFllowerPlatPages.index,
            total: vm.monthPageFllowerPlatPages.limit
        }).then(({body: {data: {pageNum, data}}}) => {
            const {sref} = echart.platform;

            let legendData = [],
                seriesData = [];

            // 遍历操作月收入数据
            data.forEach(({color, name, increase_follower} = val) => {
                legendData.push(name);
                seriesData.push({
                    name,
                    value: increase_follower,
                    itemStyle: { normal: { color: `#${color}` } }
                });
            });

            // 平台收入饼图配置
            echart.platform.options = {
                tooltip: {
                    trigger: 'item',
                    formatter: "{a} <br/>{b} : {c} ({d}%)"
                },
                graphic: {
                    elements: [{
                        type: 'text',
                        left: 'center',
                        top: '23.5%',
                        style: {
                            text: '平台增粉\n占比图',
                            fill: '#333c44',
                            font: 'bolder 14px "Microsoft YaHei"',
                            textAlign: 'center'
                        }
                    }]
                },
                legend: {
                    top: 347,
                    left: 'center',
                    orient: 'vertical',
                    itemGap: 20,
                    data: legendData
                },
                series: [{
                    name: '平台增粉占比图',
                    type: 'pie',
                    label: { 
                        normal: { show: false },
                        emphasis: { show: false } 
                    },
                    radius: ['45%', '75%'],
                    center: ['50%', '25%'],
                    data: seriesData
                }]            
            }; 
            if (sref) sref.setOption(echart.platform.options); 

            // 挂载数据
            vm.monthPageFllowerPlatPages.total = vm.monthPageFllowerPlatPages.limit * pageNum;
            vm.monthPageFllowerPlatTable = data;
        }, ({body: {msg}}) => console.log(msg));


        // 请求平台榜数据
        vm.$http.post(API_GROUPFOLLOWER, {
            startTime: getCurrYMDHMS(),
            page: vm.monthGroupAddfansPages.index,
            total: vm.monthGroupAddfansPages.limit
        }).then(({body: {data: {pageNum, data}}}) => {
            const {sref} = echart.group;

            let legendData = [],
                seriesData = [];

            // 遍历操作月收入数据
            data.forEach(({name, follower} = val) => {
                legendData.push(name);
                seriesData.push({
                    name,
                    value: follower
                });
            });

            // 小组增粉饼图配置
            echart.group.options = {
                tooltip: {
                    trigger: 'item',
                    formatter: "{a} <br/>{b} : {c} ({d}%)"
                },
                graphic: {
                    elements: [{
                        type: 'text',
                        left: 'center',
                        top: '23.5%',
                        style: {
                            text: '小组增粉\n占比图',
                            fill: '#333c44',
                            font: 'bolder 14px "Microsoft YaHei"',
                            textAlign: 'center'
                        }
                    }]
                },
                legend: {
                    top: 347,
                    left: 'center',
                    orient: 'vertical',
                    itemGap: 20,
                    data: legendData
                },
                color: ['#0d5962', '#257f8a', '#0ba8bc', '#05bcd4', '#23d7ee', '#4aebff', '#72efff', '#b1f5ff', '#e6fcff', '#f0fdff'],
                series: [{
                    name: '小组增粉占比图',
                    type: 'pie',
                    label: { 
                        normal: { show: false },
                        emphasis: { show: false } 
                    },
                    radius: ['45%', '75%'],
                    center: ['50%', '25%'],
                    data: seriesData
                }]            
            }; 
            if (sref) sref.setOption(echart.group.options); 

            // 挂载数据
            vm.monthGroupAddfansPages.total = vm.monthGroupAddfansPages.limit * pageNum;
            vm.monthGroupAddfansTable = data;
        }, ({body: {msg}}) => console.log(msg));


        // 请求主播增粉榜数据
        vm.$http.post(API_MONTHSTARFANS, {
            startTime: getCurrYMDHMS(),
            page: vm.monthAnchorAddfansPages.index,
            total: vm.monthAnchorAddfansPages.limit
        }).then(({body: {data: {pageNum, data}}}) => {
            const {sref} = echart.anchor;

            let legendData = [],
                seriesData = [];

            // 遍历操作月收入数据
            data.forEach(({remark, nickname, increase_follower} = val) => {
                legendData.push(remark || nickname);
                seriesData.push({
                    name: remark || nickname,
                    value: increase_follower
                });
            });

            // 小组增粉饼图配置
            echart.anchor.options = {
                tooltip: {
                    trigger: 'item',
                    formatter: "{a} <br/>{b} : {c} ({d}%)"
                },
                graphic: {
                    elements: [{
                        type: 'text',
                        left: 'center',
                        top: '23.5%',
                        style: {
                            text: '主播增粉\n占比图',
                            fill: '#333c44',
                            font: 'bolder 14px "Microsoft YaHei"',
                            textAlign: 'center'
                        }
                    }]
                },
                legend: {
                    top: 347,
                    left: 'center',
                    orient: 'vertical',
                    itemGap: 20,
                    data: legendData
                },
                color: ['#0d5962', '#257f8a', '#0ba8bc', '#05bcd4', '#23d7ee', '#4aebff', '#72efff', '#b1f5ff', '#e6fcff', '#f0fdff'],
                series: [{
                    name: '主播增粉占比图',
                    type: 'pie',
                    label: { 
                        normal: { show: false },
                        emphasis: { show: false } 
                    },
                    radius: ['45%', '75%'],
                    center: ['50%', '25%'],
                    data: seriesData
                }]            
            }; 
            if (sref) sref.setOption(echart.anchor.options); 

            // 挂载数据
            vm.monthAnchorAddfansPages.total = vm.monthAnchorAddfansPages.limit * pageNum;
            vm.monthAnchorAddfansTable = data;
        }, ({body: {msg}}) => console.log(msg));
    },
    data: () => ({
        dateCF: {                 // 时间组件配置
            mode: 'single',       //—— 选择的模式
            maxDate: getCurrYMD(), //—— 最大可选择时间
        },      
        currDate: getCurrYMD(), // 时间组件当前选择的时间
        currShow: 0,           //—— 当前显示榜单
        allAddfans: 0,         //—— 累计总增粉
        monthAddfans: 0,       //—— 月总增粉数据
        monthAddfansTable: [], //—— 月增粉明细数据
        monthAddfansPages: {   //—— 月增粉明细分页
            index: 1,          //—— 当前的页码
            limit: 10,         //—— 翻页的条数
            total: 10,         //—— 总条数
            data: [],          //—— 当前分页储存数据
        }, 
        monthPageFllowerPlatTable: [], //—— 平台增粉明细数据
        monthPageFllowerPlatPages: {   //—— 平台粉明细分页
            index: 1,                  //—— 当前的页码
            limit: 10,                 //—— 翻页的条数
            total: 10,                 //—— 总条数
        }, 
        monthGroupAddfansTable: [],    //—— 小组增粉明细数据
        monthGroupAddfansPages: {      //—— 小组粉明细分页
            index: 1,                  //—— 当前的页码
            limit: 10,                 //—— 翻页的条数
            total: 10,                 //—— 总条数
        }, 
        monthAnchorAddfansTable: [],    //—— 主播增粉明细数据
        monthAnchorAddfansPages: {      //—— 主播粉明细分页
            index: 1,                   //—— 当前的页码
            limit: 10,                  //—— 翻页的条数
            total: 10,                  //—— 总条数
        }, 
    }),
    components: { coPages, coSeldate },
    methods: {
        // 修改日期
        updateDate(dateStr) {
            if (this.currDate !== dateStr) {
                const
                    vm = this,
                    { state: {api: {addfans: {
                        followerImg: API_FOLLOWERIMG,
                        pageFollower: API_PAGEFOLLOWER,
                        pageFllowerPlat: API_PAGEFLLOWERPLAT,
                        groupFollower: API_GROUPFOLLOWER,
                        monthStarfans: API_MONTHSTARFANS
                    }}} } = vm.$store;


                // 请求月增粉统计数据        
                vm.$http.post(API_PAGEFOLLOWER, { startTime: dateStr }).then(({body: {data: {monthFollower, follower}}}) => {
                    vm.allAddfans = follower;
                    vm.monthAddfans = monthFollower;
                }, ({body: {msg}}) => console.log(msg));


                // 请求月收入趋势数据（曲线图）
                vm.$http.post(API_FOLLOWERIMG, {
                    startTime: getStartEndTime('start'),
                    endTime: dateStr
                }).then(({body: {data}}) => {
                    const patt = /^([0-9]+-[0-9]+-[0-9]+)\s/;

                    let xaxisData = [],
                        addfansData = [],
                        yaxisMax = 0;

                    // 遍历操作月收入数据
                    data.forEach(({idate, increase_follower} = val) => {
                        if (yaxisMax < increase_follower) yaxisMax = increase_follower;
                        if (patt.test(idate)) xaxisData.unshift(RegExp.$1);

                        addfansData.unshift(increase_follower);
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
                            name: '月增粉趋势',
                            type: 'line',
                            smooth: true,
                            itemStyle: { normal: { color: '#ffcb34'} },
                            lineStyle: { normal: { color: '#ffcb34'} },
                            areaStyle: { normal: { color: '#fad771'} },
                            data: addfansData
                        }]                
                    }; 
                    echart.inAdd.sref.setOption(echart.inAdd.options); 

                    // 挂载数据
                    vm.monthAddfansTable = data;
                    vm.monthAddfansPages.index = 1;
                    vm.monthAddfansPages.total = data.length;
                    vm.monthAddfansPages.data = data.slice(0, vm.monthAddfansPages.limit);
                }, ({body: {msg}}) => console.log(msg));


                // 请求平台榜数据
                vm.$http.post(API_PAGEFLLOWERPLAT, {
                    startTime: dateStr,
                    page: vm.monthPageFllowerPlatPages.index,
                    total: vm.monthPageFllowerPlatPages.limit
                }).then(({body: {data: {pageNum, data}}}) => {
                    const {sref} = echart.platform;

                    let legendData = [],
                        seriesData = [];

                    // 遍历操作月收入数据
                    data.forEach(({color, name, increase_follower} = val) => {
                        legendData.push(name);
                        seriesData.push({
                            name,
                            value: increase_follower,
                            itemStyle: { normal: { color: `#${color}` } }
                        });
                    });

                    // 平台收入饼图配置
                    echart.platform.options = {
                        tooltip: {
                            trigger: 'item',
                            formatter: "{a} <br/>{b} : {c} ({d}%)"
                        },
                        graphic: {
                            elements: [{
                                type: 'text',
                                left: 'center',
                                top: '23.5%',
                                style: {
                                    text: '平台增粉\n占比图',
                                    fill: '#333c44',
                                    font: 'bolder 14px "Microsoft YaHei"',
                                    textAlign: 'center'
                                }
                            }]
                        },
                        legend: {
                            top: 347,
                            left: 'center',
                            orient: 'vertical',
                            itemGap: 20,
                            data: legendData
                        },
                        series: [{
                            name: '平台增粉占比图',
                            type: 'pie',
                            label: { 
                                normal: { show: false },
                                emphasis: { show: false } 
                            },
                            radius: ['45%', '75%'],
                            center: ['50%', '25%'],
                            data: seriesData
                        }]            
                    }; 
                    if (sref) sref.setOption(echart.platform.options); 

                    // 挂载数据
                    vm.monthPageFllowerPlatPages.index = 1;
                    vm.monthPageFllowerPlatPages.total = vm.monthPageFllowerPlatPages.limit * pageNum;
                    vm.monthPageFllowerPlatTable = data;
                }, ({body: {msg}}) => console.log(msg));


                // 请求平台榜数据
                vm.$http.post(API_GROUPFOLLOWER, {
                    startTime: dateStr,
                    page: vm.monthGroupAddfansPages.index,
                    total: vm.monthGroupAddfansPages.limit
                }).then(({body: {data: {pageNum, data}}}) => {
                    const {sref} = echart.group;

                    let legendData = [],
                        seriesData = [];

                    // 遍历操作月收入数据
                    data.forEach(({name, follower} = val) => {
                        legendData.push(name);
                        seriesData.push({
                            name,
                            value: follower
                        });
                    });

                    // 小组增粉饼图配置
                    echart.group.options = {
                        tooltip: {
                            trigger: 'item',
                            formatter: "{a} <br/>{b} : {c} ({d}%)"
                        },
                        graphic: {
                            elements: [{
                                type: 'text',
                                left: 'center',
                                top: '23.5%',
                                style: {
                                    text: '小组增粉\n占比图',
                                    fill: '#333c44',
                                    font: 'bolder 14px "Microsoft YaHei"',
                                    textAlign: 'center'
                                }
                            }]
                        },
                        legend: {
                            top: 347,
                            left: 'center',
                            orient: 'vertical',
                            itemGap: 20,
                            data: legendData
                        },
                        color: ['#0d5962', '#257f8a', '#0ba8bc', '#05bcd4', '#23d7ee', '#4aebff', '#72efff', '#b1f5ff', '#e6fcff', '#f0fdff'],
                        series: [{
                            name: '小组增粉占比图',
                            type: 'pie',
                            label: { 
                                normal: { show: false },
                                emphasis: { show: false } 
                            },
                            radius: ['45%', '75%'],
                            center: ['50%', '25%'],
                            data: seriesData
                        }]            
                    }; 
                    if (sref) sref.setOption(echart.group.options); 

                    // 挂载数据
                    vm.monthGroupAddfansPages.index = 1;
                    vm.monthGroupAddfansPages.total = vm.monthGroupAddfansPages.limit * pageNum;
                    vm.monthGroupAddfansTable = data;
                }, ({body: {msg}}) => console.log(msg));


                // 请求主播增粉榜数据
                vm.$http.post(API_MONTHSTARFANS, {
                    startTime: dateStr,
                    page: vm.monthAnchorAddfansPages.index,
                    total: vm.monthAnchorAddfansPages.limit
                }).then(({body: {data: {pageNum, data}}}) => {
                    const {sref} = echart.anchor;

                    let legendData = [],
                        seriesData = [];

                    // 遍历操作月收入数据
                    data.forEach(({remark, nickname, increase_follower} = val) => {
                        legendData.push(remark || nickname);
                        seriesData.push({
                            name: remark || nickname,
                            value: increase_follower
                        });
                    });

                    // 小组增粉饼图配置
                    echart.anchor.options = {
                        tooltip: {
                            trigger: 'item',
                            formatter: "{a} <br/>{b} : {c} ({d}%)"
                        },
                        graphic: {
                            elements: [{
                                type: 'text',
                                left: 'center',
                                top: '23.5%',
                                style: {
                                    text: '主播增粉\n占比图',
                                    fill: '#333c44',
                                    font: 'bolder 14px "Microsoft YaHei"',
                                    textAlign: 'center'
                                }
                            }]
                        },
                        legend: {
                            top: 347,
                            left: 'center',
                            orient: 'vertical',
                            itemGap: 20,
                            data: legendData
                        },
                        color: ['#0d5962', '#257f8a', '#0ba8bc', '#05bcd4', '#23d7ee', '#4aebff', '#72efff', '#b1f5ff', '#e6fcff', '#f0fdff'],
                        series: [{
                            name: '主播增粉占比图',
                            type: 'pie',
                            label: { 
                                normal: { show: false },
                                emphasis: { show: false } 
                            },
                            radius: ['45%', '75%'],
                            center: ['50%', '25%'],
                            data: seriesData
                        }]            
                    }; 
                    if (sref) sref.setOption(echart.anchor.options); 

                    // 挂载数据
                    vm.monthAnchorAddfansPages.index = 1;
                    vm.monthAnchorAddfansPages.total = vm.monthAnchorAddfansPages.limit * pageNum;
                    vm.monthAnchorAddfansTable = data;
                }, ({body: {msg}}) => console.log(msg));
            };
        },
        // 切换本月增粉明细分页
        monthAddfansSwitchPage(index) {
            const { limit } = this.monthAddfansPages;

            this.monthAddfansPages.index = index;
            this.monthAddfansPages.data = this.monthAddfansTable.slice((index - 1) * limit, index * limit);
        },
        // 切换平台明细分页
        monthPagePlatincomeSwitchPage(index) {
            const 
                vm = this,
                API_PAGEFLLOWERPLAT = vm.$store.state.api.addfans.pageFllowerPlat;

            // 请求数据
            vm.$http.post(API_PAGEFLLOWERPLAT, {
                startTime: getCurrYMDHMS(),
                page: index,
                total: vm.monthPageFllowerPlatPages.limit
            }).then(({body: {data: {pageNum, data}}}) => {
                let legendData = [],
                    seriesData = [];
                    
                // 遍历操作月收入数据
                data.forEach(({color, name, increase_follower} = val) => {
                    legendData.push(name);
                    seriesData.push({
                        name,
                        value: increase_follower,
                        itemStyle: { normal: { color: `#${color}` } }
                    });
                });
                
                // 平台收入饼图配置
                echart.platform.options = {
                    tooltip: {
                        trigger: 'item',
                        formatter: "{a} <br/>{b} : {c} ({d}%)"
                    },
                    graphic: {
                        elements: [{
                            type: 'text',
                            left: 'center',
                            top: '23.5%',
                            style: {
                                text: '平台增粉\n占比图',
                                fill: '#333c44',
                                font: 'bolder 14px "Microsoft YaHei"',
                                textAlign: 'center'
                            }
                        }]
                    },
                    legend: {
                        top: 347,
                        left: 'center',
                        orient: 'vertical',
                        itemGap: 20,
                        data: legendData
                    },
                    series: [{
                        name: '平台增粉占比图',
                        type: 'pie',
                        label: { 
                            normal: { show: false },
                            emphasis: { show: false } 
                        },
                        radius: ['45%', '75%'],
                        center: ['50%', '25%'],
                        data: seriesData
                    }]            
                }; 
                echart.platform.sref.setOption(echart.platform.options); 

                // 挂载数据
                vm.monthPageFllowerPlatPages.index = index;
                vm.monthPageFllowerPlatTable = data;      
            }, ({body: {msg}}) => console.log(msg));
        },
        // 切换小组明细分页
        monthGroupAddfansSwitchPage(index) {
            const 
                vm = this,
                API_GROUPFOLLOWER = vm.$store.state.api.addfans.groupFollower;

            // 请求数据
            vm.$http.post(API_GROUPFOLLOWER, {
                startTime: getCurrYMDHMS(),
                page: index,
                total: vm.monthGroupAddfansPages.limit
            }).then(({body: {data: {pageNum, data}}}) => {
                let legendData = [],
                    seriesData = [];

                // 遍历操作月收入数据
                data.forEach(({name, follower} = val) => {
                    legendData.push(name);
                    seriesData.push({
                        name,
                        value: follower
                    });
                });

                // 小组增粉饼图配置
                echart.group.options = {
                    tooltip: {
                        trigger: 'item',
                        formatter: "{a} <br/>{b} : {c} ({d}%)"
                    },
                    graphic: {
                        elements: [{
                            type: 'text',
                            left: 'center',
                            top: '23.5%',
                            style: {
                                text: '小组增粉\n占比图',
                                fill: '#333c44',
                                font: 'bolder 14px "Microsoft YaHei"',
                                textAlign: 'center'
                            }
                        }]
                    },
                    legend: {
                        top: 347,
                        left: 'center',
                        orient: 'vertical',
                        itemGap: 20,
                        data: legendData
                    },
                    color: ['#0d5962', '#257f8a', '#0ba8bc', '#05bcd4', '#23d7ee', '#4aebff', '#72efff', '#b1f5ff', '#e6fcff', '#f0fdff'],
                    series: [{
                        name: '小组增粉占比图',
                        type: 'pie',
                        label: { 
                            normal: { show: false },
                            emphasis: { show: false } 
                        },
                        radius: ['45%', '75%'],
                        center: ['50%', '25%'],
                        data: seriesData
                    }]            
                }; 
                echart.group.sref.setOption(echart.group.options); 

                // 挂载数据
                vm.monthGroupAddfansPages.index = index;
                vm.monthGroupAddfansTable = data;      
            }, ({body: {msg}}) => console.log(msg));
        },
        // 切换主播明细分页
        monthAnchorAddfansSwitchPage(index) {
            const 
                vm = this,
                API_MONTHSTARFANS = vm.$store.state.api.addfans.monthStarfans;

            // 请求数据
            vm.$http.post(API_MONTHSTARFANS, {
                startTime: getCurrYMDHMS(),
                page: index,
                total: vm.monthAnchorAddfansPages.limit
            }).then(({body: {data: {pageNum, data}}}) => {
                let legendData = [],
                    seriesData = [];

                // 遍历操作月收入数据
                data.forEach(({name, increase_follower} = val) => {
                    legendData.push(name);
                    seriesData.push({
                        name,
                        value: increase_follower
                    });
                });

                // 小组增粉饼图配置
                echart.anchor.options = {
                    tooltip: {
                        trigger: 'item',
                        formatter: "{a} <br/>{b} : {c} ({d}%)"
                    },
                    graphic: {
                        elements: [{
                            type: 'text',
                            left: 'center',
                            top: '23.5%',
                            style: {
                                text: '主播增粉\n占比图',
                                fill: '#333c44',
                                font: 'bolder 14px "Microsoft YaHei"',
                                textAlign: 'center'
                            }
                        }]
                    },
                    legend: {
                        top: 347,
                        left: 'center',
                        orient: 'vertical',
                        itemGap: 20,
                        data: legendData
                    },
                    color: ['#0d5962', '#257f8a', '#0ba8bc', '#05bcd4', '#23d7ee', '#4aebff', '#72efff', '#b1f5ff', '#e6fcff', '#f0fdff'],
                    series: [{
                        name: '主播增粉占比图',
                        type: 'pie',
                        label: { 
                            normal: { show: false },
                            emphasis: { show: false } 
                        },
                        radius: ['45%', '75%'],
                        center: ['50%', '25%'],
                        data: seriesData
                    }]            
                }; 
                echart.anchor.sref.setOption(echart.anchor.options); 

                // 挂载数据
                vm.monthAnchorAddfansPages.index = index;
                vm.monthAnchorAddfansTable = data;        
            }, ({body: {msg}}) => console.log(msg));
        },
        // 切换榜单
        switchTab(index) {
            if (index !== this.currShow) this.currShow = index;
        }
    },
    // 过滤器集合
    filters: {
        // 显示时分秒
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
export default Object.assign({ name: 'p-addfans' }, vm);
</script>


<style lang="less" scoped>
    #p-addfans {
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

            /*本月收入明细*/
            .addfans-table {
                .table-th {
                    width: 50%;
                    line-height: 55px;
                }
                .table-tr {
                    height: 78px;
                    border-bottom: 1px solid #eaeaea;
                }
                .table-td {
                    width: 50%;
                    color: #333c44;
                    line-height: 78px;
                }
            }

            /*平台增粉榜*/
            .platform-table {
                .table-right {
                    width: 270px;

                    .table-cont {
                        height: 789px;
                        border-bottom: 1px solid #eaeaea;
                    }
                }
                .table-left {
                    height: 847px;
                    margin-right: 270px;
                    border-right: 1px solid #eaeaea;

                    .table-cont {
                        height: 790px;
                    }
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
                        width: 8%;
                    }
                    &:nth-child(2) {
                        width: 46%;
                    }
                    &:nth-child(3) {
                        width: 46%;
                    }
                }
                .table-td {
                    color: #333c44;
                    line-height: 78px;
                    
                    figure {
                        height: 78px;
                    }
                    img {
                        width: 52px;
                        height: 52px;
                        margin: 0 12px;
                        vertical-align: middle;
                        border-radius: 6px;
                    }
                    figcaption {
                        vertical-align: middle;
                    }
                }
            }

            /*小组增粉榜*/
            .group-table {
                .table-right {
                    width: 270px;

                    .table-cont {
                        height: 789px;
                        border-bottom: 1px solid #eaeaea;
                    }
                }
                .table-left {
                    height: 847px;
                    margin-right: 270px;
                    border-right: 1px solid #eaeaea;

                    .table-cont {
                        height: 790px;
                    }
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
                        width: 9%;
                    }
                    &:nth-child(2) {
                        width: 30%;
                    }
                    &:nth-child(3) {
                        width: 29%;
                    }
                    &:nth-child(4) {
                        width: 32%;
                    }
                }
                .table-td {
                    color: #333c44;
                    line-height: 78px;
                }
            }
            
            /*主播增粉榜*/
            .anchor-table {
                .table-right {
                    width: 270px;

                    .table-cont {
                        height: 789px;
                        border-bottom: 1px solid #eaeaea;
                    }
                }
                .table-left {
                    height: 847px;
                    margin-right: 270px;
                    border-right: 1px solid #eaeaea;

                    .table-cont {
                        height: 790px;
                    }
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
                        width: 8%;
                    }
                    &:nth-child(2) {
                        width: 28%;
                    }
                    &:nth-child(3) {
                        width: 21%;
                    }
                    &:nth-child(4) {
                        width: 21%;
                    }
                    &:nth-child(5) {
                        width: 9%;
                    }
                    &:nth-child(6) {
                        width: 13%;
                    }
                }
                .table-td {
                    color: #333c44;
                    line-height: 78px;

                    img {
                        width: 52px;
                        height: 52px;
                        margin-top: 12px;
                        margin-left: 3px;
                    }
                    .username {
                        line-height: 78px;
                        margin-left: 67px;
                    }
                    .platform {
                        height: 28px;
                        margin-top: 10px;
                        line-height: 28px;
                    }
                    .platform-id {
                        height: 26px;
                        color: #aaa;
                        line-height: 26px;
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
    }
</style>