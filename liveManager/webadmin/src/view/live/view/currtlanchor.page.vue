/**
 * Created by miaoyu on 2016/12/16 0016.
 */
<template>
    <div id="p-currtlanchor">
    	<header class="curr-header">
			<span class="title h-100 font-18 font-bold fl">今日上播时长最高主播</span>
			<div class="autoref font-14 fr">
    			<span>{{ refTime }}秒后刷新数据</span>
				<span class="ico icon-home"></span>
    		</div>
    	</header>
		<section class="curr-main">
			<div class="table-thead clear">
				<div class="table-th font-16 font-bold text-center fl">主播</div>
				<div class="table-th font-16 font-bold text-center fl">时长</div>
				<div class="table-th font-16 font-bold text-center fl">平台</div>
				<div class="table-th font-16 font-bold text-center fl">等级</div>
				<div class="table-th font-16 font-bold text-center fl">经纪人</div>
			</div>
			<ul class="table-tbody">
				<li class="table-tr c-pointer clear" v-for="item of topLivetime">
					<div class="table-td h-100 font-16 fl">
						<img class="userimg arc fl" :src="item.avatar" 
													:alt="item.remark || item.nickname">
						<div class="username h-100 text-hidden">{{ item.remark || item.nickname }}</div>
					</div>
					<div class="table-td h-100 font-16 text-center text-hidden fl">+{{ item.workTime }}时</div>
					<div class="table-td h-100 font-16 text-center text-hidden fl">{{ item.platname }}</div>
					<div class="table-td h-100 font-16 text-center text-hidden fl">{{ item.levename }}</div>
					<div class="table-td h-100 font-16 text-center text-hidden fl">{{ item.agentname }}</div>
				</li>
			</ul>
			<div class="table-footer">
				<co-pages :index="index"
					      :limit="limit"
					      :total="total"
					      v-on:switchPage="switchPage" />
			</div>
		</section>
    </div>
</template>


<script>
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

let InterId;

// vm对象
const vm = {
	// 组件创建完成后的钩子
    // 这里获取到页面渲染所需的数据
    created() {
    	closePgloading();
    	
    	const 
    		vm = this,
    		API_TOLIVETIME = vm.$store.state.api.todayall.topLivetime;

        vm.$http.post(API_TOLIVETIME, {
        	startTime: getCurrYMDHMS(),
        	total: vm.limit,
            page: vm.index
        }).then(({body: {data: {pageNum, data}}}) => {
        	vm.total = vm.limit * pageNum;
        	vm.topLivetime = data;
        	vm.openRefTime();
        }, ({body: {msg}}) => console.log(msg));
    },
    data: () => ({
        index: 1,	    //—— 当前的页码
    	limit: 10,	    //—— 翻页的条数
    	total: 10,      //—— 总条数
        refTime: 90,    //—— 定时刷新时长
        topLivetime: [] //—— 当前上播时长最高主播数据
    }),
    watch: {
        ['refTime'](curr) {
            const vm = this;

            // 重新启动时间倒计时器
            if (curr === 90) vm.openRefTime();

            // 异步调用新数据
            if (curr === 0) {
            	const API_TOLIVETIME = vm.$store.state.api.todayall.topLivetime;

            	vm.closeRefTime();
            	vm.index = 1;

		        vm.$http.post(API_TOLIVETIME, {
		        	startTime: getCurrYMDHMS(),
		        	total: vm.limit,
		        	page: vm.index
		        }).then(({body: {data: {pageNum, data}}}) => {
		        	vm.total = vm.limit * pageNum;
		        	vm.topLivetime = data;
		        	vm.refTime = 90
		        }, ({body: {msg}}) => console.log(msg));
            };
        }
    },
    components: { coPages },
    methods: {
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
        },
    	// 切换分页
		switchPage(index) {
	    	const 
	    		vm = this,
	    		API_TOLIVETIME = vm.$store.state.api.todayall.topLivetime;

	        // 请求数据
	        vm.$http.post(API_TOLIVETIME, {
	        	startTime: getCurrYMDHMS(),
	        	total: vm.limit,
	        	page: index
	        }).then(({body: {data: {pageNum, data}}}) => {
	        	vm.index = index;
	        	vm.topLivetime = data;
	        }, ({body: {msg}}) => console.log(msg));			
		}
    }
};


// 暴露组件配置
export default Object.assign({ name: 'p-currtlanchor' }, vm);
</script>


<style lang="less" scoped>
    #p-currtlanchor {
        /*头部样式*/
		.curr-header {
			height: 50px;
			background: #fff;
			
			.title {
				margin-left: 20px;
				line-height: 50px;
			}
			/*今日总览刷新*/
			.autoref {
				margin-top: 19px;
				margin-right: 20px;
				color: #757b81;1
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

		/*内部样式*/
		.curr-main {
			margin: 20px;
			background: #fff;
		}
		.table-tr {
			height: 78px;
			border-bottom: 1px solid #eaeaea;

			&:hover {
				transition: all .2s;
				border-bottom-color: #fff;
				box-shadow: 0 5px 5px -3px rgba(0,0,0,0.3);
			}
		}
		.table-th,
		.table-td {
			&:nth-child(1) {
				width: 36%;
			}
			&:nth-child(2) {
				width: 19%;
			}
			&:nth-child(3) {
				width: 20%;
			}
			&:nth-child(4) {
				width: 10%;
			}
			&:nth-child(5) {
				width: 15%;
			}
		}
		.table-th {
			height: 56px;
			line-height: 56px;
			border-bottom: 2px solid #eaeaea;
		}
		.table-td {
			line-height: 78px;

			img {
				width: 52px;
				height: 52px;
				color: #333c44;
				margin-top: 12px;
				margin-left: 20px;
			}
			.username {
				margin-left: 93px;
			}
			.game {
				height: 27px;
				margin-top: 11px;
				line-height: 27px;
			}
			.rmb {
				height: 25px;
				color: #aaa;
				line-height: 25px;
			}
		}
		.table-footer {
			height: 72px;
		}
    }
</style>