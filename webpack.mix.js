const { mix } = require('laravel-mix');

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

mix.js('resources/assets/js/app.js', 'public/js');

mix.sass('resources/assets/sass/app.scss', 'public/css');



mix.styles([
    'resources/assets/css/material-dashboard.css',
    'resources/assets/css/font-awesome.css',
    'resources/assets/css/material-icons.css',
    'resources/assets/css/custom.css'
], 'public/css/style.css');

mix.js([
    'resources/assets/js/app.js',
    'resources/assets/js/bootstrap-notify.js',
    'resources/assets/js/chartist.min.js',
    'resources/assets/js/material.min.js',
    'resources/assets/js/material-dashboard.js'
], 'public/js/script.js');

mix.js([
    'resources/assets/js/material-dashboard.js'
], 'public/js/modal.js');

mix.copyDirectory('resources/assets/fonts', 'public/fonts');
mix.copyDirectory('resources/assets/img', 'public/img');