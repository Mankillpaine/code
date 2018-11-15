/**
 * Created by Administrator on 2016/10/21 0021.
 */
'use strict';

let fs = require('fs'),
    path = require('path'),
    gulp = require('gulp'),
    gutil = require('gulp-util'),
    gmincss = require('gulp-minify-css'),
    colors = require('colors'),
    webpack = require('webpack'),
    autoprefixer = require('autoprefixer'),
    browsersync = require('browser-sync'),
    extractTextPlugin = require('extract-text-webpack-plugin'),
    webpackInitConfig, getDevRouter, serverDevTask, minCssTask, getHTMLTask;

/**
 * 配置控制台输出颜色
 */
colors.setTheme({
    error: 'red',
    success: 'green'
});

/**
 * webpack初始化配置
 * —— context - 文件上下文路径
 * —— entry: { - 输入路径
 * ——       common - common核心模块公共路径
 * ——       index - index模块路径
 * —— }
 * —— output: { - 输出路径
 * ——       path - 输出目录
 * ——       filename - 输出文件名
 * —— }
 * —— entryHTML - 输入模块路径
 * —— outputHTML - 输出模块路径
 * —— module: { - 依赖模块
 * ——       loaders: [ - 加载器列表
 * ——           { test: /\.less$/, loader: extractTextPlugin.extract('style', 'css!postcss!less') } - less提取样式文件加载器
 * ——           { test: /\.(svg|ttf|eot|woff|woff2)$/, loader: 'file-loader?name=font/[name].[ext]' } - 字体文件提取加载器
 * ——           { test: /\.(png|jpg|gif|jpeg)$/, loader: 'url-loader?limit=10240&name=images/[name].[ext]' } - 图片提取加载器
 * ——       ]
 * —— }
 * —— plugins: [ - 依赖插件列表
 * ——       new extractTextPlugin('css/[name].css') - 提取css样式文件插件
 * ——       new webpack.optimize.CommonsChunkPlugin('common', 'js/[name].bundle.js') - 提取公共js文件插件
 * —— ]
 * —— postcss - 自动添加css浏览器厂商私有前缀
 * —— resolve - webpack找不到模块解决办法
 * —— resolveLoader - webpack找不到模块解决办法
 * —— watch - 是否开启自动监听文件
 * —— cache - 是否开启缓存功能
 */
webpackInitConfig = {
    context: __dirname,
    entry: {
        'common': ['./src/common/common.module.js'],
        'index': './src/index/index.module.js',
        'serv': './src/serv/serv.module.js',
        'observe': './src/observe/observe.module.js',
        'observedet': './src/observedet/observedet.module.js',
        'search': './src/search/search.module.js',
        'consultsearch': './src/consultsearch/consultsearch.module.js',
        'anchorcomindex': './src/anchorcomindex/anchorcomindex.module.js',
        'onedayanchorlist': './src/onedayanchorlist/onedayanchorlist.module.js',
        'onedayanchorincome': './src/onedayanchorincome/onedayanchorincome.module.js',
        'onedayanchorfans': './src/onedayanchorfans/onedayanchorfans.module.js',
        'industryindex': './src/industryindex/industryindex.module.js',
        'terraceindex': './src/terraceindex/terraceindex.module.js',
        'anchordet': './src/anchordet/anchordet.module.js',
    },
    output: {
        path: './static',
        filename: 'js/[name].bundle.js'
    },
    entryHTML: './src/view',
    outputHTML: './static/view',
    module: {
        loaders: [
            { test: /\.less$/, loader: extractTextPlugin.extract('style', 'css!postcss!less', { publicPath: '../' }) },
            { test: /\.(svg|ttf|eot|woff|woff2)$/, loader: 'file-loader?name=font/[name].[ext]' },
            { test: /\.(png|jpg|gif|jpeg)$/, loader: 'url-loader?limit=10240&name=images/[name].[ext]' }
        ]
    },
    plugins: [
        new extractTextPlugin('css/[name].css'),
        new webpack.optimize.CommonsChunkPlugin('common', 'js/[name].bundle.js')
    ],
    postcss: [autoprefixer()],
    resolve: {
        fallback: path.join(__dirname, 'node_modules')
    },
    resolveLoader: {
        fallback: path.join(__dirname, 'node_modules')
    },
    watch: false,
    cache: false
};

/**
 * 获取测试服务路由
 * 参数：
 *      callback(function) - 成功后的回调方法，回调函数内置参数routes配置对象
 * 返回值：
 *      -
 */
getDevRouter = (callback) => {
    let {entryHTML, outputHTML} = webpackInitConfig,
        routes = {},
        defaultIndex;

    // 读取路由文件
    fs.readdir(entryHTML, (err, data) => {
        if (err) console.log('----- [error] 读取路由文件出错 --------------'.error);

        // 遍历配置项目
        data.forEach((value) => routes['/'+ path.basename(value, '.html')] = entryHTML +'/'+ value);
        defaultIndex = routes['/index'] ? routes['/index'] : routes[0];

        // 执行回调
        callback(routes, defaultIndex);
    });
};

/**
 * 测试服务任务
 * 参数：
 *      -
 * 返回值：
 *      -
 */
serverDevTask = () => {
    // 执行获取路由方法
    getDevRouter((routes, defaultIndex) => {
        /**
         * 测试服务配置项目
         * —— host - ip地址
         * —— port - 端口号
         * —— files - 监听变化文件位置
         * —— server: {
         * ——     baseDir - 服务目录
         * ——     index - 默认起始路由
         * ——     routes - 配置路由对象
         * —— }
         * —— reloadDelay - 配置刷新延迟时间
         * —— ui - 是否开启UI服务
         */
        browsersync({
            host: '127.0.0.1',
            port: 5001,
            files: [__dirname +'/src/view/**', __dirname +'/static/**'],
            server: {
                baseDir: __dirname +'/..',
                index: 'web/'+ defaultIndex.substring(2),
                routes: routes
            },
            reloadDelay: 500,
            ui: false
        });
    });
};

