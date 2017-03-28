const gulp = require('gulp');
const elixir = require('laravel-elixir');


/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Less
 | file for our application, as well as publishing vendor resources.
 |
 */


/**
 * Default gulp is to run this elixir stuff
 */
elixir(function(mix) {

    // font-awesome
    mix.copy('resources/assets/bower/font-awesome/fonts/*.*','public/fonts/');
    mix.copy('resources/assets/bower/font-awesome/css/font-awesome.min.css','public/css');

    mix.copy('resources/assets/bower/Ionicons/fonts/*.*','public/fonts/');
    mix.copy('resources/assets/bower/Ionicons/css/ionicons.min.css','public/css');

    // AdminLTE
    mix.copy('resources/assets/bower/AdminLTE/plugins/jQuery/jquery-2.2.3.min.js','public/js');
    mix.copy('resources/assets/bower/AdminLTE/bootstrap/js/bootstrap.min.js','public/js');
    mix.copy('resources/assets/bower/AdminLTE/dist/js/app.min.js','public/js');
    mix.copy('resources/assets/bower/AdminLTE/plugins','public/plugins');
    mix.copy('resources/assets/bower/AdminLTE/bootstrap/fonts/*.*','public/fonts/');
    mix.copy('resources/assets/bower/AdminLTE/bootstrap/css/bootstrap.min.css','public/css');
    mix.copy('resources/assets/bower/AdminLTE/dist/css/AdminLTE.min.css','resources/assets/backend/css/adminlte.min.css');
    mix.copy('resources/assets/bower/AdminLTE/dist/css/skins/*.*','public/css/skins');
    mix.copy('resources/assets/bower/AdminLTE/dist/img','public/img');

     // bootstrap-fileinput
     mix.copy('resources/assets/bower/bootstrap-fileinput','public/plugins/bootstrap-fileinput');
     // frontend
     // semantic ui
     mix.copy('resources/assets/bower/semantic','public/semantic');
     // video.js
     mix.copy('resources/assets/bower/video.js/dist','public/videojs');
     // simplemde
     mix.copy('resources/assets/bower/simplemde/dist','public/simplemde');

    // 合并前端的CSS样式文件
    mix.styles([
            'bootstrap-assets/css/bootstrap.min.css',
            'plugins/owl-carousel/owl.carousel.css',
            'plugins/owl-carousel/owl.theme.css',
            'plugins/owl-carousel/owl.transitions.css',
            'plugins/Lightbox/dist/css/lightbox.css',
            'plugins/Icons/et-line-font/style.css',
            'plugins/animate.css/animate.css',
            'css/main.css',
            'css/sweetalert.css',
            'css/font-awesome.min.css'
        ],
        'public/assets/css/app.min.css',
        'resources/assets/frontend/'
    );

    // 合并后台的CSS样式文件
    mix.styles([
            'select2.min.css',
            'daterangepicker-bs3.css',
            'bootstrap.min.css',
            'font-awesome.min.css',
            'adminlte.min.css',
            'adminlte-skin.min.css',
            'sweetalert.css',
            'common.css'
        ],
        'public/assets/backend/css/app.min.css',
        'resources/assets/backend/css'
    );

    // 合并前端的Javascript脚本文件
    mix.scripts([
            'js/jquery.min.js',
            'bootstrap-assets/js/bootstrap.min.js',
            'js/custom.js',
            'plugins/owl-carousel/owl.carousel.min.js',
            'js/jquery.easing.min.js',
            'plugins/countTo/jquery.countTo.js',
            'plugins/inview/jquery.inview.min.js',
            'plugins/Lightbox/dist/js/lightbox.min.js',
            'plugins/WOW/dist/wow.min.js',
            'js/sweetalert.min.js'
        ],
        'public/assets/js/app.min.js',
        'resources/assets/frontend'
    );

    // 合并后台的Javascript脚本文件
    mix.scripts([
            'jquery.min.js',
            'bootstrap.min.js',
            'adminlte.min.js',
            'select2.full.min.js',
            'moment.min.js',
            'sweetalert.min.js',
            'daterangepicker.js',
            'common.js'
        ],
        'public/assets/backend/js/app.min.js',
        'resources/assets/backend/js'
    );

    // 监控文件变动，自动刷新浏览器
    mix.browserSync({
        files: [
            'app/**/*',
            'public/**/*',
            'resources/views/**/*'
        ],
        port: 5000,
        proxy: 'localhost:8000'
    });

    // 生成版本和缓存清除
    mix.version([
        'assets/backend/js/app.min.js',
        'assets/backend/css/app.min.css',
        'assets/js/app.min.js',
        'assets/css/app.min.css'
    ]);

});
