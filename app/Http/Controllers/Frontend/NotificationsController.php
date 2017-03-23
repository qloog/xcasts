<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NotificationsController extends Controller
{
    public function index()
    {
        $notifications = [];

        return view('frontend.notifications.index', compact('notifications'));
    }
}
