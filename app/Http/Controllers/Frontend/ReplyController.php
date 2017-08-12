<?php

namespace App\Http\Controllers\Frontend;

use App\Contracts\Repositories\ReplyRepository;
use App\Contracts\Repositories\VoteRepository;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReplyController extends Controller
{

    use ValidatesRequests;

    protected $repository;
    protected $voteRepo;

    public function __construct(ReplyRepository $repository, VoteRepository $votes)
    {
        $this->repository = $repository;
        $this->voteRepo = $votes;
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
        $this->validate($request, [
            'topic_id' => 'required',
            'body' => 'required'
        ]);

        if ($this->repository->create($request->all())) {
            return redirect()->route('topics.show', $request->get('topic_id'));
        }
        return Redirect::back()->withInput()->withErrors('保存失败！');
    }

    public function vote($id)
    {
        $reply = $this->repository->find($id);

        if ($this->voteRepo->replyUpVote($reply)) {
            return response()->json(['code' => 200 , 'msg' => 'ok', 'count' => $reply->vote_count + 1]);
        }

        return response()->json(['code' => 400 , 'msg' => 'error']);
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
