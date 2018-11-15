/**
 * Created by miaoyu on 2016/12/16 0016.
 */
<template>
    <div id="p-ahrecord">
		<div class="live-img" v-eline="'live'"></div>
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

// echarts插件具体配置
let echart = {
        // 直播记录折线数据
        live: {
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
            API_LIVELOG = vm.$store.state.api.anchor.livelog; 


        // 请求主播详情数据
        vm.$http.post(API_LIVELOG, {
        	platformid,
        	platform,
        	startTime: '20170117'
        	// startTime: getCurrYMDHMS()
        }).then(({body}) => {
        	let data = JSON.parse(body.data),
        		xAxisData = [],
        		followerData = [],
        		incomeData = [],
        		onlineData = [];

        	console.log(data);

        	data.forEach(({follower, income, itime, online, recommend}) => {
        		xAxisData.push(itime);
        		incomeData.push(income);
        	});


            echart.live.options = Object.assign({}, {
				tooltip: { trigger: 'axis' },
				grid: {
			        left: '36px',
			        right: '56px',
			        bottom: '20px',
			        containLabel: true
			    },
			    backgroundColor: '#fff',
	            xAxis: {
		        	axisLabel: { interval: 5 },
		        	splitLine: { show: true },
		        	boundaryGap: false,
		            data: xAxisData

		        },
	            yAxis: {
	            	min: 0,
	            	// max: yAxisMax
	            	max: 2000
	            },
	            series: [{
	            	name: '收入记录(元)',
	            	type: 'bar',
	            	smooth: true,
	            	itemStyle: { normal: { color: '#ffcb34'} },
	            	lineStyle: { normal: { color: '#ffcb34'} },
	            	areaStyle: { normal: { color: '#fad771'} },
	            	// data: incomeData,
	            	data: [1, 33, 5555, 100, 200, 555, 666, 777, 1000, 222 , 333, 13]
	            }]
            }); 
            echart.live.sref.setOption(echart.live.options);	
        }, ({body: {msg}}) => console.log(msg)); 
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
export default Object.assign({ name: 'p-ahrecord' }, vm);
</script>


<style lang="less" scoped>
    #p-ahrecord {
		.live-img {
			height: 300px;
		}
    }
</style>