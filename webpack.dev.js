// Core packages
const webpack = require('webpack');
const path = require('path');
const merge = require('webpack-merge');
const common = require('./webpack.common.js');

// Other
const OpenBrowserPlugin = require('open-browser-webpack-plugin');
const DashboardPlugin = require('webpack-dashboard/plugin');
const WriteFilePlugin = require('write-file-webpack-plugin');

// Setup proxy to link webpack dev server with other host (e.g. WAMP or LAMP setups).
const proxyConfig = {
    "target": {
        "host": "localhost",
        "protocol": 'http:',
        "port": 80
    },
    ignorePath: false,
    changeOrigin: true,
    secure: false,
};

module.exports = merge(common, {
    devtool: 'inline-source-map',
    module: {
        rules: [{
            test: /\.(scss|sass)$/,
            exclude: /(node_modules|bower_components)/,
            use: [{
                loader: 'style-loader',
            },{
                loader: 'css-loader',
                query: {
                    minimize: false,
                    sourceMap: true,
                    importLoaders: 2
                }
            }, {
                loader: 'sass-loader',
                query: {
                    sourceMap: true,
                    sourceMapContents: true
                }
            }]
        }]
    },
    plugins: [
        new OpenBrowserPlugin({
            url: 'http://localhost:3000'
        }),
        new DashboardPlugin(),
        new webpack.NamedModulesPlugin(),
        new WriteFilePlugin({
            test: /^(?!.*(hot)).*/,
        }),
    ],
    devServer: {
        publicPath: '/wp-content/themes/jhuy/',
        headers: {
            "Access-Control-Allow-Origin": "*",
            "Access-Control-Allow-Methods": "GET, POST, PUT, DELETE, PATCH, OPTIONS",
            "Access-Control-Allow-Headers": "X-Requested-With, content-type, Authorization"
        },
        proxy: {
            '/': proxyConfig,
            '**': proxyConfig,
        }
    }
});
