/**
 * Created by miaoyu on 2016/12/16 0016.
 */
<style lang="less" scoped>
    #p-admin {
        /*头部样式*/
        .ly-header {
            z-index: 8;
            height: 60px;
            background: gray;
        }
        
        /*主体样式*/
        .ly-container {
            background: #f2f2f2;

            /*防止内容看不到占位符*/
            &:before {
                content: '';
                display: block;
                height: 60px;
            }
        }

        /*内容导航样式*/
        .ly-left {
            top: 60px;
            bottom: 0;
            width: 250px;
            background: #333c44;
        }

        /*内容主体*/
        .ly-right {
            margin-left: 250px;
        }
        
        .main-ain-duration {
            animation-duration: .6s;
        }
        /*动画延迟*/
        .main-ain-delay {
            animation-delay: .6s;
        }    
    }
</style>

<template>
	<div id="p-admin">
        <header class="ly-header fixed w-100">
            <t-toolbar></t-toolbar>
        </header>
        <div class="ly-container clear rel">
            <div class="ly-left abs">
                <t-nav></t-nav>
            </div>
            <div class="ly-right h-100 hidden">
                <!-- <transition enter-active-class="animated lightSpeedIn main-ain-delay" 
                            leave-active-class="animated bounceOut main-ain-duration"> -->
                   <router-view></router-view>
                <!-- </transitiono> -->
            </div>          
        </div>
	</div>
</template>

<script>
import tNav from './nav.tem.vue';
import tToolbar from './toolbar.tem.vue';

export default {
	name: 'p-admin',
    components: {
        tNav,
        tToolbar
    }
};
</script>