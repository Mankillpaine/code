/**
 * Created by Administrator on 2016/11/2 0002.
 */
'use strict';

// 构造Carousel函数
function Carousel(ele) {
    // 全局常量对象
    this.global = {
        translteX: 0,
        speedX: 0,
        index: 0,
        payId: null,
        timeId: null,
        minX: 0,
        maxX: 0,
        animatePay: true,
        isResAni: false
    };
    // 获取通用节点
    this.eleS = this._getAllDom(ele);
    // 设置样式
    this._setCSS();
    // 设置html
    this._setHTML();
    // 执行初始化动画
    this._performAni('left');
    // 自动播放
    this._autoPay();
};

// Carousel原型
Carousel.prototype = {
    constructor: Carousel,
    /**
     * 获取通用节点
     */
    _getAllDom: function(ele) {
        var imgList = ele.find('.img-list'),
            img = imgList.find('li'),
            arcList = ele.find('.arc-list'),
            arc = null

        return {
            ele: ele,
            imgList: imgList,
            img: img,
            arcList: arcList,
            arc: arc
        };
    },

    /**
     * 设置图片宽度
     */
    _setCSS: function() {
        // 设置图片宽度
        var imgWidth = this._setImgWidth();

        // 设置容器样式
        this._setContainerWidth(imgWidth);

        // 设置动画
        this._setAnimate();

        // 创建圆点
        this._createArc();
    },

    /**
     * 自动播放
     */
    _autoPay: function() {
        var _this = this;

        clearInterval(_this.global.payId);
        _this.global.payId = setInterval(function() {
            _this._performAni('left');
        }, 5000);
    },

    /**
     * 设置图片宽度
     */
    _setAnimate: function() {
        var speedX = this.global.speedX;

        // 配置动画
        this.eleS.imgList.css('transition', 'transform .6s');

        // 计算极限距离
        this.global.minX = 0;
        this.global.maxX = (this.eleS.img.length + 1) * -speedX;
    },

    /**
     * 执行动画
     */
    _performAni: function(align) {
        var global = this.global;

        if (global.animatePay) {
            global.animatePay = false;

            // 是否重置动画设置
            if (this.global.isResAni) {
                this.eleS.imgList.css('transition', 'transform .6s');
                this.global.isResAni = false;
            };

            // 判断动画执行方向
            if (align === 'left') {
                global.translteX -= global.speedX;
                if (global.index++ > this.eleS.img.length) global.index = 1;
            } else {
                global.translteX += global.speedX;
                if (global.index-- <= 0) global.index = this.eleS.img.lengt;
            };

            // 计算滑动距离
            this.eleS.imgList.css('transform', 'translateX('+ global.translteX +'px)');
            this.eleS.arc.css({
                background: '#fff'
            }).eq(global.index - 1).css({
                background: '#38bbff'
            });

            // 执行中间件
            this._setTimeoutUse(align);
        };
    },

    /**
     * 创建圆点
     */
    _createArc: function() {
        var tem = '';

        // 生成圆点模板
        this.eleS.img.each(function() {
            tem += '<li class="arc"></li>';
        });

        this.eleS.arcList.append(tem);
        this.eleS.arc = this.eleS.arcList.find('li');
        // this._arcHoverEvent();
    },

    /**
     * 绑定圆点触碰事件
     */
    _arcHoverEvent: function() {
        var _this = this;

        this.eleS.arc.hover(function() {
            clearInterval(_this.global.payId);

            _this.global.index = _this.eleS.arc.index(this);
            _this.global.translteX = -_this.global.speedX * (_this.global.index + 2);
            _this.eleS.imgList.css('transform', 'translateX('+ _this.global.translteX +'px)');
            _this.eleS.arc.css({
                background: '#fff'
            }).eq(_this.global.index).css({
                background: '#38bbff'
            });

            // 执行中间件
            _this._setTimeoutUse('left');
        }, function() {
            _this._autoPay();
        });
    },

    /**
     * 定时中间件
     */
    _setTimeoutUse: function(align) {
        var _this = this;

        //console.log(1);

        clearTimeout(this.global.timeId);
        this.global.timeId = setTimeout(function() {
            _this.global.animatePay = true;

            // 判断是否达到极限距离
            if (align === 'left') {
                if (_this.global.translteX <= _this.global.maxX) {
                    _this.eleS.imgList.css('transition', 'none');

                    _this.global.translteX = _this.global.minX;
                    _this._performAni('left');
                    _this.global.isResAni = true;
                };
            } else {
                if (_this.global.translteX >= _this.global.minX) {
                    _this.eleS.imgList.css('transition', 'none');

                    _this.global.translteX = _this.global.maxX;
                    _this._performAni('right');
                    _this.global.isResAni = true;
                };
            };
        }, 600);
    },

    /**
     * 设置图片宽度
     */
    _setImgWidth: function() {
        var width = this.eleS.ele.width();

        // 设置图片宽度
        this.eleS.img.width(width);
        this.global.speedX = width;

        return width;
    },

    /**
     * 设置容器宽度
     */
    _setContainerWidth: function(width) {
        this.eleS.imgList.width(width * (this.eleS.img.length + 2));
    },

    /**
     * 设置html
     */
    _setHTML: function() {
        var img = this.eleS.img,
            imgList = this.eleS.imgList,
            firDom = img.eq(img.length - 1).clone(true),
            lastDom = img.eq(0).clone(true);

        // 插入前后节点
        imgList.append(lastDom).prepend(firDom);
        this.global.index = img.length + 2;
    }
}

// 挂载Carousel模块
module.exports = Carousel;