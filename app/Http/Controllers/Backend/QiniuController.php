<?php

namespace App\Http\Controllers\Backend;

use App\Services\QiNiuService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QiniuController extends Controller
{
    public function index()
    {
        $qiniuSrv = new QiNiuService();
        $files = $qiniuSrv->list();

        return view('backend.qiniu.index', compact('files'));
    }
}
