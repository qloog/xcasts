<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Contracts\Repositories\CommentRepository;
use App\Contracts\Repositories\UserRepository;
use App\Contracts\Repositories\VideoRepository;
use App\Contracts\Repositories\CourseRepository;
use App\Http\Requests;
use App\Http\Controllers\Controller;


class VideoController extends Controller
{
    protected $courseRepo;
    protected $videoRepo;
    protected $commentRepo;
    protected $userRepo;

    public function __construct(UserRepository $users, CourseRepository $courses, VideoRepository $videos, CommentRepository $comments)
    {
        $this->userRepo = $users;
        $this->courseRepo = $courses;
        $this->videoRepo = $videos;
        $this->commentRepo = $comments;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param $slug
     * @param $episodeId
     * @return \Illuminate\Http\Response
     */
    public function show($slug, $episodeId)
    {
        $course = $this->courseRepo->findByField('slug', $slug)->first();

        $video = $this->videoRepo->findWhere(['course_id' => $course->id, 'episode_id' => $episodeId])->first();
        $comments = $this->commentRepo
            ->orderBy('created_at','desc')
            ->findWhere(['type' => 'video', 'relation_id' => $video->id])
            ->all();

        $preLink = '';
        $nextLink = '';
        if ($this->videoRepo->findWhere(['course_id' => $course->id, 'episode_id' => $episodeId - 1, 'is_publish' => 1])->toArray()) {
            $preLink = route('video.show', ['slug' => $course->slug, 'episode_id' => $video->episode_id - 1]);
        }
        if ($this->videoRepo->findWhere(['course_id' => $course->id, 'episode_id' => $episodeId + 1, 'is_publish' => 1])->toArray()) {
            $nextLink = route('video.show', ['slug' => $course->slug, 'episode_id' => $video->episode_id + 1]);
        }

        $videos = $this->videoRepo->findWhere(['course_id' => $course->id]);

        $recentCourses = Course::where('is_publish', 1)->orderBy('created_at', 'desc')->take(15)->get();

        return view('frontend.video.detail', compact('course', 'video', 'videos', 'comments','preLink', 'nextLink', 'recentCourses'));
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
