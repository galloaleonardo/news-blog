const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css');

mix.js('resources/js/sb-admin-2.js', 'public/js')
    .sass('resources/sass/sb-admin-2.scss', 'public/css');

mix.copy('resources/js/functions.js', 'public/js');
mix.copy('resources/js/scripts-news-theme.js', 'public/js');
mix.copy('node_modules/jquery/dist/jquery.min.js', 'public/js');
mix.copy('node_modules/bootstrap/dist/js/bootstrap.min.js', 'public/js');

mix.copy('resources/css/styles-news-theme.css', 'public/css');
mix.copy('resources/css/ionicons.css', 'public/css');
mix.copy('node_modules/bootstrap/dist/css/bootstrap.min.css', 'public/css');

mix.copyDirectory('node_modules/@fortawesome/fontawesome-free', 'public/fontawesome');
mix.copyDirectory('node_modules/jquery.easing/jquery.easing.min.js', 'public/js');
