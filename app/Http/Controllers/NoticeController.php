<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Notice;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoticeController extends Controller
{
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
     * @param  \App\Models\Notice  $notice
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        session_start();
        $class=$_SESSION['classId'];
        $ta=$_SESSION['ta'];

        $notice=Notice::find($id);
        return view('notices.show',['notice'=>$notice,'class'=>$class,'ta'=>$ta]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Notice  $notice
     * @return \Illuminate\Http\Response
     */
    public function edit(Notice $notice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Notice  $notice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Notice $notice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Notice  $notice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Notice $notice)
    {
        //
    }

    public function teacher_notice_show($course_id,$notice_id)
    {
        # yearslist
            //先抓取該老師所有課程 ---- 排序
        $courses = Teacher::find(Auth::id())->courses()->get()->sortbydesc('year');
        //寫入資料
        foreach ($courses->unique('year') as $course){
            $years[]= $course -> year;
        }

        # courses_year
            // 使用$course_id 抓取該課程的年度
        $course = Course::find($course_id);
        $courses_year = $courses -> where('year',$course -> year);

        # notice
        $notice = Notice::find($notice_id);

        return view('teacher.courses.notice.show',[
            'years' => $years,
            'courses_year' => $courses_year,
            'course_id' => $course_id,
            'notice' => $notice,
        ]);

//        return $courses_year;


    }
}
