const {mix} = require('laravel-mix');
const webpack = require('webpack');


mix.webpackConfig({
    plugins: [
        // Dirty hack for our AdminLTE image, can we do better somehow?
        new webpack.NormalModuleReplacementPlugin(
            /boxed-bg.jpg$/,
            __dirname + "/node_modules/admin-lte/dist/img/boxed-bg.jpg"
        ),
        // Thanks iCheck...
        new webpack.NormalModuleReplacementPlugin(
            /blue.png$/,
            __dirname + "/node_modules/icheck/skins/square/blue.png"
        ),
        new webpack.NormalModuleReplacementPlugin(
            /blue@2x.png$/,
            __dirname + "/node_modules/icheck/skins/square/blue@2x.png"
        )
    ]
});
/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/assets/js/app.js', 'public/js')
    .sass('resources/assets/sass/scss.scss', 'public/css')
    .less('resources/assets/less/less.less', 'public/css')
    .version();
