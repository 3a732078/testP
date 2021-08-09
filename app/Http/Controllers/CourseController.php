<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Notice;
use App\Models\Ta;
use App\Models\Teacher;
use App\Models\Textbook;
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

        return view('classes.index',[
            'course'=>$course,
            'notices'=>$notices,
            'class'=>$class,'ta'=>$ta,
            'courses'=>$course,
            ]
        );
    }

    // ======= year.index
    public function year(Request $request ,$year_id, $semester)
    {
        //        return $courses_year;
        $course = Course::all();
        //=== 抓取該課程的所有公告
        if (isset($courses)){
            //===先抓取所有的年度
            $courses = Course::all()->sortByDesc('year');
            foreach ($courses->unique('year') as $data) {
                $years[$data->id] = $data->year;
            }

            //===改抓取 該年度所有課程 使用 [ $year_id]
            $courses_year = User::find(Auth::id()) -> teacher()->first() -> courses()
                -> where('year',$year_id)-> where('semester' ,$semester) -> get()->sortbyDESC('classroom');

            //=== 預設顯示科系id較小的課程
            $course = $courses_year-> first();

            // === 抓取該課程的所有公告
            $notices = $course -> notices() -> get();

            return view('teacher.year.index',[
                'courses_year' => $courses_year,
                'notices' => $notices,
                'years' => $years,
                'course_id' => $course -> id,
            ]);

        }else{
            return back()->with('null',"該年度沒有課程");
        }

    }

    // ======= office.year.index
    public function office_year($year, $semester)
    {
        //        return $courses_year;
        $courses_year = User::find(Auth::id())->teacher() -> first()->courses()->get()
            ->where('year',$year)->where('semester',$semester);

//        return $courses;

        //=== 抓取該課程的所有公告
        if (isset($courses)){
            //===先抓取所有的年度
            $courses = Course::all()->sortByDesc('year');
            foreach ($courses->unique('year') as $data) {
                $years[$data->id] = $data->year;
            }

            //===改抓取 該年度所有課程 使用 [ $year_id]
            $courses_year = User::find(Auth::id()) -> teacher()->first() -> courses()
                -> where('year',$year)-> where('semester' ,$semester) -> get()->sortbyDESC('classroom');

            //=== 預設顯示科系id較小的課程
            $course = $courses_year-> first();

            // === 抓取該課程的所有公告
            $notices = $course -> notices() -> get();

//            return view('teacher.office.year.index',[
//                'courses_year' => $courses_year,
//                'notices' => $notices,
//                'years' => $years,
//                'course_id' => $course -> id,
//            ]);

        }else{
            return back()->with('null',"該年度沒有課程");
        }
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

        //使用該年度 抓取所有 該學期的 課程
        $courses_year = $courses_year = User::find(Auth::id())->teacher() -> first() -> courses()->get()
            ->where('year',$course -> year)->where('semester',$course -> semester)-> sortbyDESC('classroom');

        //抓取上下學期
        if($course -> semester == 1){
            $semester = '上學期';
        }else{
            $semester = '下學期';
        }

        return view('teacher.courses.notices',[
            'year_semester' => $course -> year . "學年度" . $semester,
            'courses_year' => $courses_year,
            'notices' => $notices,
            'course' => $course,
            'course_id' => $course_id,
        ]);
//        return $courses_year;

    }

    // ============  office 公告
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
        $courses_year = $courses_year = User::find(Auth::id())->teacher() -> first() -> courses()->get()
            ->where('year',$course -> year)->where('semester',$course -> semester)-> sortbyDESC('classroom');

        //抓取上下學期
        if($course -> semester == 1){
            $semester = '上學期';
        }else{
            $semester = '下學期';
        }

        return view('teacher.office.courses.notices',[
            'year_semester' => $course -> year . "學年度" . $semester,
            'courses_year' => $courses_year,
            'notices' => $notices,
            'course_id' => $course_id,
            'course' => $course,
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
        $textbooks = $course->textbooks()->get();

        //使用該年度抓取所有課程
        $courses_year = $courses_year = User::find(Auth::id())->teacher() -> first() -> courses()->get()
            ->where('year',$course -> year)->where('semester',$course -> semester)-> sortbyDESC('classroom');

        //        return $courses_year;

        //抓取上下學期
        if($course -> semester == 1){
            $semester = '上學期';
        }else{
            $semester = '下學期';
        }

        return view('teacher.courses.text_materials',[
            'year_semester' => $course -> year . "學年度" . $semester,
            'textbooks' => $textbooks,
            'courses_year' => $courses_year,
            'course_id' => $course_id,
            'course' => $course
        ]);
    }

    // ========== 教材區
    public function office_text_materials($course_id)
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
        $courses_year = $courses_year = User::find(Auth::id())->teacher() -> first() -> courses()->get()
            ->where('year',$course -> year)->where('semester',$course -> semester)-> sortbyDESC('classroom');

        //        return $courses_year;

        //抓取上下學期
        if($course -> semester == 1){
            $semester = '上學期';
        }else{
            $semester = '下學期';
        }

        return view('teacher.office.courses.text_materials',[
            'year_semester' => $course -> year . "學年度" . $semester,
            'notices' => $notices,
            'courses_year' => $courses_year,
            'course_id' => $course_id,
            'course' => $course,
        ]);
    }

    // === 瀏覽筆記
    public function BN($course_id)
    {
        // === $years寫入資料
        $courses = \App\Models\Course::all()-> sortByDesc('year');
        foreach ($courses->unique('year') as $course) {
            $years[] = $course -> year;
        }

        //使用該年度抓取所有課程
        $courses_year = $courses_year = User::find(Auth::id())->teacher() -> first() -> courses()->get()
            ->where('year',$course -> year)->where('semester',$course -> semester)-> sortbyDESC('classroom');

        //使用course_id抓取該課堂所有 [教材]
        $text_materials = Textbook::where('course_id',$course_id)->get();
        //個別教材抓取所有筆記 [包括未分享]
        foreach ($text_materials as $text_material){
            $notes[] = $text_material -> notes() -> get();
        }

        //抓取上下學期
        if($course -> semester == 1){
            $semester = '上學期';
        }else{
            $semester = '下學期';
        }

        return view('teacher.courses.BN',[
            'year_semester' => $course -> year . "學年度" . $semester,
            'courses_year' => $courses_year,
            'course_id' => $course_id,
            'course' => $course,
        ]);
    }

    // === 評量區
    public function office_BN($course_id)
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
        $courses_year = $courses_year = User::find(Auth::id())->teacher() -> first() -> courses()->get()
            ->where('year',$course -> year)->where('semester',$course -> semester)-> sortbyDESC('classroom');

        //        return $courses_year;

        //抓取上下學期
        if($course -> semester == 1){
            $semester = '上學期';
        }else{
            $semester = '下學期';
        }

