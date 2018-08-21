<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Course;
use App\Models\CourseDependencies;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Contracts\Repositories\CourseRepository;
use App\Http\Controllers\Controller;

class CourseController extends Controller
{
    /**
     * @var CourseRepository
     */
    protected $courseRepo;


    public function __construct(CourseRepository $courses)
    {
        $this->courseRepo = $courses;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $type = $request->get('type');
        $courses = $this->courseRepo->getCourseListByType($type, 15);

        return view('frontend.course.index', compact('courses', 'type'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $course = $this->courseRepo->findWhere(['slug' => $slug])->first();

        // $dependCourseIds = CourseDependencies::where(['course_id' => $course->id, 'status' => 1])
        //     ->orderBy('order', 'asc')
        //     ->pluck('dependency_course_id')
        //     ->toArray();
        //
        // $dependCourses = Course::whereIn('id', $dependCourseIds)->get();
        $dependCourses = [];

        return view('frontend.course.detail', compact('course', 'dependCourses'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
