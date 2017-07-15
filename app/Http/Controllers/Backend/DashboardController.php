<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests;
use App\Http\Controllers\Backend\BaseController;
use Illuminate\Http\Request;
use App\Models\Page;
use Auth;

class DashboardController extends BaseController
{

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        return view('backend.dashboard');
	}

}
