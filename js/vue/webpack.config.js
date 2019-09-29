const
    path = require('path'),
    VueLoaderPlugin = require('vue-loader/lib/plugin');

module.exports = {
    mode: 'development',
    module: {
        rules: [
            {
                test: /\.vue$/,
                loader: 'vue-loader'
            },
            {
                test: /\.js$/,
                loader: 'bable-loader'
            },
            {
                test: /\.scss$/,
                use: [
                    'vue-style-loader',
                    {
                        loader: 'css-loader',
                        options: {
                            sourceMap: true
                        },
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
        new VueLoaderPlugin()
    ],
    resolve: {
        extensions: ['.vue', '.js'],
        alias: {
            'vue': 'vue/dist/vue.esm.js'
        }
    }
};