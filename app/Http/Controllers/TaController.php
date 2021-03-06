<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseStudent;
use App\Models\Student;
use App\Models\Ta;
use App\Models\Teacher;
use App\Models\User;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaController extends Controller
{
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
        $classId=$class;
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

    public function create($course_id){
        // === $years寫入資料
        $courses = \App\Models\Course::all()-> sortByDesc('year');
        foreach ($courses->unique('year') as $course) {
            $years[] = $course -> year;
        }

        //使用該年度 抓取所有 該學期的 課程
        $course = Course::find($course_id);
        $courses_year = $courses_year = User::find(Auth::id())->teacher() -> first() -> courses()->get()
            ->where('year',$course -> year)->where('semester',$course -> semester)-> sortbyDesc('classroom');

        // 抓取該系所的所有學生
        $department_students = Course::find($course_id)->department() -> first()
            ->students()->get()
            ->sortbydesc('classroom');

        // 刪除已有TA的學生
        $TAs = TA::all();
        $flag = 0;
        foreach ($department_students as $data){
            foreach ($TAs as $TA){

                if($TA -> student_id == $data->id){

                    unset($department_students[$flag]);
                }
            }
            $flag ++;
        }
        //學號設定到$student_id
        foreach ($department_students as $department_student){
            $students_id[] = $department_student -> user() -> first() -> account;
        }
//        return $department_students;
        //抓取上下學期
        if($course -> semester == 1){
            $semester = '上學期';
        }else{
            $semester = '下學期';
        }

        return view('teacher.office.courses.TA.create',[
            'year_semester' => $course -> year . "學年度" . $semester,
            'courses_year' => $courses_year,
            'course_id' => $course_id,
            'department_students'=>$department_students,
        ]);
    }

    public function store(Request $request,$course_id,$student_id){
        $ta = new Ta();
        $ta -> student_id = $student_id;
        $ta -> course_id = $course_id ;
        $ta -> save();

        //回到TA列表
        return redirect(route('teacher.office.courses.TA_office',[$course_id,] ) ) ;

    }

    public function show(Ta $ta)
    {
        //
    }

    public function edit(Ta $ta)
    {
        //
    }


    public function update(Request $request, Ta $ta)
    {
        //
    }

    public function destroy(Ta $ta,$course_id,$ta_id)
    {
        $TA = Ta::find($ta_id);
        $TA -> delete();

        return redirect(route('teacher.office.courses.TA_office', [
            $course_id,
            ])
        );
    }

    // 老師與TA聯繫
    public function message($course_id,$student_id)
    {
        // === $years寫入資料
        $courses = \App\Models\Course::all()-> sortByDesc('year');
        foreach ($courses->unique('year') as $course) {
            $years[] = $course -> year;
        }

        //使用該年度 抓取所有 該學期的 課程
        $courses_year = User::find(Auth::id())->teacher() -> first() -> courses()->get()
            ->where('year',$course -> year)->where('semester',$course -> semester)-> sortbyDesc('classroom');

        //抓取上下學期
        if($course -> semester == 1){
            $semester = '上學期';
        }else{
            $semester = '下學期';
        }

        if(Auth::user() -> type == '老師'){
            $sender_type  = '老師';
        }else{
            $sender_type  = '學生';
        }
        $teacher_id = Course::find($course_id) -> teacher_id;
        $messages = Message::where('teacher_id',$teacher_id) -> where('student_id',$student_id) -> get() ;

        if ($sender_type == '老師'){
            $sender = Teacher::find($teacher_id);
            $receiver = Student::find($student_id);
        }else{
            $receiver= Teacher::find($teacher_id);
            $sender= Student::find($student_id);
        }

        return view('teacher.courses.TA.message',[
            'year_semester' => $course -> year . "學年度" . $semester,
            'courses_year' => $courses_year,
            'course_id' => $course_id,
            'messages' => $messages,
            'sender_type' => $sender_type,
            'course' => $course,
            'sender' => $sender,
            'receiver' => $receiver,

        ]);
    }

    // TA與老師聯繫
    public function TA_message($course_id)
    {
        //使用該年度 抓取所有 該學期的 課程
        $course = Course::find($course_id);
        $courses_year = $courses_year = User::find(Auth::id())->student() -> first() -> courses()->get()
            ->where('year',$course -> year)->where('semester',$course -> semester)-> sortbyDesc('classroom');
        $teacher = Course::find($course_id) -> teacher;
        $courses = Auth::user() -> student -> courses() -> get() -> sortbyDesc('year');

        //抓取上下學期
        if($course -> semester == 1){
            $semester = '上學期';
        }else{
            $semester = '下學期';
        }
        if(Auth::user() -> type == '老師'){
            $sender_type  = '老師';
        }else{
            $sender_type  = '學生';
        }
        $teacher_id = Course::find($course_id) -> teacher_id;
        $messages = Message::where('teacher_id',$teacher_id) -> where('student_id',Auth::user() -> student -> id) -> get() ;

        if ($sender_type == '老師'){
            $sender = Teacher::find($teacher_id);
            $receiver = Student::find(Auth::user() -> student -> id);
        }else{
            $receiver= Teacher::find($teacher_id);
            $sender= Student::find(Auth::user() -> student -> id);
        }

        return view('ta.message',[
            'teacher' => $teacher,
            'courses' =>$courses,
            'course' => $course,
            'receiver' => $receiver,
            'messages' => $messages,
            'sender' => $sender,
        ]);
    }

    //儲存訊息
    public function message_store(Request $request,$course_id,$recever_id){
        $message = new \App\Models\Message();
        if (Auth::user() -> type == '老師'){
            $message -> teacher_id = User::find(Auth::id())->teacher()
                ->first() -> id;
            $message -> student_id = $recever_id;
            $message -> content = $request -> message;
            $message -> sender = User::find(Auth::id())->type;
            $message -> save();
        }else{
            $message -> teacher_id = $recever_id;
            $message -> student_id = Auth::user() -> student -> id;
            $message -> content = $request -> message;
            $message -> sender = User::find(Auth::id())->type;
            $message -> save();
        }


        return back();

    }
}
