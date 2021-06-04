<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseStudent;
use App\Models\Question;
use App\Models\Student;
use App\Models\Ta;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $student = Student::where('user_id', $request->user()->id)->value('id');

        $courses = Coursestudent::where('student_id', $student)->get();

        $count = count($courses);


        $name=array();
        $teacher=array();
        $subject=array();
        $semester=array();
        $year=array();
        $taid=array();
        for($i=0;$i<$count;$i++){
//            $courses = Coursestudent::where('student_id', $student)->value('id');
            $course=$courses->pluck('course_id');
//            echo $course[$i];
//            echo "抓到的課堂ID是：".$course;
            $ta=Ta::where('course_id', $course[$i])->value('student_id');

            $tastu=Student::where('id', $ta)->value('user_id');
            $taname=User::where('id', $tastu)->value('name');
            if($student===$ta){
            }else{
                array_push($name,$taname);
            }

            $teaid=Course::where('id', $course[$i])->value('teacher_id');
            $teauid=Teacher::where('id', $teaid)->value('user_id');
            $teaname=User::where('id', $teauid)->value('name');
            if($student===$ta){
            }else {
                array_push($teacher, $teaname);
            }
            $classname=Course::where('id', $course[$i])->value('name');
            if($student===$ta){
            }else {
                array_push($subject, $classname);
            }
            $seme=Course::where('id', $course[$i])->value('semester');
            if($student===$ta){
            }else {
                array_push($semester, $seme);
            }
            $ye=Course::where('id', $course[$i])->value('year');
            if($student===$ta){
            }else {
                array_push($year, $ye);
            }
            $tas=Ta::where('course_id', $course[$i])->value('id');
            if($student===$ta){
            }else {
                array_push($taid, $tas);
            }
        }

        $count2 = count($name);

        return view('questions.index',['name'=>$name,'count2'=>$count2,'teacher'=>$teacher,'class'=>$subject,'semester'=>$semester,'year'=>$year,'taid'=>$taid]);
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
        $this->validate($request, [
            'send' => 'required|max:255',
            'taid'=>'required',
            'studentid'=>'required',
            'classid'=>'required'
        ]);
        Question::create([
            'ta_id'=>$request->taid,
            'student_id'=>$request->studentid,
            'course_id'=>$request->classid,
            'title'=>"我覺得title沒有必要",
            'content'=>$request->send,
            'time'=>now(),
            //response
        ]);
        return redirect('questions/'.$request->taid);
    }
    public function tastore(Request $request)
    {
        $this->validate($request, [
            'send' => 'required|max:255',
            'stuid'=>'required',
            'taid'=>'required',
            'classid'=>'required'
        ]);
        Question::create([
            'ta_id'=>$request->taid,
            'student_id'=>$request->stuid,
            'course_id'=>$request->classid,
            'title'=>"我覺得title沒有必要",
            'content'=>$request->send,
            'time'=>now(),
            'response'=>"TA",
        ]);
        return redirect('ta/questions/'.$request->stuid);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
//        $question=Question::find($id);
        $student = Student::where('user_id', $request->user()->id)->value('id');
        $class=Ta::where('id', $id)->value('course_id');
        $questions=Question::where('ta_id', $id)->where('student_id', $student)->get();

        return view('questions.show',['questions'=>$questions,'id'=>$id,'student'=>$student,'class'=>$class]);

    }
    public function tashow(Request $request,$id){

        session_start();
//        dd($_SESSION['class']);

        $student=Student::where('id',$id)->value('id');
        $loginstudent = Student::where('user_id', $request->user()->id)->value('id');
//        $class=Ta::where('student_id', $loginstudent)->value('course_id');
        $class=$_SESSION['class'];
        $ta=Ta::where('student_id', $loginstudent)->value('id');
        $questions=Question::where('ta_id', $ta)->where('student_id', $id)->get();
        $classn=Course::where('id',$class)->value('name');

        return view('questions.tashow',['questions'=>$questions,'id'=>$id,'ta'=>$ta,'class'=>$class,'classn'=>$classn]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        //
    }

    public function class(Request $request,$ta)
    {
        session_start();
        $classId=$_SESSION['classId'];
        $student = Student::where('user_id', $request->user()->id)->value('id');
        $class=Ta::where('id', $ta)->value('course_id');
        $tastu=Ta::where('id', $ta)->value('student_id');
        $questions=Question::where('ta_id', $ta)->where('student_id', $student)->get();
        $id=$ta;
        if($student!==$tastu) {
            return view('questions.show', ['questions' => $questions, 'id' => $id, 'student' => $student, 'class' => $class,'classId'=>$classId]);
        }
        else
        {

            return back()->with('alert', '當前使用者為該課堂TA');
        }


//        return view('classes.index',['course'=>$course,'notices'=>$notices,'class'=>$class]);
    }
}
