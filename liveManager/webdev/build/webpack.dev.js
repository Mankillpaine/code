/**
 * Created by miaoyu on 2016/12/16 0016.
 */
const
    path = require('path'),
    webpack = require('webpack'),
    htmlWebpackPlugin = require('html-webpack-plugin'),
    {	path: {entry, outDev},
        server: {host, port},
        api_path: {dev: apiPath},
        maxLimit
        } = require('./config.json');

let webpackConfig = require('./webpack.base.js');


// 启用缓存 和 自动监听打包
webpackConfig.watch = true;
webpackConfig.cache = true;


// 输入入口
// 配置 webpack-dev-server 需要的强制项
Object.keys(webpackConfig.entry).forEach((val) =>
    webpackConfig.entry[val].unshift(`webpack-dev-server/client?http://${host}:${port}/`, 'webpack/hot/dev-server'));


// 输出目录
webpackConfig.output = {
    path: path.resolve(__dirname, outDev),	// 输出文件目录
    filename: 'js/[name].bundle.js',		// 输出的文件名
    publicPath: '/',						// 核心文件path指向，详细查看webpack-publicPath
    chunkFilename: "js/[name].chunks.js"	// 通过 require.ensure 加载生成的文件命名规则
};


// 配置加载器
// less加载器
webpackConfig.module.loaders.push({
    test: /\.less$/,
    loader: 'style-loader!css-loader!postcss-loader!less-loader'
});
// font字体加载器
webpackConfig.module.loaders.push({
    test: /\.(svg|ttf|eot|woff|woff2)$/,
    loader: 'file-loader?name=font/[name].bundle.[ext]'
});
// 图片加载器
webpackConfig.module.loaders.push({
    test: /\.(png|jpg|gif|jpe?g)$/,
    loader: `url-loader?limit=${maxLimit}&name=images/[name].bundle.[ext]`
});


// 插件配置
webpackConfig.plugins = [
    new htmlWebpackPlugin({												  // 生成html文件插件
        cache: true,   						    						  //—— 是否启用缓存
        filename: 'index.html',                  						  //—— 生成文件名称
        template: `${path.resolve(__dirname, entry)}/common/index.html`,  //—— 加载生成文件模板路径
        showErrors: true,                        						  //—— 是否在 html 里面输入错误
    }),
    new webpack.HotModuleReplacementPlugin(),	 						  // 测试服务热替换插件
    new webpack.NoErrorsPlugin(),				 						  // 编译错误不停止插件
    new webpack.DefinePlugin({					 						  // 定义全局常量插件
        'process.env.NODE_ENV': '"development"', 						  //—— 所属环境为 dev 测试环境
        'process.env.API_URL': JSON.stringify(apiPath)			 		  //—— 定义全局API域名
    })
];


module.exports = webpackConfig;