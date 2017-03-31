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
    // frontend
    // jquery
    mix.copy('resources/assets/bower/jquery/dist/jquery.min.js','resources/assets/frontend/js');
    // semantic ui
    mix.copy('resources/assets/bower/semantic/dist/semantic.min.js','resources/assets/frontend/js');
    mix.copy('resources/assets/bower/semantic/dist/semantic.min.css','resources/assets/frontend/css');
    mix.copy('resources/assets/bower/semantic/dist/themes/default','public/build/assets/css/themes/default');
    // video.js
    mix.copy('resources/assets/bower/video.js/dist/video.min.js','resources/assets/frontend/js');
    mix.copy('resources/assets/bower/video.js/dist/video-js.min.css','resources/assets/frontend/css');
    // simplemde
    mix.copy('resources/assets/bower/simplemde/dist/simplemde.min.js','resources/assets/frontend/js');
    mix.copy('resources/assets/bower/simplemde/dist/simplemde.min.css','resources/assets/frontend/css');

    // font-awesome
    mix.copy('resources/assets/bower/font-awesome/fonts/*.*','public/assets/fonts/');
    mix.copy('resources/assets/bower/font-awesome/css/font-awesome.min.css','resources/assets/backend/css');
    mix.copy('resources/assets/bower/font-awesome/css/font-awesome.min.css','resources/assets/frontend/css');

    // Ionicons
    mix.copy('resources/assets/bower/Ionicons/fonts/*.*','public/assets/backend/fonts/');
    mix.copy('resources/assets/bower/Ionicons/css/ionicons.min.css','resources/assets/backend/css');

    // AdminLTE
    mix.copy('resources/assets/bower/AdminLTE/plugins/jQuery/jquery-2.2.3.min.js','resources/assets/backend/js');
    mix.copy('resources/assets/bower/AdminLTE/bootstrap/js/bootstrap.min.js','resources/assets/backend/js');
    mix.copy('resources/assets/bower/AdminLTE/dist/js/app.min.js','resources/assets/backend/js');
    mix.copy('resources/assets/bower/AdminLTE/plugins','public/assets/backend/plugins');
    mix.copy('resources/assets/bower/AdminLTE/bootstrap/fonts/*.*','public/assets/backend/fonts/');
    mix.copy('resources/assets/bower/AdminLTE/bootstrap/css/bootstrap.min.css','resources/assets/backend/css');
    mix.copy('resources/assets/bower/AdminLTE/dist/css/AdminLTE.min.css','resources/assets/backend/css/adminlte.min.css');
    mix.copy('resources/assets/bower/AdminLTE/dist/css/skins/*.*','resources/assets/backend/css');
    mix.copy('resources/assets/bower/AdminLTE/dist/img','public/assets/backend/img');

    // bootstrap-fileinput
    mix.copy('resources/assets/bower/bootstrap-fileinput','public/plugins/bootstrap-fileinput');

    // 合并前端的CSS样式文件
    mix.styles([
            'css/semantic.min.css',
            'css/simplemde.min.css',
            'css/video-js.min.css',
            'css/font-awesome.min.css'
        ],
        'public/assets/css/app.min.css',
        'resources/assets/frontend/'
    );

    // 合并后台的CSS样式文件
    // mix.styles([
    //         'select2.min.css',
    //         'daterangepicker-bs3.css',
    //         'bootstrap.min.css',
    //         'font-awesome.min.css',
    //         'adminlte.min.css',
    //         'adminlte-skin.min.css',
    //         'sweetalert.css',
    //         'common.css'
    //     ],
    //     'public/assets/backend/css/app.min.css',
    //     'resources/assets/backend/css'
    // );

    // 合并前端的Javascript脚本文件
    mix.scripts([
            'js/jquery.min.js',
            'js/semantic.min.js',
            'js/simplemde.min.js',
            'js/video.min.js'
        ],
        'public/assets/js/app.min.js',
        'resources/assets/frontend'
    );

    // 合并后台的Javascript脚本文件
    // mix.scripts([
    //         'jquery.min.js',
    //         'bootstrap.min.js',
    //         'adminlte.min.js',
    //         'select2.full.min.js',
    //         'moment.min.js',
    //         'sweetalert.min.js',
    //         'daterangepicker.js',
    //         'common.js'
    //     ],
    //     'public/assets/backend/js/app.min.js',
    //     'resources/assets/backend/js'
    // );

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
        // 'assets/backend/js/app.min.js',
        // 'assets/backend/css/app.min.css',
        'assets/js/app.min.js',
        'assets/css/app.min.css'
    ]);

});
