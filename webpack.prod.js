// Core packages
const webpack = require('webpack');
const merge = require('webpack-merge');
const common = require('./webpack.common.js');

const ExtractTextPlugin = require('extract-text-webpack-plugin');

module.exports = merge(common, {
    devtool: 'source-map',
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
        new ExtractTextPlugin({
            filename: 'style.css',
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
        })
    ]
});
