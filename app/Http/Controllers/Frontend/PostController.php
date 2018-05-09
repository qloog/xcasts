<?php

namespace App\Http\Controllers\Frontend;

use App\Contracts\Repositories\CommentRepository;
use App\Contracts\Repositories\PostRepository;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{

    protected $postRepo;
    protected $commentRepo;

    public function __construct(PostRepository $posts, CommentRepository $comments)
    {
        $this->postRepo = $posts;
        $this->commentRepo = $comments;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $posts = $this->postRepo->orderBy('created_at', 'desc')->paginate(10);
        $topPosts = Post::where('status',1)->orderBy('view_count', 'desc')->take(10)->get();
        $posts = Post::where('status',1)->orderBy('created_at', 'desc')->paginate(10);

        return view('frontend.post.index', compact('posts', 'topPosts'));
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
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $post = $this->postRepo->findByField('slug',$slug)->first();

        $comments = $this->commentRepo
            ->orderBy('created_at','desc')
            ->findWhere(['type' => 'blog', 'relation_id' => $post->id])
            ->all();

        $this->postRepo->increment($post->id, 'view_count', 1);

        return view('frontend.post.show', compact('post','comments'));
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
