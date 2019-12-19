const path = require('path');
const HtmlWebpackPlugin = require('html-webpack-plugin');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const autoprefixer = require('autoprefixer');
const cssnano = require('cssnano');

module.exports = {
    entry: './dev/js/main.js',
    output: {
        path: path.resolve(__dirname, 'build'),
        filename: 'bundle.js'
    },
    module: {
       rules: [
           {
               test: /\.pug$/,
               use: 'pug-loader'
           },
           {
               test: /\.scss$/,
               use: [
                   'css-hot-loader', MiniCssExtractPlugin.loader,
                   {
                       loader: 'css-loader',
                       options: {
                           sourceMap: true
                       }
                   },
                   {
                       loader: 'postcss-loader',
                       options: {
                           sourceMap: true,
                           plugins: [
                               autoprefixer,
                               cssnano({
                                   preset: [
                                       'default'
                                   ]
                               })
                           ]
                       }
                   },
                   {
                       loader: 'sass-loader',
                       options: {
                           sourceMap: true
                       }
                   }
               ]
           }
       ]
    },
    plugins: [
        new HtmlWebpackPlugin({
            template: './dev/pug/index.pug'
        })
    ],
    devtool: 'inline-source-map',
    devServer: {
        open: true,
        openPage: 'index.html',
        contentBase: path.join(__dirname, 'build'),
        watchContentBase: true
    },
    watch: true
};
