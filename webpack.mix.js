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

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css');

mix.js('resources/js/sb-admin-2.js', 'public/js')
    .sass('resources/sass/sb-admin-2.scss', 'public/css');

mix.copy('resources/js/functions.js', 'public/js');

mix.copyDirectory('node_modules/@fortawesome/fontawesome-free', 'public/fontawesome');
mix.copyDirectory('node_modules/jquery.easing/jquery.easing.min.js', 'public/js');
