<?php

namespace App\Http\Controllers\Frontend;

use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NotificationController extends Controller
{
    public function index()
    {
        $user = User::find(Auth::id());

        $notifications = $user->notifications;
        var_dump($notifications);exit;

        return view('frontend.notification.index', compact('notifications'));
    }
}
