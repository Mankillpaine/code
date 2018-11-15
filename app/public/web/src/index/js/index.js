/**
 * Created by Administrator on 2016/11/1 0001.
 */
'use strict';

// 引入依赖
var $ = require('jquery'),
    api = require('./../config/api.config.js'),
    echarts = require('echarts'),
    constant = require('./../../public/config/constant.config.js'),
    carousel = require('./../../public/plus/carousel.plus.js'),
    global = {
        // 定时跑热门主播id
        interId: null,
        // 最热主播定时跑位置
        newSpeed: 0,
        // 挂在全局渲染方法
        setMapOption: null,
        // 倒计时时间 10分钟
        countDownTime: 10 * 60 * 1000,
        // countDownTime: 100 * 60 * 1000,
        // 倒计时ID
        countDownId: null
    }, myChart;

// 引入中国地图数据
require('./china.js');
// 引入轮播插件样式
require('./../../public/css/carousel.plus.less');


// 获取最热主播列表数据
function getNewAuthor(callback) {
    $.get(constant.API_URL + api.fingAuthorlist, function(data) {
        if (data.code === '200') {
            callback(data.data);
        } else {
            console.log('网络出错！');
        };
    }, 'json');
};
// 0 - 平台id
// 1 - 主播id
// 2 - 主播名称
// 3 - 头像
// 4 - 省份id
// 5 - 当前主播在线人数
// 6 - {
//     0 - 影响力指数
//     1 - 省
//     2 - 平台
// }

// 获取省份热度数据
function getAreaNew(callback) {
    $.get(constant.API_URL + api.findHostlist, function(data) {
        // console.log(data);
        if (data.code === '200') {
            callback(data.data);
        } else {
            console.log('网络出错！');
        };
    }, 'json');
};
// function getAreaNew(callback) {
//     $.get(constant.API_URL + api.findHostlist, function(data) {
//         callback(data);
//     }, 'json');
// };

// 获取地图省份配置项
function getMapConfig() {
    return { 
        '北京市': { x: 480, y: 201 }, '天津市': { x: 490, y: 217 }, '上海市': { x: 534, y: 335 },
        '重庆市': { x: 380, y: 355 }, '河北省': { x: 464, y: 229 }, '河南省': { x: 446, y: 295 },
        '云南省': { x: 312, y: 443 }, '辽宁省': { x: 554, y: 183 }, '黑龙江省': { x: 606, y: 101 },
        '湖南省': { x: 430, y: 385 }, '安徽省': { x: 490, y: 337 }, '山东省': { x: 490, y: 255 },
        '江苏省': { x: 520, y: 311 }, '浙江省': { x: 522, y: 371 }, '海南省': { x: 406, y: 515 },
        '江西省': { x: 468, y: 391 }, '湖北省': { x: 438, y: 341 }, '广西壮族自治区': { x: 396, y: 445 },
        '甘肃省': { x: 346, y: 275 }, '山西省': { x: 436, y: 241 }, '内蒙古自治区': { x: 410, y: 187 },
        '陕西省': { x: 388, y: 295 }, '吉林省': { x: 594, y: 151 }, '福建省': { x: 496, y: 413 },
        '贵州省': { x: 376, y: 403 }, '广东省': { x: 450, y: 451 }, '青海省': { x: 268, y: 263 },
        '西藏自治区': { x: 174, y: 329 }, '四川省': { x: 328, y: 349 }, '宁夏回族自治区': { x: 362, y: 245 },
        '台湾省': { x: 534, y: 443 }, '香港特别行政区': { x: 450, y: 473 }, '南海诸岛': { x: 0, y: 0},
        '澳门特别行政区': { x: 428, y: 479 }, '新疆维吾尔自治区': { x: 148, y: 181 } 
    };
};

// 处理省份热度数据
function handleAreaData(configData, data) {
    var maxHeat = 0;

    data.forEach(function(value) {
        // 计算最大热度
        if (value[1] > maxHeat) maxHeat = value[1];

        configData[value[0]].heat = value[1] || 0;
        // console.log(configData[value[0]].heat);
    });

    return {
        areaData: configData,
        maxHeat: maxHeat
    };
};

