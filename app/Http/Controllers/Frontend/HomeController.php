<?php

namespace App\Http\Controllers\Frontend;

use App\Contracts\Repositories\CourseRepository;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Video;

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
    protected $courseRepo;

    /**
     * Create a new controller instance.
     *
     * @param CourseRepository $courses
     */
    public function __construct(CourseRepository $courses)
    {
        $this->middleware('auth');

        $this->courseRepo = $courses;
    }

    /**
     * Show the application welcome screen to the user.
     *
     * @return Response
     */
    public function index()
    {
        $courses = $this->courseRepo->getCourseListByType(null, 9);

        // 课程总数
        $courseCount = Course::where('is_publish', 1)->count();

        // 视频总数
        $videoCount = Video::where('is_publish', 1)->count();

        // 视频总时长
        $videos = Video::where('is_publish', 1)->get()->toArray();
        $durationArr = array_column($videos, 'duration');
        $durations = array_sum($durationArr);
        $totalDuration = formatToHour($durations);

        return view('frontend.welcome', compact('courses','courseCount', 'videoCount', 'totalDuration'));
    }

}
