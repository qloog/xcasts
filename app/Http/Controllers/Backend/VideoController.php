<?php

namespace App\Http\Controllers\Backend;

use App\Contracts\Repositories\VideoRepository;
use App\Services\UploadsManager;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class VideoController extends Controller
{

    protected $videoRepo;
    protected $uploadManager;

    public function __construct(VideoRepository $videos, UploadsManager $uploadsManager)
    {
        $this->videoRepo = $videos;
        $this->uploadManager = $uploadsManager;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $videos = $this->videoRepo->orderBy('course_id', 'desc')->orderBy('episode_id','desc')->paginate(10);

        return view('backend.video.index', compact('videos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.video.create');
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

        if ($this->videoRepo->create(array_merge($request->all(), ['mp4_url' => $fileInfo['file_path']]))) {
            return redirect()->route('admin.video.index');
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
        $video = $this->videoRepo->find($id);

        return view('backend.video.edit', compact('video'));
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

        if ($this->videoRepo->update($postData, $id)) {
            return redirect()->route('admin.video.index');
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
