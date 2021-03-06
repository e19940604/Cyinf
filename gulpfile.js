var elixir  = require('laravel-elixir');
var gulp    = require('gulp');

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
elixir(function(mix) {
    /* compileing sass */
    mix.sass([
        'curriculum.scss',
        'curriculum-courseDetail.scss',
        'notify.scss'
    ], 'public/Curr/css/app.css');
    /* executing phpunit test */
    mix.phpUnit();
});
