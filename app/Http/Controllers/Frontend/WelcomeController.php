<?php

namespace App\Http\Controllers\Frontend;

use App\Contracts\Repositories\CourseRepository;
use App\Http\Controllers\Controller;

class WelcomeController extends Controller {

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
    protected $courseRepo;

    /**
     * Create a new controller instance.
     *
     * @param CourseRepository $courses
     */
	public function __construct(CourseRepository $courses)
	{
		$this->middleware('guest');

        $this->courseRepo = $courses;
	}

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
        $courses = $this->courseRepo->getCourseListByType(null, 15);

		return view('frontend.welcome', compact('courses'));
	}

}
