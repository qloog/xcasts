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

    // oauth login
    Route::get('login/oauth/{driver}', 'Auth\LoginController@redirectToProvider');
    Route::get('login/oauth/{driver}/callback', 'Auth\LoginController@handleProviderCallback');

    // vip
    Route::get('vip', 'PlanController@index')->name('vip');

    // need to auth controller
    Route::group(['middleware' => 'auth'], function ()
    {
        Route::get('/home', 'HomeController@index')->name('home');

        // user
        Route::get('users/{user}/edit', 'UserController@edit')->name('user.edit');
        Route::put('users/{user}', 'UserController@update')->name('user.update');
        Route::get('users/{id}/edit_avatar', 'UserController@editAvatar')->name('user.edit_avatar');
        Route::put('users/{id}/update_avatar', 'UserController@updateAvatar')->name('user.update_avatar');
        Route::get('users/{id}/edit_password', 'UserController@editPassword')->name('user.edit_password');
        Route::put('users/{id}/update_password', 'UserController@updatePassword')->name('user.update_password');
        Route::get('users/{id}/bind', 'UserController@editAvatar')->name('user.bind');
        Route::post('users/follow/{id}', 'UserController@follow')->name('user.follow');
        Route::get('notifications', 'NotificationsController@index')->name('notifications.index');
        Route::post('upload/image', 'UploadController@uploadImage')->name('upload.image');

        // comment
        Route::post('comment', 'CommentController@store')->name('comment.store');
        Route::post('comment/{id}/vote', 'CommentController@vote')->name('comment.vote');

        Route::get('payment/pay', 'PaymentController@pay')->name('payment.pay');
        Route::get('payment/notify', 'PaymentController@notify')->name('payment.notify');
        Route::get('payment/return', 'PaymentController@return')->name('payment.return');

        Route::post('topics/{id}/upvote', 'TopicController@upVote')->name('topics.upvote');
        Route::post('topics/{id}/downvote', 'TopicController@downVote')->name('topics.downvote');
        Route::resource('reply', 'ReplyController');
        Route::post('reply/{id}/vote', 'ReplyController@vote')->name('reply.vote');

        // buy plan
        Route::get('plans/{alias}/purchase', 'PlanController@purchase')->name('plan.purchase');
        Route::get('plans/{alias}/pay', 'PlanController@pay')->name('plan.pay');
        Route::get('plans/{alias}/success', 'PlanController@success')->name('plan.success');
        Route::get('plans/{order_id}/check', 'PlanController@checkQRStatus')->name('plan.check');
    });

    // push 消息是 post 方式
    Route::post('plans/push', 'PlanController@push')->name('plan.push');

    // business route
    Route::get('/', 'WelcomeController@index')->name('welcome');

    // user
    Route::get('users/activation/{token}', 'Auth\LoginController@userActivation')->name('user.activation');
    Route::get('users/{id}', 'UserController@show')->name('user.show');
    Route::get('users/{id}/topics', 'UserController@topics')->name('user.topics');
    Route::get('users/{id}/replies', 'UserController@replies')->name('user.replies');
    Route::get('users/{id}/votes', 'UserController@votes')->name('user.votes');
    Route::get('users/{id}/following', 'UserController@following')->name('user.following');
    Route::get('users/{id}/followers', 'UserController@followers')->name('user.followers');

    // course & video
    Route::resource('courses', 'CourseController');
    Route::get('courses/{slug}/episodes/{episode_id}', 'VideoController@show')->name('video.show');
    Route::get('courses/{slug}', 'CourseController@show')->name('courses.show');

    // topic
    Route::resource('topics', 'TopicController');

    // blog
    Route::get('posts', 'PostController@index')->name('post.index');
    Route::get('posts/{slug}', 'PostController@show')->name('post.show');

    // feedback
    Route::get('feedback', 'FeedbackController@create')->name('feedback.create');
    Route::post('feedback', 'FeedbackController@store')->name('feedback.store');
    Route::get('feedback/success', 'FeedbackController@success')->name('feedback.success');

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
    Route::group(['as' => 'admin.', 'prefix' => 'admin', 'middleware' => ['auth:admin']], function ()
    {
        //dashboard
        Route::get('/', ['as' => 'dashboard', 'uses' => 'DashboardController@index']);
        Route::get('dashboard', ['as' => 'dashboard', 'uses' => 'DashboardController@index']);

        //users
        Route::get('user', 'UserController@index')->name('admin.user');
        Route::resource('auth/user', 'UserController', ['as' => 'auth']);
        Route::get('auth/user/change-password/{id}', 'UserController@changePassword');
        Route::post('auth/user/update-password/{id}', ['as' => 'user.update-password', 'uses' => 'UserController@updatePassword']);
        Route::resource('auth/role', 'RoleController', ['as' => 'auth']);
        Route::resource('auth/permission', 'PermissionController', ['as' => 'auth']);
        Route::get('user/add_member', 'UserController@addMember')->name('user.add_member');
        Route::post('user/open_member', 'UserController@openMember')->name('user.open_member');

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

        // course
        Route::resource('course', 'CourseController');
        // video
        Route::resource('video', 'VideoController');
        Route::post('video/{video}/publish', 'VideoController@publish')->name('video.publish');

        // section
        Route::resource('section', 'SectionController');

        // forum
        Route::resource('forum/topics', 'TopicController');
        Route::get('forum/replies/index', 'ReplyController@index');

        // comment
        Route::resource('comment', 'CommentController');
        // feedback
        Route::get('feedback', 'FeedbackController@index')->name('feedback.index');

        //plan
        Route::resource('plan', 'PlanController');

        //blog
        Route::resource('post', 'PostController');
        // order
        Route::get('order', 'OrderController@index')->name('order.list');
    });
});
