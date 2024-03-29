const { merge } = require("webpack-merge"); // webpack-merge
const common = require("./webpack.common.js"); // 汎用設定をインポート
const path = require("path");
const webpack = require("webpack");
const WebpackNotifierPlugin = require("webpack-notifier");
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const CssMinimizerPlugin = require("css-minimizer-webpack-plugin");
const autoprefixer = require("autoprefixer");
const cssnano = require("cssnano");
const postcssAssets = require("postcss-assets");

const config = merge(common, {
  output: {
    publicPath: "http://localhost:8080/",
  },
  mode: "development",
  devtool: "inline-source-map",
  plugins: [
    new webpack.HotModuleReplacementPlugin(),
    new WebpackNotifierPlugin({
      title: "Success compiled!",
      contentImage: path.join(__dirname, "dev/js/icons/shibasaki_ko.jpg"),
      alwaysNotify: true,
    }),
  ],
  optimization: {
    minimize: true,
    minimizer: [new CssMinimizerPlugin()],
    runtimeChunk: 'single'
  },
  devServer: {
    open: true,
    compress: true,
    inline: true,
    hot: true,
    disableHostCheck: true,
    host: "0.0.0.0",
  },
});

for (const key in config.entry) {
  if (config.entry.hasOwnProperty(key)) {
    config.entry[key].unshift(
      "webpack-hot-middleware/client?path=http://localhost:8080/__webpack_hmr"
    );
    config.entry[key].unshift("webpack/hot/only-dev-server");
  }
}

config.module.rules.push({
  test: /\.scss$/,
  exclude: /node_modules/,
  use: [
    "css-hot-loader",
    MiniCssExtractPlugin.loader,
    {
      loader: "css-loader",
      options: {
        sourceMap: true,
        importLoaders: 1,
        url: false,
      }
    },
    {
      loader: "postcss-loader",
      options: {
        sourceMap: true,
        postcssOptions: {
          plugins: [
            autoprefixer(),
            cssnano({
              preset: [
                "default",
                {
                  discardComments: {
                    removeAll: true,
                  }
                }
              ]
            }),
            postcssAssets({
              loadPaths: ["dev/images/"],
              relative: true
            }),
          ],
        },
      },
    },
    {
      loader: "sass-loader",
      options: {
        sourceMap: true,
        sassOptions: {
          includePaths: [path.resolve(__dirname, './dev/sass')],
        },
      }
    },
  ]
});

module.exports = config;
