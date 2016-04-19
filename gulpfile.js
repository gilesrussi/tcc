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

elixir(function(mix) {
    mix.sass('app.scss')
		.version('css/app.css');

    mix.styles([
        'libs/familylato.css',
        'libs/font-awesome.min.css',
        'libs/bootstrap.min.css',


        'libs/toastr.min.css',
        '../../../public/css/app.css'
    ]);

    mix.scripts([
        'libs/jquery.min.js',
        'libs/bootstrap.min.js',
        'libs/toastr.min.js'
    ])
});
