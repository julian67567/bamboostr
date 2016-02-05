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


elixir.config.sourcemaps = false;

/*
elixir(function(mix) {
    mix.sass('app.scss');
});*/

//hace Mix por el asterisco y genera un archivo
elixir(function(mix) {
    mix.less('*.less')
    .version('public/css/style.css');
});

/*
elixir(function(mix) {
    mix.version('css/all.css');
});
*/

elixir(function(mix) {
    mix.coffee('*.coffee')
    .version('public/js/coffe.js');
});