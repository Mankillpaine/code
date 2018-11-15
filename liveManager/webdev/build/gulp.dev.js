/**
 * Created by miaoyu on 2016/12/16 0016.
 */
require('./gulp.base.js');

const
    opn = require('opn'),
    gulp = require('gulp'),
    webpack = require('webpack'),
    webpackConfig = require('./webpack.dev.js'),
    webpackDevServer = require('webpack-dev-server'),
    {path: {outDev}, server: {host, port}, autoOpen} = require('./config.json');


// webpack任务
gulp.task('webpack:dev', () => {
    const
    // 获取 compiler
        compiler = webpack(webpackConfig),

    // 创建测试服务
        server = new webpackDevServer(compiler, {
            hot: true,									  // 是否启动 hot 热替换功能
            quiet: true,								  // 控制台是否安静输出
            stats: { colors: true},						  // 状态设置
            noInfo: true,								  // 不显示信息
            headers: { "X-Custom-Header": "yes" },		  // 设置请求头
            compress: true,								  // 是否启用gzip压缩
            publicPath: webpackConfig.output.publicPath,  // 一般为 webpack.output.publicPath 值
            contentBase: webpackConfig.output.publicPath, // 一般为 http://127.0.0.1:5001 或 /
            clientLogLevel: "error",					  // 输出的信息类型
            historyApiFallback: false					  // 设置为 true 可以启用 html5 的路由
        });

    server.listen(port, host, () => {
        const url = `http://${host}:${port}/`;

        // 如果配置要自动打开游览器就打开
        if (autoOpen) opn(url);

        // 输出测试服务信息
        console.log(`[gulp-task] ----- webpack:dev [${url}] -----`.success)
    });
});


module.exports = ['webpack:dev'];