<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use App\Contracts\Repositories\CourseRepository;
use App\Contracts\Repositories\VideoRepository;
use App\Services\UploadsManager;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class VideoController extends Controller
{

    protected $videoRepo;
    protected $uploadManager;
    protected $courseRepo;

    public function __construct(VideoRepository $videos, UploadsManager $uploadsManager, CourseRepository $courses)
    {
        $this->videoRepo = $videos;
        $this->uploadManager = $uploadsManager;
        $this->courseRepo = $courses;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $courseId = $request->get('course_id', 0);

        $videos = $this->videoRepo->getVideoListByCourseId($courseId);

        return view('backend.video.index', compact('videos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $courseId = $request->get('course_id', 0);
        $courses = $this->courseRepo->all()->pluck('name','id')->toArray();

        return view('backend.video.create', compact('courses', 'courseId'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($this->videoRepo->create(array_merge($request->all(), ['user_id'=>\Auth::id()]))) {
            return redirect()->route('admin.video.index');
        }
        return back()->withInput()->withErrors('保存失败！');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $video = $this->videoRepo->find($id);
        $courses = $this->courseRepo->all()->pluck('name','id')->toArray();
        return view('backend.video.edit', compact('video','courses'));
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
        $postData = $request->all();
        if (!empty($request->file())) {
            $fileInfo = $this->uploadManager->uploadFile($request->file('mp4_url'));
            if (empty($fileInfo)) {
                return back()->withInput()->withErrors('上传出错！');
            }
            $postData['mp4_url'] = $fileInfo['file_path'];
        }

        if ($this->videoRepo->update($postData, $id)) {
            return redirect()->route('admin.video.index');
        }

        return back()->withInput()->withErrors('保存失败！');
    }

    /**
     * 修改发布状态
     *
     * @param Request $request
     * @param         $id
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function publish(Request $request, $id)
    {
        $publishData = [
            'is_publish' => 1,
            'published_at' => Carbon::now()
        ];
        if ($this->videoRepo->update($publishData, $id)) {
            return response()->json(['ret' => 1]);
        }

        return response()->json(['ret' => 0]);
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
