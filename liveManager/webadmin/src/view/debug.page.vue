/**
 * Created by miaoyu on 2016/12/16 0016.
 */
<style lang="less" scoped>
    #p-debug {
        height: 2000px;

        p {
            height: 700px;
            margin: 20px;
            background: #fff;
        }
    }
</style>

<template>
    <div id="p-debug">
        <p class="font-30">debug</p>
    </div>
</template>

<script>
// import { getService } from './../service/apidata.service.js'

// vm对象
const vm = {
    created() {
        // getService();
    },
	data: () => ({
		
	})
};


// 暴露组件配置
export default Object.assign({ name: 'p-debug' }, vm);
</script>