<?php

namespace App\Http\Controllers\Frontend;

use App\Contracts\Repositories\CourseRepository;
use App\Http\Controllers\Controller;

/**
 * Class HomeController
 * @package App\Http\Controllers\Frontend
 */
class HomeController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | Home Controller
    |--------------------------------------------------------------------------
    |
    | This controller renders your application's "dashboard" for users that
    | are authenticated. Of course, you are free to change or remove the
    | controller as you wish. It is just here to get your app started!
    |
    */
    protected $courses;

    /**
     * Create a new controller instance.
     * @param CourseRepository $courses
     */
    public function __construct(CourseRepository $courses)
    {
        $this->middleware('auth');

        $this->courses = $courses;
    }


    /**
     *
     */
    function index()
    {
        $courses = $this->courses->orderBy('id', 'DESC')->paginate(30);

        return view('frontend.home', compact('courses'));
    }

}