// 设置地图省份配置项
function setMapAreaConfig(data) {
    var config = [],
        value;

    // 遍历处理数据
    for (var item in data) {
        value = data[item].heat;
        if (item === '南海诸岛') value = 0;

        config.push({
            name: item,
            value: value || 0,
            itemStyle: {
                emphasis: {
                    areaColor: '#a4e0ff'
                }
            },
            label: {
                emphasis: {
                    textStyle: {
                        color: '#fff'
                    }
                }
            }
        });
    };

    // 配置拉下配置项
    // config.push({
    //     name: '南海诸岛',
    //     value: 0,
    //     itemStyle: {
    //         normal: {
    //             opacity: 0,
    //             label: { show: false }
    //         }
    //     }
    // });

    return config;
};

// 获取渲染地图信息对象
function getMapOption(maxHeat, data) {
    return {
        title: false,
        tooltip: {
            trigger: 'item',
            formatter: '{b}{a}当前主播在线人数：{c}'
        },
        visualMap: {
            inRange: {
                color: ['#194a69','#15a6f1']
                // color: ['#1b3444','#0082c5']
            },
            min: 0,
            max: maxHeat,
            show: false,
            left: 'left',
            top: 'bottom',
            text: ['高','低'],           // 文本，默认为数值文本
            calculable: false,
            continuous: false,
        },
        series: [{
            type: 'map',
            map: 'china',
            zoom: 1.25,
            data: data,
        }]
    };
};

// 获取省份数据主播列表数据
function getAreaAndAuthorData(callback) {
    var areaData;

    // 抓到省份数据
    getAreaNew(function(data) {
        areaData = data;

        // 抓到主播列表数据
        getNewAuthor(function(data) {
            callback(areaData, data);
        });
    });
};

// 热门主播定时跑
function newAuthorInter(mapConfig, authorlistData, callback) {
    var index = global.newSpeed,
        _callback = callback || function() {};

    // 开启弹出框
    opNewAuthorAlert(mapConfig, authorlistData[index], function() {
        _callback(authorlistData[index]);
    });

    // 步伐加1
    global.newSpeed++;
};

// 开启最热主播弹出框
function opNewAuthorAlert(mapConfig, authorData, callback) {
    var newUserEle = $('.index-show .map-user'),
        defaultUserEle = newUserEle.find('.user-default'),
        hoverUserEle = newUserEle.find('.user-hover'),
        area = authorData[6][1],

        // 设置默认展示框位置
        setDefaultXY_show = function(callback) {
            // 设置文本信息
            defaultUserEle.find('p').text(authorData[5] +'人在线');
            defaultUserEle.find('img').attr({
                src: authorData[3],
                alt: authorData[2]
            });

            // 设置样式
            defaultUserEle.show(0, function(){
                newUserEle.css({
                    top: mapConfig[area].y - defaultUserEle.height() - 20,
                    left: mapConfig[area].x - defaultUserEle.width() / 2
                });
                defaultUserEle.css('opacity', 1);

                callback();
            });
        },

        // 设置详细展示框位置
        setHoverXY_show = function(callback) {
            // 设置文本信息
            hoverUserEle.find('img').attr({
                src: authorData[3],
                alt: authorData[2]
            });
            /* 1-映客，2-抱抱，3-花椒直播，4-熊猫直播，5-全民直播，6-陌陌直播，7-一直播，8-关拍 */
            hoverUserEle.attr('href', '/app/zbdetail?id='+ authorData[0] +'&platformid='+ authorData[1]);
            hoverUserEle.find('.name').text(authorData[2]);
            hoverUserEle.find('.platform').text(authorData[6][2]);
            hoverUserEle.find('.influence-index .color').text(authorData[6][0]);
            hoverUserEle.find('.people-size .color').text(authorData[5] +'人在线');

            // 设置样式
            hoverUserEle.show(0, function() {
                newUserEle.css({
                    top: mapConfig[area].y - hoverUserEle.height() - 24,
                    left: mapConfig[area].x - hoverUserEle.width() / 2
                })
                hoverUserEle.css('opacity', 1);

                callback();
            });
        };

    // console.log(authorData);
    // console.log(area);
    // 

    // 显示默认展示框
    setDefaultXY_show(function() {
        // 隐藏详细展示框
        hoverUserEle.css({
            display: 'none',
            opacity: 0
        });

        // 绑定切换详细弹窗
        defaultUserEle.find('img').off('mouseover.index-show-map-mouseoverSwitch').on('mouseover.index-show-map-mouseoverSwitch', function() {
            // 隐形默认展示框
            defaultUserEle.css({
                display: 'none',
                opacity: 0
            });

            // 显示详细展示框
            setHoverXY_show(function() {
                // 绑定点击隐藏
                hoverUserEle.off('mouseout.index-show-map-mouseoutSwitch1').on('mouseout.index-show-map-mouseoutSwitch1', function(e) {
                    if (e.target === hoverUserEle.get(0)) {
                        // 隐藏详细展示框
                        hoverUserEle.css({
                            display: 'none',
                            opacity: 0
                        });

                        // 显示默认展示框
                        setDefaultXY_show(function(){});
                    };
                });                
            });
        });

        // // 绑定切换详细弹窗
        // defaultUserEle.find('img').off('click.index-show-map-clickSwitch').on('click.index-show-map-clickSwitch', function() {
        //     // 隐形默认展示框
        //     defaultUserEle.css({
        //         display: 'none',
        //         opacity: 0
        //     });

        //     // 显示详细展示框
        //     setHoverXY_show(function() {
        //         // 绑定点击隐藏
        //         hoverUserEle.find('img').off('click.index-show-map-clickSwitch1').on('click.index-show-map-clickSwitch1', function() {
        //             // 隐藏详细展示框
        //             hoverUserEle.css({
        //                 display: 'none',
        //                 opacity: 0
        //             });

        //             // 显示默认展示框
        //             setDefaultXY_show(function(){});
        //         });
        //     });
        // });

        // 执行回调
        callback();
    });
};

