/**
 * Created by Administrator on 2016/11/2 0002.
 */
'use strict';

var $ = require('jquery'),
    api = require('./../config/api.config.js'),
	echarts = require('echarts'),
    constant = require('./../../public/config/constant.config.js'),
    global = {
        // 选择开始日期
        starttime: getStartTime(new Date()),
        // 选择结束日期
        endtime: formatTime(new Date()),
        // 数据表默认配置
        imgOption: getImgOption()
    }, myChart;

// 引入时间插件样式
window.jQuery = $;
window.$ = $;
require('./../../public/plus/seldate/css/lyz.calendar.less');
require('./../../public/plus/seldate/js/lyz.calendar.min.js');

// 获取开始时间
function getStartTime(time) {
    var times;

    // 计算相隔12天数
    times = Date.parse(time) -  2 * 7 * 24 * 60 * 60 * 1000;

    // 返回开始时间
    return formatTime(new Date(times));
};

// 获取格式日期时间
function formatTime(times) {
    var str = '';

    str += times.getFullYear(times) +'-';
    str += times.getMonth(times) + 1 +'-';
    str += times.getDate(times) - 1;

    return str;
};

// 选择时间插件
function selDate() {
    var strEle = $(".start-time"),
        strContentEle = strEle.find('.time-content'),
        endEle = $(".end-time"),
        endContentEle = endEle.find('.time-content');

    // 设置默认时间
    strContentEle.text(global.starttime);
    endContentEle.text(global.endtime);

    // 开始日期
    strEle.calendar({
        controlId: "start-time-sel",                          // 弹出的日期控件ID，默认: $(this).attr("id") + "Calendar"
        speed: 200,                                           // 三种预定速度之一的字符串("slow", "normal", or "fast")或表示动画时长的毫秒数值(如：1000),默认：200
        complement: true,                                     // 是否显示日期或年空白处的前后月的补充,默认：true
        readonly: true,                                       // 目标对象是否设为只读，默认：true
        upperLimit: new Date(Date.parse(new Date()) - 24 * 60 * 60 * 1000),                               // 日期上限，默认：NaN(不限制)
        lowerLimit: new Date("2011/01/01"),                   // 日期下限，默认：NaN(不限制)
        callback: function (data) {                           // 点击选择日期后的回调函数
            strContentEle.text(data);
            global.starttime = data;
        }
    });
    // 结束日期
    endEle.calendar({
        controlId: "end-time-sel",
        speed: 200,                                           // 三种预定速度之一的字符串("slow", "normal", or "fast")或表示动画时长的毫秒数值(如：1000),默认：200
        complement: true,                                     // 是否显示日期或年空白处的前后月的补充,默认：true
        readonly: true,                                       // 目标对象是否设为只读，默认：true
        upperLimit: new Date(),                               // 日期上限，默认：NaN(不限制)
        lowerLimit: new Date("2011/01/01"), 
        callback: function(data) {
            endContentEle.text(data);
            global.endtime = data;
        }
    });
};
selDate();

// 请求指数数据
// function getIndexData() {
//     $.get(constant.API_URL + api.fingPlatmba, {
//         starttime: global.starttime,
//         endtime: global.endtime
//     }, function(data) {
//         if (data.code === '200') {
//             callback(data.data);
//         } else {
//             console.log('网络出错！');
//         };
//     }, 'json');
// };
function getIndexData(callback) {
    $.get(constant.API_URL + api.fingPlatmba, {
        starttime: global.starttime,
        endtime: global.endtime
    }, function(data) {
        callback(data);
    }, 'json');
};

// 获取时间相隔12天时间数组
function get12TimeS() {
    var curTime = Date.parse(new Date()),
        day = 24 * 60 * 60 * 1000,
        timeS = [];

    for (var n = 0; n < 15; n++) {
        timeS.unshift(formatTime(new Date(curTime - n * day)));
    };

    return timeS;
};

// 获取平台数据option
function getImgOption() {
    return {
        // 是否显示表格标题
        title: false,
        // 图表缩放
        grid: {
            top: '26px',
            left: '46px',
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
            boundaryGap: false,
            data: null
        },
        // Y轴数据
        yAxis: {
            type: 'value'
        },
        series: [{
            name:'直播行业指数',
            type:'line',
            stack: false,
            itemStyle: {normal: {color: '#0f70d6'}},
            lineStyle: {normal: {color: '#0f70d6'}},
            areaStyle: {normal: {color: 'transparent'}},
            data: null
        }]
    };
};

// 处理请求回来的数据结构
function handleGetDate(data) {
    var timeObj = {},
        xDate = [], reS = [];
    
    // 遍历添加数据到制定对象
    data.forEach(function(val) {
        if (!timeObj[val.idate]) timeObj[val.idate] = [];

        timeObj[val.idate] = val.index;
    });

    // 遍历出返回数据
    for (var item in timeObj) {
        xDate.push(item);

        reS.push(timeObj[item]);
    };

    return {
        xDate: xDate,
        serDate: reS
    };
};

// 初始化表数据
function initImgDate() {
    var ele = $('.anchorcomindex-main-right .table-tbody');

    // 初始获取数据 渲染图表
    getIndexData(function(data) {
        var dataS = handleGetDate(data);

        // 配置项
        global.imgOption.xAxis.data = dataS.xDate;
        global.imgOption.series[0].data = dataS.serDate;

        // 初始化数据
        myChart = echarts.init(ele.get(0));

        // 渲染数据
        myChart.setOption(global.imgOption);
    });
};
initImgDate();

// 绑定按钮查询
function btnFindEvent() {
    var ele = $('.anchorcomindex-main-right .btn-search');

    ele.click(function() {
        // 初始获取数据 渲染图表
        getIndexData(function(data) {
            var dataS = handleGetDate(data);

            // 配置项
            global.imgOption.xAxis.data = dataS.xDate;
            global.imgOption.series[0].data = dataS.serDate;

            // 渲染数据
            myChart.setOption(global.imgOption);
        });        
    });
};
btnFindEvent();