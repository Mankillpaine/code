/**
 * Created by miaoyu on 2016/12/16 0016.
 */
<template>
    <nav id="nav" v-once>
        <h1 class="logo">
            <router-link class="db-wh-100 text-indent-hidden" to="/index">logo</router-link>
        </h1>
        <div class="ly-list" v-for="list of listS">
            <div class="list-title">{{list.listTitle}}</div>
            <ul class="list" :class="list.className">
                <router-link class="item c-pointer" 
                             v-for="item of list.childNav" :to="item.path" tag="li">
                    <span class="ico h-100 fl" :class="item.ico"></span>
                    <span class="label di h-100 fl">{{item.title}}</span>
                </router-link>
            </ul>
        </div>
    </nav>
</template>


<script>
// nav配置信息
// 直播数据分析导航
let listS = [{
    listTitle: '直播数据分析',
    className: 'live-list',
    childNav: [{
        title: '今日总览',
        path: '/admin/todayall',
        ico: 'icon-home'
    }, {
        title: '收入分析',
        path: '/admin/income',
        ico: 'icon-home'
    }, {
        title: '增粉分析',
        path: '/admin/addfans',
        ico: 'icon-home'
    }]
}];

// 考勤分析导航
listS.push({
    listTitle: '考勤分析导航',
    className: 'check-list',
    childNav: [{
        title: '直播考勤',
        path: '/page1',
        ico: 'icon-home'
    }, {
        title: '日勤奋主播',
        path: '/page2',
        ico: 'icon-home'
    }, {
        title: '未达标主播',
        path: '/page3',
        ico: 'icon-home'
    }]
});

// 主播管理导航
listS.push({
    listTitle: '主播管理',
    className: 'anchor-list',
    childNav: [{
        title: '主播管理',
        path: '/page1',
        ico: 'icon-home'
    }, {
        title: '上升最快主播',
        path: '/page2',
        ico: 'icon-home'
    }, {
        title: '低迷主播预警',
        path: '/page3',
        ico: 'icon-home'
    }]
});

// 公会设置导航
listS.push({
    listTitle: '公会设置',
    className: 'guild-list',
    childNav: [{
        title: '经纪人',
        path: '/page1',
        ico: 'icon-home'
    }, {
        title: '主播设置',
        path: '/page2',
        ico: 'icon-home'
    }, {
        title: '主播级别设置',
        path: '/page3',
        ico: 'icon-home'
    }, {
        title: '自刷账号设置',
        path: '/page3',
        ico: 'icon-home'
    }, {
        title: '修改账户密码',
        path: '/page3',
        ico: 'icon-home'
    }]
});


export default {
    name: 'nav',
    data: () => ({ listS })
};
</script>


<style lang="less" scoped>
    /*logo样式*/
    .logo {
        height: 80px;
        background: url(../images/logo.jpg) no-repeat;
        background-size: 100% 100%;
    }

    /*列表样式*/
    .ly-list {
        border-bottom: 2px solid black;
    }
    .item {
        height: 54px;
        font-size: 18px;
    }
    .ico {
        width: 90px;
        font-size: 24px;
        line-height: 54px;
    }
    .label {
        line-height: 54px;
    }
    .list-title {
        font-size: 14px;
        line-height: 30px;
        text-indent: 15px;
    }
</style>