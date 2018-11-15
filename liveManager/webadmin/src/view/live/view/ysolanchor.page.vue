/**
 * Created by miaoyu on 2016/12/16 0016.
 */
<template>
    <div id="p-ysolanchor">
        <header class="ys-header">
            <span class="title h-100 font-18 font-bold fl">昨日在线最高主播</span>
            <div class="seldate font-14 fr">
                <co-seldate class="sel-input"
                            :options="dateCF"
                            :placeholder="currDate"
                            @updateDate="updateDate" />
            </div>
        </header>
        <section class="ys-main">
            <div class="table-thead clear">
                <div class="table-th font-16 font-bold text-center fl">主播</div>
                <div class="table-th font-16 font-bold text-center fl">昨日在线人数</div>
                <div class="table-th font-16 font-bold text-center fl">昨日在线时长</div>
                <div class="table-th font-16 font-bold text-center fl">昨日收入</div>
                <div class="table-th font-16 font-bold text-center fl">热门榜</div>
                <div class="table-th font-16 font-bold text-center fl">等级</div>
                <div class="table-th font-16 font-bold text-center fl">经纪人</div>
            </div>
            <ul class="table-tbody">
                <li class="table-tr c-pointer clear" v-for="item of ysTopOnline">
                    <div class="table-td h-100 font-16 fl">
                        <img class="userimg arc fl" :src="item.avatar" 
                                                    :alt="item.remark || item.nickname">
                        <div class="username text-hidden">{{ item.remark || item.nickname }}</div>
                        <div class="platform text-hidden">{{ item.platname }}</div>
                    </div>
                    <div class="table-td h-100 font-16 text-center text-hidden fl">{{ item.online }}人</div>
                    <div class="table-td h-100 font-16 text-center text-hidden fl">{{ item.workTime }}分钟</div>
                    <div class="table-td h-100 font-16 text-center fl">
                        <div class="game text-hidden">{{ item.income }}花椒币</div>
                        <div class="rmb text-hidden">{{ item.rmb }}人民币</div>
                    </div>
                    <div class="table-td h-100 font-16 text-center text-hidden fl">{{ item.recommend || '-' }}</div>
                    <div class="table-td h-100 font-16 text-center text-hidden fl">{{ item.levelname }}</div>
                    <div class="table-td h-100 font-16 text-center text-hidden fl">{{ item.agentname }}</div>
                </li>
            </ul>
            <div class="table-footer">
                <co-pages :index="index"
                          :limit="limit"
                          :total="total"
                          v-on:switchPage="switchPage" />
            </div>
        </section>
    </div>
</template>


<script>
import coPages from './../../../components/pages.vue';
import coSeldate from './../../../components/seldate.vue';
import { closePgloading } from './../../../service/pageloading.service.js';


// 获取昨天的日期：年-月-日
function getYsTime() {
    const 
        ysD = new Date(Date.parse(new Date()) - 1000 * 60 * 60 * 24),
        patt = /^([0-9]+)-([0-9]+)-([0-9]+)$/;

    let year = ysD.getFullYear(),
        month = ysD.getMonth() + 1,
        day = ysD.getDate();

    // 位数不够自动补0
    if (String(month).length === 1) month = `0${month}`;
    if (String(day).length === 1) day = `0${day}`;

    return `${year}-${month}-${day}`;
};