//        return view('teacher.courses.home_works',[
//            'year_semester' => $course -> year . "學年度" . $semester,
//            'courses_year' => $courses_year,
//            'notices' => $notices,
//            'course_id' => $course_id,
//        ]);
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
        $courses_year = $courses_year = User::find(Auth::id())->teacher() -> first() -> courses()->get()
            ->where('year',$course -> year)->where('semester',$course -> semester)-> sortbyDESC('classroom');

        //抓取上下學期
        if($course -> semester == 1){
            $semester = '上學期';
        }else{
            $semester = '下學期';
        }

        $TA = TA::where('course_id',$course_id)->get();

        return view('teacher.courses.TA_office',[
            'year_semester' => $course -> year . "學年度" . $semester,
            'courses_year' => $courses_year,
            'notices' => $notices,
            'course_id' => $course_id,
            'TA' => $TA,
            'course' => $course,
            ]);
    }

    // === TA相關事務
    public function office_TA_office($course_id)
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
        $courses_year = $courses_year = User::find(Auth::id())->teacher() -> first() -> courses()->get()
            ->where('year',$course -> year)->where('semester',$course -> semester)-> sortbyDESC('classroom');

        //抓取上下學期
        if($course -> semester == 1){
            $semester = '上學期';
        }else{
            $semester = '下學期';
        }

        $TA = TA::where('course_id',$course_id)->get();

        return view('teacher.office.courses.TA_office',[
            'year_semester' => $course -> year . "學年度" . $semester,
            'courses_year' => $courses_year,
            'notices' => $notices,
            'course_id' => $course_id,
            'TA' => $TA,
            'course' => $course,
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