/**
 * 压缩css任务
 * 参数：
 *      [callabck](function) - 成功后的回调
 * 返回值：
 *      -
 */
minCssTask = (callback = () => {}) => {
    let dirurl = webpackInitConfig.output.path +'/css';

    // 读取文件进行压缩
    fs.readdir(dirurl, function(err, data) {
        if (err) console.log('----- [success] css压缩失败 ---------'.error);

        // 压缩css文件
        data.forEach((value) => ((src) => {
            gulp.src(`${dirurl}/${value}`)
                .pipe(gmincss())
                .pipe(gulp.dest(dirurl));
        })(value));

        // 压缩成功打印并输出
        console.log('----- [success] css压缩完成 ---------'.success);
        callback();
    });
};

/**
 * 提取html任务
 * 参数：
 *      [callabck](function) - 成功后的回调
 * 返回值：
 *      -
 */
getHTMLTask = (callback = () => {}) => {
    let {entryHTML, outputHTML} = webpackInitConfig,
        indexSize = 0,
        indexLength,

        /**
         * 读取目录文件
         * 参数：
         *      callabck(function) - 成功后的回调，回调内置参数basename文件名称
         * 返回值：
         *      -
         */
        readDirFile = (callback) => {
            fs.readdir(entryHTML, (err, list) => {
                if (err) console.log('----- [error] html读取失败 ---------'.error);

                indexLength = list.length;
                list.forEach((value) => ((basename) => callback(basename))(value));
            });
        },

        /**
         * 读取文件内容
         * 参数：
         *      basename - 需要读取的文件名称，含后缀
         *      callabck(function) - 成功后的回调，回调内置参数文件内容
         * 返回值：
         *      -
         */
        readFile = (basename, callback) => {
            fs.readFile(`${entryHTML}/${basename}`, 'utf-8', (err, data) => {
                if (err) console.log(`----- [error] ${basename}文件读取失败 -----------`.error);

                // 读取文件成功
                callback(data);
            });
        },

        /**
         * 是否创建目录
         * 参数：
         *      basename - 需要读取的文件名称，含后缀
         *      fileData - 需要写入的文件内容，utf-8编码的
         *      callabck(function) - 成功后的回调，回调内置参数文件内容
         * 返回值：
         *      -
         */
        isCreateDir = (basename, fileData, callback) => {
            fs.exists(outputHTML, (exists) => {
                // 如果不存在创建目录
                if (!exists) {
                    fs.mkdir(outputHTML, (err) => callback(basename, fileData));
                } else {
                    callback(basename, fileData);
                }
            });
        },

        /**
         * 写入文件
         * 参数：
         *      basename - 需要读取的文件名称，含后缀
         *      fileData - 需要写入的文件内容，utf-8编码的
         *      callabck(function) - 成功后的回调
         * 返回值：
         *      -
         */
        writeFile = (basename, fileData, callback) => {
            fs.writeFile(`${outputHTML}/${basename}`, fileData, {encoding: 'utf-8'}, (err, data) => {
                if (err) {
                    console.log(`----- [error] ${basename}文件写入失败 -----------`.error);
                } else {
                    indexSize++;
                    console.log(`----- [success] ${basename}文件写入成功 -----------`.success);
                };

                // 文件写入满足条数执行回调
                if (indexSize === indexLength) callback();
            });
        };

    // 读取目录
    readDirFile((basename) => {
        // 读取文件
        readFile(basename, (fileData) => {
            // 是否创建目录
            isCreateDir(basename, fileData, (basename, fileData) => {
                writeFile(basename, fileData, () => callback());
            });
        });
    });
};

/**
 * dev 测试任务
 * 命令：
 *      gulp fev
 * 说明：
 *      1、开启了webpack自动打包任务
 *      2、开启了更新html模板和静态文件自动刷新游览器任务
 */
gulp.task('dev', () => {
    let isSuccess = false,
        config = Object.assign(webpackInitConfig, {
            watch: true,
            cache: true
        });

    // 执行webpack自动编译
    webpack(config, (err, stats) => {
        if (err) throw new gutil.PluginError('webpack', err);

        // 如果第一次编译成功就执行开启server任务，否则刷新游览器
        if (!isSuccess) {
            isSuccess = true;

            serverDevTask();
        } else {

            browsersync.reload({stream:true})
        };

        // 打印成功或者失败
        // gutil.log('----- webpack watch -----', stats.toString({ colors: true }));
    });
});

/**
 * pro 生产打包任务
 * 命令：
 *      gulp pro
 * 说明：
 *      1、开启了webpack依赖打包任务
 */
gulp.task('pro', () => {
    let config = Object.assign(webpackInitConfig, {
            plugins: [
                new extractTextPlugin('css/[name].css'),
                new webpack.optimize.CommonsChunkPlugin('common', 'js/[name].bundle.js'),
                new webpack.optimize.UglifyJsPlugin({
                    compress: {
                        warnings: false,
                    },
                    output: {
                        comments: false,
                    },
                })
            ]
        });

    // webpack打包任务
    webpack(config, (err, stats) => {
        if (err) throw new gutil.PluginError('webpack', err);

        // 打印成功或者失败
        gutil.log('----- [webpack] -----', stats.toString({ colors: true }));

        // 打包css样式
        minCssTask();

        // 提取html任务
        getHTMLTask(() => console.log(`----- [success] 生产任务打包完成 -------------`.success));
    });
});