/**
 * Created by Administrator on 2016/11/2 0002.
 */
'use strict';

var $ = require('jquery'),
    api = require('./../config/api.config.js'),
    constant = require('./../../public/config/constant.config.js'),
	echarts = require('echarts'),
    urlPar = getUrlPar(),
    global = {
        platform: urlPar.id,
        platformid: urlPar.platformid,
        switchIndex: 0,
        option: imgDefConfig()
    }, 
    myChart;

// 获取url参数
function getUrlPar() {
    var str = location.search.substring(1),
        parS = {},
        strS;
    
    strS = str.split('&');

    strS.forEach(function(val) {
        str = val.split('=');

        parS[str[0]] = str[1];
    });

    return parS;
};

// 获取收入记录
function getDayIncome(callback) {
    $.get(constant.API_URL + api.findZbincome, {
        platform: global.platform,
        platformid: global.platformid
    }, function(data) {
        callback(data);
    }, 'json');
};

// 图表默认配置项
function imgDefConfig() {
    return {
        // 是否显示表格标题
        title: false,
        // 图表缩放
        grid: {
            top: '26px',
            left: '86px',
            right: '46px',
            bottom: '36px',
        },
        // 鼠标触碰悬浮提示框
        tooltip: {
            trigger: 'axis'
        },
        // X轴数据
        xAxis: {
            type: 'category',
            boundaryGap : false,
            data: null
        },
        // Y轴数据
        yAxis: {
            type : 'value'
        },
        series : [{
            name: null,
            type:'line',
            stack: false,
            smooth: true,
            itemStyle: {normal: {color: '#ff617f'}},
            lineStyle: {normal: {color: '#ff617f'}},
            areaStyle: {normal: {color: 'transparent'}},
            data: null
        }]
    };
};

// 返回处理数据后的数据格式
function reHandleData(data) {
    var parObj = {},
        xData = [],
        dataS = [];

    data.forEach(function(val) {
        if (!parObj[val.idate]) parObj[val.idate] = {};

        parObj[val.idate].increase_rmb = val.increase_rmb;
    });

    for (var item in parObj) {
        xData.push(item);
        dataS.push(parObj[item].increase_rmb);
    };

    return {
        xData: xData,
        dataS: dataS
    };
};

// 返回处理数据后的粉丝数据格式
function reHandleFansData(data) {
    var parObj = {},
        xData = [],
        dataS = [];

    data.forEach(function(val) {
        if (!parObj[val.idate]) parObj[val.idate] = {};

        parObj[val.idate].increase_follower = val.increase_follower;
    });

    for (var item in parObj) {
        xData.push(item);
        dataS.push(parObj[item].increase_follower);
    };

    return {
        xData: xData,
        dataS: dataS
    };
};

// 渲染日收入记录表
function drawIncomeImg() {
    getDayIncome(function(data) {
        var option = global.option,
            getHandData = reHandleData(data);
        
        option.tooltip.formatter = '{b}<br>日收入记录：{c}';
        option.xAxis.data = getHandData.xData;
        option.series[0].name = '日收入记录';
        option.series[0].data = getHandData.dataS;

        // 渲染表
        myChart.setOption(option);
    });
};

// 获取增粉记录
function getDayFans(callback) {
    $.get(constant.API_URL + api.findZbfan, {
        platform: global.platform,
        platformid: global.platformid
    }, function(data) {
        callback(data);
    }, 'json');
};

// 渲染日增粉记录
function drawAddFans() {
    getDayFans(function(data) {
        var option = global.option,
            getHandData = reHandleFansData(data);

        option.xAxis.data = getHandData.xData;
        option.tooltip.formatter = '{b}<br>日增粉记录：{c}';
        option.series[0].name = '日增粉记录';
        option.series[0].data = getHandData.dataS;

        // 渲染表
        setTimeout(function() {
            myChart.setOption(option);
        }, 50);
    });
};

// 初始化表
function initDrawImg() {
    var ele = $('.anchordet-main-left .table-tbody');

    // 初始化图标控件
    myChart = echarts.init(ele.get(0));

    // 第一次画表
    drawIncomeImg();
};
initDrawImg();

// 切换表格
function tabSwitch() {
    var ele = $('.anchordet-main-left .table .table-head'),
        btn = ele.find('li'),
        index;

    // 绑定切换事件
    btn.click(function() {
        index = btn.index(this);
        global.switchIndex = index;
 
        if (index === 0) { // 日收入记录
            drawIncomeImg();
        } else { // 日增粉记录
            drawAddFans();
        };

        // 修改样式
        btn.removeClass('sel').eq(index).addClass('sel');
    });
};
tabSwitch();

// // 直播平台活跃指数图表
// function anchordetCanvas() {
// 	var ele = $('.anchordet-main-left .table-tbody'),
// 		myChart, option;

// 	// 初始化图标控件
//     myChart = echarts.init(ele.get(0));

//     // 初始化图表配置
//     option = {
//     	// 是否显示表格标题
//     	title: false,
//     	// 图表缩放
//     	grid: {
// 			top: '26px',
// 			left: '46px',
// 			right: '46px',
// 			bottom: '36px',
//     	},
//     	// 鼠标触碰悬浮提示框
//         tooltip : {
// 	        trigger: 'axis'
// 	    },
// 	    // X轴数据
// 	    xAxis: {
//             type : 'category',
//             boundaryGap : false,
//             data : ['2016-10-01', '2016-10-02', '2016-10-03', '2016-10-04', '2016-10-05', '2016-10-06', '2016-10-07']
//         },
//         // Y轴数据
//         yAxis: {
//             type : 'value'
//         },
//         series : [{
//             name:'日收入记录',
//             type:'line',
//             stack: false,
//             smooth: true,
//             itemStyle: {normal: {color: '#ff617f'}},
//             lineStyle: {normal: {color: '#ff617f'}},
//             areaStyle: {normal: {color: 'transparent'}},
//             data:[0, 132, 101, 134, 90, 230, 220]
// 	    }]
//     };

//     // 初始图表数据
//     myChart.setOption(option);
// };
// // anchordetCanvas();