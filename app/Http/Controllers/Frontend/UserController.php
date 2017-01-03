<?php

namespace App\Http\Controllers\Frontend;

use App\Contracts\Repositories\UserRepository;
use App\Services\UploadsManager;
use Ender\UEditor\Uploader\Upload;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{

    protected $userRepository;
    protected $uploadManager;

    public function __construct(UserRepository $userRepository, UploadsManager $uploadsManager)
    {
        $this->userRepository = $userRepository;
        $this->uploadManager = $uploadsManager;
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = $this->userRepository->find($id);

        $topics = $this->userRepository->getTopicsByUserId($user->id, 20);

        $replies = $this->userRepository->getRepliesByUserId($user->id, 20);

        return view('frontend.user.detail', compact('user', 'topics', 'replies'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = $this->userRepository->find($id);

        return view('frontend.user.edit', compact('user'));
    }

    public function editAvatar($id)
    {
        $user = $this->userRepository->find($id);

        return view('frontend.user.avatar', compact('user'));
    }

    public function updateAvatar(Request $request, $id)
    {
        if (!$request->hasFile('avatar')) {
            return Redirect::back()->withInput()->withErrors('未添加上传图片！');

        }
        $imageInfo = $this->uploadManager->uploadImage($request->file('avatar'));
        if (empty($imageInfo)) {
            return Redirect::back()->withInput()->withErrors('上传出错！');
        }

        if ($this->userRepository->update(['avatar' => $imageInfo['image_path']], $id, false)) {
            return redirect()->route('user.avatar.edit', $id);
        }
        return Redirect::back()->withInput()->withErrors('保存失败！');

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
        if ($this->userRepository->update($request->except(['name','email']), $id, false)) {
            return redirect()->route('user.edit', $id);
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

    public function topics($id)
    {
        $user = $this->userRepository->find($id);
        $topics = $this->userRepository->getTopicsByUserId($id, 15);

        return view('frontend.user.topics', compact('user','topics'));
    }

    public function replies($id)
    {
        $user = $this->userRepository->find($id);
        $replies = $this->userRepository->getRepliesByUserId($id, 15);

        return view('frontend.user.replies', compact('user','replies'));
    }

    public function votes($id)
    {
        $user = $this->userRepository->find($id);
        $votes = $this->userRepository->getVotesByUserId($id, 15);

        return view('frontend.user.votes', compact('user','votes'));
    }

    public function following($id)
    {
        $user = $this->userRepository->find($id);
        $followings = $this->userRepository->getFollowingsByUserId($id, 15);

        return view('frontend.user.following', compact('user','followings'));
    }

    public function followers($id)
    {
        $user = $this->userRepository->find($id);
        $followers = $this->userRepository->getFollowingsByUserId($id, 15);

        return view('frontend.user.followers', compact('user','followers'));
    }
}
