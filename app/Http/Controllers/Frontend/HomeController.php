<?php

namespace App\Http\Controllers\Frontend;

use App\Contracts\Repositories\SeriesRepository;
use App\Http\Controllers\Controller;
use App\Models\Page;

class HomeController extends Controller {

    /*
    |--------------------------------------------------------------------------
    | Welcome Controller
    |--------------------------------------------------------------------------
    |
    | This controller renders the "marketing page" for the application and
    | is configured to only allow guests. Like most of the other sample
    | controllers, you are free to modify or remove it as you desire.
    |
    */
    protected $seriesRepo;

    /**
     * Create a new controller instance.
     *
     * @param SeriesRepository $series
     */
    public function __construct(SeriesRepository $series)
    {
        $this->middleware('auth');

        $this->seriesRepo = $series;
    }

    /**
     * Show the application welcome screen to the user.
     *
     * @return Response
     */
    public function index()
    {
        $series = $this->seriesRepo->orderBy('id', 'DESC')->paginate(10);

        return view('frontend.welcome', compact('series'));
    }

}
