<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests;
use App\Http\Controllers\Backend\BaseController;
use App\Models\Comment;
use App\Models\Feedback;
use App\Models\Reply;
use App\Models\Topic;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Page;
use Auth;
use Illuminate\Support\Facades\Redis;

class DashboardController extends BaseController
{

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        // 总注册用户
        $data['totalUserCount'] = User::count('id');

        // 总注册用户激活数
        $data['totalActivatedUserCount'] = User::where('is_activated', 1)->count();

	    // 今日注册用户
        $data['todayRegisteredUserCount'] = User::where([
            ['created_at', '>=', Carbon::now() . ' 00:00:00'],
            ['created_at', '<=', Carbon::now() . ' 23:59:59']
        ])->count();

        // 今日注册并激活用户
        $data['todayActivatedUserCount'] = User::where([
            ['created_at', '>=', Carbon::now() . ' 00:00:00'],
            ['created_at', '<=', Carbon::now() . ' 23:59:59'],
            ['is_activated', '=', 1]
        ])->count();

        // 今日登录过的用户
        $data['todayLoginUserCount'] = User::where([
            ['last_login_time', '>=', Carbon::now() . ' 00:00:00'],
            ['last_login_time', '<=', Carbon::now() . ' 23:59:59'],
        ])->count();


        // 当前在线用户数 10分钟内
        $onlineKey = 'online_users';
        $startTime = Carbon::now()->subMinute(10)->getTimestamp();
        $endTime = Carbon::now()->getTimestamp();
        $redis = Redis::connection();
        $data['onlineUserCount'] = $redis->zcount($onlineKey, $startTime, $endTime);
        // 当前在线用户列表 10分钟内
        $onlineUserIds = $redis->zrangebyscore($onlineKey, $startTime, $endTime);
        $data['onlineUsers'] = User::whereIn('id', $onlineUserIds)->get();

        // 最新注册用户 top 8
        $data['lastRegisteredUsers'] = User::orderBy('created_at', 'desc')->take(8)->get();

        // 帖子列表 top 5
        $data['lastTopics'] = Topic::orderBy('created_at', 'desc')->take(5)->get();

        // 帖子回复列表 top 5
        $data['lastReplies'] = Reply::orderBy('created_at', 'desc')->take(5)->get();

        // 视频/文章评论列表 top 5
        $data['lastComments'] = Comment::orderBy('created_at', 'desc')->take(5)->get();

        // 反馈 top 5
        $data['feedbacks'] = Feedback::orderBy('created_at', 'desc')->take(5)->get();

        return view('backend.dashboard', $data);
	}

}
