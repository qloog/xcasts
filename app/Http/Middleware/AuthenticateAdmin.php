<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Contracts\Auth\Guard;
use Route;
use URL;

class AuthenticateAdmin
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param  Guard $auth
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $previousUrl = URL::previous();
        if ($this->auth->guest()) {
            if ($request->ajax()) {
                return response()->json(
                    [
                        'status' => 0,
                        'code' => 401,
                        'message' => '没有权限操作'
                    ]
                );
            } else {
                return redirect()->guest('admin/login');
            }
        } else {
            if (Auth::id() != 1) {
                abort(404, 'Unauthorized action.');
            }
        }

        //if (!Auth::user()->can(Route::currentRouteName())) {
        if (false) {
            if ($request->ajax()) {
                return response()->json(
                    [
                        'status' => 0,
                        'code' => 401,
                        'message' => '没有权限操作'
                    ]
                );
            } else {
                return view('backend.errors.401', compact('previousUrl'));
            }
        }

        return $next($request);
    }
}