<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Notice;
use App\Models\Ta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($class)
    {
        session_start();
        $_SESSION['classId']=$class;

        $course=Course::find($class);
        $notices=Notice::where('course_id',$class)->get();
        $ta=Ta::where('course_id',$class)->value('id');
        $_SESSION['ta']=$ta;

        return view('classes.index',['courses'=>$course,'notices'=>$notices,'class'=>$class,'ta'=>$ta]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    //公告
    public function courses($course_id)
    {
        //=== 使用id抓取課程
        $course = Course::find($course_id);

        $courses = Auth::user()->teacher()->first()->courses()->get()->
        unique('year')->sortbydesc('year');

        foreach ($courses as $data){
            $years[$data -> id] = $data -> year;
        }

        $notices = $course->notices()->get();

        return view('teacher.courses.notices',[
            'course' => $course,
            'notices' => $notices,
            'years' => $years,
        ]);
    }

    // === 教材區
    public function text_materials($course_id)
    {
        //=== 使用id抓取課程
        $course = Course::find($course_id);

        $courses = Auth::user()->teacher()->first()->courses()->get()->
        unique('year')->sortbydesc('year');

        foreach ($courses as $data){
            $years[$data -> id] = $data -> year;
        }

        $notices = $course->notices()->get();

        return view('teacher.courses.text_materials',[
            'course' => $course,
            'notices' => $notices,
            'years' => $years,
        ]);
    }

    // === 評量區
    public function home_works($course_id)
    {
        //=== 使用id抓取課程
        $course = Course::find($course_id);

        $courses = Auth::user()->teacher()->first()->courses()->get()->
        unique('year')->sortbydesc('year');

        foreach ($courses as $data){
            $years[$data -> id] = $data -> year;
        }

        $notices = $course->notices()->get();

        return view('teacher.courses.home_works',[
            'course' => $course,
            'notices' => $notices,
            'years' => $years,
        ]);
    }

    // === TA相關事務
    public function TA_offices($course_id)
    {
        //=== 使用id抓取課程
        $course = Course::find($course_id);

        $courses = Auth::user()->teacher()->first()->courses()->get()->
        unique('year')->sortbydesc('year');

        foreach ($courses as $data){
            $years[$data -> id] = $data -> year;
        }

        $notices = $course->notices()->get();

        return view('teacher.courses.TA_offices',[
            'course' => $course,
            'notices' => $notices,
            'years' => $years,
        ]);
    }
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
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        //
    }
}
