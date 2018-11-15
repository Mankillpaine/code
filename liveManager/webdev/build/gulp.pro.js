/**
 * Created by miaoyu on 2016/12/16 0016.
 */
require('./gulp.base.js');

const
    path = require('path'),
    gulp = require('gulp'),
    gutil = require('gulp-util'),
    clean = require('gulp-clean'),
    webpack = require('webpack'),
    webpackConfig = require('./webpack.pro.js'),
    {path: {outPro}} = require('./config.json');


// 清理目录任务
gulp.task('clean:pro', () =>
    gulp.src(path.resolve(__dirname, outPro), {read: false})
        .pipe(clean())
        .on('end', () => console.log('[gulp-task] ----- clean:pro - success -----'.success)));


// webpack任务
gulp.task('webpack:pro', ['clean:pro'], (cb) => {
    webpack(webpackConfig, (err, stats) => {
        // webpack 错误时及时报错
        if (err) throw new gutil.PluginError('webpack:build', err);

        // webpack 编译成功时输出
        gutil.log('[webpack:build]', stats.toString({
            hash: false,
            cached: false,
            chunks: false,
            colors: true,
            source: false,
            timings: true,
            modules: false,
            version: false,
            reasons: false,
            children: false,
            errorDetails: true,
            cachedAssets: false,
            chunkModules: false,
        }));

        // 执行回调
        cb();
    });
});


module.exports = ['webpack:pro'];