// 初始化地图
function initMap(maxHeat, data) {
    var ele = $('.index-show .map-main'),
        option = getMapOption(maxHeat, data);

    // 挂在全局渲染方法
    myChart = echarts.init(ele.get(0));

    // 初始渲染
    myChart.setOption(option);
};

// 初始渲染并且定时渲染
function initAndInterExport(mapConfig, authorlistData) {
    // 开启最热主播弹出框
    newAuthorInter(mapConfig, authorlistData, function() {
        var interTime = Math.ceil(global.countDownTime / authorlistData.length + 1);

        // 热门主播定时跑
        global.interId = setInterval(function() {
            newAuthorInter(mapConfig, authorlistData, function() {});
        }, interTime);
    });
};

// 开启倒计时
function openCountDown() {
    clearTimeout(global.countDownId);
    global.countDownId = setTimeout(function() {
        // 取消上次定时事件
        clearInterval(global.interId);
        global.newSpeed = 0;

        // 从新请求省份数据
        getAreaAndAuthorData(function(areaData, authorlistData) {
            var mapConfig = getMapConfig(),
                heatConfig = handleAreaData(mapConfig, areaData),
                option = getMapOption(heatConfig.maxHeat, setMapAreaConfig(heatConfig.areaData));

            // 重新渲染地图
            myChart.setOption(option);

            // 初始渲染并且定时渲染
            initAndInterExport(mapConfig, authorlistData);

            // 开启倒计请求数据刷新
            openCountDown();
        });
    }, global.countDownTime);
};

// 初始化主播数据
function initExport() {
    // 拿到数据渲染热度地图
    getAreaAndAuthorData(function(areaData, authorlistData) {
        var mapConfig = getMapConfig(),
            heatConfig = handleAreaData(mapConfig, areaData);

        // 初始化地图
        initMap(heatConfig.maxHeat, setMapAreaConfig(heatConfig.areaData));

        // 初始渲染并且定时渲染
        initAndInterExport(mapConfig, authorlistData);

        // 开启倒计请求数据刷新
        openCountDown();
    });
};

// 轮播器
function carouselShow() {
    // 开启轮播
    var car = new carousel($('.carousel-main'));
};
// 开启轮播
carouselShow();

// 延迟加载初始化地图数据
setTimeout(function() {
    // 初始地图展现主播数据
    initExport();
}, 1000);