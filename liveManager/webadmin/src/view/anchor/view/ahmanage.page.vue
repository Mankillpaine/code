/**
 * Created by miaoyu on 2016/12/16 0016.
 */
<template>
    <div id="p-ahmanage">
    	<header class="curr-header">
			<span class="title h-100 font-18 font-bold fl">主播管理</span>
    	</header>
    	<section class="showblock">
    		<div class="show-left h-100 fl">
    			<span class="label db font-14">主播总数(人)</span>
    			<p class="cont text-hidden font-30 font-bold color-white">{{ anchorAll }}</p>
    			<span class="label db font-14">本月平均在线(人)</span>
    			<p class="cont text-hidden font-30 font-bold color-white">{{ avaragePepople }}</p>    			
    		</div>
    		<ul class="show-right h-100">
    			<li class="cake-cont h-100 fl" v-eline="'sex'"></li>
    			<li class="cake-cont h-100 fl" v-eline="'platform'"></li>
    			<li class="cake-cont h-100 fl" v-eline="'province'"></li>
    		</ul>
    	</section>
    	<section class="screen">
			<div class="srceen-head">
				<span class="label font-16 font-bold">筛选</span>
				<div class="srceen-search fr">
					<input type="text" v-model="searchVal" placeholder="请输入ID、昵称、平台进行搜索">
					<span class="btn db fr">
						<span class="ico icon-home font-14"
                              @click="searchInfo"></span>
					</span>
				</div>
			</div>
    		<ul class="clear">
    			<li class="item clear">
    				<div class="item-head fl">
    					<em class="db font-14 fl">平　台：</em>
						<span class="btn db font-14 fl"
                              :class="{'sel': screen.platformSel === 'unlimited'}"
                              @click="submitScreen('platform', 'unlimited', null)">不限</span>
    				</div>
    				<div class="item-cont">
    					<span class="btn db font-14 fl" 
                              v-for="(item, $index) in screen.platform"
                              :class="{'sel': screen.platformSel === $index}"
                              @click="submitScreen('platform', $index, item)">{{ item.name }}</span>
    				</div>
    			</li>
    			<li class="item clear">
    				<div class="item-head fl">
    					<em class="db font-14 fl">地　区：</em>
						<span class="btn db font-14 fl"
                              :class="{'sel': screen.provinceSel === 'unlimited'}"
                              @click="submitScreen('province', 'unlimited', null)">不限</span>
    				</div>
    				<div class="item-cont">
    					<span class="btn db font-14 fl" 
                              v-for="(item, $index) of screen.province"
                              :class="{'sel': screen.provinceSel === $index}"
                              @click="submitScreen('province', $index, item)">{{ item.province }}</span>
    				</div>
    			</li>
    			<li class="item clear">
    				<div class="item-head fl">
    					<em class="db font-14 fl">等　级：</em>
						<span class="btn db font-14 fl"
                              :class="{'sel': screen.levelSel === 'unlimited'}"
                              @click="submitScreen('level', 'unlimited', null)">不限</span>
    				</div>
    				<div class="item-cont">
    					<span class="btn db font-14 fl"
                              v-for="(item, $index) of screen.level"
                              :class="{'sel': screen.levelSel === $index}"
                              @click="submitScreen('level', $index, item)">{{ item.name }}</span>
    				</div>
    			</li>
    			<li class="item clear">
    				<div class="item-head fl">
    					<em class="db font-14 fl">经纪人：</em>
						<span class="btn db font-14 fl"
                              :class="{'sel': screen.agentSel === 'unlimited'}"
                              @click="submitScreen('agent', 'unlimited', null)">不限</span>
    				</div>
    				<div class="item-cont">
    					<span class="btn db font-14 fl" 
                              v-for="(item, $index) in screen.agent"
                              :class="{'sel': screen.agentSel === $index}"
                              @click="submitScreen('agent', $index, item)">{{ item.name }}</span>
    				</div>
    			</li>
    			<li class="item clear">
    				<div class="item-head fl">
    					<em class="db font-14 fl">性　别：</em>
						<span class="btn db font-14 fl"
                              :class="{'sel': screen.genderSel === 'unlimited'}"
                              @click="submitScreen('gender', 'unlimited', null)">不限</span>
    				</div>
    				<div class="item-cont">
    					<span class="btn db font-14 fl"
                              :class="{'sel': screen.genderSel === 0}"
                              @click="submitScreen('gender', 0, 1)">男</span>
    					<span class="btn db font-14 fl"
                              :class="{'sel': screen.genderSel === 1}"
                              @click="submitScreen('gender', 1, 0)">女</span>
    				</div>
    			</li>
    		</ul>
    	</section>
    	<section class="table">
    		<div class="table-thead clear">
    			<span class="table-th di h-100 font-16 font-bold text-center fl">主播</span>
    			<span class="table-th di h-100 font-16 font-bold text-center fl">总收入</span>
    			<span class="table-th di h-100 font-16 font-bold text-center fl">月在线时长</span>
    			<span class="table-th di h-100 font-16 font-bold text-center fl">综合指数</span>
    			<span class="table-th di h-100 font-16 font-bold text-center fl">等级</span>
    			<span class="table-th di h-100 font-16 font-bold text-center fl">经纪人</span>
    		</div>
    		<ul class="table-tbody">
                <router-link :to="'/admin/ahdetail/'+ item.platform +'/'+ item.platformid"
                                         class="table-tr clear c-pointer" 
                                         v-for="item of anchorPages.data" tag="li">
    				<div class="table-td h-100 font-16 fl">
						<img class="userimg arc fl" :src="item.avatar" 
                                                    :alt="item.remark || item.nickname">
						<p class="username text-hidden">{{ item.remark || item.nickname }}</p>
						<p class="platform text-hidden">{{ item.platname }}</p>
    				</div>
    				<div class="table-td h-100 font-16 text-center fl">
						<p class="game text-hidden">{{ item.income }}{{ item.ratename }}</p>
						<p class="rmb text-hidden">{{ item.rmb }}人民币</p>
    				</div>
					<div class="table-td h-100 font-16 text-center text-hidden fl">{{ item.monthworktime }}分钟</div>
    				<div class="table-td h-100 font-16 text-center text-hidden fl">{{ item.indexnum }}</div>
    				<div class="table-td h-100 font-16 text-center text-hidden fl">{{ item.levename }}</div>
    				<div class="table-td h-100 font-16 text-center text-hidden fl">{{ item.name }}</div>
    			</router-link>
    		</ul>
    		<div class="table-footer">
				<co-pages :index="anchorPages.index"
                          :limit="anchorPages.limit"
                          :total="anchorPages.total"
                          v-on:switchPage="monthUnrateStarSwitchPage" />
			</div>
    	</section>
    </div>
