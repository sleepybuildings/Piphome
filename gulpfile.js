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
        'pageswipe.js',
        'clock.js',
        'lights.js',
        'lighttools.js',
        'lightcolorpicker.js',
        'weather.js',
        'networkdevices.js',
        'meter.js',
        'dailymeter.js',
        'app.js'

    ], 'public/js/globals.js');

    mix.sass('lightcolorpickers.scss');
    mix.sass('networkdevices.scss');
    mix.sass('lighttools.scss');
    mix.sass('weather.scss');
    mix.sass('clock.scss');
    mix.sass('lights.scss');
    mix.sass('meter.scss');
    mix.sass('dailymeter.scss');
    mix.sass('app.scss');

    mix.version([
        'public/css/lightcolorpickers.css',
        'public/css/networkdevices.css',
        'public/css/weather.css',
        'public/css/lighttools.css',
        'public/css/clock.css',
        'public/css/lights.css',
        'public/css/meter.css',
        'public/css/dailymeter.css',
        'public/css/app.css',
    ]);


});
