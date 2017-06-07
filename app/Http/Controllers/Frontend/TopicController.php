<?php

namespace App\Http\Controllers\Frontend;

use App\Contracts\Repositories\ReplyRepository;
use App\Contracts\Repositories\TopicRepository;
use App\Contracts\Repositories\VoteRepository;
use App\Models\Category;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Qiniu\Auth;
use Redirect;

class TopicController extends Controller
{
    use ValidatesRequests;

    /**
     * @var TopicRepository
     */
    protected $topicRepo;
    protected $replyRepo;
    protected $voteRepo;

    /**
     * TopicController constructor.
     * @param TopicRepository $topics
     * @param ReplyRepository $replies
     * @param VoteRepository  $votes
     */
    public function __construct(TopicRepository $topics, ReplyRepository $replies, VoteRepository $votes)
    {
        $this->topicRepo = $topics;
        $this->replyRepo = $replies;
        $this->voteRepo = $votes;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $topics = $this->topicRepo->orderBy('created_at', 'desc')->paginate(20);
        return view('frontend.topic.index', compact('topics'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //todo move serice or repository
        $categories = Category::all();

        return view('frontend.topic.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'category' => 'required',
            'title' => 'required|unique:forum_topics|max:255',
            'body' => 'required'
        ]);

        if ($this->topicRepo->create($request->all())) {
            return redirect()->route('topic.index');
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
        $topic = $this->topicRepo->find($id);

        $replies = $this->replyRepo->orderBy('created_at', 'asc')->findWhere(['topic_id' => $id]);
        $votedUsers = $this->topicRepo->voteBy($id);

        $this->topicRepo->increment($id, 'view_count');

        return view('frontend.topic.detail', compact('topic', 'replies','votedUsers'));
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

    public function upVote($id)
    {
        $topic = $this->topicRepo->find($id);
        $this->voteRepo->topicUpVote($topic);

        return response([
            'code' => 200,
            'vote_count' => $topic->vote_count
        ]);
    }

    public function downVote($id)
    {
        $topic = $this->topicRepo->find($id);
        $this->voteRepo->topicDownVote($topic);

        return response([
            'code' => 200,
            'vote_count' => $topic->vote_count
        ]);
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
