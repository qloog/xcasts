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

    // need to auth controller
    Route::group(['middleware' => 'auth'], function ()
    {
        Route::get('/home', ['as' => 'home', 'uses' => 'HomeController@index']);

        // user
        Route::get('user/{id}/avatar', 'UserController@editAvatar')->name('user.avatar.edit');
        Route::put('user/{id}/avatar', 'UserController@updateAvatar')->name('user.avatar.update');
        Route::get('user/{id}/bind', 'UserController@editAvatar')->name('user.bind');
        Route::post('user/follow/{id}', 'UserController@follow')->name('user.follow');
        Route::get('/notifications', 'NotificationsController@index')->name('notifications.index');

        // comment
        Route::post('comment', 'CommentController@store')->name('comment.store');

        // vip
        Route::get('vip', 'PlanController@index')->name('vip');
        Route::get('payment/pay', 'PaymentController@pay')->name('payment.pay');
        Route::get('payment/notify', 'PaymentController@notify')->name('payment.notify');
        Route::get('payment/return', 'PaymentController@return')->name('payment.return');

        Route::post('topic/{id}/upvote', 'TopicController@upVote')->name('topic.upvote');
        Route::post('topic/{id}/downvote', 'TopicController@downVote')->name('topic.downvote');
        Route::resource('reply', 'ReplyController');
    });

    // business route
    Route::get('/', ['as' => 'welcome', 'uses' => 'WelcomeController@index']);

    // user
    Route::resource('user', 'UserController');
    Route::get('user/{id}/topics', 'UserController@topics')->name('user.topics');
    Route::get('user/{id}/replies', 'UserController@replies')->name('user.replies');
    Route::get('user/{id}/votes', 'UserController@votes')->name('user.votes');
    Route::get('user/{id}/following', 'UserController@following')->name('user.following');

    // course & video
    Route::resource('course', 'CourseController');
    Route::get('course/{slug}/episodes/{episode_id}', ['as' => 'course.video.show', 'uses' => 'VideoController@show']);
    Route::get('course/{slug}', 'CourseController@show');

    // topic
    Route::resource('topic', 'TopicController');

    // blog
    Route::resource('blog', 'PostController');

    // footer
    Route::get('path', 'PathController@index')->name('path');
    Route::get('link', 'HelpController@link')->name('link');
    Route::get('one-to-one', 'HelpController@oto')->name('oto');
    Route::get('copyright', 'HelpController@copyright')->name('copyright');
    Route::get('terms', 'HelpController@terms')->name('terms');
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

        //course
        Route::resource('course', 'CourseController');
        //video
        Route::resource('video', 'VideoController');
        //forum
        Route::resource('topics', 'TopicController');

        //comment
        Route::resource('comment', 'CommentController');

        // goods
        Route::resource('goods', 'GoodsController');

        //blog
        Route::resource('post', 'PostController');
    });
});
