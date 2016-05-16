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
        '../../../node_modules/vue/dist/vue.js',
        'lights.js',
        'app.js'

    ], 'public/js/globals.js');

    mix.sass('app.scss').version('public/css/app.css');

});
