/**
 * Created by miaoyu on 2016/12/16 0016.
 */
<template>
    <div id="p-404">
        404页面
    </div>
</template>


<script>
import { getService } from './../service/apidata.service.js'


// vm对象
const vm = {
    created() {
        getService();
    },
	data: () => ({
		
	})
};


// 暴露组件配置
export default Object.assign({ name: 'p-404' }, vm);
</script>


<style lang="less" scoped>
    #p-404 {
    
    }
</style>