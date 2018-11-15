/**
 * Created by miaoyu on 2016/12/16 0016.
 */
const
    path = require('path'),
    autoprefixer = require('autoprefixer'),
    {path: {entry}, module: moduleS} = require('./config.json');

let entryS = {};


// 获取入口配置
entryS[moduleS] = [`${path.resolve(__dirname, entry)}/entry.js`];


// webpack 核心配置项
module.exports = {
    entry: entryS,
    module: {
        loaders: [
            { test: /\.js$/, exclude: /node_modules/, loader: 'babel-loader'}, // babel 转码器
            { test: /\.vue$/, loader: 'vue-loader'},						   // vue 加载器
            { test: /\.html$/, loader: 'html-loader'},						   // html 加载器
        ]
    },
    postcss: [																	 // 添加游览器私有前缀配设置
        autoprefixer({ browsers: ['last 4 versions', 'ie >= 9', '> 1% in CN'] }) //—— 游览器版本最最新的后4位、ie等于等于9、使用率在中国大于百分之1
    ],
    resolve: {
        alias: {					  		   // 别名设置
            'vue$': 'vue/dist/vue.js' 		   //—— 定义全局vue模块别名
        },
        fallback: path.resolve('node_modules') // 找不到模块后的解决办法
    },
    resolveLoader: { fallback: path.resolve('node_modules') } // 找不到加载器解决办法
};