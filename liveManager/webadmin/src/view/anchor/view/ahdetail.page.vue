/**
 * Created by miaoyu on 2016/12/16 0016.
 */
<template>
    <div id="p-ahdetail">
        <header class="ah-info">
        	<div class="ah-personal-info rel clear">
        		<figure class="personal-headimg arc abs">
        			<img class="wh-100 arc" :src="anchorInfo.avatar" 
        									:alt="anchorInfo.remark || anchorInfo.nickname">
        			<figcaption class="arc abs text-center">
        				<span class="ico icon-home font-14"></span>
        			</figcaption>
        		</figure>
        		<span class="personal-name db w-100 text-center font-16 color-white fl">{{ anchorInfo.remark || anchorInfo.nickname }}</span>
        		<div class="personal-platform w-100 text-center font-0 fl">
        			<img class="di" :src="'http://1.itoubu.com/liveManager'+ anchorInfo.platurl" 
        							:alt="anchorInfo.platname">
        			<span class="platform-id di font-14 color-white">{{ anchorInfo.platformid }}</span>
        		</div>
        		<div class="personal-outer fl w-100 text-center font-0">
        			<span class="font-14 color-white">综合指数: {{ anchorInfo.indexnum }}</span>
        			<span class="font-14 color-white">省市: {{ anchorInfo.provincename }}</span>
        			<span class="font-14 color-white">等级: {{ anchorInfo.levelname }}</span>
        			<span class="font-14 color-white">经纪人: {{ anchorInfo.agentname }}</span>
        			<!-- <span class="font-14 color-white">签约日期: 2016-11-12</span> -->
        		</div>
        	</div>
        	<ul class="ah-data clear">
        		<li class="fl text-center rel">
        			<div class="data-title font-14">粉丝 (人)</div>
        			<strong class="data-cont db font-30 font-bold text-hidden">{{ anchorInfo.follower }}</strong>
        		</li>
        		<li class="fl text-center rel">
        			<div class="data-title font-14">{{ anchorInfo.ratename }}</div>
        			<strong class="data-cont db font-30 font-bold text-hidden">{{ anchorInfo.income }}</strong>
        		</li>
        		<li class="fl text-center rel">
        			<div class="data-title font-14">收入 (元)</div>
        			<strong class="data-cont db font-30 font-bold text-hidden">{{ anchorInfo.rmb }}</strong>
        		</li>
        		<li class="fl text-center rel">
        			<div class="data-title font-14">当前在播时长 (时)</div>
        			<strong class="data-cont db font-30 font-bold text-hidden">{{ anchorInfo.workTime }}</strong>
        		</li>
        	</ul>
        </header>
        <section class="ah-fun clear">
        	<div class="fun-left fl">
        		<div class="live-state h-100">
        			<div class="online wh-100 fl" v-show="anchorState.recommend">
        				<figure class="fl rel">
	        				<img class="wh-100" :src="anchorInfo.avatar"
	        									:alt="anchorInfo.remark || anchorInfo.nickname">
	        				<figcaption class="abs font-16 color-white text-center">当前{{ anchorInfo.platname }}{{ anchorInfo.provincename }}榜第{{ anchorState.recommend }}名</figcaption>

	        			</figure>
	        			<div class="state">
	        				<span class="ico icon-home"></span>
	        				<span class="font-18 font-bold">正在直播中...</span>
	        			</div>
	        			<p class="username font-16 text-hidden"># {{ anchorState.title }}</p>
	        			<p class="time font-14 text-hidden">{{ anchorState.starttime }}开播</p>
	        			<p class="outer font-14 text-hidden">当前在线：{{ anchorState.online }}人</p>
        			</div>
	        		<div class="ont-online wh-100" v-show="!anchorState.recommend"></div>
        		</div>
        	</div>
        	<div class="fun-right fr">
        		<div class="live-history h-100">
        			<div class="history-title">
        				<span class="label font-18 font-bold">直播历史</span>
        				<router-link class="btn btn-more font-14 fr"
        							 :to="'/admin/ahhistory/'+ platform +'/'+ platformid">
							<span>更多记录</span>
							<span class="ico icon-home"></span>
						</router-link>
        			</div>
        			<ul class="history-cont">
        				<li class="w-100 fl clear" v-for="item of anchorLiveHistry">
        					<img class="fl" :src="anchorInfo.avatar" 
        									:alt="anchorInfo.remark || anchorInfo.nickname">
        					<span class="name db font-16 text-hidden"># {{ item.title }}</span>
        					<p class="info font-14 text-hidden">{{ item.starttime }}开播，时长{{ item.workTime }}小时，{{ item.onlineMax }}人观看。</p>
        				</li>
        			</ul>
        		</div>
        	</div>
        </section>
        <section class="ah-tab">
    		<ul class="tab-title clear">
    			<li class="sel-tab font-16 text-center text-none-sel fl rel c-pointer"
    				:class="{'sel': currShow === 0}"
    				@click="switchTab(0)">直播记录</li>
    			<li class="sel-tab font-16 text-center text-none-sel fl rel c-pointer"
    				:class="{'sel': currShow === 1}"
    				@click="switchTab(1)">考勤记录</li>
    		</ul>
    		<div class="tab-cont">
    			<transition name="table-fade">
	    			<!-- 直播记录 -->
	    			<div class="live-img h-100" v-eline="'live'" v-if="currShow === 0" key="table0"></div>
	    			<!-- 考勤记录 -->
	    			<div class="live-img h-100" v-eline="'check'" v-if="currShow === 1" key="table1"></div>
	    		</transition>
    		</div>
        </section>
    </div>
