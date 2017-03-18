<?php

namespace App\Http\Controllers\Backend;

use App\Contracts\Repositories\PostRepository;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Models\Post;
use Redirect, Input, Auth;

class PostController extends baseController
{

    protected $postRepo;

    public function __construct(PostRepository $posts)
    {
        $this->postRepo = $posts;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $posts = $this->postRepo->orderBy('created_at', 'desc')->paginate(10);

        return view('backend.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('backend.post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'ueditor' => 'required',
        ]);


        $page = new Post;
        $page->content = Input::get('editor');
        $page->user_id = Auth::user()->id;

        if ($page->save()) {
            return Redirect::to('admin/post');
        } else {
            return Redirect::back()->withInput()->withErrors('保存失败！');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
        return view('admin.post.edit')->withPage(Page::find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
        $this->validate($request, [
            'ueditor' => 'required',
        ]);

        $page = Post::find($id);
        $page->content = Input::get('ueditor');
        $page->user_id = Auth::user()->id;

        if ($page->save()) {
            return Redirect::to('admin/post');
        } else {
            return Redirect::back()->withInput()->withErrors('保存失败！');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
        $page = Post::find($id);
        $page->delete();

        return Redirect::to('admin/post');
    }

}