</template>


<script>
import echarts from 'echarts';
import coPages from './../../../components/pages.vue';
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


    // 公共饼图配置
let comCakeOptions = {
        tooltip: {
            trigger: 'item',
            formatter: "{a} <br/>{b} : {c} ({d}%)"
        }
    },
        
    // echarts插件具体配置
    echart = {
        // 性别分布饼图
        sex: {
            sref: null,
            options: null
        },
        // 平台分布饼图
        platform: {
            sref: null,
            options: null
        },
        // 省事分布饼图
        province: {
            sref: null,
            options: null
        },
    },

    queryScreen = {};

// vm对象
const vm = {
	// 组件创建完成后的钩子
    // 这里获取到页面渲染所需的数据
	created() {
        closePgloading();

        const
            vm = this,
            { state: {api: {anchor: {
                starManager: API_STARMANAGER,
                menu: API_MENU,
                filter: API_FILTER
            }}} } = vm.$store;  


        // 请求筛选器数据
        vm.$http.post(API_STARMANAGER, { startTime: getCurrYMDHMS() }).then(({body: {data: {avarage, starNum, gender, platform, province}}}) => {


                let sexData = [{
                    name: '男',
                    value: 0,
                    itemStyle: {normal: {color: '#05bcd4'}}
                }, {
                    name: '女',
                    value: 0,
                    itemStyle: {normal: {color: '#ff6d9a'}}
                }, {
                    name: '未知',
                    value: 0,
                    itemStyle: {normal: {color: '#a1a1a1'}}
                }], 
                platformData = [],
                provinceData = [];

                // 遍历性别饼图数据
                gender.forEach(({gender, count} = val) => {
                    if (gender === 0) {
                        sexData[0].value += sexData[0].value + count;
                    } else if (gender === 1) {
                        sexData[1].value += sexData[1].value + count;
                    } else {
                        sexData[2].value += sexData[2].value + count;
                    };
                });

                // 性别分布饼图配置
                echart.sex.options = Object.assign({}, comCakeOptions, {
                    graphic: {
                        elements: [{
                            type: 'text',
                            left: 'center',
                            top: '48%',
                            style: {
                                text: '性别分布',
                                fill: '#333c44',
                                font: 'bolder 14px "Microsoft YaHei"',
                                textAlign: 'center'
                            }
                        }]
                    },
                    series: [{
                        name: '性别分布',
                        type: 'pie',
                        label: { 
                            normal: { show: false },
                            emphasis: { show: true } 
                        },
                        radius: ['40%', '70%'],
                        data: sexData
                    }]
                }); 
                echart.sex.sref.setOption(echart.sex.options);

                // 遍历平台饼图数据
                platform.forEach(({name, count, color} = val) => {
                    platformData.push({
                        name,
                        value: count,
                        itemStyle: {normal: {color: `#${color}`}}
                    });
                });

                // 平台分布饼图配置
                echart.platform.options = Object.assign({}, comCakeOptions, {
                    graphic: {
                        elements: [{
                            type: 'text',
                            left: 'center',
                            top: '48%',
                            style: {
                                text: '平台分布',
                                fill: '#333c44',
                                font: 'bolder 14px "Microsoft YaHei"',
                                textAlign: 'center'
                            }
                        }]
                    },
                    series: [{
                        name: '平台分布',
                        type: 'pie',
                        label: { 
                            normal: { show: false },
                            emphasis: { show: true } 
                        },
                        radius: ['40%', '70%'],
                        data: platformData
                    }]
                }); 
                echart.platform.sref.setOption(echart.platform.options);

                // 遍历省份饼图数据
                province.forEach(({provincename: name, count: value} = val) => {
                    provinceData.push({
                        name,
                        value
                    });
                });

                // 省份分布饼图配置
                echart.province.options = Object.assign({}, comCakeOptions, {
                    graphic: {
                        elements: [{
                            type: 'text',
                            left: 'center',
                            top: '48%',
                            style: {
                                text: '省市分布',
                                fill: '#333c44',
                                font: 'bolder 14px "Microsoft YaHei"',
                                textAlign: 'center'
                            }
                        }]
                    },
                    series: [{
                        name: '省市分布',
                        type: 'pie',
                        label: { 
                            normal: { show: false },
                            emphasis: { show: true } 
                        },
                        radius: ['40%', '70%'],
                        data: provinceData
                    }]
                });
                echart.province.sref.setOption(echart.province.options);

                // 挂载数据
                vm.anchorAll = starNum;
                vm.avaragePepople = avarage;
          }, ({body: {msg}}) => console.log(msg));       


        // 请求筛选器数据
        vm.$http.post(API_MENU, { startTime: getCurrYMDHMS() }).then(({body: {data}}) => {
            vm.screen = Object.assign(vm.screen, {...data});
        }, ({body: {msg}}) => console.log(msg));        


        // 请求初始主播数据
        vm.$http.post(API_FILTER, {
            startTime: getCurrYMDHMS(),
            page: vm.anchorPages.index,
            total: vm.anchorPages.limit
        }).then(({body: {data: {pageNum, star}}}) => {
            vm.anchorPages.total = vm.anchorPages.limit * pageNum;
            vm.anchorPages.data = star;
        }, ({body: {msg}}) => console.log(msg));    
	},
	components: { coPages },
    data: () => ({
        anchorAll: null,      // 主播总数
        avaragePepople: null, // 平均总人数
        screen: {                     // 筛选器
            platform: [],             //—— 平台
            platformSel: 'unlimited', //—— 默认选择平台
            province: [],             //—— 地区
            provinceSel: 'unlimited', //—— 默认选择地区
            level: [],                //—— 主播等级
            levelSel: 'unlimited',    //—— 默认选择主播等级
            gender: [],               //—— 性别
            genderSel: 'unlimited',   //—— 默认选择性别
            agent: [],                //—— 经纪人
            agentSel: 'unlimited'     //—— 默认选择经纪人
        },
        searchVal: null, // 搜索的内容
        anchorPages: {  // 主播分页数据
            index: 1,   //—— 当前的页码
            limit: 10,  //—— 翻页的条数
            total: 10,  //—— 总条数
            data: []    //—— 储存的数据
        }
    }),
    methods: {
        // 提交筛选器
        submitScreen(type, index, item) {
            const 
                vm = this,
                API_FILTER = vm.$store.state.api.anchor.filter;

            // 平台筛选
            if (type === 'platform') {
                if (index !==  vm.screen.platformSel) {
                    vm.screen.platformSel = index;

                    if (index !== 'unlimited') {
                        Object.assign(queryScreen, {platform: item.id});
                    } else {
                        delete queryScreen.platform;
                    };
                };
            };

            // 地区筛选
            if (type === 'province') {
                if (index !==  vm.screen.provinceSel) {
                    vm.screen.provinceSel = index;

                    if (index !== 'unlimited') {
                        Object.assign(queryScreen, {province: item.id});
                    } else {
                        delete queryScreen.province;
                    };
                };
            };

            // 等级筛选
            if (type === 'level') {
                if (index !== vm.screen.levelSel) {
                    vm.screen.levelSel = index;

                    if (index !== 'unlimited') {
                        Object.assign(queryScreen, {level: item.id});
                    } else {
                        delete queryScreen.level;
                    };
                };
            };

            // 经纪人筛选
            if (type === 'agent') {
                if (index !== vm.screen.agentSel) {
                    vm.screen.agentSel = index;

                    if (index !== 'unlimited') {
                        Object.assign(queryScreen, {agent: item.id});
                    } else {
                        delete queryScreen.agent;
                    };
                };
            };

            // 性别筛选
            if (type === 'gender') {
                if (index !== vm.screen.genderSel) {
                    vm.screen.genderSel = index;

                    if (index !== 'unlimited') {
                        Object.assign(queryScreen, {gender: item});
                    } else {
                        delete queryScreen.gender;
                    };
                };
            };


            // 请求数据
            queryScreen = Object.assign(queryScreen, {
                startTime: getCurrYMDHMS(),
                page: 1,
                total: vm.anchorPages.limit              
            });

            vm.$http.post(API_FILTER, queryScreen).then(({body: {data: {pageNum, star}}}) => {
                vm.anchorPages.index = 1;
                vm.anchorPages.total = vm.anchorPages.limit * pageNum;
                vm.anchorPages.data = star;
            }, ({body: {msg}}) => console.log(msg));    
        },
        // 切换主播信息明细分页
        monthUnrateStarSwitchPage(index) {
            const 
                vm = this,
                API_FILTER = vm.$store.state.api.anchor.filter;

            // 请求数据
            vm.$http.post(API_FILTER, {
                startTime: getCurrYMDHMS(),
                page: index,
                total: vm.anchorPages.limit
            }).then(({body: {data: {pageNum, star}}}) => {
                // 挂载数据
                vm.anchorPages.index = index;
                vm.anchorPages.data = star;    
            }, ({body: {msg}}) => console.log(msg));
        },
    	// 切换分页
		switchPage(index) {
			console.log(`当前的页码：${index}`);
		},
        // 搜索主播信息
        searchInfo() {
            const
                vm = this,
                { searchVal } = vm,
                API_SEARCH = vm.$store.state.api.anchor.search;

            if (searchVal) {
                vm.$http.post(API_SEARCH, {
                    startTime: getCurrYMDHMS(),
                    keysword: searchVal,
                    index: 1,
                    total: vm.anchorPages.limit
                }).then(({body: {data: {pageNum, data}}}) => {
                    vm.anchorPages.total = vm.anchorPages.limit * pageNum;
                    vm.anchorPages.index = 1;
                    vm.anchorPages.data = data;
                }, ({body: {msg}}) => console.log(msg));    
            };
        }
    },
    // 组件内部指令
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
export default Object.assign({ name: 'p-ahmanage' }, vm);
</script>


<style lang="less" scoped>
    #p-ahmanage {
        /*头部样式*/
		.curr-header {
			height: 50px;
			background: #fff;
			
			.title {
				margin-left: 20px;
				line-height: 50px;
			}
		}

		/*展示块样式*/
		.showblock {
			height: 256px;
			margin: 20px;
			background: #fff;

			.show-left {
				width: 215px;
				background: #3adab9;
			}
			.label {
				height: 42px;
				margin-top: 18px;
				color: #2d816f;
				line-height: 42px;
				text-indent: 19px;
			}
			.cont {
				height: 51px;
				line-height: 51px;
				text-indent: 19px;
			}
			.show-right {
				margin-left: 215px;
			}
			.cake-cont {
				width: 33.333333333%;
			}
		}

		/*筛选框样式*/
		.screen {
			margin: 0 20px;
			background: #fff;

			.srceen-head {
				height: 56px;
				border-bottom: 2px solid #eaeaea;

				.label {
					line-height: 56px;
					padding-left: 19px;
				}
			}
			.srceen-search {
				width: 218px;
				height: 28px;
				margin-top: 14px;
				margin-right: 21px; 
				background: #f7f7f7;
				border-radius: 20px;

				input {
					width: 188px;
					color: #757b81;
					line-height: 28px;
                    text-indent: 1em;
					background: transparent;
				}
				.btn {
					width: 30px;
					height: 30px;
				}
				.ico {
					color: #444c53;
					line-height: 30px;
				}
			}
			.item {
				min-height: 48px;
				border-bottom: 1px solid #eaeaea;

				em,
				.btn {
					height: 48px;
					color: #5e5e5e;
					line-height: 48px;
				}
				em {
					padding-left: 20px;
				}
				.btn {
					padding: 0 19px;

					&.sel {
						color: #05bcd4;
					}
				}
				.item-cont {
					margin-left: 142px;
				}
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
					width: 25%;
				}
				&:nth-child(2) {
					width: 20%;
				}
				&:nth-child(3) {
					width: 17%;
				}
				&:nth-child(4) {
					width: 18%;
				}
				&:nth-child(5) {
					width: 8%;
				}
				&:nth-child(6) {
					width: 12%;
				}
			}
			.table-th {
				line-height: 56px;
			}
			.table-td {
				line-height: 78px;
				color: #333c44;

				.userimg {
					width: 52px;
					height: 52px;
					margin-top: 12px;
					margin-left: 20px;
				}
				.username {
					height: 26px;
					margin-left: 93px;
					margin-top: 11px;
					line-height: 26px;
				}
				.platform {
					height: 27px;
					margin-left: 93px;
					line-height: 27px;
					color: #aaa;
				}
				.game {
					height: 26px;
					margin-top: 11px;
					line-height: 26px;
				}
				.rmb {
					height: 27px;
					line-height: 27px;
					color: #aaa;
				}
			}
			.table-footer {
				height: 72px;
			}
		}
    }
</style>