const mix = require('laravel-mix');

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

/*
var LiveReloadPlugin = require('webpack-livereload-plugin');

mix.webpackConfig({
    plugins: [
        new LiveReloadPlugin()
    ]
});
*/


mix
    .setPublicPath('public/build')
    .setResourceRoot('build')
    .js('resources/js/app.js', 'js')
   // .sass('resources/sass/app.scss', 'css/app.css')
    .sass('resources/sass/app2.scss', 'css/app2.css')
    .version().browserSync({
        open: false,
        watchTask: true,
        proxy: 'http://0.0.0.0',
        port: 8081,
        browser: "chrome"
    });