</template>


<script>
import echarts from 'echarts';
import { closePgloading } from './../../../service/pageloading.service.js'

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

    // 公共饼图配置
let comCakeOptions = {
		tooltip: { trigger: 'axis' },
		grid: {
	        left: '36px',
	        right: '56px',
	        bottom: '20px',
	        containLabel: true
	    },
	    backgroundColor: '#fff'
    },
        
    // echarts插件具体配置
    echart = {
        // 直播记录折线数据
        live: {
            sref: null,
            options: null
        },
        // 考勤记录
        check: {
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
            { platform, platformid } = vm.$route.params,
            { state: {api: {anchor: {
            	starDetail: API_STARDETAIL,
            	starLiveState: API_STARLIVESTATE,
            	livehistry: API_LIVEHISTRY,
            	livehistrys: API_LIVEHISTRYS
            }}} } = vm.$store; 


        vm.platform = platform;
        vm.platformid = platformid;


        // 请求主播详情数据
        vm.$http.post(API_STARDETAIL, {
        	platformid,
        	platform,
        	startTime: getCurrYMDHMS()
        }).then(({body: {data: {star, worktime}}}) => {
        	vm.anchorInfo = Object.assign(star[0], worktime[0]);
        }, ({body: {msg}}) => console.log(msg)); 


        // 请求主播直播状态数据
        vm.$http.post(API_STARLIVESTATE, {
        	platformid,
        	platform
        }).then(({body: {data}}) => {
            console.log(data);
        	// if (data) vm.anchorState = data[0];
        }, ({body: {msg}}) => console.log(msg)); 


        // 请求主播直播历史数据
        vm.$http.post(API_LIVEHISTRY, {
        	platformid,
        	platform,
        	page: 1,
        	total: 2
        }).then(({body: {data: {data}}}) => {
        	vm.anchorLiveHistry = data;
        }, ({body: {msg}}) => console.log(msg)); 


        // 请求主播直播记录数据 / 考勤记录
        vm.$http.post(API_LIVEHISTRYS, {
        	platformid,
        	platform,
        	startTime: getCurrYMDHMS()
        }).then(({body: {data}}) => {
        	let xAxisData = [],
        		onlineData = [],
        		incomeData = [],
        		addfansData = [],
        		worktimeData = [],
        		markPointData = [],
        		yAxisMax = 0,
        		yAxisWKMax = 0;

        	// 遍历数据
        	data.forEach(({increase_follower, idate, onlineMax, recommend, increase_rmb, workTime}) => {
        		if (yAxisMax < onlineMax) yAxisMax = onlineMax;
        		if (yAxisMax < increase_rmb) yAxisMax = increase_rmb;
        		if (yAxisMax < increase_follower) yAxisMax = increase_follower;
        		if (yAxisWKMax < workTime) yAxisWKMax = workTime;
        		if (recommend > 0) markPointData.push({
        			name: '上榜:',
        			xAxis: idate, 
        			yAxis: increase_rmb,
        			value: `榜${recommend}`,
        			label: { 
        				normal: {
        					show: true,
        					formatter: `榜${recommend}`,
        					position: 'insideTop',
        				}
        			},
        			symbolSize: [80, 43],
        			symbolOffset: [0, '-100%'],
        			symbol: 'path://M70,39c5.641,11.701,6,12,6,12H59v-4H43v15h-2V47H25v4H8c0,0,0.359-0.299,6-12C8.244,27.208,8,27,8,27h8v-4h52v4h8 C76,27,75.755,27.208,70,39z',
        			itemStyle: { normal: {color: '#ff597c'} }
        		});

        		xAxisData.push(idate);
        		incomeData.push(increase_rmb);
        		addfansData.push(increase_follower);
        		onlineData.push(onlineMax);
        		worktimeData.push(workTime);
        	});


            // 直播记录折线图数据
            echart.live.options = Object.assign({}, comCakeOptions, {
	            legend: {
	            	data: ['收入趋势(元)', '增粉趋势(人)', '观众趋势(人)'],
	            	right: 19,
	            	top: 19
	            },
	            xAxis: {
		        	axisLabel: { interval: 5 },
		        	splitLine: { show: true },
		        	boundaryGap: false,
		            data: xAxisData
		        },
	            yAxis: {
	            	min: 0,
	            	max: yAxisMax
	            },
	            series: [{
	            	name: '收入趋势(元)',
	            	type: 'line',
	            	smooth: true,
	            	itemStyle: { normal: { color: '#ffcb34'} },
	            	lineStyle: { normal: { color: '#ffcb34'} },
	            	areaStyle: { normal: { color: '#fad771'} },
	            	data: incomeData,
	            	markPoint: { data: markPointData }
	            }, {
	            	name: '增粉趋势(人)',
	            	type: 'line',
	            	smooth: true,
	                itemStyle: { normal: { color: '#18b2d8'} },
	                lineStyle: { normal: { color: '#18b2d8'} },
	                areaStyle: { normal: { color: '#54d1f0'} },
	            	data: addfansData
	            }, {
	            	name: '观众趋势(人)',
	            	type: 'line',
	            	smooth: true,
	                itemStyle: { normal: { color: '#e9254e'} },
	            	lineStyle: { normal: { color: '#e9254e'} },
	            	areaStyle: { normal: { color: '#ff597c'} },
	            	data: onlineData,
	            }]
            }); 
            echart.live.sref.setOption(echart.live.options);	


            // 考勤记录折线图数据
            echart.check.options = Object.assign({}, comCakeOptions, {
	            legend: {
	            	data: ['考勤记录(人)'],
	            	right: 19,
	            	top: 19
	            },
			    xAxis: {
		        	axisLabel: { interval: 5 },
		        	splitLine: { show: true },
		        	boundaryGap: false,
		            data: xAxisData
		        },
	            yAxis: {
	            	min: 0,
	            	max: yAxisWKMax
	            },
	            series: [{
	            	name: '考勤记录(人)',
	            	type: 'line',
	            	smooth: true,
	            	itemStyle: { normal: { color: '#ffcb34'} },
	            	lineStyle: { normal: { color: '#ffcb34'} },
	            	areaStyle: { normal: { color: '#fad771'} },
	            	data: worktimeData,
	            }]
            }); 
            if (echart.check.sref) echart.check.sref.setOption(echart.check.options);	

            // 点击跳转
            echart.live.sref.on('click', params => {
                vm.$router.push({ name: 'ahrecord', params: { platform: vm.platform, platformid: vm.platformid }});
			});	
        }, ({body: {msg}}) => console.log(msg)); 
	},
	data: () => ({
        currShow: 0,		  // 当前显示趋势
        anchorInfo: {

        },       // 主播基本信息
        anchorState: {
            recommend: 0
        },      // 主播直播状态
       	anchorLiveHistry: [], // 主播直播历史
       	platform: null, 	  // 平台id
       	platformid: null	  // 主播id
	}),
	methods: {
		// 趋势图
        switchTab(index) {
            if (index !== this.currShow) this.currShow = index;
        },
	},
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
export default Object.assign({ name: 'p-ahdetail' }, vm);
</script>


<style lang="less" scoped>
    #p-ahdetail {
        /*主播头部信息*/
        .ah-info {
        	margin: 20px;
			
			/*主播个人信息*/
	        .ah-personal-info {
	        	height: 263px;
	        	background: url(../images/acdetail-info-bg.jpg) no-repeat center;
	        }
	        .personal-headimg {
	        	top: 23px;
	        	left: 50%;
	        	width: 100px;
	        	height: 100px;
	        	margin-left: -50px;
	        	border: 2px solid #fff;
	        }
	        figcaption {
	        	top: 81px;
	        	left: 68px;
				width: 20px;
				height: 20px;
				background: #fff;
				border: 1px solid #ff5a7d;

				.ico {
					color: #ff5a7d;
					line-height: 20px;
				}
	        }
	        .personal-name {
	        	height: 26px;
	        	margin-top: 142px;
	        	line-height: 26px;
	        }
	        .personal-platform {
	        	height: 34px;
	        	line-height: 34px;

	        	img {
	        		width: 20px;
	        		height: 20px; 
	        		margin-right: 10px;
	        		vertical-align: middle;
	        		border-radius: 4px;
	        	}
	        	.platform-id {
	        		vertical-align: middle;
	        	}
	        }
	        .personal-outer {
	        	height: 26px;
	        	margin-top: 14px;
	        	line-height: 26px;

	        	span {
	        		margin: 0 21px;
	        	}
	        }

	        /*主播展示信息*/
	        .ah-data {
	        	li {
	        		width: 25%;
	        		height: 118px;
	        		background: #fff;

	        		&:after {
	        			content: '';
	        			position: absolute;
	        			top: 0;
	        			right: 0;
	        			width: 1px;
	        			height: 100%;
	        			background: #eaeaea;
	        		}
	        		&:last-child:after {
	        			content: none;
	        		}
	        		&:nth-child(1) {
	        			border-bottom: 2px solid #29c9f1;
	        		}
	        		&:nth-child(2) {
	        			border-bottom: 2px solid #ef4d39;
	        		}
	        		&:nth-child(3) {
	        			border-bottom: 2px solid #fad771;
	        		}
	        		&:nth-child(4) {
	        			border-bottom: 2px solid #85c737;
	        		}
	        	}
	        	.data-title {
	        		height: 62px;
	        		color: #757b81;
	        		line-height: 62px;
	        	}
	        	.data-cont {
	        		height: 31px;
	        		line-height: 31px;
	        	}
	        }
        }
		
		/*功能块*/
        .ah-fun {
        	margin: 0 20px;
        	
        	.fun-left,
        	.fun-right {
        		width: 50%;
        		height: 255px;
        		background: #f2f2f2;
        	}

        	/*直播状态*/
        	.live-state {
        		margin-right: 10px;
        		background: #fff;

        		/*在线*/
        		.online {
        			figure {
						width: 214px;
						height: 214px;
						margin-top: 20px;
						margin-left: 21px;
	        		}
	        		img {
						border-radius: 6px;
					}
					figcaption {
						left: 50%;
						bottom: -7px;
						width: 247px;
						height: 31px;
						margin-left: -123.5px;
						line-height: 24px;
						background: url(../images/ahdetail-list-bg.png) no-repeat;
					}
					.state {
						height: 40px;
						margin-top: 20px;
						margin-left: 256px;
						line-height: 40px;

						.ico {
							color: #ff1849;
						}
					}
					.username {
						height: 40px;
						margin-left: 256px;
						color: #333c44;
						line-height: 40px;
					}
					.time {
						height: 25px;
						margin-left: 256px;
						color: #aaa;
						line-height: 25px;
					}
					.outer {
						height: 23px;
						margin-left: 256px;
						color: #aaa;
						line-height: 23px;
					}
        		}
        		/*不在线*/
				.ont-online {
					background: url(../images/ahdetail-notonline-bg.png) no-repeat center;
				}
        	}

        	/*直播历史*/
			.live-history {
				margin-left: 10px;
				background: #fff;
			}
			.history-title {
				height: 56px;
				border-bottom: 2px solid #ff597c;

				.label {
					padding-left: 19px;
					line-height: 56px;
				}
				.btn-more {
					height: 22px;
					margin-top: 17px;
					margin-right: 20px;
					color: #b0bcd4;
					line-height: 22px;
				}
			}
			.history-cont {
				li {
					height: 98px;
					border-bottom: 1px solid #eaeaea;

					img {
						width: 63px;
						height: 63px;
						margin-top: 18px;
						margin-left: 20px;
						border-radius: 4px;
					}
					.name {
						height: 26px;
						margin-left: 93px;
						margin-top: 18px;
						color: #333c44;
						line-height: 26px;
					}
					.info {
						height: 48px;
						margin-left: 93px;
						color: #aaa;
						line-height: 48px;
					}

					&:last-child {
						border-bottom: none;
					}
				}
			}
        }
		
		/*tab块*/
        .ah-tab {
			height: 524px;
			margin: 20px;
			background: #fff;

			.tab-title {
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
			.tab-cont {
				height: 470px;
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