<?php

namespace App\Http\Controllers\Frontend;

use App\Contracts\Repositories\UserRepository;
use App\Http\Requests\ResetPasswordRequest;
use App\Services\UploadsManager;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Laracasts\Flash\Flash;

class UserController extends Controller
{

    protected $userRepo;
    protected $uploadManager;

    public function __construct(UserRepository $userRepo, UploadsManager $uploadsManager)
    {
        $this->userRepo = $userRepo;
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
        $user = $this->userRepo->find($id);

        $topics = $this->userRepo->getTopicsByUserId($user->id, 20);

        $replies = $this->userRepo->getRepliesByUserId($user->id, 20);

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
        $user = $this->userRepo->find($id);

        return view('frontend.user.edit', compact('user'));
    }

    public function editAvatar($id)
    {
        $user = $this->userRepo->find($id);

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

        if ($this->userRepo->update(['avatar' => $imageInfo['image_path']], $id, false)) {
            return redirect()->route('user.edit_avatar', $id);
        }

        return Redirect::back()->withInput()->withErrors('保存失败！');
    }

    public function editPassword($id)
    {
        $user = $this->userRepo->find($id);
        // use user policy
        $this->authorize('update', $user);

        return view('frontend.user.edit_password', compact('user'));
    }

    public function updatePassword(Request $request, $id)
    {
        $this->validate($request, [
            'password' => 'required|confirmed|min:6',
        ]);

        $user = $this->userRepo->find($id);
        $this->authorize('update', $user);

        if ($this->userRepo->update(['password' => bcrypt($request->password)], $id, false)) {
             Flash::success('修改成功');
             return redirect(route('user.edit_password', $id));
        }
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
        if ($this->userRepo->update($request->except(['email']), $id, false)) {
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
        $user = $this->userRepo->find($id);
        $topics = $this->userRepo->getTopicsByUserId($id, 15);

        return view('frontend.user.topics', compact('user','topics'));
    }

    public function replies($id)
    {
        $user = $this->userRepo->find($id);
        $replies = $this->userRepo->getRepliesByUserId($id, 15);

        return view('frontend.user.replies', compact('user','replies'));
    }

    public function votes($id)
    {
        $user = $this->userRepo->find($id);
        $topics = $this->userRepo->getVotesByUserId($id, 15);

        return view('frontend.user.votes', compact('user','topics'));
    }

    /**
     * 我关注的用户
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function following($id)
    {
        $user = $this->userRepo->find($id);
        $followings = $this->userRepo->getFollowingsByUserId($id, 15);

        return view('frontend.user.following', compact('user','followings'));
    }

    /**
     * 关注我的用户，即粉丝
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function followers($id)
    {
        $user = $this->userRepo->find($id);
        $followers = $this->userRepo->getFollowersByUserId($id, 15);

        return view('frontend.user.followers', compact('user','followers'));
    }

    public function follow($id)
    {
        if ($this->userRepo->followUser($id)) {
            return response()->json(['code' => 200, 'msg' => 'success']);
        } else {
            // TODO add msg
            return response()->json(['code' => 400, 'msg' => 'error']);
        }
    }
}
