/**
 * Created by Administrator on 2016/11/2 0002.
 */
'use strict';

// 引入依赖
var $ = require('jquery'),
    carousel = require('./../../public/plus/carousel.plus.js');

// 引入轮播插件样式
require('./../../public/css/carousel.plus.less');

// 轮播器
function carouselShow() {
    // 开启轮播
    var car = new carousel($('.carousel-main'));
};
carouselShow();