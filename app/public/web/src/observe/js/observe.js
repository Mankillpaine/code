/**
 * Created by Administrator on 2016/11/2 0002.
 */
'use strict';

var $ = require('jquery'),
    api = require('./../config/api.config.js'),
    constant = require('./../../public/config/constant.config.js'),
    carousel = require('./../../public/plus/carousel.plus.js'),
    global = {
        // 请求参数
        // 最新咨询-0，红咖-10，行业资讯-5，头部热榜-9
        getPar: {
            '最新资讯': {
                limit: 10,
                term: 0
            },
            '红咖': {
                limit: 10,
                term: 10
            },
            '行业资讯': {
                limit: 10,
                term: 5
            }
        }, 
        // 当前选中
        curSel: '最新资讯',
        // 分页累加值
        limitSpeed: 20,
        // 插入数据节点
        listDom: $('.observe-main-left .list-main').eq(0)
    };

// 引入轮播插件样式
require('./../../public/css/carousel.plus.less');

// 新闻列表切换
function newListSwitch() {
    var ele = $('.observe-main-left'),
        tab = ele.find('.list-head li'),
        list = ele.find('.list-main'),
        index = 0;

    // 绑定点击切换事件
    tab.click(function() {
        index = tab.index(this);

        if (index === 0 ) { // 最新咨询
            global.curSel = '最新资讯';
        } else if (index === 1) { // 红咖
            global.curSel = '红咖';
        } else { // 行业资讯
            global.curSel = '行业资讯';
        };
        global.listDom = list.eq(index);
        
        // 点击特效
        tab.removeClass('sel').eq(index).addClass('sel');
        list.hide().eq(index).fadeIn();
    });

};
newListSwitch();

// 请求列表数据
// function getListData(callback) {
//     $.get(constant.API_URL + api.fingPageList, {
//         term: global.term,
//         limit: global.limit
//     }, function(data) {
//         console.log(data);
//         if (data.code === '200') {
//             callback(data.data);
//         } else {
//             console.log('网络出错！');
//         };
//     }, 'json');
// };
function getListData(callback) {
    $.get(constant.API_URL + api.fingPageList, {
        term: global.getPar[global.curSel].term,
        limit: global.getPar[global.curSel].limit
    }, function(data) {
        callback(data);
    }, 'json');
};

// 新闻列表加载更多
function newListAddMore() {
    $('.observe-main-left .btn-more').click(function() {
        var _this = this;

        // 添加请求limit
        global.getPar[global.curSel].limit += global.limitSpeed;

        // 请求数据
        getListData(function(data) {
            // 没有了隐藏按钮
            // if (data.length === 0) $(_this).hide();

            var tem = '',
                imgSrc;

            data.forEach(function(val) {
                imgSrc = val.thumb || '/app/public/web/static/images/newslist.png';

                tem += '<li>\
                            <a class="img fl" href="/app/articl_detail?id='+ val.ID +'">\
                                <img class="wh-100" src="'+ imgSrc +'" alt="'+ val.post_title +'">\
                            </a>\
                            <a class="title fl text-over-hidden" href="/app/articl_detail?id='+ val.ID +'">'+ val.post_title +'</a>\
                            <a class="content hd fl" href="/app/articl_detail?id='+ val.ID +'">'+ val.post_content +'</a>\
                            <span class="author fl">作者:'+ val.display_name +'</span>\
                            <time class="fr right">'+ val.post_modified.substring(0, 10) +'</time>\
                        </li>';        
            });

            // 添加到节点
            global.listDom.append(tem);
        });
    });
};
newListAddMore();

// 轮播器
function carouselShow() {
    // 开启轮播
    var car = new carousel($('.carousel-main'));
};
carouselShow();

// 热门绑定切换
function weekMonthSwitch() {
    var ele = $('.observe-main-right .new-list'),
        tab = ele.find('.list-head b'),
        list = ele.find('.list-main'),
        index = 0;

    // 绑定点击切换事件
    tab.click(function() {
    	index = tab.index(this);
    	
    	// 点击特效
    	tab.removeClass('sel').eq(index).addClass('sel');
    	list.hide().eq(index).fadeIn();
    });
};
weekMonthSwitch();