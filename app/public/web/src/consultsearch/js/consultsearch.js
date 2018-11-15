/**
 * Created by Administrator on 2016/11/2 0002.
 */
'use strict';

var $ = require('jquery');
    // api = require('./../config/api.config.js'),
    // constant = require('./../../public/config/constant.config.js');

// 切换列表
function listSwitch() {
    var ele = $('.new-list'),
        btn = ele.find('.list-head b'),
        list = ele.find('.list-main');

    btn.click(function() {
        var index = btn.index(this);

        btn.removeClass('sel').eq(index).addClass('sel');
        list.hide().eq(index).show();
    });
};
listSwitch();