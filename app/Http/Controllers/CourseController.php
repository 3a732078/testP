<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Notice;
use App\Models\Ta;
use App\Models\Teacher;
use App\Models\User;
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

        return view('classes.index',['course'=>$course,'notices'=>$notices,'class'=>$class,'ta'=>$ta,'courses'=>$course,]);
    }

    // ======= year.index
    public function year(Request $request , $year_id)
    {

        //===先抓取所有的年度
        $courses = Course::all()->sortByDesc('year');
        foreach ($courses->unique('year') as $data) {
            $years[$data->id] = $data->year;
        }

        //===改抓取 該年度所有課程 使用 [ $year_id]
        $courses = User::find(Auth::id()) -> teacher()->first() -> courses() -> where('year',$year_id)->get()->sortby('classroom');

        //=== 預設顯示科系id較小的課程
        $course = $courses-> first();

        //=== 抓取該課程的所有公告
        $notices = $course->notices()->get();

//        return $notices;

        return view('teacher.year.index',[
            'courses_year' => $courses,
            'notices' => $notices,
            'years' => $years,
            'course_id' => $course -> id,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // ============  公告
    public function courses($course_id)
    {
        // === $years寫入資料
        $courses = \App\Models\Course::all()-> sortByDesc('year');
        foreach ($courses->unique('year') as $course) {
            $years[] = $course -> year;
        }

        //抓取該課程所有公告
        $course = Course::find($course_id);
        $notices = $course->notices()->get();

        //使用該年度抓取所有課程
        $courses_year = User::find(Auth::id())->teacher() -> first() -> courses()->get()->where('year',$course -> year)-> sortby('classroom');

        return view('teacher.courses.notices',[
            'courses_year' => $courses_year,
            'notices' => $notices,
            'years' => $years,
            'course_id' => $course_id,
        ]);


//        return $courses_year;

    }

    public function office_courses($course_id)
    {
        // === $years寫入資料
        $courses = \App\Models\Course::all()-> sortByDesc('year');
        foreach ($courses->unique('year') as $course) {
            $years[] = $course -> year;
        }

        //抓取該課程所有公告
        $course = Course::find($course_id);
        $notices = $course->notices()->get();

        //使用該年度抓取所有課程
        $courses_year = User::find(Auth::id())->teacher() -> first() -> courses()->get()->where('year',$course -> year)-> sortby('classroom');

        return view('teacher.office.courses.notices',[
            'courses_year' => $courses_year,
            'notices' => $notices,
            'years' => $years,
            'course_id' => $course_id,
        ]);


//        return $courses_year;

    }

    // ========== 教材區
    public function text_materials($course_id)
    {
        // === $years寫入資料
        $courses = \App\Models\Course::all()-> sortByDesc('year');
        foreach ($courses->unique('year') as $course) {
            $years[] = $course -> year;
        }

        //抓取該課程所有公告
        $course = Course::find($course_id);
        $notices = $course->notices()->get();

        //使用該年度抓取所有課程
        $courses_year = User::find(Auth::id())->teacher() -> first() -> courses()->get()->where('year',$course -> year)-> sortby('classroom');

//        return $courses_year;

        return view('teacher.courses.text_materials',[
            'courses_year' => $courses_year,
            'notices' => $notices,
            'years' => $years,
            'course_id' => $course_id,
        ]);
    }

    // === 評量區
    public function home_works($course_id)
    {
        // === $years寫入資料
        $courses = \App\Models\Course::all()-> sortByDesc('year');
        foreach ($courses->unique('year') as $course) {
            $years[] = $course -> year;
        }

        //抓取該課程所有公告
        $course = Course::find($course_id);
        $notices = $course->notices()->get();

        //使用該年度抓取所有課程
        $courses_year = User::find(Auth::id())->teacher() -> first() -> courses()->get()->where('year',$course -> year)-> sortby('classroom');

//        return $courses_year;

        return view('teacher.courses.home_works',[
            'courses_year' => $courses_year,
            'notices' => $notices,
            'years' => $years,
            'course_id' => $course_id,
        ]);
    }

    // === TA相關事務
    public function TA_office($course_id)
    {
        // === $years寫入資料
        $courses = \App\Models\Course::all()-> sortByDesc('year');
        foreach ($courses->unique('year') as $course) {
            $years[] = $course -> year;
        }

        //抓取該課程所有公告
        $course = Course::find($course_id);
        $notices = $course->notices()->get();

        //使用該年度抓取所有課程
        $courses_year = User::find(Auth::id())->teacher() -> first() -> courses()->get()->where('year',$course -> year)-> sortby('classroom');

        return view('teacher.courses.TA_office',[
            'courses_year' => $courses_year,
            'notices' => $notices,
            'years' => $years,
            'course_id' => $course_id,
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
