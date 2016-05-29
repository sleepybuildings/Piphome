var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix)
{
    mix.scripts([
       // '../../../node_modules/vue/dist/vue.common.js',
        '../../../node_modules/jquery/dist/jquery.js',
        '../../../node_modules/vue/dist/vue.js',
        'clock.js',
        'lights.js',
        'lighttools.js',
        'app.js'

    ], 'public/js/globals.js');

    mix.sass('lighttools.scss');
    mix.sass('clock.scss');
    mix.sass('lights.scss');
    mix.sass('app.scss');

    mix.version([
        'public/css/lighttools.css',
        'public/css/clock.css',
        'public/css/lights.css',
        'public/css/app.css',
    ]);
});
