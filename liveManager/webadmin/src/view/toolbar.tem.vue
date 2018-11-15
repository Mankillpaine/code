/**
 * Created by miaoyu on 2016/12/16 0016.
 */
<template>
    <div id="t-toolbar" class="clear">
        <h1 class="logo fl">
            <router-link class="db-wh-100 text-indent-hidden" to="/index">logo</router-link>
        </h1>
        <div>
            <!-- 头部 -->
        </div>
    </div>
</template>


<script>
export default {
    name: 'toolbar'
};
</script>


<style lang="less" scoped>
    /*工具栏样式*/
    #t-toolbar {
        background: #05bcd4;

        /*logo样式*/
        .logo {
            width: 250px;
            height: 60px;
            background: #05bcd4 url(../public/images/logo.png) no-repeat center;
            // box-shadow: 2px 0 3px rgba(0,0,0,0.15);
        }
    }   
</style>