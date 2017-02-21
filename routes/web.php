<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

/**
 * Frontend Routes
 * Namespaces indicate folder structure
 */
Route::group(['namespace' => 'Frontend'], function ()
{
    // about login and logout
    Route::auth();
    Route::get('logout', 'Auth\LoginController@logout');

    // business route
    Route::get('/home', ['as' => 'home', 'uses' => 'HomeController@index']);
    Route::get('/', ['as' => 'welcome', 'uses' => 'WelcomeController@index']);

    // user
    Route::resource('user', 'UserController');
    Route::get('user/{id}/avatar', 'UserController@editAvatar')->name('user.avatar.edit');
    Route::put('user/{id}/avatar', 'UserController@updateAvatar')->name('user.avatar.update');
    Route::get('user/{id}/notification', 'UserController@notification')->name('user.notification');
    Route::get('user/{id}/bind', 'UserController@editAvatar')->name('user.bind');
    Route::get('user/{id}/topics', 'UserController@topics')->name('user.topics');
    Route::get('user/{id}/replies', 'UserController@replies')->name('user.replies');
    Route::get('user/{id}/votes', 'UserController@votes')->name('user.votes');
    Route::get('user/{id}/following', 'UserController@following')->name('user.following');
    Route::post('user/follow/{id}', 'UserController@follow')->name('user.follow');

    // series
    Route::resource('series', 'SeriesController');
    Route::get('series/{slug}/episodes/{episode_id}', ['as' => 'series.lesson.show', 'uses' => 'LessonController@show']);
    Route::resource('series/{slug}', 'SeriesController@show');

    // topic
    Route::resource('topic', 'TopicController');
    Route::post('topic/{id}/upvote', 'TopicController@upVote')->name('topic.upvote');
    Route::post('topic/{id}/downvote', 'TopicController@downVote')->name('topic.downvote');
    Route::resource('reply', 'ReplyController');
    // comment
    Route::post('comment', 'CommentController@store')->name('comment.store');
    Route::get('vip', 'PlanController@index')->name('vip');
    Route::get('payment/pay', 'PaymentController@pay')->name('payment.pay');
    Route::get('payment/notify', 'PaymentController@notify')->name('payment.notify');
    Route::get('payment/return', 'PaymentController@return')->name('payment.return');
    Route::get('notifications', 'NotificationController@index')->name('notifications');
});

/**
 * Backend Routes
 * Namespaces indicate folder structure
 */
Route::group(['namespace' => 'Backend'], function ()
{

    // about login and logout
    Route::group(['prefix' => 'admin'], function ()
    {
        Route::get('login', 'Auth\LoginController@showLoginForm');
        Route::post('login', 'Auth\LoginController@login');
        Route::get('logout', 'Auth\LoginController@logout');
    });

    // need to auth controller
    Route::group(['as' => 'admin.', 'prefix' => 'admin', 'middleware' => 'auth.admin'], function ()
    {
        //dashboard
        Route::get('/', ['as' => 'dashboard', 'uses' => 'DashboardController@index']);
        Route::get('dashboard', ['as' => 'dashboard', 'uses' => 'DashboardController@index']);

        //user
        Route::get('user', 'UserController@index')->name('admin.user');
        Route::resource('auth/user', 'UserController', ['as' => 'auth']);
        Route::get('auth/user/change-password/{id}', 'UserController@changePassword');
        Route::post('auth/user/update-password/{id}', ['as' => 'user.update-password', 'uses' => 'UserController@updatePassword']);
        Route::resource('auth/role', 'RoleController', ['as' => 'auth']);
        Route::resource('auth/permission', 'PermissionController', ['as' => 'auth']);

        //news
        Route::resource('news/category', 'NewsCategoryController', ['as' => 'news']);
        Route::resource('news', 'NewsController');

        //event
        Route::resource('event', 'EventController');

        //album
        Route::resource('album', 'AlbumController');
        Route::get('album/{id}/photos', ['as' => 'album.photos', 'uses' => 'AlbumController@photos']);
        Route::post('album/upload', ['as' => 'album.upload', 'uses' => 'AlbumController@storePhoto']);

        //series
        Route::resource('series', 'SeriesController');
        //video
        Route::resource('lesson', 'LessonController');
        //forum
        Route::resource('topics', 'TopicController');

        //comment
        Route::resource('comment', 'CommentController');

        //page
        Route::resource('page', 'PagesController');
        Route::resource('goods', 'GoodsController');

        //upload
        // After the line that reads
        Route::get('upload', 'UploadController@index');

        // Add the following routes
        Route::post('upload/file', ['as' => 'upload.file', 'uses' => 'UploadController@uploadFile']);
        Route::delete('upload/file', 'UploadController@deleteFile');
        Route::post('upload/folder', 'UploadController@createFolder');
        Route::delete('upload/folder', 'UploadController@deleteFolder');
        Route::post('upload/image', ['as' => 'upload.image', 'uses' => 'UploadController@uploadImage']);

        // qiniu
        Route::get('qiniu/index', 'QiniuController@index')->name('qiniu.index');
    });
});
