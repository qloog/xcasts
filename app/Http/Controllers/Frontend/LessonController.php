<?php

namespace App\Http\Controllers\Frontend;

use App\Contracts\Repositories\CommentRepository;
use App\Contracts\Repositories\LessonRepository;
use App\Contracts\Repositories\SeriesRepository;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class LessonController extends Controller
{
    protected $seriesRepo;
    protected $lessonRepo;
    protected $commentRepo;

    public function __construct(SeriesRepository $series, LessonRepository $lessons, CommentRepository $comments)
    {
        $this->seriesRepo = $series;
        $this->lessonRepo = $lessons;
        $this->commentRepo = $comments;
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
     * @param $slug
     * @param $episodeId
     * @return \Illuminate\Http\Response
     */
    public function show($slug, $episodeId)
    {
        $series = $this->seriesRepo->findByField('slug', $slug);
        $series = $series[0];

        $lessons = $this->lessonRepo->findWhere(['series_id' => $series->id, 'episode_id' => $episodeId]);
        $lesson = $lessons[0];
        $comments = $this->commentRepo
            ->orderBy('created_at','desc')
            ->findWhere(['type' => 'lesson', 'relation_id' => $lesson->id])
            ->all();

        return view('frontend.lesson.detail', compact('series', 'lesson', 'comments'));
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
