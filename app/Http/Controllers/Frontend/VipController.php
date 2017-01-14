<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VipController extends Controller
{

    public function index()
    {
        $abc = [];
        return view('frontend.vip.index', compact('abc'));
    }
}
