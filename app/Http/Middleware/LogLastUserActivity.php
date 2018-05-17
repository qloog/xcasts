<?php

namespace App\Http\Middleware;

use Auth;
use Carbon\Carbon;
use Closure;
use Illuminate\Support\Facades\Redis;

class LogLastUserActivity
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // 记录在线用户
        if(Auth::check()) {
            // 忽略管理员 from admins
            $userId = Auth::id();
            if ($userId != 1) {
                Redis::connection()->zadd('online_users', Carbon::now()->getTimestamp(), $userId);
            }
        }

        return $next($request);
    }
}
