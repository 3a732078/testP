<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Department;
use App\Models\Notice;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //最新公告
    public function index()
    {

        return view('teacher.index',[

        ]);
    }

    public function office_index(){


        return view('teacher.office.index',[

        ]);
    }

    public function course(Request $request,$course_id){

        //=== 使用id抓取課程
        $course = Course::find($course_id);

        $courses = Auth::user()->teacher()->first()->courses()->get()->
        unique('year')->sortbydesc('year');

        foreach ($courses as $data){
            $years[] = $data -> year;
        }

        //抓取該課程所有公告
        $notices = $course->notices()->get();

//        return $notices;

        return view('teacher.courses.notices',[
            'course' => $course,
            'notices' => $notices,
            'years' => $years,
        ]);
    }

    //系統建議
    public function problem(){

        //=== 抓取該老師所有課程
        $courses = User::find(Auth::id())->teacher()->first()->courses()->get()->
        unique('year')->sortbydesc('year');

        // === 寫入資料
        foreach ($courses as $course) {
            $years[$course->id] = $course->year;
        }

        return view('teacher.problem',[
            'courses'=>$courses,
            'years' => $years,
        ]);
    }

    //行事曆
    public function behave(){

        //=== 抓取該老師所有課程
        $courses = User::find(Auth::id())->teacher()->first()->courses()->get()->
        unique('year')->sortbydesc('year');

        // === 寫入資料
        foreach ($courses as $course) {
            $years[$course->id] = $course->year;
        }

        return view('teacher.behave',[
            'courses'=>$courses,
            'years' => $years,
        ]);
    }

    //系統建議
    public function system_suggest(){
        //=== 抓取該老師所有課程
        $courses = User::find(Auth::id())->teacher()->first()->courses()->get()->
        unique('year')->sortbydesc('year');

        // === 寫入資料
        foreach ($courses as $course) {
            $years[$course->id] = $course->year;
        }

        return view('teacher.system_suggest',[
            'courses'=>$courses,
            'years' => $years,
        ]);
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
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function show(Teacher $teacher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function edit(Teacher $teacher)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Teacher $teacher)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Teacher $teacher)
    {
        //
    }

    public function TA(){
        $courses = User::find(Auth::id())->teacher()->first()->courses()->get();

        return view('teacher.ta',[
            'courses' => $courses,
        ]);
    }

    //課程複製
    public function office_semester(Teacher $teacher){
        // === $years寫入資料
        $courses = \App\Models\Course::all()-> sortByDesc('year');
        foreach ($courses->unique('year') as $course) {
            $years[] = $course -> year;
        }

        //        return $courses_year;

        return view('teacher.office.semester',[

        ]);
    }

    public function test(Request $request,Teacher $teacher)
    {

        $courses = \Illuminate\Support\Facades\Auth::user()->teacher()-> first() -> courses() -> get() ;
        $course_id = $courses -> first() -> id;
        return $request;


//        return view('teacher.data');
    }


}
