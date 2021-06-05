<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseStudent;
use App\Models\Student;
use App\Models\Ta;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $type= User::where('id', Auth::id())->value('type');
        if ($type=='學生'){
            session_start();
            unset($_SESSION['classId']);
            unset($_SESSION['textbookId']);
            unset($_SESSION['ta']);
            $tai=User::where('id',Auth::id())->value('id');
            $taui=Student::where('user_id',$tai)->value('id');
            $taci=Ta::where('student_id',$taui)->get();
//            dd($taci);

            $count=count($taci);

            $tac=array();
            $tacid=array();
            for($i=0;$i<$count;$i++){
                $course=$taci->pluck('course_id');
                $cname=Course::where('id', $course[$i])->value('name');
                $cid=Course::where('id', $course[$i])->value('id');
                array_push($tac,$cname);
                array_push($tacid,$cid);
            }

            return view('ta.index',['tacid'=>$tacid,'tac'=>$tac,'count'=>$count]);

        }
    }
    public function course(Request $request,$class)
    {
//        dd($class);
        $student = Student::where('user_id', $request->user()->id)->value('id');
        session_start();
        $classId=$_SESSION['class'];
        $_SESSION['class']=$class;

//
//        $course = Ta::where('student_id', $student)->value('course_id');
        $course=$class;
        $course_name=Course::where('id', $course)->value('name');
        $list=CourseStudent::where('course_id', $course)->where('student_id','!=',$student)->get();

        $count = count($list);

        $student_list=array();
        $stu_id=array();
        $classlist=array();
        for($i=0;$i<$count;$i++) {
            $student_id = $list->pluck('student_id');
            $user=Student::where('id', $student_id[$i])->where('id','!=',$student)->value('user_id');
            $sid =Student::where('id', $student_id[$i])->value('id');
            $class=Student::where('user_id', $user)->value('classroom');
            $stu=User::where('id', $user)->value('name');
            array_push($student_list,$stu);
            array_push($stu_id,$sid);
            array_push($classlist,$class);
        }
        return view('ta.course',['student_list'=>$student_list,'count'=>$count,'course_name'=>$course_name,'stu_id'=>$stu_id,'classlist'=>$classlist,'course'=>$course,'courses'=>$course,'classId'=>$classId]);

    }

    public function tacourse(Request $request,$class)
    {

//        dd($class);
        $tai=User::where('id',Auth::id())->value('id');
        $taui=Student::where('user_id',$tai)->value('id');
        $taci=Ta::where('student_id',$taui)->get();
//            dd($taci);

        $count=count($taci);

        $tac=array();
        $tacid=array();
        for($i=0;$i<$count;$i++){
            $course=$taci->pluck('course_id');
            $cname=Course::where('id', $course[$i])->value('name');
            $cid=Course::where('id', $course[$i])->value('id');
            array_push($tac,$cname);
            array_push($tacid,$cid);
        }

        return view('ta.tacourse',['tacid'=>$tacid,'tac'=>$tac,'count'=>$count,'class'=>$class]);

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($course_id)
    {
        // === $years寫入資料
        $courses = \App\Models\Course::all()-> sortByDesc('year');
        foreach ($courses->unique('year') as $course) {
            $years[] = $course -> year;
        }

        //使用該年度 抓取所有 該學期的 課程
        $courses_year = $courses_year = User::find(Auth::id())->teacher() -> first() -> courses()->get()
            ->where('year',$course -> year)->where('semester',$course -> semester)-> sortby('classroom');

        // 抓取該系所的所有學生
        $department_students = Course::find($course_id)->department() -> first()
            ->students()->get();

//        return $department_students;

        return view('teacher.office.courses.TA.create',[
            'courses_year' => $courses_year,
            'years' => $years,
            'course_id' => $course_id,
            'department_students'=>$department_students,
        ]);
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
     * @param  \App\Models\Ta  $ta
     * @return \Illuminate\Http\Response
     */
    public function show(Ta $ta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ta  $ta
     * @return \Illuminate\Http\Response
     */
    public function edit(Ta $ta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ta  $ta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ta $ta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ta  $ta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ta $ta)
    {
        //
    }

    // 老師與TA聯繫
    public function message($course_id)
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
            ->where('year',$course -> year)->where('semester',$course -> semester)-> sortby('classroom');

        return view('teacher.office.courses.TA.message',[
            'courses_year' => $courses_year,
            'notices' => $notices,
            'years' => $years,
            'course_id' => $course_id,
        ]);
    }
}
