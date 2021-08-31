<?php

namespace App\Http\Controllers;

use App\Models\Calendar;
use App\Models\Course;
use App\Models\Department;
use App\Models\Information;
use App\Models\Notice;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Textbook;
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
        $informations = Information::all() -> sortByDesc('created_at');
        $calendars = Calendar::all() -> sortByDesc('created_at');

        return view('teacher.index',[
            'informations' => $informations,
            'calendars' => $calendars,
        ]);
    }

    //檢視最新公告
    public function information_show($id){
        $information  = Information::find($id);
        return view('teacher.information',[
            'information' => $information,
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
    public function office_semester(Request $request,Teacher $teacher){
        // === $years寫入資料
        $courses = Auth::user() -> teacher -> courses() -> get() -> sortByDesc('year');
        foreach ($courses->unique('year') as $course) {
            $years[] = $course -> year;
        }

        return view('teacher.office.semester',[
            'courses' => $courses,
        ]);
    }

    //查找年
    public function semester_year(Request $request,Teacher $teacher,$year)
    {
        // === $years寫入資料
        $courses = Auth::user()->teacher->courses()->get() -> where('year', $year);
        foreach ($courses->unique('year') as $course) {
            $years[] = $course->year;
        }


        return view('teacher.office.semester', [
            'courses' => $courses,
        ]);
    }

    //查找學期
    public function semester_semester(Request $request,Teacher $teacher,$semester){
        // === $years寫入資料
        $courses = Auth::user() -> teacher -> courses() -> get () -> where('semester' , $semester);
        foreach ($courses->unique('year') as $course) {
            $years[] = $course -> year;
        }

        return view('teacher.office.semester',[
            'courses' => $courses,
        ]);
    }

    //從...複製
    public function semester_CB(Request $request,Teacher $teacher,$course_id){
        // === $years寫入資料
        $courses = Course::all() -> sortBydesc('year');
        $course = Course::find($course_id);
        $i = 0;
        foreach ($courses as $data){
            if ($data -> id == $course -> id){
                $count = $i;
            }
            $i ++;
        }
        unset($courses[$count]);
        return view('teacher.office.clone_by',[
            'courses' => $courses,
            'course' => $course,

        ]);
    }

    //從...複製  --> 查找年
    public function CB_year(Request $request,Teacher $teacher,$course_id,$year)
    {
        $courses = Auth::user()->teacher->courses()->get() -> where('year', $year);
        foreach ($courses->unique('year') as $course) {
            $years[] = $course->year;
        }
        $course = Course::find($course_id);

        return view('teacher.office.clone_by', [
            'courses' => $courses,
            'course' => $course,
        ]);
    }

    //從...複製  --> 查找學期
    public function CB_semester(Request $request,Teacher $teacher,$course_id,$semester){
        $courses = Auth::user() -> teacher -> courses() -> get () -> where('semester' , $semester) -> sortbyDesc('year');
        foreach ($courses->unique('year') as $course) {
            $years[] = $course -> year;
        }
        $course = Course::find($course_id);

        return view('teacher.office.clone_by',[
            'courses' => $courses,
            'course' => $course,

        ]);

    }//從...複製  --> 複合查找
    public function CB_complex(Request $request,Teacher $teacher,$course_id,$year,$semester){
        $courses = Auth::user() -> teacher -> courses() -> get () -> where('semester' , $semester) -> sortbyDesc('year');
        foreach ($courses->unique('year') as $course) {
            $years[] = $course -> year;
        }
        $course = Course::find($course_id);

        return view('teacher.office.clone_by',[
            'courses' => $courses,
            'course' => $course,

        ]);

    }

    //從...複製  --> 檢視教材
    public function CB_show(Request $request,Teacher $teacher,$course_id,$BC_id){
        $course = Course::find($course_id);
        $clone_by = Course::find($BC_id);
        $text_materials = $clone_by -> textbooks() -> get();

        return view('teacher.office.clone_by.show',[
            'text_materials' => $text_materials,
            'course' => $course,
            'clone_by' => $clone_by,
        ]);
    }

    //從...複製  --> 確定複製
    public function CB_clone(Request $request,Teacher $teacher,$course_id,$BC_id){
        $course = Course::find($course_id);
        $by_course = Course::find($BC_id);
        $courses = Auth::user() -> teacher -> courses() -> get() -> sortbyDESC('year');
        if($BC_id != $course_id){
            Textbook::where('course_id',$course_id) -> delete();

            $by_course = Textbook::where('course_id',$BC_id) -> get();
            foreach ($by_course as $data){
                $to_course = new Textbook ;
                $to_course ->course_id = $course_id;
                $to_course -> name = $data -> name;
                $to_course-> path = $data -> path;
                $to_course -> save();
            }
        }

        return redirect() -> route('teacher.office.courses.text_materials',[$course_id]) -> withStatus('複製成功');
    }

    //從...複製  --> 新增
    public function CB_store(Request $request,Teacher $teacher,$course_id,$BC_id){
        $course = Course::find($course_id);
        $by_course = Course::find($BC_id);
        $courses = Auth::user() -> teacher -> courses() -> get() -> sortbyDESC('year');
        if($BC_id != $course_id){
            $by_course = Textbook::where('course_id',$BC_id) -> get();
            foreach ($by_course as $data){
                $to_course = new Textbook ;
                $to_course ->course_id = $course_id;
                $to_course -> name = $data -> name;
                $to_course-> path = $data -> path;
                $to_course -> save();
            }
        }

        return redirect() -> route('teacher.office.courses.text_materials',[$course_id]);
    }

    public function test(Request $request)
    {

        $request = User::find(Auth::id()) -> student() -> get();
        return $request;


//        return view('teacher.data');
    }


}
