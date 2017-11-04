// Core packages
const path = require('path');
const webpack = require('webpack');

// Other
const WebpackNotifierPlugin = require('webpack-notifier');
const WriteFilePlugin = require('write-file-webpack-plugin');

module.exports = {
    entry: [
        './assets/js/init.js',
        './assets/sass/init.scss'
    ],
    output: {
        path: path.resolve(__dirname),
        filename: './assets/js/bundle.js',
        publicPath: '/wp-content/themes/jhuy/assets'
    },
    module: {
        rules: [{
            test: /\.js$/,
            exclude: /(node_modules|bower_components)/,
            use: {
                loader: 'babel-loader'
            }
        }, {
            test: /\.(jpe?g|png|gif|svg)$/i,
            exclude: /(node_modules|bower_components)/,
            loader: 'file-loader',
            query:{
                limit: 8192,
                name: '/images/[ext]/[name].[ext]?[hash]',
            }
        }, {
            test: /\.(woff(2)?|ttf|eot)(\?v=[0-9]\.[0-9]\.[0-9])?$/,
            exclude: /(node_modules|bower_components)/,
            loader: 'url-loader',
            query: {
                limit: 8192,
                name: '/fonts/[name].[ext]?[hash]',
                emitFile: false
            }
        }]
    },
    plugins: [
        new WebpackNotifierPlugin({
            alwaysNotify: true
        }),
        new webpack.ProvidePlugin({
            $: 'jquery',
            jQuery: 'jquery',
            'window.jQuery': 'jquery'
        }),
        new WriteFilePlugin(),
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