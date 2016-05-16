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
    /* App files */
    mix.styles([
        '../../../bower_components/bootswatch/paper/bootstrap.min.css',
        '../../../bower_components/sweetalert/dist/sweetalert.css',
        '../../../bower_components/magnific-popup/dist/magnific-popup.css',
        '../../../bower_components/font-awesome/css/font-awesome.min.css',
        '../../../bower_components/animate.css/animate.min.css'
    ], 'public/css/app.bundle.css');
    mix.scripts([
        '../../../bower_components/jquery/dist/jquery.min.js',
        '../../../bower_components/bootstrap/dist/js/bootstrap.min.js',
        '../../../bower_components/sweetalert/dist/sweetalert.min.js',
        '../../../bower_components/jquery.scrollTo/jquery.scrollTo.min.js',
        '../../../bower_components/noty/js/noty/packaged/jquery.noty.packaged.min.js',
        '../../../bower_components/magnific-popup/dist/jquery.magnific-popup.min.js'
    ], 'public/js/app.bundle.js');
    mix.copy([
        'bower_components/bootstrap/fonts',
        'bower_components/font-awesome/fonts/*.*',
    ], 'public/fonts');
    //mix.copy('node_modules/swagger-ui/dist', 'public/apidocs');


    /* Admin files */
    mix.styles([
        '../../../bower_components/Materialize/dist/css/materialize.min.css',
        '../../../bower_components/animate.css/animate.min.css',
        '../../../bower_components/sweetalert/dist/sweetalert.css',
        '../../../bower_components/datetimepicker/jquery.datetimepicker.css'
    ], 'public/css/admin.bundle.css');
    mix.scripts([
        '../../../bower_components/jquery/dist/jquery.min.js',
        '../../../node_modules/vue/dist/vue.min.js',
        '../../../bower_components/Materialize/dist/js/materialize.min.js',
        '../../../bower_components/noty/js/noty/packaged/jquery.noty.packaged.min.js',
        '../../../bower_components/jquery.scrollTo/jquery.scrollTo.min.js',
        '../../../bower_components/sweetalert/dist/sweetalert.min.js',
        '../../../node_modules/tablesorter/dist/js/jquery.tablesorter.combined.min.js',
        '../../../node_modules/tablesorter/dist/js/extras/jquery.tablesorter.pager.min.js',
        '../../../bower_components/datetimepicker/build/jquery.datetimepicker.full.min.js'
    ], 'public/js/admin.bundle.js');

    /* Materialize-css Files */
    mix.copy('bower_components/Materialize/dist/fonts', 'public/fonts');
});
