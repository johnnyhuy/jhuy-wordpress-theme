// Core packages
const webpack = require('webpack');
const merge = require('webpack-merge');
const common = require('./webpack.common.js');

const ExtractTextPlugin = require('extract-text-webpack-plugin');
const ExtraneousFileCleanupPlugin = require('webpack-extraneous-file-cleanup-plugin');

module.exports = merge(common, {
    devtool: 'source-map',
    entry: {
        'bundle': './src/js/init.js',
        '../../style': './src/sass/init.scss',
        'admin': [
            './src/js/admin.js',
            './src/sass/admin.scss'
        ]
    },
    module: {
        rules: [{
            test: /\.(scss|sass)$/,
            exclude: /(node_modules|bower_components)/,
            use: ExtractTextPlugin.extract({
                fallback: 'style-loader',
                use: [{
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
            })
        }],
    },
    plugins: [
        new ExtraneousFileCleanupPlugin({
            extensions: ['.js']
        }),
        new ExtractTextPlugin({
            filename: 'assets/css/[name].css',
            allChunks: true
        }),
        new webpack.optimize.UglifyJsPlugin({
            sourceMap: true,
            compress: {
                warnings: false
            }
        }),
        new webpack.DefinePlugin({
            'process.env': {
                'NODE_ENV': JSON.stringify('production')
            }
        }),
        new webpack.optimize.CommonsChunkPlugin('head')
    ]
});
