const merge = require('webpack-merge');
const webpack = require('webpack');
const uglify = new webpack.optimize.UglifyJsPlugin({
    sourceMap: true,
    compress: {
        warnings: false
    }
})
const env = new webpack.DefinePlugin({
    'process.env': {
        'NODE_ENV': JSON.stringify('production')
    }
})
const common = require('./webpack.common.js');

module.exports = merge(common, {
    devtool: 'source-map',
    plugins: [
        uglify,
        env
    ]
});
