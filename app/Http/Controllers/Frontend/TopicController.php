<?php

namespace App\Http\Controllers\Frontend;

use App\Contracts\Repositories\ReplyRepository;
use App\Contracts\Repositories\TopicRepository;
use App\Contracts\Repositories\VoteRepository;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Redirect;

class TopicController extends Controller
{
    /**
     * @var TopicRepository
     */
    protected $topics;
    protected $replies;
    protected $votes;

    /**
     * TopicController constructor.
     * @param TopicRepository $topics
     * @param ReplyRepository $replies
     * @param VoteRepository  $votes
     */
    public function __construct(TopicRepository $topics, ReplyRepository $replies, VoteRepository $votes)
    {
        $this->topics = $topics;
        $this->replies = $replies;
        $this->votes = $votes;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $topics = $this->topics->orderBy('created_at', 'desc')->paginate(10);
        return view('frontend.topic.index', compact('topics'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('frontend.topic.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($this->topics->create($request->all())) {
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
        $topic = $this->topics->find($id);

        $replies = $this->replies->all();

        return view('frontend.topic.detail', compact('topic', 'replies'));
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

    public function voteUp($id)
    {
        $topic = $this->topics->find($id);
        $this->votes->topicUpVote($topic);

        return response([
            'vote-up' => true,
            'vote_count' => $topic->vote_count
        ]);
    }

    public function voteDown($id)
    {
        $topic = $this->topics->find($id);
        $this->votes->topicDownVote($topic);

        return response([
            'vote-down' => true,
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
