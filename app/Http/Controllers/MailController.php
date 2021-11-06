<?php

namespace App\Http\Controllers;

use App\Mail\SendMail;
use App\Models\Course;
use App\Models\CourseStudent;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function index($course_id){

        $course = Course::find($course_id);
        $students = array();
        $course_student = CourseStudent::where('course_id',$course_id) -> get();
        if (count($course_student) > 0) {
            foreach ($course_student as $data){
                $students[] = Student::find($data -> student_id);
            }
        }else{
            return back() -> withStatus('該堂課尚未有修課學生');
        }
        $teacher = $course -> teacher ;
        // return $students;
        return view('mail.index',[
            'course' => $course,
            'students' => $students,
            'teacher' => $teacher,
        ]);
    }

    public function create(Request $request,$course_id,$receiver_id){
        $receiver = User::find($receiver_id);

        return view('mail.create',[
            'receiver' => $receiver,

        ]);
    }

    //送出mail
    public function store(Request $request,$course_id ,$receiver_id){
        $details = [
            'title' => $request -> title,
            'body' => $request -> body,
        ];
        $receiver = User::find($receiver_id);
        Mail::to($receiver -> email) -> send(new SendMail($details));

        return redirect() -> route('mail.index',[
            $course_id,
        ])-> withStatus("寄送訊息完成");
    }
}
