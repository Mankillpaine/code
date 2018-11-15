/**
 * Created by miaoyu on 2016/12/16 0016.
 */
<template>
    <input id="co-seldate" type="text" class="font-14 c-pointer text-center" 
                        v-myflatpickr="options"
                        :placeholder="placeholder" 
                        @input="updateInput">
</template>


<script>
import 'flatpickr/dist/themes/airbnb.css';
import flatpickr from 'flatpickr';
import { zh } from 'flatpickr/dist/l10n/zh.js';

let dateCont;


/**
 * <seldate></seldate> —— 日期选择组件
 * prop: 
 *     placeholder(String) - input没有内容时展示的信息，默认为：请选择日期
 *     options(Object) - flatpickr插件的配置信息，详见：https://chmln.github.io/flatpickr/
 * 备注：
 *     1、该组件依赖插件：flatpickr，可以使用npm install flatpickr --save 来安装该插件
 *     2、该组件UI依赖 miaoyu.reset.less、miaoyu.class.less 样式文件
 */
export default {
	name: 'co-seldate',
    props: {
        // 默认显示的内容
        placeholder: {
            type: String,
            default: '请选择日期'
        },
        // flatpickr插件的配置信息，详见：https://chmln.github.io/flatpickr/
        options: {
            type: Object,
            default: () => ({})
        }
    },
    methods: {
        // 触发了input事件
        updateInput: function({target: {value}}) {
            this.$emit('updateDate', value);
        }
    },
    directives: {
        myflatpickr: {
            // 生成实例
            inserted: (el, {value}) => dateCont = new flatpickr(el, Object.assign({ locale: zh }, value)),
            // 释放索引
            unbind: () => dateCont = null
        }
    }
}
</script>