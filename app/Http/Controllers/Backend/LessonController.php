<?php

namespace App\Http\Controllers\Backend;

use App\Contracts\Repositories\LessonRepository;
use App\Services\UploadsManager;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class LessonController extends Controller
{

    protected $lessonRepo;
    protected $uploadManager;

    public function __construct(LessonRepository $lessons, UploadsManager $uploadsManager)
    {
        $this->lessonRepo = $lessons;
        $this->uploadManager = $uploadsManager;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lessons = $this->lessonRepo->orderBy('series_id', 'desc')->orderBy('episode_id','desc')->paginate(10);

        return view('backend.lesson.index', compact('lessons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.lesson.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(empty($request->file())) {
            $fileInfo = $this->uploadManager->uploadImage($request->file('mp4_url'));
            if (empty($fileInfo)) {
                return Redirect::back()->withInput()->withErrors('上传出错！');
            }
        }

        if ($this->lessonRepo->create(array_merge($request->all(), ['mp4_url' => $fileInfo['file_path']]))) {
            return redirect()->route('admin.lesson.index');
        }
        return Redirect::back()->withInput()->withErrors('保存失败！');
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
        $video = $this->lessonRepo->find($id);

        return view('backend.lesson.edit', compact('video'));
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
                return Redirect::back()->withInput()->withErrors('上传出错！');
            }
            $postData['mp4_url'] = $fileInfo['file_path'];
        }

        if ($this->lessonRepo->update($postData, $id)) {
            return redirect()->route('admin.lesson.index');
        }
        return Redirect::back()->withInput()->withErrors('保存失败！');
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