// vm对象
const vm = {
    // 组件创建完成后的钩子
    // 这里获取到页面渲染所需的数据
    created() {
        closePgloading();
        
        const 
            vm = this,
            API_TOPONLINE = vm.$store.state.api.todayall.topOnline;

        vm.$http.post(API_TOPONLINE, {
            startTime: getYsTime(),
            total: vm.limit,
            page: vm.index
        }).then(({body: {data: {pageNum, data}}}) => {
            vm.total = vm.limit * pageNum;
            vm.ysTopOnline = data;
        }, ({body: {msg}}) => console.log(msg));
    },
    // 可监听变化数据
    data: () => ({
        dateCF: {                 // 时间组件配置
            mode: 'single',       //—— 选择的模式
            maxDate: getYsTime(), //—— 最大可选择时间
        },      
        currDate: getYsTime(), // 时间组件当前选择的时间
        index: 1,     //—— 当前的页码
        limit: 10,    //—— 翻页的条数
        total: 10,    //—— 总条数
        ysTopOnline: [] //—— 当前在线主播数据
    }),
    components: { coPages, coSeldate },
    methods: {
        // 修改日期
        updateDate(dateStr) {
            // 当前选择的时间 和 日期控件选择的时间不一致才会执行
            if (dateStr !== this.currDate) {
                const 
                    vm = this,
                    API_TOPONLINE = vm.$store.state.api.todayall.topOnline;

                // 修改当前选择时间
                this.currDate = dateStr;

                // 发起请求
                vm.$http.post(API_TOPONLINE, {
                    startTime: dateStr,
                    total: vm.limit,
                    page: 1
                }).then(({body: {data: {pageNum, data}}}) => {
                    vm.index = 1;
                    vm.total = vm.limit * pageNum;
                    vm.ysTopOnline = data;
                }, ({body: {msg}}) => console.log(msg));                
            };
        },
        // 切换分页
        switchPage(index) {
            const 
                vm = this,
                API_TOPONLINE = vm.$store.state.api.todayall.topOnline;

            // 请求数据
            vm.$http.post(API_TOPONLINE, {
                startTime: getYsTime(),
                total: vm.limit,
                page: index
            }).then(({body: {data: {pageNum, data}}}) => {
                vm.index = index;
                vm.ysTopOnline = data;
            }, ({body: {msg}}) => console.log(msg));            
        }
    }
};


// 暴露组件配置
export default Object.assign({ name: 'p-ysolanchor' }, vm);
</script>


<style lang="less" scoped>
    #p-ysolanchor {
        /*头部样式*/
        .ys-header {
            height: 50px;
            background: #fff;
            
            .title {
                margin-left: 20px;
                line-height: 50px;
            }
            .seldate {
                width: 118px;
                height: 28px;
                margin-top: 11px;
                margin-right: 20px;
                background: #f7f7f7;
                border-radius: 18px;
            }
            .sel-input {
                width: 100%;
                height: 14px;
                padding: 7px 0;
                color: #05bcd4;
                background: transparent;
            }
        }

        /*内部样式*/
        .ys-main {
            margin: 20px;
            background: #fff;
        }
        .table-tr {
            height: 78px;
            border-bottom: 1px solid #eaeaea;

            &:hover {
                transition: all .2s;
                border-bottom-color: #fff;
                box-shadow: 0 5px 5px -3px rgba(0,0,0,0.3);
            }
        }
        .table-th,
        .table-td {
            &:nth-child(1) {
                width: 28%;
            }
            &:nth-child(2) {
                width: 16%;
            }
            &:nth-child(3) {
                width: 14%;
            }
            &:nth-child(4) {
                width: 16%;
            }
            &:nth-child(5) {
                width: 10%;
            }
            &:nth-child(6) {
                width: 6%;
            }
            &:nth-child(7) {
                width: 10%;
            }
        }
        .table-th {
            height: 56px;
            line-height: 56px;
            border-bottom: 2px solid #eaeaea;
        }
        .table-td {
            line-height: 78px;

            img {
                width: 52px;
                height: 52px;
                color: #333c44;
                margin-top: 12px;
                margin-left: 20px;
            }
            .username {
                height: 26px;
                margin-left: 93px;
                margin-top: 11px;
                line-height: 26px;
            }
            .platform {
                height: 26px;
                margin-left: 93px;
                color: #aaa;
                line-height: 26px;
            }
            .game {
                height: 27px;
                margin-top: 11px;
                line-height: 27px;
            }
            .rmb {
                height: 25px;
                color: #aaa;
                line-height: 25px;
            }
        }
        .table-footer {
            height: 72px;
        }
    }
</style>