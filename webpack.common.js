// Require
const path = require('path');
const extractTextPlugin = require('extract-text-webpack-plugin');
const webpackNotifierPlugin = require('webpack-notifier');
const webpack = require('webpack');
const dashboardPlugin = require('webpack-dashboard/plugin');

// Theme settings
const THEME_NAME = 'jhuy'

// Plugins
const extractSass = new extractTextPlugin({
    filename: 'style.css',
    allChunks: true
});
const notifier = new webpackNotifierPlugin({
    alwaysNotify: true
})
const jquery = new webpack.ProvidePlugin({
    $: 'jquery',
    jQuery: 'jquery',
    'windows.jQuery': 'jquery'
});
const dashboard = new dashboardPlugin();

module.exports = {
    devtool: 'source-map',
    entry: ['./assets/js/init.js', './assets/sass/init.scss'],
    output: {
        path: path.resolve(__dirname),
        filename: 'assets/js/bundle.js',
        publicPath: './'
    },
    module: {
        rules: [{
            test: /\.(scss|sass)$/,
            use: extractSass.extract({
                fallback: 'style-loader',
                use: [{
                    loader: 'css-loader',
                    query: {
                        minimize: false,
                        sourceMap: true,
                        importLoaders: 2
                    }
                },
                {
                    loader: 'sass-loader',
                    query: {
                        sourceMap: true,
                        sourceMapContents: true
                    }
                }]
            })
        },
        {
            test: /\.js$/,
            exclude: /(node_modules|bower_components)/,
            use: {
                loader: 'babel-loader'
            }
        },
        {
            test: /\.(jpe?g|png|gif|svg)$/i,
            loader: 'file-loader',
            query:{
                name: '/[ext]/[name].[ext]',
                outputPath: 'assets/images'
            }
        },
        {
            test: /\.(woff(2)?|ttf|eot)(\?v=[0-9]\.[0-9]\.[0-9])?$/,
            loader: 'url-loader',
            query: {
                limit: '10000',
                name: '[name].[ext]',
                outputPath: 'assets/fonts/'
            }
        }]
    },
    plugins: [
        extractSass,
        notifier,
        jquery,
        dashboard
    ],
    resolve: {
        alias: {
            'TweenLite': path.resolve('node_modules', 'gsap/assets/uncompressed/TweenLite.js'),
            'TweenMax': path.resolve('node_modules', 'gsap/assets/uncompressed/TweenMax.js'),
            'TimelineLite': path.resolve('node_modules', 'gsap/assets/uncompressed/TimelineLite.js'),
            'TimelineMax': path.resolve('node_modules', 'gsap/assets/uncompressed/TimelineMax.js'),
            'ScrollMagic': path.resolve('node_modules', 'scrollmagic/scrollmagic/uncompressed/ScrollMagic.js'),
            'animation.gsap': path.resolve('node_modules', 'scrollmagic/scrollmagic/uncompressed/plugins/animation.gsap.js'),
            'debug.addIndicators': path.resolve('node_modules', 'scrollmagic/scrollmagic/uncompressed/plugins/debug.addIndicators.js')
        }
    }
};