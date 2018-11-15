/**
 * Created by miaoyu on 2016/12/16 0016.
 */
<template>
    <nav id="t-nav" v-once>
        <div class="ly-list live-list">
            <div class="list-title font-16">直播数据分析</div>
            <ul class="list">
                <router-link class="item c-pointer text-none-sel" active-class="item-sel" to="/admin/todayall" tag="li">
                    <span class="ico icon-home h-100 fl"></span>
                    <span class="label di h-100 font-16 fl">今日总览</span>
                </router-link>
                <router-link class="item c-pointer text-none-sel" active-class="item-sel" to="/admin/income" tag="li">
                    <span class="ico icon-income h-100 fl"></span>
                    <span class="label di h-100 font-16 fl">收入分析</span>
                </router-link>
                <router-link class="item c-pointer text-none-sel" active-class="item-sel" to="/admin/addfans" tag="li">
                    <span class="ico icon-fans h-100 fl"></span>
                    <span class="label di h-100 font-16 fl">增粉分析</span>
                </router-link>
            </ul>
        </div>
        <div class="ly-list check-list">
            <div class="list-title font-16">考勤分析导航</div>
            <ul class="list">
                <router-link class="item c-pointer rel text-none-sel" active-class="item-sel" to="/admin/ckday" tag="li">
                    <span class="ico icon-day h-100 fl"></span>
                    <span class="label di h-100 font-16 fl">日考勤报表</span>
                    <span class="ico-label abs font-14 color-white">92%达标</span>
                </router-link>
                <router-link class="item c-pointer text-none-sel" active-class="item-sel" to="/admin/ckmonth" tag="li">
                    <span class="ico icon-month h-100 fl"></span>
                    <span class="label di h-100 font-16 fl">月考勤报表</span>
                </router-link>
            </ul>
        </div>
        <div class="ly-list anchor-list">
            <div class="list-title font-16">主播管理</div>
            <ul class="list">
                <router-link class="item c-pointer text-none-sel" active-class="item-sel" to="/admin/ahmanage" tag="li">
                    <span class="ico icon-collection h-100 fl"></span>
                    <span class="label di h-100 font-16 fl">主播管理</span>
                </router-link>
            </ul>
        </div>
        <div class="ly-list guild-list">
            <div class="list-title font-16">公会设置</div>
            <ul class="list">
                <router-link class="item c-pointer text-none-sel" active-class="item-sel" to="/admin/agentset" tag="li">
                    <span class="ico icon-home h-100 fl"></span>
                    <span class="label di h-100 font-16 fl">经纪人设置</span>
                </router-link>
                <router-link class="item c-pointer text-none-sel" active-class="item-sel" to="/admin/anchorset" tag="li">
                    <span class="ico icon-home h-100 fl"></span>
                    <span class="label di h-100 font-16 fl">主播设置</span>
                </router-link>
                <router-link class="item c-pointer text-none-sel" active-class="item-sel" to="/admin/levelset" tag="li">
                    <span class="ico icon-home h-100 fl"></span>
                    <span class="label di h-100 font-16 fl">主播级别设置</span>
                </router-link>
                <router-link class="item c-pointer text-none-sel" active-class="item-sel" to="/admin/brushset" tag="li">
                    <span class="ico icon-home h-100 fl"></span>
                    <span class="label di h-100 font-16 fl">自刷账号设置</span>
                </router-link>
                <router-link class="item c-pointer text-none-sel" active-class="item-sel" to="/admin/updatepass" tag="li">
                    <span class="ico icon-home h-100 fl"></span>
                    <span class="label di h-100 font-16 fl">修改账户密码</span>
                </router-link>
            </ul>
        </div>
    </nav>
</template>


<script>
export default {
    name: 't-nav'
};
</script>


<style lang="less" scoped>
    #t-nav {
        /*列表样式*/
        .ly-list {
            background: #333c44;
            border-bottom: 1px solid #2b333a;
        }
        .list-title {
            height: 60px;
            color: #6e747a;
            line-height: 60px;
            text-indent: 11px;
        }


        /*导航块*/
        .item {
            height: 56px;
        }
        .ico {
            width: 54px;
            margin-left: 5px;
            color: #a1a1a1;
            font-size: 20px;
            line-height: 56px;
        }
        .ico-label {
            right: 20px;
            top: 18px;
            padding: 0 10px;
            line-height: 20px;
            background: #05bcd4;
            border-radius: 6px;
        }
        .ico-label-pople {
            background: #ffa922;
        }
        .label {
            color: #a1a1a1;
            line-height: 56px;
        }
        .item.item-sel {
            position: relative;
            background: #505c68;

            // 装饰线
            &:after {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                width: 3px;
                height: 100%;
                background: #05bcd4;
            }

            .ico ,
            .label {
                color: #fff;
            }
        }    
    }
</style>