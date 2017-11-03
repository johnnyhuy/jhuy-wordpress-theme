const merge = require('webpack-merge');
const webpack = require('webpack');
const common = require('./webpack.common.js');
const path = require('path');
const openBrowserPlugin = require('open-browser-webpack-plugin')
const dashboardPlugin = require('webpack-dashboard/plugin');
const THEME_NAME = require('./webpack.common.js').THEME_NAME

// Setup proxy to link webpack dev server with other host (e.g. WAMP or LAMP setups).
const proxyConfig = {
    "target": {
        "host": "localhost",
        "protocol": 'http:',
        "port": 80
    },
    ignorePath: false,
    changeOrigin: true,
    secure: false
}

module.exports = merge(common, {
    devtool: 'inline-source-map',
    plugins: [
        new openBrowserPlugin({
            url: 'http://localhost:3000'
        }),
        new dashboardPlugin(),
        new webpack.NamedModulesPlugin()
    ],
    devServer: {
        proxy: {
            '/': proxyConfig,
            '**': proxyConfig,
        },
    }
});
