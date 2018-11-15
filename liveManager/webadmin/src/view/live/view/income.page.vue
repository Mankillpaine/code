/**
 * Created by miaoyu on 2016/12/16 0016.
 */
<template>
    <div id="p-income">
    	<header class="header">
			<span class="title h-100 font-18 font-bold fl">收入分析</span>
			<div class="seldate font-14 fr">
				<co-seldate class="sel-input"
						    :options="dateCF"
						    :placeholder="currDate"
						    @updateDate="updateDate" />
			</div>
    	</header>
    	<section class="all-show">
    		<div class="all-left h-100 fl">
    			<span class="label db font-14">本月收入(元)</span>
    			<p class="cont text-hidden font-30 font-bold color-white"
    			   :title="monthIncome">{{ monthIncome }}</p>
    			<span class="label db font-14">累积收入(元)</span>
    			<p class="cont text-hidden font-30 font-bold color-white" 
    			   :title="allIncome">{{ allIncome }}</p>
    		</div>
    		<div class="all-right h-100" v-eline="'inAdd'"></div>
    	</section>
    	<section class="main-sel">
    		<ul class="sel-title clear">
    			<li class="sel-tab font-16 text-center text-none-sel fl rel c-pointer"
    				:class="{'sel': currShow === 0}"
    				@click="switchTab(0)">本月收入明细</li>
    			<li class="sel-tab font-16 text-center text-none-sel fl rel c-pointer"
    				:class="{'sel': currShow === 1}"
    				@click="switchTab(1)">小组贡献榜</li>
    			<li class="sel-tab font-16 text-center text-none-sel fl rel c-pointer"
    				:class="{'sel': currShow === 2}"
    				@click="switchTab(2)">达标主播</li>
    			<li class="sel-tab font-16 text-center text-none-sel fl rel c-pointer"
    				:class="{'sel': currShow === 3}"
    				@click="switchTab(3)">未达标主播</li>
    			<li class="sel-tab font-16 text-center text-none-sel fl rel c-pointer"
    				:class="{'sel': currShow === 4}"
    				@click="switchTab(4)">平台贡献榜</li>
    		</ul>
    		<div class="sel-cont">
    			<transition name="table-fade">
	    			<!-- 本月收入明细 -->
	    			<div class="income-table table" v-if="currShow === 0" key="table0">
	    				<div class="table-thead clear">
	    					<span class="table-th font-16 font-bold text-center fl">日期</span>
	    					<span class="table-th font-16 font-bold text-center fl">收入</span>
	    				</div>
	    				<ul class="table-tbody">
	    					<li class="table-tr" v-for="item of monthIncomePages.data">
	    						<div class="table-td h-100 font-16 text-hidden text-center fl">{{ item.idate | showymd }}</div>
	    						<div class="table-td h-100 font-16 text-hidden text-center fl">{{ item.increase_rmb }}元</div>
	    					</li>
	    				</ul>
						<div class="table-tfooter">
							<co-pages :index="monthIncomePages.index"
								      :limit="monthIncomePages.limit"
								      :total="monthIncomePages.total"
								      v-on:switchPage="monthIncomeSwitchPage" />
						</div>
	    			</div>
	    			<!-- 小组贡献榜 -->
					<div class="group-table table" v-else-if="currShow === 1" key="table1">
						<div class="table-right fr">
							<div class="table-thead font-16 font-bold text-center">小组收入占比</div>
							<div class="table-cont" v-eline="'group'"></div>
						</div>
						<div class="table-left">
							<div class="table-thead font-16 font-bold clear">
								<span class="table-th db h-100 text-center fl">排名</span>
								<span class="table-th db h-100 text-center fl">经纪人</span>
								<span class="table-th db h-100 text-center fl">旗下主播</span>
								<span class="table-th db h-100 text-center fl">月收入</span>
								<span class="table-th db h-100 text-center fl">达标率</span>
							</div>
							<ul class="table-tbody">
								<li class="table-tr clear" v-for="(item, $index) in monthGroupIncomeTable">
									<div class="table-td h-100 font-16 text-center text-hidden fl">{{ $index + 1 }}</div>
									<div class="table-td h-100 font-16 text-center text-hidden fl">{{ item.name }}</div>
									<div class="table-td h-100 font-16 text-center text-hidden fl">{{ item.num }}名</div>
									<div class="table-td h-100 font-16 text-center text-hidden fl">{{ item.rmb }}元</div>
									<div class="table-td h-100 font-16 text-center text-hidden fl">{{ item.percent }}%</div>
								</li>
							</ul>
						</div>
						<div class="table-tfooter">
							<co-pages :index="groupIncomePages.index"
								      :limit="groupIncomePages.limit"
								      :total="groupIncomePages.total"
								      v-on:switchPage="monthGroupIncomeSwitchPage" />
						</div>
					</div>
					<!-- 达标主播 -->
					<div class="standard-table table" v-else-if="currShow === 2" key="table2">
						<div class="table-thead clear">
	    					<span class="table-th font-16 font-bold text-center fl">排名</span>
	    					<span class="table-th font-16 font-bold text-center fl">主播</span>
	    					<span class="table-th font-16 font-bold text-center fl">当前收入</span>
	    					<span class="table-th font-16 font-bold text-center fl">达标</span>
	    					<span class="table-th font-16 font-bold text-center fl">任务完成率</span>
	    					<span class="table-th font-16 font-bold text-center fl">平台&ID</span>
	    					<span class="table-th font-16 font-bold text-center fl">等级</span>
	    					<span class="table-th font-16 font-bold text-center fl">经纪人</span>
	    				</div>
	    				<ul class="table-tbody">
	    					<router-link :to="'/admin/ahdetail/'+ item.platform +'/'+ item.platformid"
                                         class="table-tr c-pointer" 
                                         v-for="(item, $index) in monthRatestarTable" tag="li">
	    						<div class="table-td h-100 font-16 text-hidden text-center fl">{{ $index + 1 }}</div>
	    						<div class="table-td h-100 font-16 text-hidden fl">
	    							<figure>
	    								<img class="arc fl" 
	    									 :src="item.avatar" 
	    									 :alt="item.remark || item.nickname">
	    								<figcaption class="text-hidden">{{ item.remark || item.nickname }}</figcaption>
	    							</figure>
	    						</div>
	    						<div class="table-td h-100 font-16 text-hidden text-center fl">{{ item.increase_rmb }}元</div>
	    						<div class="table-td h-100 font-16 text-hidden text-center fl">
	    							<span class="ico icon-home" v-show="item.reachStandard === 1"></span>
	    						</div>
	    						<div class="table-td h-100 font-16 text-hidden text-center fl">{{ item.percent }}%</div>
	    						<div class="table-td h-100 font-16 text-hidden text-center fl">
	    							<span class="info-name text-hidden db">{{ item.platname }}</span>
	    							<span class="info-id text-hidden db">ID:{{ item.platformid }}</span>
	    						</div>
	    						<div class="table-td h-100 font-16 text-hidden text-center fl">{{ item.levelname }}</div>
	    						<div class="table-td h-100 font-16 text-hidden text-center fl">{{ item.agentname }}</div>
							</router-link>
	    				</ul>
						<div class="table-tfooter">
							<co-pages :index="ratestarPages.index"
								      :limit="ratestarPages.limit"
								      :total="ratestarPages.total"
								      v-on:switchPage="monthRatestarSwitchPage" />
						</div>
					</div>
					<!-- 未达标主播 -->
					<div class="not-standard-table table" v-else-if="currShow === 3" key="table3">
						<div class="table-thead clear">
	    					<span class="table-th font-16 font-bold text-center fl">排名</span>
	    					<span class="table-th font-16 font-bold text-center fl">主播</span>
	    					<span class="table-th font-16 font-bold text-center fl">当前收入</span>
	    					<span class="table-th font-16 font-bold text-center fl">未达标</span>
	    					<span class="table-th font-16 font-bold text-center fl">任务完成率</span>
	    					<span class="table-th font-16 font-bold text-center fl">平台&ID</span>
	    					<span class="table-th font-16 font-bold text-center fl">等级</span>
	    					<span class="table-th font-16 font-bold text-center fl">经纪人</span>
	    				</div>
	    				<ul class="table-tbody">
	    					<router-link :to="'/admin/ahdetail/'+ item.platform +'/'+ item.platformid"
                                         class="table-tr c-pointer" 
                                         v-for="(item, $index) in monthNotRatestarTable" tag="li">
	    						<div class="table-td h-100 font-16 text-hidden text-center fl">{{ $index + 1 }}</div>
	    						<div class="table-td h-100 font-16 text-hidden fl">
	    							<figure>
	    								<img class="arc fl" 
	    									 :src="item.avatar" 
	    									 :alt="item.remark || item.nickname">
	    								<figcaption class="text-hidden">{{ item.remark || item.nickname }}</figcaption>
	    							</figure>
	    						</div>
	    						<div class="table-td h-100 font-16 text-hidden text-center fl">{{ item.increase_rmb }}元</div>
	    						<div class="table-td h-100 font-16 text-hidden text-center fl">
	    							<span class="ico icon-home" v-show="item.reachStandard === 0 || item.reachStandard === null"></span>
	    						</div>
	    						<div class="table-td h-100 font-16 text-hidden text-center fl">{{ item.percent }}%</div>
	    						<div class="table-td h-100 font-16 text-hidden text-center fl">
	    							<span class="info-name text-hidden db">{{ item.platname }}</span>
	    							<span class="info-id text-hidden db">ID:{{ item.platformid }}</span>
	    						</div>
	    						<div class="table-td h-100 font-16 text-hidden text-center fl">{{ item.levelname }}</div>
	    						<div class="table-td h-100 font-16 text-hidden text-center fl">{{ item.agentname }}</div>
							</router-link>
	    				</ul>
						<div class="table-tfooter">
							<co-pages :index="notRatestarPages.index"
								      :limit="notRatestarPages.limit"
							    	  :total="notRatestarPages.total"
								      v-on:switchPage="monthNotRatestarSwitchPage" />
						</div>
					</div>
					<!-- 平台贡献榜 -->
					<div class="platform-table table" v-else="currShow === 4" key="table4">
						<div class="table-right fr">
							<div class="table-thead font-16 font-bold text-center">平台收入占比图</div>
							<div class="table-cont" v-eline="'platform'"></div>
						</div>
						<div class="table-left">
							<div class="table-thead font-16 font-bold clear">
								<span class="table-th db h-100 text-center fl">排名</span>
								<span class="table-th db h-100 text-center fl">平台</span>
								<span class="table-th db h-100 text-center fl">月收入</span>
							</div>
							<ul class="table-tbody">
								<li class="table-tr clear" v-for="(item, $index) in monthPagePlatincomeTable">
									<div class="table-td h-100 font-16 text-center text-hidden fl">{{ $index + 1 }}</div>
									<div class="table-td h-100 font-0 fl">
										<figure class="text-center text-hidden">
											<img class="di" :src="'http://1.itoubu.com/liveManager/'+ item.platurl"	 
															:alt="item.name">
	    									<figcaption class="di font-16">{{ item.name }}</figcaption>
										</figure>
									</div>
									<div class="table-td h-100 font-16 text-center text-hidden fl">{{ item.rmb }}元</div>
								</li>
							</ul>
						</div>
						<div class="table-tfooter">
							<co-pages :index="pagePlatincomePages.index"
								      :limit="pagePlatincomePages.limit"
								      :total="pagePlatincomePages.total"
								      v-on:switchPage="monthPagePlatincomeSwitchPage" />
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
        },
        // 小组贡献饼图
        group: {	
        	sref: null,
            options: null
        },
        // 平台贡献饼图
        platform: {
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
        	{ state: {api: {income: {
        		pageIncome: API_PAGEINCOME,
        		incomeImg: API_INCOMEIMG,
        		groupIncome: API_GROUPINCOME,
        		rateStar: API_RATESTAR,
        		pagePlatincome: API_PAGEPLATINCOME
        	}}} } = vm.$store;


        // 请求月收入统计数据
        vm.$http.post(API_PAGEINCOME, { startTime: getCurrYMDHMS() }).then(({body: {data: {monthRmb, rmb}}}) => {
        	vm.allIncome = rmb[0].rmb;
        }, ({body: {msg}}) => console.log(msg));


        // 请求月收入趋势数据（曲线图）
        vm.$http.post(API_INCOMEIMG, {
        	startTime: getStartEndTime('start'),
        	endTime: getStartEndTime()
        }).then(({body: {data}}) => {
    		const patt = /^([0-9]+-[0-9]+-[0-9]+)/;
                
            let xaxisData = [],
                incomeData = [],
                monthIncome = 0,
                yaxisMax = 0;

            // 遍历操作月收入数据
            data.forEach(({idate, increase_rmb} = val) => {
                if (yaxisMax < increase_rmb) yaxisMax = increase_rmb;
                if (patt.test(idate)) xaxisData.unshift(RegExp.$1);

                monthIncome += increase_rmb;
                incomeData.unshift(increase_rmb);
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
                    name: '月收入趋势',
                    type: 'line',
                    smooth: true,
	                itemStyle: { normal: { color: '#ffcb34'} },
	                lineStyle: { normal: { color: '#ffcb34'} },
	                areaStyle: { normal: { color: '#fad771'} },
                    data: incomeData
                }]                
            }; 
            echart.inAdd.sref.setOption(echart.inAdd.options); 

            // 挂载数据
            vm.monthIncome = monthIncome;
            vm.monthIncomeTable = data;
            vm.monthIncomePages.total = data.length;
            vm.monthIncomePages.data = data.slice(0, vm.monthIncomePages.limit);
        }, ({body: {msg}}) => console.log(msg));


        // 请求小组贡献榜数据
        vm.$http.post(API_GROUPINCOME, {
        	startTime: getCurrYMDHMS(),
        	page: vm.groupIncomePages.index,
        	total: vm.groupIncomePages.limit
        }).then(({body: {data: {pageNum, data}}}) => {
        	const { sref } = echart.group;

        	let legendData = [],
        		seriesData = [];

            // 遍历操作月收入数据
            data.forEach(({name, rmb} = val) => {
                legendData.push(name);
                seriesData.push({
                	name,
                	value: rmb
                });
            });

            // 月收入趋势数据
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
			    			text: '小组收入\n占比图',
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
		            name: '小组收入占比图',
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
        	vm.groupIncomePages.total = vm.groupIncomePages.limit * pageNum;
        	vm.monthGroupIncomeTable = data;
        }, ({body: {msg}}) => console.log(msg));


		// 请求 达标/未达标 主播榜数据
        vm.$http.post(API_RATESTAR, {
        	startTime: getCurrYMDHMS(),
        	page: vm.ratestarPages.index,
            total: vm.ratestarPages.limit
        }).then(({body: {data: {pageNum, data}}}) => {
        	console.log(data);


        	// 达标主播数据挂载
        	vm.ratestarPages.total = vm.ratestarPages.limit * pageNum;
        	vm.monthRatestarTable = data;

        	// 未达标主播数据挂载
        	vm.notRatestarPages.total = vm.notRatestarPages.limit * pageNum;
        	vm.monthNotRatestarTable = data;
        }, ({body: {msg}}) => console.log(msg));


		// 请求平台榜数据
        vm.$http.post(API_PAGEPLATINCOME, {
        	startTime: getCurrYMDHMS(),
        	page: vm.pagePlatincomePages.index,
            total: vm.pagePlatincomePages.limit
        }).then(({body: {data: {pageNum, data}}}) => {
        	const {sref} = echart.platform;

        	let legendData = [],
        		seriesData = [];

            // 遍历操作月收入数据
            data.forEach(({color, name, rmb} = val) => {
                legendData.push(name);
                seriesData.push({
                	name,
                	value: rmb,
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
			    			text: '平台收入\n占比图',
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
		            name: '平台收入占比图',
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
        	vm.pagePlatincomePages.total = vm.pagePlatincomePages.limit * pageNum;
        	vm.monthPagePlatincomeTable = data;
        }, ({body: {msg}}) => console.log(msg));
    },
	data: () => ({
		dateCF: { 				  // 时间组件配置
			mode: 'single',		  //—— 选择的模式
			maxDate: getCurrYMD(), //—— 最大可选择时间
		},    	
		currDate: getCurrYMD(), // 时间组件当前选择的时间
		currShow: 0,		  //—— 当前显示榜单
		allIncome: 0,         //—— 累计总收入
		monthIncome: 0, 	  //—— 月总收入数据
		monthIncomeTable: [], //—— 月收入明细数据
		monthIncomePages: {   //—— 月收入明细分页
	        index: 1,	  	  //—— 当前的页码
	    	limit: 10,	      //—— 翻页的条数
	    	total: 10,        //—— 总条数
	    	data: [],	      //—— 当前分页储存数据
		}, 
		monthGroupIncomeTable: [], //——小组贡献榜数据
		groupIncomePages: {		   //——小组贡献榜分页
	        index: 1,	  	       //—— 当前的页码
	    	limit: 10,	           //—— 翻页的条数
	    	total: 10,             //—— 总条数
		},
		monthRatestarTable: [], //—— 达标主播数据
		ratestarPages: {	    //—— 达标主播分页
	        index: 1,	  	    //—— 当前的页码
	    	limit: 10,	        //—— 翻页的条数
	    	total: 10,          //—— 总条数
		},
		monthNotRatestarTable: [], //—— 未达标主播数据
		notRatestarPages: {	       //—— 未达标主播分页
	        index: 1,	  	       //—— 当前的页码
	    	limit: 10,	           //—— 翻页的条数
	    	total: 10,             //—— 总条数
		},
		monthPagePlatincomeTable: [],  //—— 平台贡献榜数据
		pagePlatincomePages: {	       //—— 平台贡献榜分页
	        index: 1,	  	           //—— 当前的页码
	    	limit: 10,	               //—— 翻页的条数
	    	total: 10,                 //—— 总条数
		}
	}),
	components: { coPages, coSeldate },
	methods: {
    	// 修改日期
    	updateDate(dateStr) {
    		if (this.currDate !== dateStr) {
		        const
		        	vm = this,
		        	{ state: {api: {income: {
		        		pageIncome: API_PAGEINCOME,
		        		incomeImg: API_INCOMEIMG,
		        		groupIncome: API_GROUPINCOME,
		        		rateStar: API_RATESTAR,
		        		pagePlatincome: API_PAGEPLATINCOME
		        	}}} } = vm.$store;


		        // 请求月收入统计数据
		        vm.$http.post(API_PAGEINCOME, { startTime: dateStr }).then(({body: {data: {monthRmb, rmb}}}) => {
		        	vm.allIncome = rmb[0].rmb;
		        }, ({body: {msg}}) => console.log(msg));


		        // 请求月收入趋势数据（曲线图）
		        vm.$http.post(API_INCOMEIMG, {
		        	startTime: getStartEndTime('start'),
		        	endTime: dateStr
		        }).then(({body: {data}}) => {
		    		const patt = /^([0-9]+-[0-9]+-[0-9]+)/;
		                
		            let xaxisData = [],
		                incomeData = [],
		                monthIncome = 0,
		                yaxisMax = 0;

		            // 遍历操作月收入数据
		            data.forEach(({idate, increase_rmb} = val) => {
		                if (yaxisMax < increase_rmb) yaxisMax = increase_rmb;
		                if (patt.test(idate)) xaxisData.unshift(RegExp.$1);

		                monthIncome += increase_rmb;
		                incomeData.unshift(increase_rmb);
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
		                    name: '月收入趋势',
		                    type: 'line',
		                    smooth: true,
			                itemStyle: { normal: { color: '#ffcb34'} },
			                lineStyle: { normal: { color: '#ffcb34'} },
			                areaStyle: { normal: { color: '#fad771'} },
		                    data: incomeData
		                }]                
		            }; 
		            echart.inAdd.sref.setOption(echart.inAdd.options); 

		            // 挂载数据
		            vm.monthIncome = monthIncome;
		            vm.monthIncomeTable = data;
		            vm.monthIncomePages.index = 1;
		            vm.monthIncomePages.total = data.length;
		            vm.monthIncomePages.data = data.slice(0, vm.monthIncomePages.limit);
		        }, ({body: {msg}}) => console.log(msg));


		        // 请求小组贡献榜数据
		        vm.$http.post(API_GROUPINCOME, {
		        	startTime: dateStr,
		        	page: vm.groupIncomePages.index,
		        	total: vm.groupIncomePages.limit
		        }).then(({body: {data: {pageNum, data}}}) => {
		        	const { sref } = echart.group;

		        	let legendData = [],
		        		seriesData = [];

		            // 遍历操作月收入数据
		            data.forEach(({name, rmb} = val) => {
		                legendData.push(name);
		                seriesData.push({
		                	name,
		                	value: rmb
		                });
		            });

		            // 月收入趋势数据
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
					    			text: '小组收入\n占比图',
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
				            name: '小组收入占比图',
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
		        	vm.groupIncomePages.index = 1;
		        	vm.groupIncomePages.total = vm.groupIncomePages.limit * pageNum;
		        	vm.monthGroupIncomeTable = data;
		        }, ({body: {msg}}) => console.log(msg));


				// 请求 达标/未达标 主播榜数据
		        vm.$http.post(API_RATESTAR, {
		        	startTime: dateStr,
		        	page: vm.ratestarPages.index,
		            total: vm.ratestarPages.limit
		        }).then(({body: {data: {pageNum, data}}}) => {
		        	// 达标主播数据挂载
		        	vm.ratestarPages.index = 1;
		        	vm.ratestarPages.total = vm.ratestarPages.limit * pageNum;
		        	vm.monthRatestarTable = data;

		        	// 未达标主播数据挂载
		        	vm.notRatestarPages.index = 1;
		        	vm.notRatestarPages.total = vm.notRatestarPages.limit * pageNum;
		        	vm.monthNotRatestarTable = data;
		        }, ({body: {msg}}) => console.log(msg));


				// 请求平台榜数据
		        vm.$http.post(API_PAGEPLATINCOME, {
		        	startTime: dateStr,
		        	page: vm.pagePlatincomePages.index,
		            total: vm.pagePlatincomePages.limit
		        }).then(({body: {data: {pageNum, data}}}) => {
		        	const {sref} = echart.platform;

		        	let legendData = [],
		        		seriesData = [];

		            // 遍历操作月收入数据
		            data.forEach(({color, name, rmb} = val) => {
		                legendData.push(name);
		                seriesData.push({
		                	name,
		                	value: rmb,
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
					    			text: '平台收入\n占比图',
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
				            name: '平台收入占比图',
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
		        	vm.pagePlatincomePages.index = 1;
		        	vm.pagePlatincomePages.total = vm.pagePlatincomePages.limit * pageNum;
		        	vm.monthPagePlatincomeTable = data;
		        }, ({body: {msg}}) => console.log(msg));
		    };
    	},
		// 切换本月收入明细分页
		monthIncomeSwitchPage(index) {
			const { limit } = this.monthIncomePages;

			this.monthIncomePages.index = index;
            this.monthIncomePages.data = this.monthIncomeTable.slice((index - 1) * limit, index * limit);
		},
		// 切换切换小组贡献榜明细分页
		monthGroupIncomeSwitchPage(index) {
			const 
	    		vm = this,
	    		API_GROUPINCOME = vm.$store.state.api.income.groupIncome;
	    		
        	// 请求数据
	        vm.$http.post(API_GROUPINCOME, {
	        	startTime: getCurrYMDHMS(),
	        	page: index,
	            total: vm.groupIncomePages.limit
	        }).then(({body: {data: {pageNum, data}}}) => {
	        	let legendData = [],
	        		seriesData = [];

	            // 遍历操作月收入数据
	            data.forEach(({name, rmb} = val) => {
	                legendData.push(name);
	                seriesData.push({
	                	name,
	                	value: rmb
	                });
	            });	               

                // 小组收入饼图数据
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
				    			text: '小组收入\n占比图',
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
			            name: '小组收入占比图',
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
	        	vm.groupIncomePages.index = index;
	        	vm.monthGroupIncomeTable = data;         	
	        }, ({body: {msg}}) => console.log(msg));
		},
		// 切换达标主播明细分页
		monthRatestarSwitchPage(index) {
			const 
	    		vm = this,
	    		API_RATESTAR = vm.$store.state.api.income.rateStar;
	    		
        	// 请求数据
	        vm.$http.post(API_RATESTAR, {
	        	startTime: getCurrYMDHMS(),
	        	page: index,
	            total: vm.ratestarPages.limit
	        }).then(({body: {data: {pageNum, data}}}) => {
	        	vm.ratestarPages.index = index;
	        	vm.monthRatestarTable = data;
	        }, ({body: {msg}}) => console.log(msg));
		},
		// 切换未达标主播明细分页
		monthNotRatestarSwitchPage(index) {
			const 
	    		vm = this,
	    		API_RATESTAR = vm.$store.state.api.income.rateStar;

        	// 请求数据
	        vm.$http.post(API_RATESTAR, {
	        	startTime: getCurrYMDHMS(),
	        	page: index,
	            total: vm.notRatestarPages.limit
	        }).then(({body: {data: {pageNum, data}}}) => {
	        	vm.notRatestarPages.index = index;
	        	vm.monthNotRatestarTable = data;
	        }, ({body: {msg}}) => console.log(msg));
		},
		// 切换平台明细分页
		monthPagePlatincomeSwitchPage(index) {
			const 
	    		vm = this,
	    		API_PAGEPLATINCOME = vm.$store.state.api.income.pagePlatincome;

        	// 请求数据
	        vm.$http.post(API_PAGEPLATINCOME, {
	        	startTime: getCurrYMDHMS(),
	        	page: index,
	        	total: vm.pagePlatincomePages.limit
	        }).then(({body: {data: {pageNum, data}}}) => {
	        	let legendData = [],
	        		seriesData = [];
	                
	            // 遍历操作月收入数据
	            data.forEach(({color, name, rmb} = val) => {
	                legendData.push(name);
	                seriesData.push({
	                	name,
	                	value: rmb,
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
				    			text: '平台收入\n占比图',
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
			            name: '平台收入占比图',
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
	        	vm.pagePlatincomePages.index = index;
	        	vm.monthPagePlatincomeTable = data; 	
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
            	const { options } = echart[value];

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
export default Object.assign({ name: 'p-income' }, vm);
</script>


<style lang="less" scoped>
    #p-income {
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
			.income-table {
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

			/*小组贡献榜*/
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
						width: 23%;
					}
					&:nth-child(3) {
						width: 22%;
					}
					&:nth-child(4) {
						width: 23%;
					}
					&:nth-child(5) {
						width: 23%;
					}
				}
				.table-td {
					color: #333c44;
					line-height: 78px;
				}
			}

			/*达标主播*/
			.standard-table,
			.not-standard-table {
				.table-tr {
					height: 78px;
					border-bottom: 1px solid #eaeaea;
				}
				.table-th {
					line-height: 55px;
				}
				.table-th,
				.table-td {
					&:nth-child(1) {
						width: 6%;
					}
					&:nth-child(2) {
						width: 22%;
					}
					&:nth-child(3) {
						width: 15%;
					}
					&:nth-child(4) {
						width: 14%;
					}
					&:nth-child(5) {
						width: 12%;
					}
					&:nth-child(6) {
						width: 16%;
					}
					&:nth-child(7) {
						width: 5%;
					}
					&:nth-child(8) {
						width: 10%;
					}
				}
				.table-td {
					color: #333c44;

					img {
						width: 52px;
						height: 52px;
						margin: 13px 2px 0 2px;
					}
					figcaption {
						margin-left: 67px;
						line-height: 78px;
					}
					.info-name {
						height: 28px;
						line-height: 28px;
						margin-top: 12px;
					}
					.info-id {
						height: 26px;
						line-height: 26px;
						color: #aaa;
						font-size: 14px;
					}

					&:nth-child(1),
					&:nth-child(3),
					&:nth-child(4),
					&:nth-child(5),
					&:nth-child(7),
					&:nth-child(8) {
						line-height: 78px;
					}
					.ico {
						color: #ff5a7d;
						font-size: 54px;
						line-height: 78px;
					}
				}
			}

			/*平台贡献榜*/
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