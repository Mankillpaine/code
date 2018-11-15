/**
 * Created by miaoyu on 2016/12/16 0016.
 */
const
    gulp = require('gulp'),
    {setTheme: setColor} = require('colors');

// 配置输出颜色
setColor({
    error: 'red',	 // 错误输出为红色
    success: 'green' // 成功输出为绿色
});