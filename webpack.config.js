// Generated using webpack-cli https://github.com/webpack/webpack-cli

// const path = require('path');
// const HtmlWebpackPlugin = require('html-webpack-plugin');
// const MiniCssExtractPlugin = require('mini-css-extract-plugin');

const isProduction = process.env.NODE_ENV == 'production';


// const stylesHandler = isProduction ? MiniCssExtractPlugin.loader : 'style-loader';
var Encore = require('@symfony/webpack-encore');
Encore.configureRuntimeEnvironment(isProduction);
Encore
    .setOutputPath('public/build/')
    .setPublicPath('/build')
    .addEntry('sb-admin-2', './public/js/sb-admin-2.js')
    .addStyleEntry('sb-admin-2-css', './public/css/sb-admin-2.css')
    .cleanupOutputBeforeBuild()
    .enableBuildNotifications()
    .enableSassLoader()
    .enableSingleRuntimeChunk()
    .enableSourceMaps(!Encore.isProduction())
    .enableVersioning(Encore.isProduction());

module.exports = Encore.getWebpackConfig();

// const config = {
//     entry: './src/index.js',
//     output: {
//         path: path.resolve(__dirname, 'dist'),
//     },
//     devServer: {
//         open: true,
//         host: 'localhost',
//     },
//     plugins: [
//         new HtmlWebpackPlugin({
//             template: 'index.html',
//         }),

//         // Add your plugins here
//         // Learn more about plugins from https://webpack.js.org/configuration/plugins/
//     ],
//     module: {
//         rules: [
//             {
//                 test: /\.(js|jsx)$/i,
//                 loader: 'babel-loader',
//             },
//             {
//                 test: /\.css$/i,
//                 use: [stylesHandler, 'css-loader', 'postcss-loader'],
//             },
//             {
//                 test: /\.(eot|svg|ttf|woff|woff2|png|jpg|gif)$/i,
//                 type: 'asset',
//             },

//             // Add your rules for custom modules here
//             // Learn more about loaders from https://webpack.js.org/loaders/
//         ],
//     },
// };

// module.exports = () => {
//     if (isProduction) {
//         config.mode = 'production';
        
//         config.plugins.push(new MiniCssExtractPlugin());
        
        
//     } else {
//         config.mode = 'development';
//     }
//     return config;
// };

