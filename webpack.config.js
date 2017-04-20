var path = require('path');
var webpack = require('webpack');
module.exports = {
    entry: {
        main: [
             "./src/assets/js/dev/toolkit.js",
             "./src/assets/js/dev/bootstrap.min.js",
             "./src/assets/js/dev/material.js",
             "./src/assets/js/dev/ripples.js",
             "./src/assets/js/react/index.jsx",
             "./src/assets/js/dev/main.es6.js"
         ]
     },
     plugins: [
         new webpack.optimize.CommonsChunkPlugin({
             name: "common",
             minChunks: 2,
             chunks: ["main"]
         }),
     ],
    output: {
        path: path.join(__dirname, "src/assets/js/dev"),
        filename: "[name].js"
    },
    resolve: {
        extensions: ['*', '.js', '.jsx'],
    },
    module: {
      loaders: [
        { test: /\.js$/, exclude: /node_modules/, loader: "babel-loader"}
      ]
    }
};
