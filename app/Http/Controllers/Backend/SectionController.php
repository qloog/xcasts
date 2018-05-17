<?php

namespace App\Http\Controllers\Backend;

use App\Models\Course;
use App\Models\Section;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $courseId = $request->get('course_id', 0);
        $sections = Section::where('course_id', $courseId)->get();

        return view('backend.section.index', compact('sections', 'courseId'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $courseId = $request->get('course_id');

        $course = Course::find($courseId);

        return view('backend.section.create', compact('course'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $result = Section::create($data);

        if ($result) {
            return redirect()->route('admin.section.index', ['course_id' => $data['course_id']]);
        }

        return  redirect()->route('admin.section.create', ['course_id' => $data['course_id']]);
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
     * @param Request $request
     * @param  int    $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $courseId = $request->get('course_id');
        $course = Course::find($courseId);
        $section = Section::find($id);

        return view('backend.section.edit', compact('section', 'course'));
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
        $data = $request->except(['_token', '_method']);

        $result = Section::where('id', $id)->update($data);

        if ($result) {
            return redirect()->route('admin.section.index', ['course_id' => $data['course_id']]);
        }

        return  redirect()->route('admin.section.edit', ['id' => $id, 'course_id' => $data['course_id']]);
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
