<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HelpController extends Controller
{

    public function link()
    {
        return view('frontend.help.link');
    }

    public function oto()
    {
        return view('frontend.help.oto');
    }

    public function copyright()
    {
        return view('frontend.help.copyright');
    }

    public function terms()
    {
        return view('frontend.help.terms');
    }
}
