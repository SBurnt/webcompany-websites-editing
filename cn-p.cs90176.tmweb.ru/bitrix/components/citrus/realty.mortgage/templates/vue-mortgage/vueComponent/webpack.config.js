var path = require('path')
var webpack = require('webpack')
var VueLoaderPlugin = require('vue-loader/lib/plugin')
var ExtractTextPlugin = require("extract-text-webpack-plugin")

module.exports = {
  entry: './src/main.js',
  output: {
    path: path.resolve(__dirname, './dist'),
    publicPath: '/dist/',
    filename: 'build.js'
  },
  module: {
    rules: [
      {
        test: /\.css$/,
        loader: ExtractTextPlugin.extract({
          use: 'css-loader?minimize=false&sourceMap=false',
          fallback: 'vue-style-loader?minimize=false&sourceMap=false'
        }),
      },
      {
        test: /\.vue$/,
        loader: 'vue-loader'
      },
      {
        test: /\.js$/,
        loader: 'babel-loader',
        exclude: /node_modules/
      },
      {
        test: /\.(png|jpg|gif|svg)$/,
        loader: 'file-loader',
        options: {
          name: '[name].[ext]?[hash]'
        }
      }
    ]
  },
  plugins: [
    new VueLoaderPlugin(),
    new ExtractTextPlugin("../../style.css"),
  ],
  resolve: {
    alias: {
      'vue$': 'vue/dist/vue.esm.js',
      AutoNumeric: 'autonumeric/dist/autoNumeric.min'
    },
    extensions: ['*', '.js', '.vue', '.json']
  },
	devServer: {
    disableHostCheck: true,
    historyApiFallback: true,
		noInfo: true,
		overlay: true,
		port: 8082,
		headers: {
			'Access-Control-Allow-Origin': '*'
		}
	},
  performance: {
    hints: false
  },
  devtool: '#eval-source-map'
}

if (process.env.NODE_ENV === 'production') {
  module.exports.devtool = '#source-map'
  // http://vue-loader.vuejs.org/en/workflow/production.html
  module.exports.plugins = (module.exports.plugins || []).concat([
    new webpack.DefinePlugin({
      'process.env': {
        NODE_ENV: '"production"'
      }
    }),
    new webpack.LoaderOptionsPlugin({
      minimize: true
    })
  ])
}
