<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseStudent;
use App\Models\Department;
use App\Models\Notice;
use App\Models\Student;
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
    public function text_materials($course_id,$TM_id)
    {
        $courses = \App\Models\Course::all()-> sortByDesc('year');
        $course = Course::find($course_id);
        $textbooks = $course->textbooks()->get();

        return view('teacher.courses.text_materials',[
            'textbooks' => $textbooks,
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

    public function clone_create($course_id){
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

    //從...複製  --> 檢視教材
    public function clone_show(Request $request,Teacher $teacher,$course_id,$BC_id){
        $course = Course::find($course_id);
        $clone_by = Course::find($BC_id);
        $text_materials = $clone_by -> textbooks() -> get();

        return view('teacher.office.clone_by.show',[
            'text_materials' => $text_materials,
            'course' => $course,
            'clone_by' => $clone_by,
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

    public function create($department_id){
        $department = Department::find($department_id);

        return view('admin.department.courses.create',[
            'department' => $department ,

        ]);
    }

    public function store(Request $request,$department_id)
    {
        $request -> validate([
            'teacher_name' => 'required',
            'name' => 'required',
            'grade' => 'required',
            'classroom' => 'required',
        ]);

        //判段正確姓
        $courses1 = Course::all();
        $flag = 0 ;
        $max_year = $courses1 -> sortByDESC('year') -> first() -> year ;
        $max_semester = $courses1 -> where('yaer' , $max_year) -> sortByDesc('semester') -> first -> semester;

        //儲存資料
        $year = date('Y') - 1911;
        $month = date('m');
        if ($month > 6){
            $semester = 1;
        }else{
            $year = $year - 1;
            $semester = 2;
        }
        switch ($request -> grade){
            case 1:
                $CY = '一';
                break;
            case 2:
                $CY= '二';
                break;
            case 3:
                $CY = '三';
                break;
            case 4:
                $CY = '四';
                break;
        }
        $course = new Course;
        $course -> teacher_id = Teacher::where('user_id', User::where('name',$request -> teacher_name) -> first() -> id) -> first() -> id ;
        $course -> department_id = $department_id ;
        $course -> name = $request -> name;
        $course -> grade = $request -> grade;
        $course -> classroom = "四資" . $CY . $request -> classroom;
        $course -> year = $year;
        $course -> semester = $semester;
        $course -> save();

//        $courses2 = Course::all();
//        foreach ($courses2 as $data){
//            if (($data -> year) - 1 >= $max_year && $data -> semester >= $max_semester ){
//                $data -> delete();
//                return back() -> withErrors('overser!!' );
//            }
//        }

        $courses = Course::all();
        $department = Department::find($department_id);
        return redirect() -> route('department.courses_index',[$department_id]);
    }

    public function show(Course $course)
    {
        //
    }

    public function edit(Course $course,$department_id,$course_id)
    {
        $department = Department::find($department_id);
        $course = Course::find($course_id);
        $departments = Department::all();
        $i = 0;
        foreach ($departments as $data){
            if ($data -> id == $department_id){
                $count = $i;
            }
            $i ++;
        }
        unset($departments[$count]);
        $grades= [1,2,3,4];
        unset($grades[$course -> grade - 1]);
        return view('admin.department.courses.edit',[
            'course' => $course ,
            'department' => $department,
            'departments' =>$departments,
            'grades' => $grades,
        ]);
    }

    public function update(Request $request, Course $course,$department_id,$course_id)
    {
        $courses = Course::all() -> sortByDesc('year');
        $max_year =  $courses -> first() -> year ;
        $max_semester = $courses -> where('year' , $max_year) -> sortbyDesc('semester') -> first() -> semester ;
        $request -> validate([
            'teacher_name' => 'required',
            'department_name' => 'required',
            'course_name' => 'required',
            'grade' => 'required',
            'classroom' => 'required',
            'year' => 'required',
            'semester' => 'required',
        ]);
        if ($request -> year - 1 >= $max_year && $request -> semester >= $max_semester) {
            return back() -> withErrors(' ','over');
        }
        switch ($request -> grade){
            case 1:
                $CN = '一';
                break;
            case 2:
                $CN = '二';
                break;
            case 3:
                $CN = '三';
                break;
            case 4:
                $CN = '四';
                break;
        }

        $course = Course::find($course_id);
        $course -> teacher_id = Teacher::where('user_id', User::where('name',$request -> teacher_name) -> first() -> id) -> first() -> id ;
        $course -> department_id = Department::where('name' , $request -> department_name ) -> first() -> id ;
        $course -> name = $request -> course_name;
        $course -> grade = $request -> grade;
        $course -> classroom = '四' . mb_substr(Department::where('name' , $request -> department_name ) -> first() -> name,0,1,'utf-8') . $CN . mb_substr($request -> classroom,3,1,'utf-8');
        $course -> year = $request -> year;
        $course -> semester = $request -> semester;
        $course -> save();

        return redirect() -> route('department.courses_index',[$department_id]) -> withStatus('Update Success');
    }

    public function destroy(Course $course,$department_id,$course_id)
    {
        $course = Course::find($course_id);
        $course_student = CourseStudent::where('course_id', $course_id) -> get();
        if (count($course_student) > 0 ){
            return back()->withErrors('error');
        }

        $course -> delete();
        return back()->withstatus('success');
    }

    public function students($department_id,$course_id){
        $course = Course::find($course_id);
        $students = array();
        $course_student = CourseStudent::where('course_id',$course_id) -> get() ;
        if (count($course_student) > 0) {
            foreach ($course_student as $data){
                $students[] = Student::find($data -> student_id);
            }
        }else{
            return back() -> withStatus('該堂課尚未有修課學生');
        }
        $department = Department::find($department_id);
        $all_classroom = array();
        foreach ($students  as $data){
            $all_classroom[] =$data -> classroom;
        }

        return view('admin.department.courses.students',[
            'students' => $students,
            'course' => $course,
            'department' => $department,
            'all_classroom' => $all_classroom,
        ]);

    }

    //查找班級
    public function students_classroom($department_id,$course_id,$classroom){
        $course = Course::find($course_id);
        $students = array();
        $course_student = CourseStudent::where('course_id',$course_id) -> get() ;
        if (count($course_student) > 0) {
            foreach ($course_student as $data){
                $students[] = Student::find($data -> student_id);
            }
        }else{
            return back() -> withStatus('該堂課尚未有修課學生');
        }
        $department = Department::find($department_id);
        return $students;
        return view('admin.department.courses.students',[
            'students' => $students,
            'course' => $course,
            'department' => $department,
            'all_students' => $students,
        ]);

    }
}
