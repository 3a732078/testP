<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Notice;
use App\Models\Teacher;
use App\Models\User;
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
        // === $years寫入資料
        $courses = \App\Models\Course::all()-> sortByDesc('year');
        foreach ($courses->unique('year') as $course) {
            $years[] = $course -> year;
        }

        //抓取該公告
        $notice = Notice::find($notice_id);

        //使用該年度抓取所有課程
        $course = Course::find($course_id);
        $courses_year = User::find(Auth::id())->teacher() -> first() -> courses()->get()->where('year',$course -> year)-> sortby('classroom');

        return view('teacher.courses.notice.show',[
            'years' => $years,
            'courses_year' => $courses_year,
            'course_id' => $course_id,
            'notice' => $notice,
        ]);

//        return $courses_year;


    }

    public function teacher_office_notice_show($course_id,$notice_id)
    {
        // === $years寫入資料
        $courses = \App\Models\Course::all()-> sortByDesc('year');
        foreach ($courses->unique('year') as $course) {
            $years[] = $course -> year;
        }

        //抓取該公告
        $notice = Notice::find($notice_id);

        //使用該年度抓取所有課程
        $course = Course::find($course_id);
        $courses_year = User::find(Auth::id())->teacher() -> first() -> courses()->get()->where('year',$course -> year)-> sortby('classroom');

        return view('teacher.office.courses.notice.show',[
            'years' => $years,
            'courses_year' => $courses_year,
            'course_id' => $course_id,
            'notice' => $notice,
        ]);

//        return $courses_year;
    }

    public function teacher_office_notice_edit($course_id,$notice_id)
    {
        // === $years寫入資料
        $courses = \App\Models\Course::all()-> sortByDesc('year');
        foreach ($courses->unique('year') as $course) {
            $years[] = $course -> year;
        }

        //抓取該公告
        $notice = Notice::find($notice_id);

        //使用該年度抓取所有課程
        $course = Course::find($course_id);
        $courses_year = User::find(Auth::id())->teacher() -> first() -> courses()->get()->where('year',$course -> year)-> sortby('classroom');

        return view('teacher.office.courses.notice.edit',[
            'years' => $years,
            'courses_year' => $courses_year,
            'course_id' => $course_id,
            'notice' => $notice,
        ]);

//        return $courses_year;
    }

    public function teacher_office_notice_store($course_id,$notice_id)
    {
        // === $years寫入資料
        $courses = \App\Models\Course::all()-> sortByDesc('year');
        foreach ($courses->unique('year') as $course) {
            $years[] = $course -> year;
        }

        //抓取該公告
        $notice = Notice::find($notice_id);

        //使用該年度抓取所有課程
        $course = Course::find($course_id);
        $courses_year = User::find(Auth::id())->teacher() -> first() -> courses()->get()->where('year',$course -> year)-> sortby('classroom');

        return view('teacher.office.courses.notice.edit',[
            'years' => $years,
            'courses_year' => $courses_year,
            'course_id' => $course_id,
            'notice' => $notice,
        ]);

//        return $courses_year;
    }
}
