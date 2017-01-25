<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QiniuController extends Controller
{
    public function index()
    {
        $albums = [];
        return view('backend.qiniu.index', compact('albums'));
    }
}
