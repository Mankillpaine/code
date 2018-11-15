/**
 * Created by Administrator on 2016/10/31 0031.
 */
'use strict';

// 加载依赖模块
var $ = require('jquery');

// 搜索切换选择
function searchSwitch() {
    var ele = $('.public-header .ly-sel'),
        btn = ele.find('.btn-sel'),
        list = ele.find('.sel-list'),
        triangle = ele.find('.ico'),
        open = false,
        textS = ['主播', '资讯'],
        selText = '主播';

    // 获取列表内容
    function getListItem() {
        var tem = '';

        textS.forEach(function(val, key) {
            if (val !== selText) tem += '<li class="fl center">'+ val +'</li>';
        });

        return tem;
    };

    // 三角形旋转动画
    function triangleAni(open) {
        if (open) {
            triangle.css('transform', 'rotate(180deg)');
        } else {
            triangle.css('transform', 'rotate(0deg)');
        };
    };

    // 关闭列表
    function closeList() {
        list.slideUp(300);

        // 三角形动画
        triangleAni(open = false);
    };

    // 设置初始化选择内容
    btn.text(selText);

    // 绑定点击切换
    btn.add(triangle).click(function() {
        if (!open) {
            // 生成新选择节点
            list.html(getListItem());

            // 三角形动画
            triangleAni(open = true);

            // 进行列表动画
            list.slideDown(300);

            // 绑定点击选择事件
            list.find('li').off('click.public-header-sel').on('click.public-header-sel', function() {
                // 设置 按钮标签 及 选中搜索字段
                selText = $(this).text();
                btn.text(selText);

                // 关闭列表
                closeList();
            });
        } else {
            closeList();
        };
    });

/*    // 点击搜索
    $('.public-header .search .btn-search').click(function() {
        $.ajax({
            url: 'http://test.itoubu.com/app/serch_articl',
            data: {
                type: 1, // 1：资讯，2：主播
                content: '123'
            },
            callback: function(data) {
                console.log(data);
            },
            type: 'json'
        });
    });*/
};
searchSwitch();