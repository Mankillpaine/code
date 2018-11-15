/**
 * Created by miaoyu on 2016/12/16 0016.
 */
<template>
	<div id="admin" class="h-100">
        <div class="ly-right h-100 fixed">
            <admin-nav></admin-nav>
        </div>
		<div class="ly-left h-100 rel">
            <header class="ly-header w-100 fixed">
                <admin-toolbar></admin-toolbar>
            </header>
			<div class="ly-main hidden">
                <router-view></router-view>
            </div>
		</div>
	</div>
</template>


<script>
import adminNav from './nav.vue';
import adminToolbar from './toolbar.vue';

export default {
	name: 'admin',
    components: {
        adminNav,
        adminToolbar
    }
};
</script>


<style lang="less" scoped>
    /*左边导航*/
    .ly-right {
        overflow: auto;
        width: 270px;
        background: #ccc;
    }

    /*右边内容块*/
    .ly-left {
        margin-left: 270px;
    }

    /*内容头部样式*/
    .ly-header {
        height: 80px;
        background: gray;
    }

    /*内容主体样式*/
	.ly-main {
		margin: 0 15px;

        /*防止内容看不到占位符*/
		&:before {
			content: '';
			display: block;
			height: 80px;
		}
	}
</style>