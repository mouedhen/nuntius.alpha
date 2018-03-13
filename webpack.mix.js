const mix = require('laravel-mix');
var LiveReloadPlugin = require('webpack-livereload-plugin');

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

mix
    .extract([
        'axios',
        'babel-polyfill',
        'chart.js',
        'element-ui',
        'inputmask',
        'moment',
        'moment-duration-format',
        'moment-timezone',
        'vue',
        'vue-chartjs',
        'vue-data-tables',
        'vue-flatpickr-component',
        'vue-router',
        'vuex',
    ])
    .js('resources/assets/js/app.js', 'public/js')
    .sass('resources/assets/sass/app.scss', 'public/css')
    .sass('resources/assets/sass/print.scss', 'public/css')
    .webpackConfig({
        plugins: [
            new LiveReloadPlugin()
        ]
    })
    .disableNotifications();
