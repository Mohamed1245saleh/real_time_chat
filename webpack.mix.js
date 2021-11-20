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
    .vue()
    .sass('resources/sass/app.scss', 'public/css');

mix.css('resources/css/chat.css', 'public/css/style.css');
mix.css('resources/css/style.css', 'public/css/style.css');
// mix.css('resources/css/fontawesome.css', 'public/css/style.css');
// mix.css('resources/css/bootstrap.css', 'public/css/style.css');
mix.js('resources/js/index.js', 'public/js/index.js').vue();
// mix.js('resources/js/index.js', 'public/js/index.js');