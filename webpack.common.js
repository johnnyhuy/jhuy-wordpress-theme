// Core packages
const path = require('path');
const webpack = require('webpack');

// Other
const WebpackNotifierPlugin = require('webpack-notifier');

module.exports = {
    output: {
        path: path.resolve(__dirname),
        filename: 'assets/js/[name].js',
        publicPath: '/wp-content/themes/jhuy/'
    },
    module: {
        rules: [{
            test: /\.js$/,
            use: {
                loader: 'babel-loader'
            }
        }, {
            test: /\.(jpe?g|png|gif|svg)$/i,
            loader: 'file-loader',
            query:{
                limit: 8192,
                name: 'assets/images/[ext]/[name].[ext]',
            }
        }, {
            test: /\.(woff(2)?|ttf|eot|otf)(\?v=[0-9]\.[0-9]\.[0-9])?$/,
            loader: 'url-loader',
            query: {
                limit: 8192,
                name: 'assets/fonts/[name].[ext]',
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
        })
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