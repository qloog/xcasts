<?php

namespace App\Http\Controllers\Frontend;

use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NotificationsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //$notifications = [];

        $user = User::find(Auth::id());
        $notifications = $user->notifications();

        // reset to 0
        $user->notification_count = 0;
        $user->save();

        return view('frontend.notifications.index', compact('user', 'notifications'));
    }
}
