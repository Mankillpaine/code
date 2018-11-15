/**
 * Created by miaoyu on 2016/12/16 0016.
 */
const
    path = require('path'),
    webpack = require('webpack'),
    htmlWebpackPlugin = require('html-webpack-plugin'),
    extractTextPlugin = require('extract-text-webpack-plugin'),
    {	path: {entry, outPro},
        api_path: {pro: apiPath},
        domain,
        maxLimit
    } = require('./config.json');

let webpackConfig = require('./webpack.base.js');


// 输出目录
webpackConfig.output = {
    path: path.resolve(__dirname, outPro),	// 输出文件目录
    filename: 'js/[name].[hash].js',		// 输出的文件名
    publicPath: domain,						// 核心文件path指向，详细查看webpack-publicPath
    chunkFilename: "js/[name].[hash].js"	// 通过 require.ensure 加载生成的文件命名规则
};

// 配置加载器
// less加载器
webpackConfig.module.loaders.push({
    test: /\.less$/,
    loader: extractTextPlugin.extract('style', 'css-loader!postcss-loader!less-loader', { publicPath: '../' })
});
// css加载器
webpackConfig.module.loaders.push({
    test: /\.css$/,
    loader: extractTextPlugin.extract('style', 'css-loader', { publicPath: '../' })
});
// font字体加载器
webpackConfig.module.loaders.push({
    test: /\.(svg|ttf|eot|woff|woff2)$/,
    loader: 'file-loader?name=font/[name].[hash].[ext]'
});
// 图片加载器
webpackConfig.module.loaders.push({
    test: /\.(png|jpg|gif|jpe?g)$/,
    loader: `url-loader?limit=${maxLimit}&name=images/[name].[hash].[ext]`
});


// 插件配置
webpackConfig.plugins = [
    new htmlWebpackPlugin({													  // 生成html文件插件
        cache: false,   													  //—— 是否启用缓存
        filename: 'index.html',                 							  //—— 生成文件名称
        template: `${path.resolve(__dirname, entry)}/index.html`, 	  //—— 加载生成文件模板路径
        showErrors: false,                      							  //—— 是否在html里面输入错误
    }),
    new extractTextPlugin('css/[name].[hash].css'), 						  // 抽出css样式为独立文件
    new webpack.optimize.CommonsChunkPlugin('vendor', 'js/[name].[hash].js'), // 抽出公共的js文件
    new webpack.optimize.OccurenceOrderPlugin(),							  // 入口大文件有较高比重全
    new webpack.optimize.UglifyJsPlugin({									  // js文件丑化
        compress: { warnings: false }
    }),
    new webpack.DefinePlugin({												  // 定义全局常量插件
        'process.env.NODE_ENV': '"production"',  							  //—— 所属环境为 pro 生产环境
        'process.env.API_URL': JSON.stringify(apiPath)						  //—— 定义全局API域名
    })
];


module.exports = webpackConfig;